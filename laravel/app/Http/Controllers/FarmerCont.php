<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\Farmers;
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
        return view('fregister');
    }

    public function showl()
    {
        return view('flogin');
    }

    public function dashboard()
    {
        return view('farmer/dashboard');
    }

    public function profile()
    {
        return view('farmer/fprofile');
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
        $fa->password = Hash::make( $request->password);
        $fa->save();

        return redirect('farmer/dashboard')->with('status', "Your account is created successfully.");
    }

    public function auth(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
