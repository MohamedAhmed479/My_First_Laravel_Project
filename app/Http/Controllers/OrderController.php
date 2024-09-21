<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Coupon;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Traits\OrderTrait;
use Carbon\Carbon;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class OrderController extends Controller
{
    use OrderTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Auth::check()) {
            return to_route('login');
        }
        // Will go to the cart
        $customer_id = Auth::user()->id;
        $order = Order::where('customer_id', $customer_id)->where('status', 'in_the_cart')->first();
        if ($order != null) {
            $products = $order->products;
            $subtotal = $order->total;
            $shipping = 50;
            $tax = $subtotal * 14 / 100;


            if ($order->coupon_id != null) {
                // Net total
                $percentage = $order->coupon->percentage;
                $coupon_discount_value = $order->total * $percentage / 100;

                $new_total_order = $order->total - $coupon_discount_value;

                // Net total
                $net_total = $new_total_order;

                $tax = $net_total * 14 / 100;

                $net_total = $net_total + $tax + $shipping;
            } else {
                $net_total = $subtotal + $shipping + $tax;
            }

            $order->update([
                'net_total' => $net_total,
            ]);
        }

        return view('front.cart', get_defined_vars());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        if(Auth::user()->rule == 'admin' || Auth::user()->rule == 'super_admin') {
            return back();
        }

        // Get the current logged-in user's ID (customer ID)
        $customer_id = Auth::user()->id;

        // Find an existing 'in the cart' order for the customer or create a new one if it doesn't exist
        // This ensures the customer has an active cart to add products to
        $order = $this->findOrMakeOrder($customer_id);

        // Validate and retrieve the product quantity from the request
        // If no quantity is specified, default to 1
        $new_quantity = $this->getAndValidateQuantity($request, $product);

        // Check if the product already exists in the order
        $product_in_order_item = OrderItem::where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->first();

        // If the product is already in the order, ensure the total quantity doesn't exceed stock
        if ($product_in_order_item != null) {
            // Check if the new quantity plus the existing quantity in the order exceeds the product stock
            if ($new_quantity + $product_in_order_item->quantity > $product->stock) {
                // Return an error message if the requested quantity exceeds available stock
                return back()->with('error-message', "We have $product->stock item(s) right now");
            }
        }

        // Add the product to the order or update the quantity if it already exists in the order
        // Returns the total cost of the added/updated product(s)
        $total_products = OrderItemController::addProducts($order, $product, $new_quantity);

        // Calculate the new total order value by adding the cost of the new products to the current total
        $total_order = $order->total + $total_products;

        // Update the total value of the order in the database
        $order->update([
            'total' => $total_order,
        ]);

        // Redirect back to the previous page (e.g., the product page or cart)
        return back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($order_id, $product_id)
    {
        $order_id = Crypt::decrypt($order_id);
        $product_id = Crypt::decrypt($product_id);

        $order_item = OrderItem::where('order_id', $order_id)->where('product_id', $product_id)->first();
        $order_item_price = $order_item->price;

        $order_item->update([
            'quantity' => $order_item->quantity - 1,
        ]);

        $order = Order::find($order_id);
        $order->update([
            'total' => $order->total - $order_item_price,
        ]);

        if ($order_item->quantity == 0) {
            $order_item->delete();
        }
        return back();
    }

    public function applyCoupon(Request $request, Order $order)
    {
        $request->validate([
            'coupon_code' => 'required|string|max:100|exists:coupons,code',
        ]);

        $user_coupon = $request->input('coupon_code');

        $coupon = Coupon::where('code', $user_coupon)->first();


        $order->update([
            'coupon_id' => $coupon->id,
        ]);

        return back()->with("success", "Coupon added successfully");
    }

    public function confirmOrder(Order $order)
    {

        $customer = Auth::user();
        return view("front.confirmOrder", get_defined_vars());
    }

    public function processing(Order $order)
    {

        $order_items = OrderItem::where('order_id', $order->id)->get();

        foreach ($order_items as $item) {
            $quantity = $item->quantity;
            $product_id = $item->product_id;

            $product = Product::find($product_id);
            $stock = $product->stock;

            $new_stock = $stock - $quantity;

            $product->update([
                'stock' => $new_stock,
            ]);
        }

        $order->update([
            'status' => 'processing',
        ]);

        return view('front.loading_page');
    }

    // الصفحه دي علشان المستخدم يرجه ويشوف تفاصيل الطلب بتاعه
    public function details(Order $order)
    {
        $customer = Auth::user();

        return view('front.order-details', get_defined_vars());
    }

    public function allOrders()
    {
        $orders = Order::where('customer_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('front.orders', get_defined_vars());
    }

    // ========================================
    // ADMIN FUNCTIONS 
    public function viewAll()
    {
        $orders = Order::where('status', '!=', 'in_the_cart')->orderBy('created_at', 'desc')->paginate(15);

        return view("admin.orders.view_orders", get_defined_vars());
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('admin.orders.show_order', get_defined_vars());
    }


    public function cancelOrder(Order $order)
    {
        // We need to return the products in this order.
        $order_items = OrderItem::where("order_id", $order->id)->get();


        if(count($order_items) > 0) {
            foreach ($order_items as $order_item) {
                $order_item_quantity = $order_item->quantity;
                $order_item_id = $order_item->product_id;

                $product = Product::find($order_item_id);

                $product->update([
                    'stock' => $product->stock + $order_item_quantity,
                ]);

            }
        }

        $order->update([
            'status' => 'cancelled',
            'delivery_time' => null,
        ]);
        
        return back()->with('success', 'Order Cancelled Successfully');
    }

    public function deleteOrder(Order $order)
    {
        $order->delete();

        return to_route('admin.viewAllOrders')->with('success', 'Order Deleted Successfully');
    }

    public function showOrderItems(Order $order)
    {
        $order_items = OrderItem::where('order_id', $order->id)->paginate(10);

        return view('admin.orders.show_order_items', get_defined_vars());
    }

    public function viewCancelledOrders()
    {

        $cancelledOrders = Order::where('status', 'cancelled')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.orders.view_cancelled_orders', get_defined_vars());
    }

    public function processingOrders()
    {
        $processingOrders = Order::where('status', 'processing')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.view_processing_orders', get_defined_vars());
    }

    public function shippingOrders(Request $request)
    {

        $request->validate([
            'arrival_date' => 'required|date|after_or_equal:today',
        ]);
        $delivery_time = $request->input('arrival_date');

        $orders = Order::where('status', 'processing')->get();

        if (count($orders) > 0) {
            foreach ($orders as $order) {
                $order->update([
                    'status' => 'shipped',
                    'delivery_time' => $delivery_time,
                ]);

                // here create a new payment for any order 
                Payment::create([
                    'user_id' => $order->customer_id,
                    'order_id' => $order->id,
                    'amount' => $order->net_total,
                ]);
            }
        } else {
            return back();
        }

        return back()->with('success', 'The orders have been successfully Shipped.');
    }

    public function shippedOrders()
    {
        $shippedOrders = Order::where('status', 'shipped')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.view_shipped_orders', get_defined_vars());
    }

    public function deliveredAndPaid(Order $order) {

        $order->update([
            'delivery_time' => Carbon::now(),
            'status' => 'delivered',
        ]);

        $payment_record = Payment::where('order_id', $order->id)->first();
        $payment_record->update([
            'amount' => $order->net_total,
            'payment_status' => 'successful',
            'payment_date' => Carbon::now(),
        ]);

        return back()->with('success', 'The Order has been successfully deilvered.');
        
    }

    public function showDeliveredOrders() {
        $deliveredOrders = Order::where('status', 'delivered')->orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.orders.view_delivered_orders', get_defined_vars());

    }

    public function searchOrder(Request $request) {
        $request->validate([
            'order_search' => 'required|numeric|exists:orders,id',
        ]);

        $order_id = $request->input('order_search');
        $order = Order::where('id', $order_id)->first();

        return to_route('admin.viewSpecificOrder', ['order' => $order]);
    }

    public function viewSpecificOrder(Order $order) {
        return view('admin.orders.view_specific_order', get_defined_vars());
    }

    public function viewCustomersOrders(User $customer) {
        $orders = $customer->orders;

        return view('admin.orders.view_customer_orders', get_defined_vars());
    }


}
