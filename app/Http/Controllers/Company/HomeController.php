<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Role;
use App\Admin;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Twilio\Rest\Client as TwilioClient;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function home()
    {
        return view("company.home");
    }
    public function ViewProfile(){
    	return view("company.profileview");
    }
    public function EditProfileView(){
    	return view("company.editprofileview");
    }
    public function EditProfilePost(Request $request){
    	$rules = array(
            'name'     => 'required',
            'password'      => 'required|confirmed|min:6',
            'email'         => 'required|email|unique:users,email,'.Auth::user()->id
        );
        $validator = Validator::make($request->all(), $rules)->validate();

        $company = Auth::user();
        $company->name = $request['name'];
        $company->email = $request['email'];
        if ($request['password'] != "******")
            $company->password = bcrypt($request['password']);
        $company->save();

        return redirect("company/ViewProfile");
    }
    public function ViewPayment(){
    	return view("company/paymentview");
    }
}
