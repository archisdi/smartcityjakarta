@extends('layouts.app')

@section('ext_header_script')
    <style>
        #map {
            height: 500px;
            margin: 0;
            padding: 0
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Heatmap Tempat Sampah
        </h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-sm btn-default" onclick="toggleHeatmap()">Toggle Heatmap</button>
                <button class="btn btn-sm btn-default" onclick="changeGradient()">Change gradient</button>
                <button class="btn btn-sm btn-default" onclick="changeRadius()">Change radius</button>
                <button class="btn btn-sm btn-default" onclick="changeOpacity()">Change opacity</button>
            </div>
            <div class="box-body">
                <div id="map"></div>
            </div>
        </div>
    </section>
@endsection

@section('ext_footer_script')
    <script src="https://maps.googleapis.com/maps/api/js?key={{config('api.google')}}&libraries=visualization"></script>
    <script>

        var map, heatmap, radius;
        radius = 10;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 11,
                center: {lat: -6.209, lng: 106.841}
            });

            heatmap = new google.maps.visualization.HeatmapLayer({
                data: getPoints(),
                map: map,
                radius: radius
            });
        }

        function toggleHeatmap() {
            heatmap.setMap(heatmap.getMap() ? null : map);
        }

        function changeGradient() {
            var gradient = [
                'rgba(0, 255, 255, 0)',
                'rgba(0, 255, 255, 1)',
                'rgba(0, 191, 255, 1)',
                'rgba(0, 127, 255, 1)',
                'rgba(0, 63, 255, 1)',
                'rgba(0, 0, 255, 1)',
                'rgba(0, 0, 223, 1)',
                'rgba(0, 0, 191, 1)',
                'rgba(0, 0, 159, 1)',
                'rgba(0, 0, 127, 1)',
                'rgba(63, 0, 91, 1)',
                'rgba(127, 0, 63, 1)',
                'rgba(191, 0, 31, 1)',
                'rgba(255, 0, 0, 1)'
            ]
            heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
        }

        function changeRadius() {
            heatmap.set('radius', heatmap.get('radius') ? null : radius);
        }

        function changeOpacity() {
            heatmap.set('opacity', heatmap.get('opacity') ? null : 0.4);
        }

        function getPoints() {
            return [
                @foreach($data as $item)
                    new google.maps.LatLng({{$item->latitude}}, {{$item->longitude}}),
                @endforeach
            ];
        }

        initMap();
    </script>
@endsection
