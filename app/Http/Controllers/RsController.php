<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Rs;
use Illuminate\Http\Request;
use GuzzleHttp;
use ConsoleTVs\Charts\Facades\Charts;
use Maatwebsite\Excel\Facades\Excel;

class RsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->client = new GuzzleHttp\Client(['headers' => ['Authorization' => config('api.key')]]);
        $this->url_umum = config('api.url') . 'rumahsakitumum/';
        $this->url_khusus = config('api.url') . 'rumahsakitkhusus/';
        $this->url_puskesmas = config('api.url') . 'puskesmas/';

    }

    public function index(){
        $rs = Rs::paginate(10);

        return view('rs.index',compact('rs'));
    }

    public function remine()
    {
        $raw_umum = $this->client->request('GET', $this->url_umum);

        if ($raw_umum->getStatusCode() != 200) {
            abort($raw_umum->getStatusCode(), 'The response code is not 200');
        }

        $raw_khusus = $this->client->request('GET', $this->url_khusus);

        if ($raw_khusus->getStatusCode() != 200) {
            abort($raw_khusus->getStatusCode(), 'The response code is not 200');
        }

        $raw_puskesmas = $this->client->request('GET', $this->url_puskesmas);

        if ($raw_puskesmas->getStatusCode() != 200) {
            abort($raw_puskesmas->getStatusCode(), 'The response code is not 200');
        }

        $body_umum = json_decode($raw_umum->getBody(), true);
        $body_khusus = json_decode($raw_khusus->getBody(), true);
        $body_puskesmas = json_decode($raw_puskesmas->getBody(), true);


        foreach (Rs::all() as $item) {
            $item->delete();
        }

        foreach ($body_umum['data'] as $item) {
            if(Kota::find($item['kode_kota'])){
                Rs::create([
                    'nama' => $item['nama_rsu'],
                    'jenis_id' => 1,
                    'kota_id' => $item['kode_kota'],
                    'kecamatan_id' => $item['kode_kecamatan'],
                    'kelurahan_id' => $item['kode_kelurahan'],
                    'latitude' => $item['latitude'],
                    'longitude' => $item['longitude']
                ]);
            }
        }

        foreach ($body_khusus['data'] as $item) {
            if(Kota::find($item['kode_kota'])){
                Rs::create([
                    'nama' => $item['nama_rsk'],
                    'jenis_id' => 2,
                    'kota_id' => $item['kode_kota'],
                    'kecamatan_id' => $item['kode_kecamatan'],
                    'kelurahan_id' => $item['kode_kelurahan'],
                    'latitude' => $item['latitude'],
                    'longitude' => $item['longitude']
                ]);
            }
        }

        foreach ($body_puskesmas['data'] as $item) {
            if(Kota::find($item['kode_kota'])){
                Rs::create([
                    'nama' => $item['nama_Puskesmas'],
                    'jenis_id' => 3,
                    'kota_id' => $item['kode_kota'],
                    'kecamatan_id' => $item['kode_kecamatan'],
                    'kelurahan_id' => $item['kode_kelurahan'],
                    'latitude' => $item['location']['latitude'],
                    'longitude' => $item['location']['longitude']
                ]);
            }
        }

        return redirect(route('rs.index'));
    }

    public function chart($type){

        $data = Rs::all();

        foreach ($data as $item){
            $item['kota'] = $item->kota->nama;
        }

        $chart = Charts::database($data, $type, 'highcharts')
            ->elementLabel("Total")
            ->title("Distribusi RS / Puskesmas")
            ->colors(['#D9CCB9', '#DF7782', '#E95D22','#017890','#613D2D'])
            ->dimensions(1000, 500)
            ->responsive(false)
            ->groupBy('kota');

        return view('rs.chart',compact('chart'));
    }

    public function maps(){

        $data = Rs::all();

        return view('rs.maps',compact('data'));
    }

    public function export(){

        $rs = Rs::all();
        $data = collect([]);

        foreach ($rs as $item){
            $data->push([
                'nama' => $item->nama,
                'jenis' => $item->jenis->nama,
                'regional' => $item->kota->nama,
                'kecamatan' => $item->kecamatan->nama,
                'kelurahan' => $item->kelurahan->nama
            ]);
        }


        Excel::create('Data Rs/puskesmas', function ($excel) use ($data) {
            $excel->sheet('anggota', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            })->export('xlsx');
        });

    }

}
