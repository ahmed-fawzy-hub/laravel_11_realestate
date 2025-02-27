<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
class NotificationModel extends Model
{
    use HasFactory;
    protected $table = 'notification';
    protected $fillable = ['title','message','user_id'];
}