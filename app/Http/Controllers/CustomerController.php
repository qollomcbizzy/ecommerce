<?php

namespace App\Http\Controllers;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   public function RegisterCustomer(Request $request){
    $this->validate($request,[
        'name' => 'required',
        'email' => 'required|email|max:255',
        'creditcard' => 'required',
        'address1' => 'required',
        'address2' => 'required',
        'city' => 'required',
        'region' => 'required',
        'postalcode' => 'required',
        'country' => 'required',
        'dayphone' => 'required',
        'evephone' => 'required',
        'mobphone' => 'required',
        'password' => ['required', 'string', 'min:6', 'confirmed'],
       ]);
       
        $customer = new Customer;

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->credit_card = $request->creditcard;
        $customer->address_1= $request->address1;
        $customer->address_2= $request->address2;
        $customer->city= $request->city;
        $customer->region = $request->region;
        $customer->country = $request->country;
        $customer->postal_code = $request->postalcode;
        $customer->day_phone = $request->dayphone;
        $customer->eve_phone = $request->evephone;
        $customer->mob_phone = $request->mobphone;
        $customer->password = bcrypt($request->password);

        $customer->save();

        return redirect('/login');
   }
}