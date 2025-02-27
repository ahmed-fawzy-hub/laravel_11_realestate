<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserTimeModel extends Model
{
    use HasFactory;
    protected $table = 'user_time';
    protected $fillable = [
        'week_id',
        'user_id',
        'start_time',
        'end_time',
        'status',
    ];
    static public function getDetail($weekid){
        return self::where('week_id','=',$weekid)->where('user_id','=',Auth::user()->id)->first();
    }
}