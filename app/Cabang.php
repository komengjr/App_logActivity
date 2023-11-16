<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = 'tbl_cabang';
    protected $fillable = [
        'kd_cabang','kd_entitas_cabang','nama_cabang','latitude','longtitude','city','alamat','phone'
     ];
}
