<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">Start Bootstrap</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <!-- <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a> -->
                        <a class="dropdown-item" class="fas fa-address-book" href="#">Login as: {{ Auth::user()->name }}</a>
                        <a class="dropdown-item"><i class="fas fa-id-badge"></i>IP: {{auth()->user()->previousLoginIp()??'Not found'}}</a>
                        <a class="dropdown-item"><i class="fas fa-id-card-alt"></i>Last Visit: {{auth()->user()->previousLoginAt()??'Not found'}}</a>
                        <div class="dropdown-divider"></div>
                        <!-- <a class="dropdown-item" href="http://training-kptm8.test/home">Logout</a> -->
                        
                        <!-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> -->
                    <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Logout</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                        <!-- <a class="dropdown-item" href="http://training-kptm8.test/login" >
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a> -->

              


                    </div>
                </li>
            </ul>
        </nav>