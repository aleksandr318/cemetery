<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Service;
use App\Question;
use App\Lead;
use App\LeadContact;
use App\User;
use DB;


use App\Mail\NewLeadEmail;


use Twilio\Rest\Client as TwilioClient;

class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function sendMSG($phone, $message)
    {
        $twilioAccountSid   = 'ACf3e4989fcd812169a6af5a1bb54ed12d';
        $twilioAuthToken    = '4af43d63092a67599679056a4eb3b140';
 
        $twilioClient = new TwilioClient($twilioAccountSid, $twilioAuthToken);

        $myTwilioNumber = '+16466062865';
        $body = $message;

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
    public function findservice(Request $request){
        return redirect("service-detail/".$request['keyword']);
    }
    public function services(Request $request)
    {
        $category_filter = "*";
        $services = Service::all();
        if ( isset($request['category']) )
        {
            $category_filter = $request['category'];
            $services = Service::where("category_id", $category_filter)->get();
        }  
        return view('service.servicelist')->with("services", $services)
                                          ->with("category_filter", $category_filter);
    }
    public function servicedetail($id){
        $service = Service::where("id", $id)->first();
        return view('service.servicedetailview')->with("service", $service);
    }
    public function servicesubmitview($id){
        $service = Service::where("id", $id)->first();
        $questions = Question::where("service_id", $id)->get();
        return view('service.servicesubmitview')->with("service", $service)
                                                ->with("questions", $questions);
    }
    public function servicesubmitpost(Request $request){
        $lead = new Lead();
        $lead->service_id = $request['service_id'];
        $lead->zipcode = $request['zipcode'];
        $lead->status = 1;
        $lead->save();

        $service_obj = Service::where("id", $request['service_id'])->first();
        $service_name = "";
        if ($service_obj) $service_name = $service_obj->name;

        $companies = User::where("role", "company")->get();
        foreach ($companies as $company) {
            $this->sendMSG("+".$company->phone, "New lead is submitted. Service is ".$service_name);
            $content = "New lead is submitted. Service is ".$service_name;
            Mail::to($company->email)->send(new NewLeadEmail($content, "New Lead", "homelead@generation.co", "Homelead Generation"));
        }



        $questions = Question::where("service_id", $request['service_id'])->get();
        foreach ($questions as $question) {
            $leadcontact = new LeadContact();
            $leadcontact->lead_id = $lead->id;
            $leadcontact->question_id = $question->id;
            $leadcontact->answer = $request['name'.$question->id];
            $leadcontact->save();
        }

        return redirect("confirm-lead-submit");
    }
    public function confirmleadsubmit(){
        return view("confirm.leadsubmitview");
    }
}
