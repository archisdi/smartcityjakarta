<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    protected $table = 'tps';

    protected $fillable = [
      'id', 'nama' , 'kota_id', 'kecamatan_id', 'kelurahan_id', 'alamat', 'longitude', 'latitude'
    ];

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
