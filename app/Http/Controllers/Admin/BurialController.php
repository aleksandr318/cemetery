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
use App\Mount;
use App\Section;
use App\Lot;
use App\Plot;
use App\RequestedBurial;
use App\Burial;

class BurialController extends Controller
{
    public function RequestedBurialsView()
    {
        $burials = RequestedBurial::all();
        return view("admin.burials.requestedlist")->with("burials", $burials);
    }
    public function BurialManagementView()
    {
        $burials = Burial::all();
        return view("admin.burials.list")->with("burials", $burials);
    }
    public function AddBurialView(){
        return view("admin.burials.add");
    }
    public function AddBurialPost(Request $request){
        $burial = new Burial();
        $burial->name = $request['name'];
        $burial->type = $request['type'];
        $burial->status = "pending";
        $burial->save();
        return redirect("admin/BurialManagementView");
    }
}
