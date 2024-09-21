<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUpdateRequest;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    function formatCurrency($amount)
    {
        if ($amount >= 1000 && $amount < 1000000) {
            return number_format($amount / 1000, 1) . 'K'; // ألف
        } elseif ($amount >= 1000000) {
            return number_format($amount / 1000000, 1) . 'M'; // مليون
        } else {
            return number_format($amount, 2); // أقل من ألف
        }
    }

    public function dashboard()
    {
        // Get the total sales balance by summing up all the payments.
        $balance = Payment::sum('amount');

        // Format the sales balance as a currency for display.
        $formatted_balance = $this->formatCurrency($balance);

        // Get the number of orders that have been successfully delivered.
        $orders_count = Order::where('status', 'delivered')->count();

        // Calculate the average order value by dividing the total sales balance by the number of delivered orders.
        $AVG_orders = $balance / $orders_count;

        // Format the average order value to two decimal places.
        $AVG_orders = number_format($AVG_orders, 2);

        // Count the number of customers (users with the role 'customer').
        $customer_count = User::where('rule', 'customer')->count();

        // Calculate today's total sales balance by summing all payments made today.
        $today_sales = Payment::whereDate('created_at', now())->sum('amount');

        // Calculate the total sales balance for the current month.
        $monthly_sales = Payment::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        // Format the monthly sales balance as a currency for display.
        $formatted_monthly_sales = $this->formatCurrency($monthly_sales);

        // Count the number of customers who were active today (based on their last activity date).
        $today_visitor = User::whereDate('last_activity', now())
            ->where('rule', 'customer')
            ->count();

        // Count the number of customers who were active yesterday.
        $yesterday_visitor = User::whereDate('last_activity', now()->subDay())
            ->where('rule', 'customer')
            ->count();

        // Pass all the variables to the view and render the admin dashboard.
        return view("admin.index", get_defined_vars());
    }

    public function viewAdmins()
    {
        $id = Auth::user()->id;

        $admins = User::where(function ($query) {
            $query->where('rule', 'admin')
                ->orWhere('rule', 'super_admin');
        })
            ->where('id', '!=', $id)
            ->where('rule', '!=', 'super_admin')
            ->paginate(25);

        return view('admin.admins.view_admins', get_defined_vars());
    }

    public function createAdmin()
    {
        return view('admin.admins.add_new');
    }

    public function destroyAdmin($encryptedId)
    {
        $adminId = Crypt::decrypt($encryptedId);

        $admin = User::findOrFail($adminId);

        $adminName = $admin->username;

        $admin->delete();

        return to_route('admin.viewAll')->with("success", "Admin $adminName Deleted Successfully");
    }

    public function show_admin(User $admin)
    {
        return view('admin.admins.show_admin', get_defined_vars());
    }

    public function edit_admin(User $admin)
    {
        return view('admin.admins.edit_admin', get_defined_vars());
    }

    public function updateAdmin(AdminUpdateRequest $request)
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

        return to_route('admin.viewAll')->with("success", "Admin Updated Successfully");
    }


    public function searchAdmin(Request $request)
    {
        $request->validate([
            'admin_search' => 'required|numeric|exists:users,id',
        ]);

        $admin_id = $request->input('admin_search');
        $admin = User::where('id', $admin_id)->where('rule', '!=', 'customer')->first();

        return to_route('admin.viewSpecificAdmin', ['admin' => $admin]);
    }


    public function viewSpecificAdmin(User $admin)
    {
        return view('admin.admins.view_specific_admin', get_defined_vars());
    }
}
