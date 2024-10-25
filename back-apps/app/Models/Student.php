<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table = 'students';
    protected $fillable = ['nama','nim', 'email', 'jurusan'];
    public $timestamps = false;
}
