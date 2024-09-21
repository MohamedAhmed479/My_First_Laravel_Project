<?php

namespace App\Traits;

use App\Models\Order;

trait OrderTrait {

    public function getAndValidateQuantity($request, $product) {
        // Check if the request contains a 'quantity' field
        if ($request->has('quantity')) {
            // Validate the quantity, ensuring it is numeric and less than the available product stock
            $request->validate([
                'quantity' => "nullable|numeric|lt:".$product->stock+ 1,  // Quantity must be less than the product's stock
            ], [
                // Custom error message for when the quantity exceeds available stock
                'quantity.lt' => "We have $product->stock item(s) right now",  
            ]);
    
            // If the 'quantity' input is not null or empty, use it as the new quantity
            if ($request->input('quantity')) {
                $new_quantity = $request->input('quantity');
                return $new_quantity;
    
            } else {
                // If the quantity is null or empty, default to 1
                return 1;
            }
            
        } else {
            // If the request doesn't contain 'quantity', default to 1
            return 1;
        }
    }
    

    public function findOrMakeOrder($customer_id) {
        // Search for an existing order for the given customer that has the status 'in_the_cart'
        $order = Order::where('customer_id', $customer_id)->where('status', 'in_the_cart')->first();
    
        // Check if the order doesn't exist (customer has no active cart order)
        if ($order == null) {
            // Customer doesn't have an order "in the cart" status, so create a new one
            Order::create([
                'customer_id' => $customer_id,  // Assign the customer ID to the order
                'status' => 'in_the_cart',      // Set the status of the order to 'in_the_cart'
                'total' => 0,                   // Initialize the total amount to 0
            ]);
    
            // After creating the order, retrieve it again to get the ID
            $order = Order::where('customer_id', $customer_id)->where('status', 'in_the_cart')->first();
            $orderId = $order->id;  // Get the order ID of the newly created order
        } else {
            // If the order exists, simply get the order ID of the existing order
            $orderId = $order->id;
        }
    
        // Return the found or newly created order
        return $order;
    }
    
}

?>