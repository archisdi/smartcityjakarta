@extends('layouts.app')

@section('ext_header_script')
    <style>
        #map {
            height: 600px;
            margin: 0;
            padding: 0
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Home
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-building-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Regional</span>
                        <span class="info-box-number">{{\App\Models\Kota::all()->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-building-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Kecamatan</span>
                        <span class="info-box-number">{{\App\Models\Kecamatan::all()->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-building-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Kelurahan</span>
                        <span class="info-box-number">{{\App\Models\Kelurahan::all()->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-building-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">RW</span>
                        <span class="info-box-number">{{\App\Models\Rw::all()->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('ext_footer_script')
    <script src="https://maps.googleapis.com/maps/api/js?key={{config('api.google')}}&libraries=visualization"></script>
    <script>

        var map;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 11,
                center: {lat: -6.209, lng: 106.841}
            });
        }

        initMap();
    </script>
@endsection

