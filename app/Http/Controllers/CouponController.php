<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::paginate(10);

        return view('admin.coupons.view_coupons', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupons.create_coupon');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponRequest $request)
    {
        $validatedData = $request->validated();

        Coupon::create($validatedData);

        return to_route('admin.coupons.index')->with('success', 'Coupon Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view("admin.coupons.edit_coupon", get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        $validatedData = $request->validated();
        
        $coupon->update($validatedData);
        
        return to_route('admin.coupons.index')->with('success', 'Coupon Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        
        return to_route('admin.coupons.index')->with('success', 'Coupon Deleted Successfully');
    }
}
