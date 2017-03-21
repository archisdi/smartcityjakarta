@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            RS / Puskesmas
            <small>Data rs umum, khusus, dan puskesmas</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="width: 40px">Nama Rs</th>
                                <th style="width: 40px">Jenis Rs</th>
                                <th style="width: 40px">Kota</th>
                                <th style="width: 40px">Kecamatan</th>
                                <th style="width: 40px">Kelurahan</th>
                            </tr>
                            @foreach($rs as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->jenis->nama}}</td>
                                    <td>{{$item->kota->nama}}</td>
                                    <td>{{$item->kecamatan->nama}}</td>
                                    <td>{{$item->kelurahan->nama}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="box-footer">
                        {{$rs->render()}}
                        <div class="pull-right">
                            <a  href="{{route('rs.export')}}" class="btn btn-sm btn-primary"><span class="fa fa-file-excel-o"></span> Export</a>
                            <a  href="{{route('rs.maps')}}" class="btn btn-sm btn-primary"><span class="fa fa-map-o"></span> Map</a>
                            <a  href="{{route('rs.chart','bar')}}" class="btn btn-sm btn-primary"><span class="fa fa-bar-chart"></span> Chart</a>
                            <a  href="{{route('rs.remine')}}" class="btn btn-sm btn-primary"><span class="fa fa-refresh"></span> Re-Mine</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection