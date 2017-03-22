<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel center-block">
            <span class="label label-default text-bold">{{strtoupper(Auth::user()->username)}}</span>
        </div>

        <ul class="sidebar-menu">
            <li class="header">NAVIGATION</li>
            <li class="{{ Request::is('home') ? 'active' : '' }}"><a href="{{route('home')}}"><i class="fa fa-home"></i> <span>Home</span></a></li>
            <li class="treeview {{ Request::is('kota','rw','kelurahan','kecamatan') ? 'active' : '' }}">
                <a href="">
                    <i class="fa fa-map-o"></i> <span>Regional</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('kota.index')}}"><i class="fa fa-circle-o"></i> <span>Kota</span></a></li>
                    <li><a href="{{route('kecamatan.index')}}"><i class="fa fa-circle-o"></i> <span>Kecamatan</span></a></li>
                    <li><a href="{{route('kelurahan.index')}}"><i class="fa fa-circle-o"></i> <span>Kelurahan</span></a></li>
                    <li><a href="{{route('rw.index')}}"><i class="fa fa-circle-o"></i> <span>RW</span></a></li>
                </ul>
            </li>
            <li class="{{ Request::is('tps','tps/*') ? 'active' : '' }}"><a href="{{route('tps.index')}}"><i class="fa fa-trash-o"></i> <span>TPS</span></a></li>
            <li class="{{ Request::is('rumahsakit','rumahsakit/*')? 'active' : '' }}"><a href="{{route('rs.index')}}"><i class="fa fa-hospital-o"></i> <span>rumahsakit / Puskesmas</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
