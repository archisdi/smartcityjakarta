<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use GuzzleHttp;
use Maatwebsite\Excel\Facades\Excel;

class KecamatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->client = new GuzzleHttp\Client(['headers' => ['Authorization' => config('api.key')]]);
        $this->url = config('api.url') . 'kecamatan/';
    }

    public function index()
    {
        return view('kecamatan.index', ['kecamatan' => Kecamatan::paginate(10)]);
    }

    public function remine()
    {
        $raw = $this->client->request('GET', $this->url);

        if ($raw->getStatusCode() != 200) {
            abort($raw->getStatusCode(), 'The response code is not 200');
        }

        $body = json_decode($raw->getBody(), true);

        foreach (Kecamatan::all() as $item) {
            $item->delete();
        }

        foreach ($body['data'] as $item) {
            Kecamatan::create([
                'id' => $item['kode_kecamatan'],
                'nama' => $item['nama_kecamatan'],
                'kota_id' => $item['kode_kota']
            ]);
        }

        return redirect(route('kecamatan.index'));
    }

    public function export(){

        $kecamatan = Kecamatan::all();
        $data = collect([]);

        foreach ($kecamatan as $item){
            $data->push([
                'id' => $item->id,
                'nama' => $item->nama,
                'regional' => $item->kota->nama
            ]);
        }

        Excel::create('Data Kecamatan', function ($excel) use ($data) {
            $excel->sheet('anggota', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            })->export('xlsx');
        });

    }
}
