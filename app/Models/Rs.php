<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rs extends Model
{
    protected $table = 'rs';

    protected $fillable = [
      'jenis_id', 'kota_id', 'kelurahan_id', 'kecamatan_id', 'nama', 'latitude', 'longitude'
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

    public function jenis(){
        return $this->BelongsTo('App\Models\JenisRs');
    }
}
