<?php
namespace App\Http\Controllers;

use App\Models\ComposeEmailModel;
use App\Models\User;
use Illuminate\Http\Request;

use App\Mail\ComposeEmailMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller {
    public function email_compose(Request $request) {
    $data['getEmail']=User::whereIn('role',  ['agent','user'])->get();
        return view('admin.email.compose', $data);
    }
    public function email_compose_post(Request $request) {
        $save=new ComposeEmailModel();
        $save->user_id=$request->user_id;
        $save->cc_email=trim($request->cc_email);
        $save->subject=trim($request->subject);
        $save->descriptions=trim($request->descriptions);
        $save->save();

        $getUserEmail=User::where('id', '=', $request->user_id)->first();
        Mail::to($getUserEmail->email)->cc($request->cc_email)->send(new ComposeEmailMail($save));
        return redirect('admin/email/compose')->with('success', 'Email sent successfully');
    }
    public function email_sent(Request $request){
        $data['getRecord']=ComposeEmailModel::get();
        return view('admin.email.send',$data);
    }
    public function admin_email_sent_delete(Request $request){
        if(!empty($request->id)){
            $option=explode(',', $request->id);
            foreach($option as $id){
                if(!empty($id)){
                    $getRecord=ComposeEmailModel::find($id);
                    $getRecord->delete();
                }
            }
        }
        return redirect('admin/email/sent')->with('success', 'Email deleted successfully');
    }
    public function admin_email_read($id, Request $request){
        $data['getRecord']=ComposeEmailModel::find($id);
        return view('admin.email.read', $data);
    }
    public function admin_email_read_delete($id, Request $request){
        $deleteRecord=ComposeEmailModel::find($id);
        $deleteRecord->delete();
        return redirect('admin/email/sent')->with('success', 'Email deleted successfully');
    }
}