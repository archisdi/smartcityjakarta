<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

@include('layouts.header_script')

<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

    @include('layouts.header')

    @include('layouts.sidebar')

    <div class="content-wrapper">
        @yield('content')
    </div>

    @include('layouts.footer')

</div>

@include('layouts.footer_script')

</body>
</html>
