<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerUpdateRequest;
use App\Http\Requests\StoreconversationRequest;
use App\Models\conversation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CustomerController extends Controller
{

    public function viewCustomers()
    {
        $customers = User::where('rule', 'customer')->paginate(25);


        return view('customers.view_customers', get_defined_vars());
    }

    public function show_customer(User $customer)
    {
        return view('customers.show_customer', get_defined_vars());
    }

    public function edit_customer(User $customer)
    {
        return view('customers.edit_customer', get_defined_vars());
    }

    public function updateCustomer(CustomerUpdateRequest $request)
    {

        $validatedData = $request->validated();

        $adminId = $validatedData['id'];

        if (empty($validatedData['password'])) {
            unset($validatedData['password']);
        } else {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        unset($validatedData['id']);

        User::find($adminId)->update($validatedData);

        return to_route('admin.viewAllCustomers')->with("success", "Customer Updated Successfully");
    }

    public function destroyCustomer($encryptedId)
    {
        $customerId = Crypt::decrypt($encryptedId);
        
        $customer = User::findOrFail($customerId);

        $customerName = $customer->username;

        $customer->delete();

        return to_route('admin.viewAllCustomers')->with("success", "Customer $customerName Deleted Successfully");
    }

    public function activeCustomers()
    {

        $activeCustomers = User::where('last_activity', '>=', Carbon::now()->subMinutes(15))->where('rule', 'customer')->paginate(25);

        return view("customers.activeCustomers", get_defined_vars());
    }

    public function inactiveCustomers()
    {

        $threshold = Carbon::now()->subDays(90);

        $inactiveCustomers = User::where('rule', 'customer') 
        ->where(function ($query) use ($threshold) {
            $query->where('last_activity', '<', $threshold)
                  ->orWhereNull('last_activity');
        })
        ->paginate(25);

        return view("customers.inActiveCustomers", get_defined_vars());
    }

    public function searchCustomer(Request $request) {
        $request->validate([
            'customer_search' => 'required|numeric|exists:users,id',
        ]);

        $customer_id = $request->input('customer_search');
        $customer = User::where('id', $customer_id)->where('rule', 'customer')->first();

        return to_route('admin.viewSpecificCustomer', ['customer' => $customer]);
    }

    
    public function viewSpecificCustomer(User $customer) {
        return view('customers.view_specific_customer', get_defined_vars());
        
    }

        /**
     * Display a listing of the resource.
     */
    public function conversations()
    {
        if(Auth::user()->rule == 'admin' || Auth::user()->rule == 'super_admin') {
            return back();
        }
        
        $conversation_messages = Conversation::where('conversation_id', Auth::user()->id)->orderBy('sent_at', 'asc')->get();
        return view('front.chats.chat', get_defined_vars());
    }


    public function storeCustomerMessage(Request $request)
    {
        $message = $request->validate([
            'message' => 'string|required',
        ]);

        conversation::create([
            'conversation_id' => Auth::user()->id,
            'sender_id' => Auth::user()->id, // Authenticated user ID
            'message' => $message['message'],
            'status' => 'sent',
            'is_customer' => 1, // Assuming there is a column in the users table

        ]);

        return back();
        
    }

}
