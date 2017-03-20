<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rw extends Model
{
    protected $table = 'rw';

    protected $fillable = ['nama' , 'id' ,'kota_id' , 'kecamatan_id', 'kelurahan_id'];

    public function kota(){
        return $this->BelongsTo('App\Models\Kota');
    }

    public function kecamatan(){
        return $this->BelongsTo('App\Models\Kecamatan');
    }

    public function kelurahan(){
        return $this->BelongsTo('App\Models\Kelurahan');
    }

}
