@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            RW
            <small>Data RW</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 10px">ID RW</th>
                                <th style="width: 40px">Nama RW</th>
                                <th style="width: 40px">Nama Kelurahan</th>
                                <th style="width: 40px">Nama Kecamatan</th>
                                <th style="width: 40px">Nama Kota</th>
                            </tr>
                            @foreach($rw as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->kelurahan->nama}}</td>
                                    <td>{{$item->kecamatan->nama}}</td>
                                    <td>{{$item->kota->nama}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="box-footer">
                        {{$rw->render()}}
                        <div class="pull-right">
                            <a  href="{{route('rw.remine')}}" class="btn btn-sm btn-primary"><span class="fa fa-refresh"></span> Re-Mine</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
