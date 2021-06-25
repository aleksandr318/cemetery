<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Subscriber;
use App\Mail\testmail;
use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
   //     $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == "company")
            return redirect("/company/home");
        return view('home');
    }
    public function logout(){
        
        $role = Auth::user()->role;
        Auth::logout();
        \Session::flush();
        if ($role == "company") return redirect("company/");
        return redirect("/");
    }
    public function subscribe(Request $request){
        $subscriber = new Subscriber();
        $subscriber->email = $request['email'];
        $subscriber->save();
        return redirect("confirm-subscribe-submit");
    }
    public function confirmsubscribesubmit(){
        return view("confirm.subscribesubmitview");
    }
    public function contact(){
        return view("contactus");
    }
    public function contactpost(Request $request){

        $content = ["name"=>$request['name'], "email"=>$request['email'], "subject"=>$request['subject'], "message"=>$request['message']];
        Mail::to("admin@gmail.com")->send(new ContactEmail($content, "Contact Mail", "homelead@generation.co", "Homelead Generation"));
        echo json_encode("We got your message. We will reply in 24 hours.");
    }
}
