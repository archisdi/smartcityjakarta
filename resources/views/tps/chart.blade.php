@extends('layouts.app')

@section('ext_header_script')
    {!! Charts::assets() !!}
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Chart Tempat Sampah
        </h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                {!! $chart->render() !!}
            </div>
        </div>
    </section>
@endsection
