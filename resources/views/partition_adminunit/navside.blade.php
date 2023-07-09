<nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link {{Request::path() == 'adminunit/dashboard' ? 'active' : ''}}" href="/adminunit/dashboard">
                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Data</div>
            <a class="nav-link {{Request::path() == 'adminunit/barang' ? 'active' : ''}}" href="/adminunit/barang">
                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-tachometer-alt"></i></div>
                Barang
            </a>
            <a class="nav-link {{Request::path() == 'adminunit/reqpeminjaman' ? 'active' : ''}}" href="/adminunit/reqpeminjaman">
                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-tachometer-alt"></i></div>
                Permintaan Peminjaman
            </a>
            <a class="nav-link {{Request::path() == 'adminunit/peminjaman' ? 'active' : ''}}" href="/adminunit/peminjaman">
                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-tachometer-alt"></i></div>
                Peminjaman
            </a>
            <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Tabel Data
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav"> -->
                    <!-- <a class="nav-link {{Request::path() == 'adminunit/unit' ? 'active' : ''}}" href="/adminunit/unit">Unit</a> -->
                    <!-- <a class="nav-link {{Request::path() == 'adminunit/kategori' ? 'active' : ''}}" href="/adminunit/kategori">Kategori</a> -->
                    <!-- <a class="nav-link {{Request::path() == 'adminunit//barang' ? 'active' : ''}}" href="/adminunit/barang">Barang</a>
                    <a class="nav-link {{Request::path() == 'adminunit/reqpeminjaman' ? 'active' : ''}}" href="/adminunit/reqpeminjaman">Permintaan Peminjaman</a>
                    <a class="nav-link {{Request::path() == 'adminunit/peminjaman' ? 'active' : ''}}" href="/adminunit/peminjaman">Peminjaman</a>
                </nav> -->
            <!-- </div> -->
        </div>
    </div>
    <!-- <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ auth()->user()->name }}
    </div> -->
</nav>