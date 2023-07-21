<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\Delivery;
use App\Models\dpayment;
use App\Models\DPpricing;
use App\Models\drequests;
use App\Models\FarmerGroups;
use App\Models\Farmers;
use App\Models\fpayment;
use App\Models\MilkCollection;
use App\Models\Payment;
use App\Models\Retailers as ModelsRetailers;
use App\Models\rrequests;
use App\Morets\Retailers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RetailCont extends Controller
{
    //
    public $ret;

    public function showr()
    {
        return view('retailer/Rregister');
    }

    public function showl()
    {
        return view('retailer/Rlogin');
    }

    public function dashboard()
    {
        return view('retailer/dashboard');
    }

    public function profile()
    {
        return view('retailer/rprofile');
    }

    public function authRegister(Request $request)
    {


        $ret = new ModelsRetailers();
        $ret->Rid = $request->National_id;
        $ret->Name = $request->Name;
        $ret->county_id = $request->County;
        $ret->sc_id = $request->subCounty;
        $ret->town_id = $request->Town;
        $ret->email = $request->email;
        $ret->age = $request->age;
        $ret->Phone_no = $request->phone;
        $ret->BName = $request->BName;
        $ret->password = Hash::make($request->password);
        $ret->save();
        Auth::guard('retailer')->login($ret);
        return redirect('retailer/login')->with('status', "Your account is created successfully.");
    }

    public function auth(Request $request)
    {
        // Validate the form data
        $credentials =  $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::guard('retailers')->attempt($credentials)) {
            // Successful login
            return redirect('/retailer/dashboard');
        }

        // Failed login
        return redirect('/retailer/login')->withErrors([
            'email' => 'Invalid email or password',
        ]);
    }

    public function buymilk(Request $request)
    {
        $counties = County::all();

        $countyId = $request->County;
        $subcountyId = $request->subCounty;
        $townId = $request->Town;
    
        $farmerGroups = FarmerGroups::query();
    
        if ($countyId) {
            $farmerGroups->where('county_id', $countyId);
        }
    
        if ($subcountyId) {
            $farmerGroups->where('sc_id', $subcountyId);
        }
    
        if ($townId) {
            $farmerGroups->where('town_id', $townId);
        }
    
        $farmerg = $farmerGroups->get();

        // Pass the retailer and other data to the view
        return view('retailer.viewfgroups', ['County'=>$countyId, 'subCounty'=>$subcountyId, 'Town'=>$townId, 'farmerg'=>$farmerg]);
    }

    public function order(Request $request)
    {
        $rr = new rrequests();
        $rr->Rid = Auth::guard('retailers')->id();
        $rr->Gid = $request->Gid;
        $rr->demand_required = $request->demand;
        $rr->response = 0;
        $rr->save();
        return redirect('retailer/viewdeliveries');
    }

    public function view_delivery(Request $request)
    {
        $ret = auth('retailers')->user();
        $rr = rrequests::all()->where('Rid','=', $ret->id);
        $del = Delivery::all();
        return view('retailer/deliveries', ['deliveries' => $del]);
    }

    public function confirm_delivery(Request $request)
    {
        $drequest = Delivery::findOrFail($request->id);
        $drequest->delivery_confirmation = 1;
        $drequest->save();

        return redirect('retailer/viewtransactions');
    }

    public function makePayment(Request $request)
    {

        // Calculate the delivery person's cut
        $deliveryPersonAmount = $request->total_amount * 0.1;
        $farmersAmount = $request->amount - $deliveryPersonAmount;

        // Create the payment record in the payments table
        $payment = Payment::create([
            'Rid' => $request->Rid,
            'Gid' => $request->GID,
            'delivery_id' => $request->ddid,
            'total_price' => $request->total_amount,
            'payment_confirmation' => 0, // You can set the payment confirmation status as needed.
        ]);

        // Create the dpayment record in the dpayment table
        $del_id = auth('delivery_person')->id();
        $dpayment = dpayment::create([
            'Did' => $del_id,
            'Gid' => $request->GID,
            'delivery_id' => $request->ddid,
            'total_dprice' => $deliveryPersonAmount,
            'payment_confirmation' => 0, // Set the payment confirmation status as needed.
        ]);

        // Get the milk collections for the farmer group
        $milkCollections = MilkCollection::where('Gid', $request->GID)->get();
        $fgps = FarmerGroups::where('id', $request->GID)->get();
        // Distribute the farmers' payments based on the amount of milk produced
        foreach($fgps as $fgp){
        foreach ($milkCollections as $milkCollection) {
            $individualPayment = ($milkCollection->amount_produced / $farmersAmount) * $farmersAmount;
            fpayment::create([
                'Fid' => $milkCollection->Fid,
                'MCid' => $milkCollection->id,
                'pid' => $payment->id,
                'Gid' => $request->GID,
                'income' => $individualPayment * $fgp->price_per_litre,
                'Payment_confirmation' => 0, // Set the payment confirmation status as needed.
            ]);
        }}

        return redirect('retailer/dashboard');

    }

    public function viewpaymentsmade()
    {
        $ret = auth('retailers')->user();
        $transactions = Payment::all()->where('Rid', '=', $ret->Rid);
        return view('retailer/transactions', ['transactions' => $transactions]);
    }
}
