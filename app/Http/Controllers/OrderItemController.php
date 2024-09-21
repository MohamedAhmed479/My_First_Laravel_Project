<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{

    public static function addProducts(Order $order, Product $product, $quantity)
    {
        // Check if the product already exists in the order by querying the OrderItem table
        $order_product = OrderItem::where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->first();

        // If the product is not already in the order, create a new order item
        if ($order_product == null) {
            // Create a new order item with the order and product details
            OrderItem::create([
                'order_id' => $order->id,                // Assign the order ID
                'product_id' => $product->id,            // Assign the product ID
                'price' => $product->price,              // Set the product price
                'quantity' => $quantity,                 // Set the quantity of the product
                'amount' => $quantity * $product->price, // Calculate the total amount (quantity * price)
            ]);

            // Calculate the money added to the order for this new item
            $new_money = $quantity * $product->price;
        } else {
            // If the product already exists in the order, update the quantity and amount
            $old_quantity = $order_product->quantity;   // Get the current quantity of the product in the order
            $new_quantity = $old_quantity + $quantity;  // Calculate the new quantity

            // Update the existing order item with the new quantity and updated amount
            $order_product->update([
                'quantity' => $new_quantity,                 // Update the quantity in the order item
                'amount' => $new_quantity * $product->price, // Update the total amount for this product
            ]);

            // Calculate the money added to the order for the additional quantity
            $new_money = $quantity * $new_quantity * $product->price;
        }

        // Return the total amount added to the order
        return $new_money;
    }



    
}
