@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Kelurahan
            <small>Data Kelurahan</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-body">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 10px">ID kelurahan</th>
                                <th style="width: 40px">Nama kelurahan</th>
                                <th style="width: 40px">Nama Kecamatan</th>
                                <th style="width: 40px">Nama Kota</th>
                            </tr>
                            @foreach($kelurahan as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->kecamatan->nama}}</td>
                                    <td>{{$item->kota->nama}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="box-footer">
                        {{$kelurahan->render()}}
                        <div class="pull-right">
                            <a  href="{{route('kelurahan.export')}}" class="btn btn-sm btn-primary"><span class="fa fa-file-excel-o"></span> Export</a>
                            <a  href="{{route('kelurahan.remine')}}" class="btn btn-sm btn-primary"><span class="fa fa-refresh"></span> Re-Mine</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
