<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Rs;
use App\Models\Tps;
use Illuminate\Http\Request;
use GuzzleHttp;
use ConsoleTVs\Charts\Facades\Charts;
use Maatwebsite\Excel\Facades\Excel;

class TpsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->client = new GuzzleHttp\Client(['headers' => ['Authorization' => config('api.key')]]);
        $this->url = config('api.url') . 'tps/';
    }

    public function index()
    {
        return view('tps.index', ['tps' => Tps::paginate(10)]);
    }

    public function remine()
    {
        $raw = $this->client->request('GET', $this->url);

        if ($raw->getStatusCode() != 200) {
            abort($raw->getStatusCode(), 'The response code is not 200');
        }

        $body = json_decode($raw->getBody(), true);

        foreach (Tps::all() as $item) {
            $item->delete();
        }

        foreach ($body['data'] as $item) {
            if(Kota::find($item['kode_kota'])){
                Tps::create([
                    'id' => $item['id'],
                    'nama' => $item['nama_tps'],
                    'kota_id' => $item['kode_kota'],
                    'kecamatan_id' => $item['kode_kecamatan'],
                    'kelurahan_id' => $item['kode_kelurahan'],
                    'longitude' => $item['location']['longitude'],
                    'latitude' => $item['location']['latitude']
                ]);
            }
        }

        return redirect(route('tps.index'));
    }

    public function chart($type){

        $data = Tps::all();

        foreach ($data as $item){
            $item['kota'] = $item->kota->nama;
        }

        $chart = Charts::database($data, $type, 'highcharts')
            ->elementLabel("Total")
            ->title("Distribusi Tempat Sampah")
            ->dimensions(1000, 500)
            ->colors(['#D9CCB9', '#DF7782', '#E95D22','#017890','#613D2D'])
            ->responsive(false)
            ->groupBy('kota');

        return view('tps.chart',compact('chart'));
    }

    public function maps(){
        $data = Tps::all();

        return view('tps.maps',compact('data'));
    }

    public function export(){

        $tps = Tps::all();
        $data = collect([]);

        foreach ($tps as $item){
            $data->push([
                'nama' => $item->nama,
                'regional' => $item->kota->nama,
                'kecamatan' => $item->kecamatan->nama,
                'kelurahan' => $item->kelurahan->nama
            ]);
        }


        Excel::create('Data Tempat Pembuangan Sampah', function ($excel) use ($data) {
            $excel->sheet('anggota', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            })->export('xlsx');
        });

    }
}
