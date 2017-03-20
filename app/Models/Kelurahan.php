<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'kelurahan';

    protected $fillable = ['nama' , 'id' , 'kota_id' ,'kecamatan_id'];

    public function kota(){
        return $this->BelongsTo('App\Models\Kota');
    }

    public function kecamatan(){
        return $this->BelongsTo('App\Models\Kecamatan');
    }

}
