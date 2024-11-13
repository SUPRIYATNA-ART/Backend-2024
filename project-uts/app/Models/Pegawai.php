<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'Pegawai';
    protected $filable = ['nama','jeniskelamin', 'no','alamat','email','status','tanggal'];
    public $timestamps ='Ffalse';
}
