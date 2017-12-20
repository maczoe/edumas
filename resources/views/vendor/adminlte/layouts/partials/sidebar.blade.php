<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <li class="{{ set_active(['home']) }}"><a href="{{ url("/home") }}"><i class="fa fa-dashboard"></i> <span>Inicio</span></a></li>
        <li class="{{ set_active(['registration*']) }}"><a href="{{ route("registration1") }}"><i class="fa fa-pencil"></i> <span>Inscripción</span></a></li>
        <li class="{{ set_active(['payments*']) }}"><a href="{{ route("payments") }}"><i class="fa fa-calendar-check-o"></i> <span>Pagos Mensuales</span></a></li>
        <li class="{{ set_active(['attendances']) }}"><a href="#"><i class="fa fa-check-square"></i> <span>Asistencia</span></a></li>
        <li class="{{ set_active(['marks']) }}"><a href="{{ route("marks") }}"><i class="fa fa-table"></i> <span>Notas</span></a></li>
        <li class="treeview {{ set_active(['cash/*']) }}">
          <a href="#"><i class="fa fa-money"></i> <span>Caja</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="{{ set_active(['cash/sales']) }}"><a href="#"><i class="fa fa-cart-plus"></i> <span>Ventas</span></a></li>
            <li class="{{ set_active(['cash/spendings']) }}"><a href="#"><i class="fa fa-minus-square"></i> <span>Gastos</span></a></li>
            <li class="{{ set_active(['cash/deposits']) }}"><a href="#"><i class="fa fa-bank"></i> <span>Depositos</span></a></li>
          </ul>
        </li>
        <li class="treeview {{ set_active(['maintenances/*']) }}">
          <a href="#"><i class="fa fa-database"></i> <span>Mantenimientos</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="{{ set_active(['maintenances/establishments']) }}"><a href="{{ route('establishments.index') }}" ><i class="fa fa-university"></i> <span>Establecimientos</span></a></li>
            <li class="{{ set_active(['maintenances/students']) }}"><a href="{{ route('students.index') }}"><i class="fa fa-male"></i> <span>Alumnos</span></a></li>
            <li class="{{ set_active(['maintenances/teachers']) }}"><a href="{{ route('teachers.index') }}"><i class="fa fa-user-secret"></i> <span>Profesores</span></a></li>
            <li class="{{ set_active(['maintenances/subjects']) }}"><a href="{{ route('subjects.index') }}"><i class="fa fa-mortar-board"></i> <span>Cursos</span></a></li>
            <li class="{{ set_active(['maintenances/grades']) }}"><a href="{{ route('grades.index') }}"><i class="fa fa-tasks"></i> <span>Grados</span></a></li>
            <li class="{{ set_active(['maintenances/groups']) }}"><a href="{{ route('groups.index') }}"><i class="fa fa-users"></i><span>Grupos</span></a></li>
            <li class="{{ set_active(['maintenances/classes']) }}"><a href="{{ route('classes.index') }}"><i class="fa fa-pencil-square-o"></i> <span>Clases</span></a></li>
            <li class="{{ set_active(['maintenances/payment_plans']) }}"><a href="{{ route('payment_plans.index') }}"><i class="fa fa-money"></i><span>Planes de pago</span></a></li>
            <li class="{{ set_active(['maintenances/products']) }}"><a href="{{ route('products.index') }}"><i class="fa fa-barcode"></i> <span>Productos</span></a></li>
            <li class="{{ set_active(['maintenances/series']) }}"><a href="{{ route('series.index') }}"><i class="fa fa-table"></i> <span>Series</span></a></li>
          </ul>
        </li>
        <li class="treeview {{ set_active(['reports/*']) }}">
          <a href="#"><i class="fa fa-copy"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="{{ set_active(['reports/student']) }}"><a href="#"><i class="fa fa-user-plus"></i><span>Reporte de Alumnos</span></a></li>
            <li class="{{ set_active(['reports/sales']) }}"><a href="#"><i class="fa fa-line-chart"></i><span>Reporte de Ventas</span></a></li>
            <li class="{{ set_active(['reports/cashflow']) }}"><a href="#"><i class="fa fa-dollar"></i><span>Reporte de Caja Diaria</span></a></li>
            <li class="{{ set_active(['reports/insolvents']) }}"><a href="#"><i class="fa fa-user-times"></i><span>Reporte de Insolventes</span></a></li>
            <li class="{{ set_active(['reports/attendances']) }}"><a href="#"><i class="fa fa-check-square-o"></i><span>Reporte de Asistencias</span></a></li>
            <li class="{{ set_active(['reports/marks']) }}"><a href="#"><i class="fa fa-file"></i><span>Reporte de Notas</span></a></li>
          </ul>
        </li>

            <!-- Optionally, you can add icons to the links -->
            {{-- <li class="active"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            <li><a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.anotherlink') }}</span></a></li> --}}
            {{-- <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.multilevel') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                </ul>
            </li> --}}
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
