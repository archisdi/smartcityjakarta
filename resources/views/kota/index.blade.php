@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Kota
            <small>Data bagian kota</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="box box-primary">
                    <div class="box-body">
                        <table class="table table-responsive">
                            <tr>
                                <th style="width: 10px">ID Kota</th>
                                <th style="width: 40px">Nama Kota</th>
                            </tr>
                            @foreach($kota as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->nama}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="box-footer">
                        {{$kota->render()}}
                        <div class="pull-right">
                            <a  href="{{route('kota.export')}}" class="btn btn-sm btn-primary"><span class="fa fa-file-excel-o"></span> Export</a>
                            <a  href="{{route('kota.remine')}}" class="btn btn-sm btn-primary"><span class="fa fa-refresh"></span> Re-Mine</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
