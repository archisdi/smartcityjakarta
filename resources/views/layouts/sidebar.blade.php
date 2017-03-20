<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel center-block">
            <span class="label label-default text-bold">{{strtoupper(Auth::user()->username)}}</span>
        </div>

        <ul class="sidebar-menu">
            <li class="header">NAVIGATION</li>
            <li class="active"><a href="{{route('home')}}"><i class="fa fa-home"></i> <span>Home</span></a></li>
            <li><a href="{{route('kota.index')}}"><i class="fa fa-circle-o"></i> <span>Kota</span></a></li>
            <li><a href="{{route('kecamatan.index')}}"><i class="fa fa-circle-o"></i> <span>Kecamatan</span></a></li>
            <li><a href="{{route('kelurahan.index')}}"><i class="fa fa-circle-o"></i> <span>Kelurahan</span></a></li>
            <li><a href="{{route('rw.index')}}"><i class="fa fa-circle-o"></i> <span>RW</span></a></li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
