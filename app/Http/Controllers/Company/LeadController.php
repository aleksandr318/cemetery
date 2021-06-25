<?php

namespace App\Http\Controllers\Company;

use App\User;
use App\Role;
use App\Admin;
use App\Permission;
use App\Lead;
use App\LeadContact;
use App\Question;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


use Twilio\Rest\Client as TwilioClient;

class LeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function openleadlistview()
    {
    	$leads = Lead::where("status", 1)->get();
        return view("company.openleadsview")->with("leads", $leads);
    }
    public function acceptedleadlistview()
    {
    	$leads = Lead::whereIn("status", [2,3])->where("company_id", Auth::user()->id)->get();
        return view("company.acceptedleadsview")->with("leads", $leads);
    }
    public function ServiceDetailView($id){
    	$service = Service::where("id", $id)->first();
        $questions = Question::where("service_id", $id)->get();
        return view("company.services.detailview")->with("service", $service)
                                                ->with("questions", $questions);
    }
    public function LeadDetailView($id){
    	$lead = Lead::where("id", $id)->first();
    	return view("company.leaddetailview")->with("lead", $lead);
    }
    public function acceptlead(Request $request){
    	$lead = Lead::where("id", $request['lead_id'])->first();
    	$lead->status = 2;
    	$lead->company_id = Auth::user()->id;
    	$lead->save();
    	return redirect("company/acceptedleadlistview");
    }
    public function completelead(Request $request){
    	$lead = Lead::where("id", $request['lead_id'])->first();
    	$lead->status = 3;
    	$lead->save();
    	return redirect()->back();
    }
}
