<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Piket extends Model
{
    protected $table = 'tbl_piket_user';
    protected $fillable = [
        'id_piket','id_user','kd_cabang','tgl_piket','status_piket'
     ];
}
