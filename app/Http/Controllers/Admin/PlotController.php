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
use App\BurialDetail;

class PlotController extends Controller
{
    public function MountManagementView()
    {
        $mounts = Mount::all();
        return view("admin.plots.segment.list")->with("mounts", $mounts);
    }
    public function AddMountView(){
        return view("admin.plots.segment.mount.add");
    }
    public function AddMountPost(Request $request){
        $mount = new Mount();
        $mount->name = $request['name'];
        $mount->lat = $request['lat'];
        $mount->long = $request['long'];
        $mount->save();

        return redirect("admin/MountManagementView");
    }
    public function EditMountView($id){
        $mount = Mount::where("id", $id)->first();
        return view("admin.plots.segment.mount.edit")->with("mount", $mount);
    }
    public function EditMountPost(Request $request){
        $mount = Mount::where("id", $request['mtId'])->first();
        $mount->name = $request['name'];
        $mount->lat = $request['lat'];
        $mount->long = $request['long'];
        $mount->save();

        return redirect("admin/MountManagementView");
    }
    public function RemoveMountPost(Request $request){
        Mount::where("id", $request['mtId'])->delete();
        return redirect("admin/MountManagementView");   
    }
    public function AddSectionView($id){
        $mount = Mount::where("id", $id)->first();
        return view("admin.plots.segment.section.add")->with("mount", $mount);
    }
    public function AddSectionPost(Request $request){
        $section = new Section();
        $section->mtId = $request['mtId'];
        $section->name = $request['name'];
        $section->polygon = $request['shape_value'];
        $section->save();
        return redirect("admin/MountManagementView");
    }
    public function EditSectionView($id){
        $section = Section::where("id", $id)->first();
        $mount = Mount::where("id", $section->mtId)->first();
        return view("admin.plots.segment.section.edit")->with("section", $section)
                                                       ->with("mount", $mount);
    }
    public function EditSectionPost(Request $request){
        $section = Section::where("id",$request['sectionId'])->first();
        $section->name = $request['name'];
        $section->polygon = $request['shape_value'];
        $section->save();
        return redirect("admin/MountManagementView");
    }
    public function RemoveSectionPost(Request $request){
        Section::where("id", $request['sectionId'])->delete();
        return redirect("admin/MountManagementView"); 
    }
    public function AddLotView($id){
        $section = Section::where("id", $id)->first();
        return view("admin.plots.segment.lot.add")->with("section", $section);
    }
    public function AddLotPost(Request $request){
        $lot = new Lot();
        $lot->mtId = $request['mtId'];
        $lot->sectionId = $request['sectionId'];
        $lot->name = $request['name'];
        $lot->polygon = $request['shape_value'];
        $lot->save();
        return redirect("admin/MountManagementView");
    }
    public function EditLotView($id){
        $lot = Lot::where("id",$id)->first();
        $section = Section::where("id", $lot->sectionId)->first();
        return view("admin.plots.segment.lot.edit")->with("lot", $lot)
                                                   ->with("section", $section);
    }
    public function EditLotPost(Request $request){
        $lot = Lot::where("id",$request['lotId'])->first();
        $lot->name = $request['name'];
        $lot->polygon = $request['shape_value'];
        $lot->save();
        return redirect("admin/MountManagementView");
    }
    public function RemoveLotPost(Request $request){
        Lot::where("id", $request['lotId'])->delete();
        return redirect("admin/MountManagementView"); 
    }
    public function PlotsView(){
        $plots = Plot::all();
        return view("admin.plots.list")->with("plots", $plots);
    }
    public function AddPlotView(){
        return view("admin.plots.add");
    }
    public function GetSectionPost(Request $request){
        $sections = Section::where("mtId", $request['mtId'])->get();
        echo json_encode($sections);
    }
    public function GetLotPost(Request $request){
        $lots = Lot::where("sectionId", $request['sectionId'])->get();
        echo json_encode($lots);
    }
    public function AddPlotPost(Request $request){
        $plot = new Plot();
        $plot->grave_name = $request['grave_name'];
        $plot->mtId = $request['mtId'];
        $plot->sectionId = $request['sectionId'];
        $plot->lotId = $request['lotId'];
        $plot->status = "open";
        $plot->polygon = $request['shape_value'];
        $plot->save();

        return redirect("admin/PlotsView");
    }

    public function AllPlotMapView(Request $request){
        $mount = Mount::where("id", $request['mtId'])->first();
        return view("admin.plots.map")->with("mount", $mount);
    }
    public function getSections(Request $request){
        $sections = Section::where("mtId", $request['id'])->get();
        echo json_encode($sections);
    }
    public function getLots(Request $request){
        $lots = Lot::where("sectionId", $request['id'])->get();
        echo json_encode($lots);
    }
    public function getPlotInfos(Request $request){
        $lot_obj = Lot::where("id", $request['id'])->first();
        $section_obj = Section::where("id", $lot_obj->sectionId)->first();
        echo json_encode(array("sectionPath" => $section_obj->polygon,
                               "sectionName" => $section_obj->name,
                               "sectionId" => $section_obj->id));
    }
    public function getPlots(Request $request){
        $plots = Plot::where("lotId", $request['id'])->get();
        echo json_encode($plots);
    }
    public function PlotDetail($id){
        $plot = Plot::where("id", $id)->first();
        $burialDetails = BurialDetail::where("plotId", $plot->id)->get();

        
        $mount = Mount::where("id", $plot->mtId)->first();
        $section = Section::where("id", $plot->sectionId)->first();
        $lot = Lot::where("id", $plot->lotId)->first();

        $position = ($mount?$mount->name:"") ."/". ($section?$section->name:"") ."/". ($lot?$lot->name:"");

        return view("admin.plots.detail")->with("plot", $plot)
                                         ->with("burialDetails", $burialDetails)
                                         ->with("position", $position);
    }
    public function AddBurialInPlot(Request $request){
        $bd = new BurialDetail();
        $bd->plotId = $request['plotId'];
        $bd->burialId = $request['burialId'];
        $bd->save();
        return redirect()->back();
    }
    public function RemoveBurialInPost(Request $request){
        BurialDetail::where("id", $request['id'])->delete();
        return redirect()->back();
    }
}
