<?php

namespace App\Http\Controllers;

use App\Models\ComposeEmailModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\RegisteredMail;
use App\Http\Requests\ResetPassword;

class AdminController extends Controller
{
    //
    public function AdminDashboard(Request $request){
        $user=User::selectRaw('count(id) as count , DATE_FORMAT(created_at, "%Y-%m") as month')->groupBy('month')->orderBy('month', 'asc')->get();
        $data['months']=$user->pluck('month');
        $data['counts']=$user->pluck('count');
        return view('admin.index', $data);
    }
    public function AdminLogout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
    public function AdminLogin(Request $request){
        return view('admin.admin_login');
    }
    public function admin_profile(Request $request){
        $data['getRecord']=User::find(Auth::user()->id);
        return view('admin.admin_profile',$data);
    }
    public function admin_profile_update(Request $request){
        $request->validate([
            
            'email' => 'required | unique:users,email,'.Auth::user()->id,
        ]);
        $user=User::find(Auth::user()->id);
        $user->name=trim($request->name);
        $user->username=trim($request->username);
        $user->email=trim($request->email);
        $user->phone=trim($request->phone);
        if(!empty($request->password)){
            $user->password=Hash::make($request->password);
        }
        if(!empty($request->file('photo'))){
            $file=$request->file('photo');
            $randomStr=Str::random(30);
            $fileName=$randomStr.'.'.$file->getClientOriginalExtension();
            $file->move('upload/',$fileName);
            $user->photo=$fileName;
        }
        $user->address=trim($request->address);
        $user->about=trim($request->about);
        $user->website=trim($request->website);
        $user->save();
        return redirect('/admin/profile')->with('success','Profile Updated Successfully');
    }
    public function admin_users(Request $request){
        $data['getRecord']=User::getRecord($request);
        $data['TotalAdmin']=User::where('role','=','admin')->where('is_delete','=',0)->count();
        $data['TotalAgent']=User::where('role','=','agent')->where('is_delete','=',0)->count();
        $data['TotalUser']=User::where('role','=','user')->where('is_delete','=',0)->count();
        $data['TotalActive']=User::where('status','=','active')->where('is_delete','=',0)->count();
        $data['TotalInactive']=User::where('status','=','inactive')->where('is_delete','=',0)->count();
        $data['Total']=User::where('is_delete','=',0)->count();
        return view('admin.users.list',$data);
    }
    public function admin_users_view(Request $request,$id){
        $data['getRecord']=User::find($id);
        return view('admin.users.view',$data);
    }
    public function admin_add_users(Request $request){
        return view('admin.users.add');
    }
    public function cheeckEmail(Request $request){
        $email=$request->input('email');
        $isExists=User::where('email','=',$email)->first();
        if($isExists){
            return response()->json(array("exists"=>true));
        }else{
           return response()->json(array("exists"=>false));
        }
    }
    public function admin_add_users_store(Request $request){
       $save = $request->validate([
            'name' => 'required',
            'email' => 'required | unique:users,email',
            'role' => 'required',
            'status' => 'required',
        ]);
        $save=new User;
        $save->name=trim($request->name);
        $save->username=trim($request->username);
        $save->email=trim($request->email);
       
        $save->phone=trim($request->phone);
       
        $save->role=trim($request->role);
        $save->status=trim($request->status);
        $save->remember_token=Str::random(50);
        $save->save();
        Mail::to($save->email)->send(new RegisteredMail($save));
        return redirect('/admin/users')->with('success','User Added Successfully');
    }
    public function set_new_password(Request $request,$token){
        $data['token']=$token;
        return view('auth.reset_pass',$data);
    }
    public function set_new_password_post(ResetPassword $request,$token){
       $user=User::where('remember_token','=' ,$token)->first();
         if($user->count() == 0){
            abort(404);
         }
          $user=$user->first();
          $user->password=Hash::make($request->password);
          $user->remember_token=Str::random(50);
          $user->status='active';
          $user->save();
          return redirect('admin/login')->with('success','Password Updated Successfully');
    }
    public function admin_users_edit_id(Request $request,$id){
        $data['getRecord']=User::find($id);
        return view('admin.users.edit',$data);
    }
    public function admin_users_edit_id_update(Request $request,$id){
        $save=User::find($id);
        $save->name=trim($request->name);
        $save->username=trim($request->username);
        $save->email=trim($request->email);
        $save->phone=trim($request->phone);
        $save->role=trim($request->role);
        $save->status=trim($request->status);
        $save->save();
        return redirect('/admin/users')->with('success','User Updated Successfully');
    }
    public function admin_delete_soft(Request $request,$id){
        $softDelete=User::find($id);
        $softDelete->is_delete=1;
        $softDelete->save();
        return redirect('/admin/users')->with('success','User Deleted Successfully');
    }
    public function admin_users_update(Request $request){
        $recorder=User::find($request->input('edit_id'));
        $recorder->name=$request->input('edit_name');
        $recorder->save();
        $json['success']='Record Updated Successfully';
        echo json_encode($json);
    }
    public function admin_users_changeStatus(Request $request){
        $order=User::find($request->order_id);
        $order->status=$request->status_id;
        $order->save();
        $json['success']=true;
        echo json_encode($json);
    }
    public function my_profile(Request $request){
        $data['getRecord']=User::find(Auth::user()->id);
        return view('admin.profile',$data);
    }

    public function my_profile_update(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required | unique:users,email,'.Auth::user()->id,
        ]);
        $user=User::find(Auth::user()->id);
        $user->name=trim($request->name);
        $user->username=trim($request->username);
        $user->email=trim($request->email);
        $user->phone=trim($request->phone);
        if(!empty($request->password)){
            $user->password=Hash::make($request->password);
        }
        if(!empty($request->file('photo'))){
            $file=$request->file('photo');
            $randomStr=Str::random(30);
            $fileName=$randomStr.'.'.$file->getClientOriginalExtension();
            $file->move('upload/',$fileName);
            $user->photo=$fileName;
        }
        $user->address=trim($request->address);
        $user->about=trim($request->about);
        $user->website=trim($request->website);
        $user->save();
        return redirect('/my_profile')->with('success','Profile Updated Successfully');
    }
    public function AgentEmailInbox(Request $request){
        $data['getRecord']=ComposeEmailModel::getAgentRecord(Auth::user()->id);
        return view('agent.email.inbox',$data);
    }
}