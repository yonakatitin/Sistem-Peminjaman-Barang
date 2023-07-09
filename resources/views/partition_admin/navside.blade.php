                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="/admin/dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Data</div>
                            <a class="nav-link {{Request::path() == 'admin/unit' ? 'active' : ''}}" href="/admin/unit">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-book"></i></div>
                                Unit
                            </a>
                            <a class="nav-link {{Request::path() == 'admin/kategori' ? 'active' : ''}}" href="/admin/kategori">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-landmark"></i></div>
                                Kategori
                            </a>
                            <a class="nav-link {{Request::path() == 'admin/user' ? 'active' : ''}}" href="/admin/user">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-users"></i></div>
                                User
                            </a>
                            <a class="nav-link {{Request::path() == 'admin/adminunit' ? 'active' : ''}}" href="/admin/adminunit">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-id-badge"></i></div>
                                Admin Unit
                            </a>
                            <a class="nav-link {{Request::path() == 'admin/reqadminunit' ? 'active' : ''}}" href="/admin/reqadminunit">
                            <div class="sb-nav-link-icon"><i class="fas fa-fw fa-user-check"></i></div>
                                Request Admin Unit
                            </a>
                            <!-- <a class="nav-link {{Request::path() == 'admin/reqadminunit' ? 'active' : ''}}" href="/admin/reqadminunit">Request Admin Unit</a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Tabel Data 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link {{Request::path() == 'admin/unit' ? 'active' : ''}}" href="/admin/unit">Unit</a>
                                    <a class="nav-link {{Request::path() == 'admin/kategori' ? 'active' : ''}}" href="/admin/kategori">Kategori</a>
                                    <a class="nav-link {{Request::path() == 'admin/user' ? 'active' : ''}}" href="/admin/user">User</a>
                                    <a class="nav-link {{Request::path() == 'admin/adminunit' ? 'active' : ''}}" href="/admin/adminunit">Admin Unit</a>
                                    <a class="nav-link {{Request::path() == 'admin/reqadminunit' ? 'active' : ''}}" href="/admin/reqadminunit">Request Admin Unit</a>
                                </nav>
                            </div> -->
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ auth()->user()->name }}
                    </div>
                </nav>