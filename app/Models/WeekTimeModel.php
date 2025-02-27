<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
class WeekTimeModel extends Model
{
    use HasFactory;
    protected $table = 'week_time';
    protected $fillable = [
        'week_id',
        'user_id',
        'start_time',
        'end_time',
        'status',
    ];
}