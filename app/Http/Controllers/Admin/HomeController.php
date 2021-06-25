<?php

namespace App\Http\Controllers\Admin;

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
    public function index()
    {
        $twilioAccountSid   = 'ACf3e4989fcd812169a6af5a1bb54ed12d';
        $twilioAuthToken    = '4af43d63092a67599679056a4eb3b140';
 
        $twilioClient = new TwilioClient($twilioAccountSid, $twilioAuthToken);

        $myTwilioNumber = '+16466062865';
        $body = "Test PSN";

        $phone = '+12027953213';

        //$phone = "+12027953213";
        //$phone = "+15165511685";

        $response = $twilioClient->messages->create(
            
            $phone,
            array(
                "from" => $myTwilioNumber,
                "body" => $body/*,
                "mediaUrl" => $guest->qrcode*/
            )
        );   
        return view("admin.home");
    }
    public function logout()
    {
        Auth::logout();
        \Session::flush();
        return redirect("admin/");
    }
    public function ViewProfile()
    {
        return view("admin.profile.viewprofile");
    }
    public function EditProfileView()
    {
        return view("admin.profile.editprofile");
    }
    public function EditProfilePost(Request $request)
    {
        $rules = array(
            'name'     => 'required',
            'password'      => 'required|confirmed|min:6',
            'email'         => 'required|email'
        );
        $validator = Validator::make($request->all(), $rules)->validate();

        $admin = Auth::user();
        $admin->name = $request['name'];
        $admin->email = $request['email'];
        if ($request['password'] != "******")
            $admin->password = bcrypt($request['password']);
        $admin->save();

        return redirect("admin/ViewProfile");
    }
}
