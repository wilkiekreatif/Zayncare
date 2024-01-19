<!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
      <li class="nav-header"></li>
      {{-- Dashboard Menu --}}
      <li class="nav-item">
        <a href="{{url('/dashboard')}}" class="nav-link @if(Request::is('dashboard')) active @endif">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-header"></li>
      <li class="nav-item @if(Request::is('gudang')) menu-is-opening menu-open @elseif(Request::is('gudang/*')) menu-is-opening menu-open @endif">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-warehouse"></i>
          <p>
            Gudang Farmasi
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item @if(Request::is('gudang/obatalkes')) menu-is-opening menu-open @elseif(Request::is('gudang/obatalkes/*')) menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bed"></i>
              <p>
                Obat Alkes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('obatalkes.index')}}" class="nav-link @if(Request::is('gudang/obatalkes')) active @endif">
                  <i class="fa fa-layer-group nav-icon"></i>
                  <p>Master Obat Alkes</p>
                </a>
              </li>
              @if(request()->is('gudang/obatalkes/create'))
                <li class="nav-item">
                  <a href="{{ route('obatalkes.create')}}" class="nav-link active">
                    <i class="fa fa-upload nav-icon"></i>
                    <p>Tambah Master Obat Alkes Baru</p>
                  </a>
                </li>
              @endif
              <li class="nav-item">
                <a href="{{route('obatalkes.stok')}}" class="nav-link  @if(Request::is('gudang/obatalkes/stok')) active @endif">
                  <i class="fa fa-cubes nav-icon"></i>
                  <p>Stok</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link  @if(Request::is('master/bed')) active @endif">
                  <i class="fa fa-shopping-cart nav-icon"></i>
                  <p>Pembelian</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('supplier.index') }}" class="nav-link @if(Request::is('gudang/supplier')) active @elseif(Request::is('gudang/supplier/*')) active @endif">
              <i class="nav-icon fas fa-building"></i>
              <p>Suppliers</p>
            </a>
          </li>
        </ul>
      </li>

      {{-- 
      <li class="nav-header"></li>
      <li class="nav-item">
        <a href="{{url('pendaftaran')}}" class="nav-link @if(Request::is('pendaftaran/*')) active @endif @if(Request::is('pendaftaran')) active @endif">
          <i class="nav-icon fas fa-home"></i>
          <p>PENDAFTARAN</p>
        </a>
      </li>
      <li class="nav-header"></li>
      <li class="nav-item">
        <a href="{{url('azalea')}}" class="nav-link @if(Request::is('azalea')) active @endif">
          <i class="nav-icon fas fa-bed"></i>
          <p>AZALEA</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('akasia')}}" class="nav-link @if(Request::is('akasia')) active @endif">
          <i class="nav-icon fas fa-bed"></i>
          <p>AKASIA</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/asoka')}}" class="nav-link @if(Request::is('asoka')) active @endif">
          <i class="nav-icon fas fa-bed"></i>
          <p>ASOKA</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('anthurium') }}" class="nav-link @if(Request::is('anthurium')) active @endif">
          <i class="nav-icon fas fa-bed"></i>
          <p>ANTHURIUM</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/perinatologi')}}" class="nav-link @if(Request::is('perinatologi/*')) active @endif">
          <i class="nav-icon fas fa-bed"></i>
          <p>PERINATOLOGI</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/intensifdewasa')}}" class="nav-link @if(Request::is('intensifdewasa/*')) active @endif">
          <i class="nav-icon fas fa-bed"></i>
          <p>INTENSIF DEWASA</p>
        </a>
      </li> --}}

      {{-- MultiLevel Menu --}}
      <li class="nav-header">MULTI LEVEL EXAMPLE</li>
    </ul>
  </nav>
<!-- /.sidebar-menu -->