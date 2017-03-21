<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;
use GuzzleHttp;
use Maatwebsite\Excel\Facades\Excel;

class KotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->client = new GuzzleHttp\Client(['headers' => ['Authorization' => config('api.key')]]);
        $this->url = config('api.url') . 'kota/';
    }

    public function index()
    {
        return view('kota.index', ['kota' => Kota::paginate(10)]);
    }

    public function remine()
    {
        $raw = $this->client->request('GET', $this->url);

        if ($raw->getStatusCode() != 200) {
            abort($raw->getStatusCode(), 'The response code is not 200');
        }

        $body = json_decode($raw->getBody(), true);

        foreach (Kota::all() as $item) {
            $item->delete();
        }

        foreach ($body['data'] as $item) {
            Kota::create([
                'id' => $item['kode_kota'],
                'nama' => $item['nama_kota']
            ]);
        }

        return redirect(route('kota.index'));
    }

    public function export(){

        $kota = Kota::all();
        $data = collect([]);

        foreach ($kota as $item){
            $data->push([
                'id' => $item->id,
                'nama' => $item->nama
            ]);
        }

        Excel::create('Data Regional', function ($excel) use ($data) {
            $excel->sheet('anggota', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            })->export('xlsx');
        });

    }

}
