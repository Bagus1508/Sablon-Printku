<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
    use HasFactory;
    public $table = 'level_users';
    protected $dates = [
        'updated_at',
        'created_at',
    ];
    protected $guarded = ['id'];
    public function user(){
        return $this->hasMany(User::class);
    }
}
