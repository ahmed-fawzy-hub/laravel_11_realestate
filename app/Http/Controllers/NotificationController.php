<?php
namespace App\Http\Controllers;

use App\Models\NotificationModel;
use App\Models\User;
use Illuminate\Http\Request;
class NotificationController extends Controller
{
    public function notification_index(Request $request){
        $data['getRecord'] = User::where('role','=',['user','agent'])->get();
        return view('admin.notification.update',$data);
    }
    public function notification_send(Request $request){
      $saveDb = new NotificationModel();
      $saveDb->message = trim($request->message);
      $saveDb->user_id = trim($request->user_id);
      $saveDb->title = trim($request->title);
      $saveDb->save();
       $user = User::where('id','=',$request->user_id)->first();
       if(!empty($user->token)){
           try{
               $server_key = 'please set your firebase server key';
               $token = $user->token;
               $body['title'] = $request->title;
               $body['message'] = $request->message;
               $body['body'] = $request->message;
               $url = 'https://fcm.googleapis.com/fcm/send';
               $notification = array('title' =>$request->title , 'body' => $request->message);
               $arrayToSend = array('to' => $token, 'data' => $body, 'priority' => 'high');
               $json1 = json_encode($arrayToSend);
               $headers = array();
               $headers[] = 'Content-Type: application/json';
               $headers[] = 'Authorization: key=' . $server_key;
               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, $url);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST" );
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $result = curl_exec($ch);
                curl_close($ch);
           }
              catch(\Exception $e){
            echo $e;
              }
       }
         return redirect('admin/notification')->with('success','Notification send successfully');
    }
}