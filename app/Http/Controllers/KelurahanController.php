<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Kota;
use Illuminate\Http\Request;
use GuzzleHttp;

class KelurahanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->client = new GuzzleHttp\Client(['headers' => ['Authorization' => config('api.key')]]);
        $this->url = config('api.url') . 'kelurahan/';
    }

    public function index()
    {
        return view('kelurahan.index', ['kelurahan' => Kelurahan::paginate(10)]);
    }

    public function remine()
    {
        $raw = $this->client->request('GET', $this->url);

        if ($raw->getStatusCode() != 200) {
            abort($raw->getStatusCode(), 'The response code is not 200');
        }

        $body = json_decode($raw->getBody(), true);

        foreach (Kelurahan::all() as $item) {
            $item->delete();
        }

        foreach ($body['data'] as $item) {
            if(Kota::find($item['kode_kota'])){
                Kelurahan::create([
                    'id' => $item['kode_kelurahan'],
                    'nama' => $item['nama_kelurahan'],
                    'kota_id' => $item['kode_kota'],
                    'kecamatan_id' => $item['kode_kecamatan']
                ]);
            }
        }

        return redirect(route('kelurahan.index'));
    }
}
