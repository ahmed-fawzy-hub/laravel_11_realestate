<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
class weekModel extends Model
{
    use HasFactory;
    protected $table = 'week';
    protected $fillable = [
        'week_name',
        'week_start',
        'week_end',
        'status',
    ];
}