<?php

namespace App\Http\Controllers;
use App\Models\UserTimeModel;
use Illuminate\Http\Request;
use App\Models\weekModel;
use App\Models\WeekTimeModel;
use Illuminate\Support\Facades\Auth;

class UserTimeController extends Controller
{
    public function week_list(Request $request){
        $data['getRecord'] = weekModel::get();
        return view('admin.week.list',$data);
    }
    public function week_add(Request $request){
        return view('admin.week.add');
    }
    public function week_store(Request $request){
        $save = new weekModel();
        $save->name=trim($request->name);
        $save->save();
        return redirect('admin/week')->with('success','Week Added Successfully');
    }
    public function week_edit(Request $request,$id){
        $data['getRecord'] = weekModel::find($id);
        return view('admin.week.edit',$data);
    }
    public function week_update(Request $request,$id){
        $save = weekModel::find($id);
        $save->name=trim($request->name);
        $save->save();
        return redirect('admin/week')->with('success','Week Updated Successfully');
    }
    public function week_delete(Request $request,$id){
        $save = weekModel::find($id);
        $save->delete();
        return redirect('admin/week')->with('success','Week Deleted Successfully');
    }
    public function week_time_list(Request $request){
        $data['getRecord'] = WeekTimeModel::get();
        return view('admin.week_time.list',$data);
    }
    public function week_time_add(Request $request){
        return view('admin.week_time.add');
    }
    public function week_time_add_store(Request $request){
        $save=new WeekTimeModel;
        $save->name=trim($request->name);
        $save->save();
        return redirect('admin/week_time')->with('success','Week Time Added Successfully');
    }
    public function week_time_edit(Request $request,$id){
        $data['getRecord'] = WeekTimeModel::find($id);
        return view('admin.week_time.edit',$data);
    }
    public function week_time_update(Request $request,$id){
        $save = WeekTimeModel::find($id);
        $save->name=trim($request->name);
        $save->save();
        return redirect('admin/week_time')->with('success','Week Time Updated Successfully');
    }
    public function week_time_delete(Request $request,$id){
        $save = WeekTimeModel::find($id);
        $save->delete();
        return redirect('admin/week_time')->with('success','Week Time Deleted Successfully');
    }
    public function admin_schedule(Request $request){
       $data['week'] = weekModel::get();
       $data['week_time_row'] = WeekTimeModel::get();
       $data['getRecord'] = UserTimeModel::get(); 
        return view('admin.schedule.list', $data);
    }
    public function admin_schedule_update(Request $request){
        UserTimeModel::where('user_id','=',Auth::user()->id)->delete();
        if(!empty($request->week)){
            foreach($request->week as $value){
              if(!empty($value['status'])){
                $record = new UserTimeModel;
                $record->week_id = trim($value['week_id']);
                $record->user_id=Auth::user()->id;
                $record->status='1';
                $record->start_time=trim($value['start_time']);
                $record->end_time=trim($value['end_time']);
                $record->save();               
              }
            }
        }
         return redirect('admin/schedule')->with('success','Schedule Updated Successfully');
    }
}