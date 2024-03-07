<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{

    protected $table = 'applications';
    protected $fillable = ['name','email','number','course','year','address','message','status'];
    use HasFactory;
}
