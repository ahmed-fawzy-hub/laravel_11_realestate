<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComposeEmailModel extends Model
{
    use HasFactory;
    protected $table = 'compose_email';
    static public function getAgentRecord($user_id){
        return self::select('compose_email.*')->where('compose_email.user_id','=',$user_id)->get();
    }
}