<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\avg_amount;
use App\Models\County;
use App\Models\Deliveryperson;
use App\Models\drequests;
use App\Models\FarmerGroups;
use App\Models\Farmers;
use App\Models\fpayment;
use App\Models\Livestock;
use App\Models\LivestockType;
use App\Models\MilkCollection;
use App\Models\Retailers;
use App\Models\rrequests;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class FarmerCont extends Controller
{

    public $fa;

    public function showr()
    {
        return view('farmer/fregister');
    }

    public function showl()
    {
        return view('farmer/flogin');
    }

    public function dashboard()
    {
        return view('farmer/dashboard');
    }

    public function profile()
    {
        $livt = LivestockType::all();
        $avg = avg_amount::where('Fid', auth('farmer')->id())->get();
        return view('farmer/fprofile', ['averages' => $avg, 'livts' => $livt]);
    }

    public function authRegister(Request $request)
    {


        $fa = new Farmers();
        $fa->Fid = $request->National_id;
        $fa->Name = $request->Name;
        $fa->county_id = $request->County;
        $fa->sc_id = $request->subCounty;
        $fa->town_id = $request->Town;
        $fa->email = $request->email;
        $fa->age = $request->age;
        $fa->Phone_no = $request->phone;
        $fa->password = Hash::make($request->password);
        $fa->save();

        Auth::guard('farmer')->login($fa);
        return redirect('farmer/login')->with('status', "Your account is created successfully.");
    }

    public function auth(Request $request)
    {
        // Validate the form data
        $credentials =  $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::guard('farmer')->attempt($credentials)) {
            $farmer = Auth::guard('farmer')->user();

            if ($farmer->Gid) {
                // Farmer has a farmer group ID, redirect to farmer group dashboard
                return redirect('/farmergroup/dashboard');
            } else {
                // Farmer does not have a farmer group ID, redirect to normal dashboard
                return redirect('/farmer/dashboard');
            }

            // Failed login
            return redirect('/farmer/login')->withErrors([
                'email' => 'Invalid email or password',
            ]);
        }
    }

    public function viewrequests($id)
    {
        $group = FarmerGroups::find($id);
        $rr = rrequests::where('Gid', $id)->get();

        if ($group)
            return view('farmer/requestlist', ['group' => $group, 'rr' => $rr]);
        else
            return view('farmer/requestlist');
    }

    public function viewGroups(Request $request)
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
        return view('farmer.groups', ['County' => $countyId, 'subCounty' => $subcountyId, 'Town' => $townId, 'farmerg' => $farmerg]);
    }

    public function joinGroup(Request $request)
    {
        $farmer =  Auth::guard('farmer')->user();
        $farmer->Gid = $request->Gid;
        $farmer->save();
        return redirect('farmergroup/dashboard');
    }

    public function FgDashboard()
    {
        return view('farmer/farmergroup/dashboard');
    }

    public function viewRrequests(Request $request)
    {
        $group = auth()->guard('farmer')->user();
        $rr = rrequests::where('Gid', $group->Gid)->get();

        if ($group->Gid)
            return view('farmer/farmergroup/requestlist', ['Rrequests' => $rr]);
        else
            return redirect('farmer/farmergroup/requestlist');

        return view('farmer/farmergroup/requestlist');
    }

    public function confirm_Rrequest(Request $request)
    {
        $rrequest = rrequests::findOrFail($request->id);
        $rrequest->response = 1;
        $rrequest->save();

        return redirect('/farmergroup/view-dp');
    }

    public function deliveryrequest(Request $request)
    {
        $rr = new drequests();
        $far = Auth::guard('farmer')->user();
        $rr->Gid = $far->Gid;
        $rr->Did = $request->Did;
        $rr->est_amount = $request->est_amount;
        $rr->response = 0;
        $rr->save();
        return redirect('/farmergroup/view-milkproduction');
    }

    public function viewDeliveryservices(Request $request)
    {
        $counties = County::all();

        $countyId = $request->County;
        $subcountyId = $request->subCounty;
        $townId = $request->Town;

        $dpss = Deliveryperson::query();

        if ($countyId) {
            $dpss->where('county_id', $countyId);
        }

        if ($subcountyId) {
            $dpss->where('sc_id', $subcountyId);
        }

        if ($townId) {
            $dpss->where('town_id', $townId);
        }

        $dps = $dpss->get();
        return view('farmer/farmergroup/deliveryservices', ['County' => $countyId, 'subCounty' => $subcountyId, 'Town' => $townId, 'dps' => $dps]);
    }

    public function viewmilkproduction()
    {
        $fa = auth()->guard('farmer')->user();
        $mc = MilkCollection::query();
        if ($fa) {
            $mc->where('Fid', $fa->Fid);
        }
        $rr = $mc->get();
        return view('farmer/farmergroup/milkcollection', ['MilkCs' => $rr]);
    }

    public function confirm_MC(Request $request)
    {
        $rrequest = MilkCollection::findOrFail($request->id);
        $rrequest->pickup_confirmation = 1;
        $rrequest->save();

        return view('farmer/farmergroup/viewpayments');
    }

    public function viewpayments()
    {
        $fa = auth()->guard('farmer')->user();
        $mc = fpayment::query();
        if ($fa) {
            $mc->where('Fid', $fa->Fid);
        }
        $rr = $mc->get();
        return view('farmer/farmergroup/viewpayments', ['Rrequests' => $rr]);
    }

    public function confirmpayment(Request $request)
    {
        $drequest = Farmers::findOrFail($request->id);
        $drequest->response = 1;
        $drequest->save();

        return redirect('farmergroup/dashboard');
    }

    public function livestock(Request $request)
    {
        $liv = new Livestock();
        $liv->Fid = auth('farmer')->id();
        $liv->Ltid = $request->Ltid;
        $liv->Quantity = $request->quantity;
        $liv->save();

        avg_amount::calculateAveragesForFarmer(auth('farmer')->id());
        return redirect('farmer/fprofile');
    }
}
