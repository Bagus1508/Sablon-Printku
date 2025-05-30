<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogHistory extends Model
{
    use HasFactory;
    
    public $table = 'logs';
    protected $dates = [
        'updated_at',
        'created_at',
    ];
    protected $guarded = ['id'];
}
