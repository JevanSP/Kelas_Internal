<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="/dasboard">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dasboard
                </a>

                {{-- @if (Auth::user()->role == 'admin') --}}

                <div class="sb-sidenav-menu-heading">Role</div>
                <a class="nav-link" href="/user">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    User
                </a>
                <div class="sb-sidenav-menu-heading">Management</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Produk
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="/jenisbarang">Jenis Barang</a>
                        <a class="nav-link" href="/barang">Barang</a>
                    </nav>
                </div>

                {{-- @endif --}}

                {{-- @if (Auth::user()->role == 'kasir') --}}
                    
                <div class="sb-sidenav-menu-heading">TRANSAKSI</div>
                <a class="nav-link" href="/transaksi">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                    Transaksi
                </a>

                {{-- @endif --}}
                {{-- <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="/dasboard">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dasboard
                </a>
                <div class="sb-sidenav-menu-heading">Role</div>
                <a class="nav-link" href="/user">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    User
                </a>
                <div class="sb-sidenav-menu-heading">Management</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Produk
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="/jenisbarang">Jenis Barang</a>
                        <a class="nav-link" href="/barang">Barang</a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">TRANSAKSI</div>
                <a class="nav-link" href="/transaksi">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                    Transaksi
                </a> --}}
            </div>
        </div>
    </nav>
</div>