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

class AccountController extends Controller
{
    public function WorkerManagementView()
    {
        $workers = User::where("role", "worker")->get();
        return view("admin.workers.list")->with("workers", $workers);
    }
    public function WorkerDetailView($id){
    	$worker = User::where("id", $id)->first();
    	return view("admin.workers.view")->with("worker", $worker);	
    }
    public function AddWorkerView(){
        return view("admin.workers.add");
    }
    public function AddWorkerPost(Request $request){
    	$rules = array(
            'name'     => 'required',
            'phone'     => 'required',
            'password'      => 'required|confirmed|min:6',
            'email'         => 'required|email|unique:users'
        );
        $validator = Validator::make($request->all(), $rules)->validate();

        $worker = new User();
        $worker->name = $request['name'];
        $worker->photo = $request['photo'];
        $worker->email = $request['email'];
        $worker->password = bcrypt($request['password']);
        $worker->phone = $request['phone'];
        $worker->balance = 0;
        $worker->role = "worker";
        $worker->status = "active";
        $worker->save();

        return redirect("admin/WorkerManagementView");
    }
    public function EditWorkerView($id){
    	$worker = User::where("id", $id)->first();
    	return view("admin.workers.edit")->with("worker", $worker);	
    }
    public function EditWorkerPost(Request $request){
    	$rules = array(
            'name'     => 'required',
            'phone'     => 'required',
            'password'      => 'required|confirmed|min:6',
            'email'         => 'required|email|unique:users,email,'.$request['id']
        );
        $validator = Validator::make($request->all(), $rules)->validate();

        $worker = User::where("id", $request['id'])->first();
        $worker->name = $request['name'];
        $worker->photo = $request['photo'];
        $worker->email = $request['email'];
        if ( $request['password'] != "******" )	$worker->password = bcrypt($request['password']);
        $worker->phone = $request['phone'];
	    $worker->status = $request['status']?"active":"suspend";
        $worker->save();

        return redirect("admin/WorkerManagementView");
    }
    public function RemoveWorkerPost(Request $request){
    	User::where("id", $request['id'])->delete();
    	return redirect("admin/WorkerManagementView");
    }



    public function UserManagementView()
    {
        $users = User::where("role", "user")->get();
        return view("admin.users.list")->with("users", $users);
    }
    public function UserDetailView($id){
        $user = User::where("id", $id)->first();
        return view("admin.users.view")->with("user", $user); 
    }
    public function AddUserView(){
        return view("admin.users.add");
    }
    public function AddUserPost(Request $request){
        $rules = array(
            'name'     => 'required',
            'phone'     => 'required',
            'password'      => 'required|confirmed|min:6',
            'email'         => 'required|email|unique:users'
        );
        $validator = Validator::make($request->all(), $rules)->validate();

        $user = new User();
        $user->name = $request['name'];
        $user->photo = $request['photo'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->phone = $request['phone'];
        $user->balance = 0;
        $user->role = "user";
        $user->status = "active";
        $user->save();

        return redirect("admin/UserManagementView");
    }
    public function EditUserView($id){
        $user = User::where("id", $id)->first();
        return view("admin.users.edit")->with("user", $user); 
    }
    public function EditUserPost(Request $request){
        $rules = array(
            'name'     => 'required',
            'phone'     => 'required',
            'password'      => 'required|confirmed|min:6',
            'email'         => 'required|email|unique:users,email,'.$request['id']
        );
        $validator = Validator::make($request->all(), $rules)->validate();

        $user = User::where("id", $request['id'])->first();
        $user->name = $request['name'];
        $user->photo = $request['photo'];
        $user->email = $request['email'];
        if ( $request['password'] != "******" ) $user->password = bcrypt($request['password']);
        $user->phone = $request['phone'];
        $user->status = $request['status']?"active":"suspend";
        $user->save();

        return redirect("admin/UserManagementView");
    }
    public function RemoveUserPost(Request $request){
        User::where("id", $request['id'])->delete();
        return redirect("admin/UserManagementView");
    }
}
