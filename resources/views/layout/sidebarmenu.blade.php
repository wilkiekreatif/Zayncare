<!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
      <li class="nav-header"></li>
      {{-- Dashboard Menu --}}
      <li class="nav-item">
        <a href="{{url('/dashboard')}}" class="nav-link @if(Request::is('dashboard')) active @elseif(Request::is('/')) active @endif">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
        </a>
      </li>

      <li class="nav-header"></li>
      <li class="nav-item @if(Request::is('sysadmin')) menu-is-opening menu-open @elseif(Request::is('sysadmin/*')) menu-is-opening menu-open @endif">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-laptop-code"></i>
          <p>
            System Administrator
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item @if(Request::is('sysadmin/obatalkes')) menu-is-opening menu-open @elseif(Request::is('sysadmin/obatalkes/*')) menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-pills"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('obatalkes.index')}}" class="nav-link @if(Request::is('sysadmin/user')) active @endif">
                  <i class="fa fa-users nav-icon"></i>
                  <p>Master User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('obatalkes.index')}}" class="nav-link @if(Request::is('sysadmin/dokter')) active @endif">
                  <i class="fa fa-user-md nav-icon"></i>
                  <p>Master Dokter</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('obatalkes.defekta')}}" class="nav-link  @if(Request::is('sysadmin/tindakan')) active @endif">
                  <i class="fa fa-stethoscope nav-icon"></i>
                  <p>Master Tindakan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/construction')}}" class="nav-link  @if(Request::is('sysadmin/poliklinik')) active @endif">
                  <i class="fa fa-hospital nav-icon"></i>
                  <p>Master Poliklinik</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item @if(Request::is('sysadmin/config')) menu-is-opening menu-open @elseif(Request::is('sysadmin/config/*')) menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Config
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link @if(Request::is('sysadmin/enveditor')) active @endif">
                  <i class="fa fa-server nav-icon"></i>
                  <p>ENV Editor</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
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
              <i class="nav-icon fas fa-pills"></i>
              <p>
                Obat Alkes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('obatalkes.index')}}" class="nav-link @if(Request::is('gudang/obatalkes')) active @endif">
                  <i class="fa fa-server nav-icon"></i>
                  <p>Master Obat Alkes</p>
                </a>
              </li>
              {{-- @if(request()->is('gudang/obatalkes/create'))
                <li class="nav-item">
                  <a href="{{ route('obatalkes.create')}}" class="nav-link active">
                    <i class="fa fa-upload nav-icon"></i>
                    <p>Tambah Master Obat Alkes Baru</p>
                  </a>
                </li>
              @endif --}}
              <li class="nav-item">
                <a href="{{route('obatalkes.defekta')}}" class="nav-link  @if(Request::is('gudang/obatalkes/defekta')) active @endif">
                  <i class="fa fa-shopping-cart nav-icon"></i>
                  <p>Pembelian</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="{{url('/construction')}}" class="nav-link  @if(Request::is('gudang/obatalkes/stokopname')) active @endif">
                  <i class="fa fa-clipboard-list nav-icon"></i>
                  <p>Stock Opname</p>
                </a>
              </li> --}}
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('supplier.index') }}" class="nav-link @if(Request::is('gudang/supplier')) active @elseif(Request::is('gudang/supplier/*')) active @endif">
              <i class="nav-icon fas fa-truck"></i>
              <p>Suppliers</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-header"></li>

      <li class="nav-item @if(Request::is('register')) menu-is-opening menu-open @elseif(Request::is('register/*')) menu-is-opening menu-open @endif">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-hospital"></i>
          <p>
            Pendaftaran
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('register.index')}}" class="nav-link @if(Request::is('register/masterpasien')) active @elseif(Request::is('register/masterpasien/*')) active @endif">
              <i class="nav-icon fas fa-user-injured"></i>
              <p>Master Pasien</p>
            </a>
          </li>
          @if(request()->is('register/create'))
                <li class="nav-item">
                  <a href="{{ route('register.create')}}" class="nav-link active">
                    <i class="fa fa-upload nav-icon"></i>
                    <p>Tambah Master Pasien Baru</p>
                  </a>
                </li>
              @endif
          <li class="nav-item">
            <a href="{{route('register.registered')}}" class="nav-link @if(Request::is('register/registered')) active @elseif(Request::is('register/registered/*')) active @endif">
              <i class="nav-icon fas fa-user-injured"></i>
              <p>Pasien terdaftar</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-header"></li>
      
      <li class="nav-item @if(Request::is('poliklinik')) menu-is-opening menu-open @elseif(Request::is('poliklinik/*')) menu-is-opening menu-open @endif">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-clinic-medical"></i>
          <p>
            Poliklinik
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('poliklinik.index')}}" class="nav-link @if(Request::is('poliklinik')) active @elseif(Request::is('poliklinik/*')) active @endif">
              <i class="nav-icon fas fa-user-injured"></i>
              <p>Pasien Terdaftar</p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="#" class="nav-link @if(Request::is('poliklinik/report')) active @elseif(Request::is('poliklinik/report')) active @endif">
              <i class="nav-icon fas fa-file"></i>
              <p>Laporan Pasien</p>
            </a>
          </li> --}}
        </ul>
      </li>

      <li class="nav-header"></li>
      
      <li class="nav-item @if(Request::is('apotek')) menu-is-opening menu-open @elseif(Request::is('apotek/*')) menu-is-opening menu-open @endif">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-store-alt"></i>
          <p>
            Apotek
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item @if(Request::is('apotek/penjualan')) menu-is-opening menu-open @elseif(Request::is('apotek/penjualanUmum')) menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-pills"></i>
              <p>
                Penjualan Umum
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('apotek.pu')}}" class="nav-link @if(Request::is('apotek/penjualan')) active @endif">
                  <i class="nav-icon fas fa-tablets"></i>
                  <p>Daftar Penjualan Umum</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('apotek.jualumum')}}" class="nav-link @if(Request::is('apotek/penjualanUmum')) active @elseif(Request::is('apotek/penjualanUmum/*')) active @endif">
                  <i class="nav-icon fas fa-cash-register"></i>
                  <p>Transaksi Penjualan Umum</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('apotek.index')}}" class="nav-link @if(Request::is('apotek')) active @endif">
              <i class="nav-icon fas fa-file-prescription"></i>
              <p>Resep Poliklinik</p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="#" class="nav-link @if(Request::is('apotek/resepluar')) active @elseif(Request::is('apotek/resepluar/*')) active @endif">
              <i class="nav-icon fas fa-file-prescription"></i>
              <p>Penjualan Resep Luar</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link @if(Request::is('apotek/report')) active @elseif(Request::is('apotek/report')) active @endif">
              <i class="nav-icon fas fa-file-prescription"></i>
              <p>Copy Resep</p>
            </a>
          </li> --}}
        </ul>
      </li>

      <li class="nav-header"></li>
      
      <li class="nav-item @if(Request::is('kasir')) menu-is-opening menu-open @elseif(Request::is('kasir/*')) menu-is-opening menu-open @endif">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-cash-register"></i>
          <p>
            Kasir
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('kasir.index')}}" class="nav-link @if(Request::is('kasir/pembayaranpasien')) active @elseif(Request::is('kasir/pembayaranpasien/*')) active @endif">
              <i class="nav-icon fas fa-money-bill-wave-alt"></i>
              <p>Pembayaran Pasien</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link @if(Request::is('kasir/pembayaranumum')) active @elseif(Request::is('kasir/pembayaranumum/*')) active @endif">
              <i class="nav-icon fas fa-money-bill-wave-alt"></i>
              <p>Pembayaran Umum</p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="#" class="nav-link @if(Request::is('kasir/report')) active @elseif(Request::is('kasir/report')) active @endif">
              <i class="nav-icon fas fa-user"></i>
              <p>Laporan Transaksi</p>
            </a>
          </li> --}}
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
      {{-- <li class="nav-header">MULTI LEVEL EXAMPLE</li> --}}
    </ul>
  </nav>
<!-- /.sidebar-menu -->