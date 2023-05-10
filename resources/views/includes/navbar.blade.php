<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('assets/production/images/user.png') }}" alt="">{{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"
                        href="#profile"
                        data-toggle="modal"
                        data-id="{{ Auth::user()->id }}"
                        data-target="#profile{{ Auth::user()->id }}"
                    >
                        Profil
                    </a>
                    <a
                        class="dropdown-item"
                        href="#logout"
                        data-toggle="modal"
                        data-toggle="tooltip"
                    >
                        <i class="fa fa-sign-out pull-right"></i>
                        Keluar
                    </a>
                    </div>
                </li>

                <!-- Edit modal -->
                <div class="modal fade showModal" id="profile{{ Auth::user()->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form id="edit" action="{{ route('admin.update',Auth::user()->id) }}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                            @method('PUT')
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">
                                        <i class="fa fa-edit"></i>
                                        Profile&nbsp;{{ Auth::user()->role }}
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <input type="hidden" value="back" name="back">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="name"
                                                        value="{{Auth::user()->name}}"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input
                                                        type="email"
                                                        class="form-control"
                                                        name="email"
                                                        value="{{Auth::user()->email}}"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password Lama</label>
                                                    <input
                                                        type="password"
                                                        class="form-control"
                                                        name="oldpassword"
                                                        autocomplete="off"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password Baru</label>
                                                    <input
                                                        type="password"
                                                        class="form-control"
                                                        name="newpassword"
                                                        autocomplete="off"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <br>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input
                                                            type="radio"
                                                            class="custom-control-input"
                                                            name="gender"
                                                            id="Laki-Laki"
                                                            value="Laki-Laki" {{ old('gender', Auth::user()->gender) == 'Laki-Laki' ? 'checked' : ''}}
                                                        >
                                                        <label for="Laki-Laki" class="custom-control-label">
                                                            Laki-laki
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input
                                                            type="radio"
                                                            class="custom-control-input"
                                                            name="gender"
                                                            id="Perempuan"
                                                            value="Perempuan" {{ old('gender', Auth::user()->gender) == 'Perempuan' ? 'checked' : ''}}
                                                        >
                                                        <label for="Perempuan" class="custom-control-label">
                                                            Perempuan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Modal Logout --}}
                <div id="logout" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form class="d-inline-block" action="{{route('logout')}}" method="GET">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title">Keluar</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin keluar ?</p>
                                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-primary" data-dismiss="modal" value="Batal">
                                    <button type="submit" class="btn btn-danger btn-small">Ya, Yakin</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </ul>
        </nav>
    </div>
</div>
