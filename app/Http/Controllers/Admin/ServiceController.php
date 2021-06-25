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
use App\ServiceCategory;
use App\Service;
use App\Question;
use App\Lead;
use App\LeadContact;

class ServiceController extends Controller
{
    public function CategoryManagementView()
    {
        $categories = ServiceCategory::all();
        return view("admin.services.category.list")->with("categories", $categories);
    }
    public function AddCategoryPost(Request $request){
        $category = new ServiceCategory();
        $category->name = $request['name'];
        $category->description = $request['description'];
        $category->image = $request['image'];
        $category->save();

        return redirect("admin/CategoryManagementView");
    }
    public function EditCategoryPost(Request $request){
        $category = ServiceCategory::where("id", $request['id'])->first();
        $category->name = $request['name'];
        $category->description = $request['description'];
        $category->image = $request['image'];
        $category->save();
        
        return redirect("admin/CategoryManagementView");
    }
    public function RemoveCategory(Request $request){
        ServiceCategory::where("id", $request['id'])->delete();
        return redirect("admin/CategoryManagementView");
    }

    public function ServiceManagementView(){
        $services = Service::all();
        return view("admin.services.list")->with("services", $services);
    }
    public function AddServicePost(Request $request){
        $service = new Service();
        $service->category_id = $request['category_id'];
        $service->name = $request['name'];
        $service->description = $request['description'];
        $service->photo = $request['image'];
        $service->working_day = $request['working_day'];
        $service->contacted_time = 0;
        $service->status = "active";
        $service->save();

        return redirect("admin/ServiceManagementView");
    }
    public function EditServicePost(Request $request){
        $service = Service::where("id", $request['id'])->first();
        $service->category_id = $request['category_id'];
        $service->name = $request['name'];
        $service->description = $request['description'];
        $service->photo = $request['image'];
        $service->working_day = $request['working_day'];
        $service->save();

        return redirect("admin/ServiceManagementView");
    }
    public function RemoveService(Request $request){
        Service::where("id", $request['id'])->delete();
        return redirect("admin/ServiceManagementView");
    }  
    public function ServiceDetailView($id){
        $service = Service::where("id", $id)->first();
        $questions = Question::where("service_id", $id)->get();
        return view("admin.services.detailview")->with("service", $service)
                                                ->with("questions", $questions);
    }
    public function AddQuestionPost(Request $request){
        $question = new Question();
        $question->service_id = $request['id'];
        $question->content = $request['content'];
        $question->save();
        return redirect()->back()->with(["msg" => "New Question is added."]);
    }
    public function EditQuestionPost(Request $request){
        $question = Question::where("id", $request['id'])->first();
        $question->content = $request['content'];
        $question->save();
        return redirect()->back()->with(["msg" => "Question is updated."]);
    }
    public function RemoveQuestionPost(Request $request){
        Question::where("id", $request['id'])->delete();
        return redirect()->back()->with(["msg" => "Question is removed."]);
    }
    public function LeadManagementView(){
        $leads = Lead::all();
        return view("admin.lead.leadlistview")->with("leads", $leads);
    }
    public function LeadDetail($id){
        $lead = Lead::where("id", $id)->first();
        return view("admin.lead.leaddetailview")->with("lead", $lead);
    }
}
