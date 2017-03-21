<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Kota;
use Illuminate\Http\Request;
use GuzzleHttp;
use Maatwebsite\Excel\Facades\Excel;

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

    public function export(){

        $kelurahan = Kelurahan::all();
        $data = collect([]);

        foreach ($kelurahan as $item){
            $data->push([
                'id' => $item->id,
                'nama' => $item->nama,
                'regional' => $item->kota->nama,
                'kecamatan' => $item->kecamatan->nama
            ]);
        }

        Excel::create('Data Kelurahan', function ($excel) use ($data) {
            $excel->sheet('anggota', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            })->export('xlsx');
        });

    }
}
