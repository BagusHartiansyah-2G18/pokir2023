<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mtimer extends Model
{
    use HasFactory;
    protected $table = 'timer';
    // protected $fillable = [
    //     'name',
    //     'username',
    //     'kdJaba',
    //     'email',
    //     'password',
    // ];
    protected $guarded = ['id'];

}
