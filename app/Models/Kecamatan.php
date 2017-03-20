<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    protected $fillable = ['nama' , 'id', 'kota_id'];

    public function kota(){
        return $this->BelongsTo('App\Models\Kota');
    }

}
