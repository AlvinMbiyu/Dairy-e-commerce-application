<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\Delivery;
use App\Models\Deliveryperson;
use App\Models\dpayment;
use App\Models\DPpricing;
use App\Models\drequests;
use App\Models\FarmerGroups;
use App\Models\Farmers;
use App\Models\MilkCollection;
use App\Models\Retailers;
use App\Models\rrequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DeliverCont extends Controller
{
    //
    public $del;

    public function showr()
    {
        return view('deliveryperson/dregister');
    }

    public function showl()
    {
        return view('deliveryperson/dlogin');
    }

    public function dashboard()
    {
        return view('deliveryperson/dashboard');
    }

    public function profile()
    {
        return view('deliveryperson/dprofile');
    }

    public function authRegister(Request $request)
    {


        $del = new Deliveryperson();
        $del->Did = $request->National_id;
        $del->Name = $request->Name;
        $del->county_id = $request->County;
        $del->sc_id = $request->subCounty;
        $del->town_id = $request->Town;
        $del->email = $request->email;
        $del->age = $request->age;
        $del->Phone_no = $request->phone;
        $del->Op_vehicle = $request->vehicle;
        $del->vehicle_no = $request->vehicle_no;
        $del->password = Hash::make($request->password);
        $del->save();

        Auth::guard('delivery_person')->login($del);
        return redirect('delivery-person/login')->with('status', "Your account is created successfully.");
    }

    public function auth(Request $request)
    {
        // Validate the form data
        $credentials =  $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::guard('delivery_person')->attempt($credentials)) {
            $dp = Auth::guard('delivery_person')->user();

            return redirect('/delivery-person/dashboard');
        }

        // Failed login
        return redirect('/delivery-person/login')->withErrors([
            'email' => 'Invalid email or password',
        ]);
    }

    public function viewrequests(Request $request)
    {
        $group = auth()->guard('farmer')->user();
        $rr = drequests::where('Gid', $group->Gid)->get();

        return view('deliveryperson/requestlist', ['Rrequests' => $rr]);
    }

    public function acceptrequest(Request $request)
    {
        $drequest = drequests::findOrFail($request->id);
        $drequest->response = 1;
        $drequest->save();

        return redirect('delivery-person/pick-up');
    }

    public function viewFMCP(Request $request)
    {
        $counties = County::all();
        $fa = auth()->guard('farmer')->user();

        $countyId = $request->County;
        $subcountyId = $request->subCounty;
        $townId = $request->Town;
        $dr = drequests::query();
        if ($fa) {
            $dr->where('Gid', $fa->Gid);
        }
        $farmers = Farmers::query();

        if ($countyId) {
            $farmers->where('county_id', $countyId);
        }

        if ($subcountyId) {
            $farmers->where('sc_id', $subcountyId);
        }

        if ($townId) {
            $farmers->where('town_id', $townId);
        }
        if ($fa) {
            $farmers->where('Gid', $fa->Gid);
        }
        $drs = $dr->get();
        $farmers = $farmers->get();
        return view('deliveryperson/pickup', ['County' => $countyId, 'subCounty' => $subcountyId, 'Town' => $townId, 'farmers' => $farmers, 'drs' => $drs]);
    }

    public function inputcollectiondata(Request $request)
    {
        $rr = new MilkCollection();
        $rr->DRid = $request->DRid;
        $rr->Fid = $request->Fid;
        $rr->Gid = $request->Gid;
        $rr->amount_produced = $request->amount_produced;
        $rr->pickup_confirmation = 0;
        $rr->save();
        return redirect('delivery-person/deliver');
    }

    public function viewdeliveryloc()
    {
        
        $ret = auth()->guard('retailers')->user();
        $del = auth()->guard('delivery_person')->user();

        $dppricing = DPpricing::all()->first();

        $rr = rrequests::query();
        if ($ret) {
            $rr->where('Rid', $ret->Rid);
        }

        $rrequests = $rr->get();
        return view('deliveryperson/deliverloc', [ 'rrequests' => $rrequests, 'dppricing' => $dppricing]);
    }

    public function inputAD(Request $request)
    {
        $delivery = new Delivery();
        $delivery->Gid = $request->Gid;
        $delivery->dppid = $request->dppid;
        $delivery->RRid = $request->RRid;
        $delivery->amount_delivered = $request->amount_delivered;
        $delivery->delivery_confirmation = 0;
        $delivery->save();
        return redirect('/deliveryperson/viewpayments');
    }

    public function viewpayments()
    {
        $payments = dpayment::where('Did', auth('delivery_person')->id())->get();
        return view('deliveryperson/payments', ['payments' => $payments]);
    }

    public function confirmpayment(Request $request)
    {
        $drequest = drequests::findOrFail($request->id);
        $drequest->response = 1;
        $drequest->save();

        return redirect('delivery-person/dashboard');
    }
}
