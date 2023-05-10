@extends('layouts.app')

@section('title')
    Guru
@endsection

@push('style')
    <style>
        .gallery-container .delete-gallery {
            display: block;
            position: absolute;
            top: -10px;
            right: 0;
        }

        .showModal {
            color: #73879c;
        }

        .showModal h4 {
            font-size: 24px;
        }
    </style>
@endpush

@section('content')
    <div class="">
        <div class="mb-5 page-title">
            <div class="title_left">
                <h3><small>Guru</small></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="x_panel">
                    <div class="x_title">
                        <a
                            class="mb-2 btn btn-primary btn-md"
                            href="#createData"
                            data-toggle="modal"
                            data-toggle="tooltip"
                        >
                            <i class="fa fa-plus-square"></i>
                            &nbsp;Tambah
                        </a>
                        <!-- Create modal -->
                        <div class="modal fade" id="createData" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form action="{{route('teacher.store')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                    @csrf
                                    @method('POST')
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">
                                                Tambah Guru
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nama</label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="name"
                                                                value="{{ old('name') }}"
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
                                                                value="{{ old('email') }}"
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nik</label>
                                                            <input
                                                                type="number"
                                                                class="form-control"
                                                                name="nik"
                                                                value="{{ old('nik') }}"
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Jabatan</label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="position"
                                                                value="{{ old('position') }}"
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nomor Telepon</label>
                                                            <input
                                                                type="number"
                                                                class="form-control"
                                                                name="phone_number"
                                                                placeholder="Contoh : 086865567789"
                                                                value="{{ old('phone_number') }}"
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-1">
                                                        <div class="form-group">
                                                            <label>Jenis Kelamin</label>
                                                            <br>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input
                                                                    type="radio"
                                                                    class="custom-control-input"
                                                                    name="gender"
                                                                    value="Laki-Laki"
                                                                    id="laki_laki"
                                                                >
                                                                <label for="laki_laki" class="custom-control-label">
                                                                    Laki - Laki
                                                                </label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input
                                                                    type="radio"
                                                                    class="custom-control-input"
                                                                    name="gender"
                                                                    value="Perempuan"
                                                                    id="perempuan"
                                                                >
                                                                <label for="perempuan" class="custom-control-label">
                                                                    Perempuan
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Email</th>


                                            <th>No HP</th>
                                            <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($teachers as $data)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$data->name}}</td>
                                                    <td>{{$data->email}}</td>

                                                    <td>{{$data->phone_number}}</td>
                                                    <td>
                                                        <a class="btn btn-warning btn-sm"
                                                            href="#editData{{$data->id}}"
                                                            data-toggle="modal"
                                                            data-toggle="tooltip"
                                                        >
                                                            Ubah
                                                        </a>
                                                        <a class="btn btn-danger btn-sm"
                                                            href="#deleteData{{$data->id}}"
                                                            data-toggle="modal"
                                                            data-toggle="tooltip"
                                                        >
                                                            Hapus
                                                        </a>
                                                    </td>
                                                    <!-- Edit modal -->
                                                    <div class="modal fade showModal" id="editData{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <form action="{{route('teacher.update', $data->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myModalLabel">
                                                                            <i class="fa fa-edit"></i>
                                                                            Ubah Guru
                                                                        </h4>
                                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Name</label>
                                                                                        <input
                                                                                            type="text"
                                                                                            class="form-control"
                                                                                            name="name"
                                                                                            value="{{$data->name}}"
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
                                                                                            value="{{$data->email}}"
                                                                                        >
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>NIK</label>
                                                                                        <input
                                                                                            type="number"
                                                                                            class="form-control"
                                                                                            name="nik"
                                                                                            value="{{$data->nik}}"
                                                                                        >
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Jabatan</label>
                                                                                        <input
                                                                                            type="text"
                                                                                            class="form-control"
                                                                                            name="position"
                                                                                            value="{{$data->position}}"
                                                                                        >
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Nomor Telepon</label>
                                                                                        <input
                                                                                            type="number"
                                                                                            class="form-control"
                                                                                            name="phone_number"
                                                                                            placeholder="Contoh : 086865567789"
                                                                                            value="{{$data->phone_number}}"
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
                                                                                                value="Laki-Laki"
                                                                                                {{$data->gender=='Laki-Laki'?'checked':''}}
                                                                                                id="laki_laki{{$data->id}}"
                                                                                            >
                                                                                            <label for="laki_laki{{$data->id}}" class="custom-control-label">
                                                                                                Laki - Laki
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                                            <input
                                                                                                type="radio"
                                                                                                class="custom-control-input"
                                                                                                name="gender"
                                                                                                value="Perempuan"
                                                                                                {{$data->gender=='Perempuan'?'checked':''}}
                                                                                                id="perempuan{{$data->id}}"
                                                                                            >
                                                                                            <label for="perempuan{{$data->id}}" class="custom-control-label">
                                                                                                Perempuan
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <a class="btn btn-warning"
                                                                            href="#reset{{$data->id}}"
                                                                            data-toggle="modal"
                                                                            data-toggle="tooltip"
                                                                        >
                                                                            Reset password
                                                                        </a>
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                    </div>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    {{-- Modal Delete Data --}}
                                                    <div id="deleteData{{$data->id}}" class="modal fade">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form class="d-inline-block" action="{{route('teacher.destroy', $data->id)}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Hapus Guru</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Apakah Anda yakin ingin menghapus data <strong>?</strong></p>
                                                                        <p class="text-warning"><small>Tindakan ini tidak bisa dibatalkan.</small></p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="button" class="btn btn-primary" data-dismiss="modal" value="Batal">
                                                                        <button type="submit" class="btn btn-danger btn-small">Hapus</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Modal Reset Data --}}
                                                    <div id="reset{{$data->id}}" class="modal fade">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form class="d-inline-block" action="{{route('reset.password.teacher', $data->id)}}" method="POST">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Reset Password</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Apakah Anda yakin ingin mengreset password <strong>?</strong></p>
                                                                        <p class="text-warning"><small>Tindakan ini tidak bisa dibatalkan.</small></p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancel">
                                                                        <button type="submit" class="btn btn-danger btn-small">reset</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/production/js/alert/sweetalert2.min.js') }}"></script>
    {{-- alert success add --}}
    <script>
        if ({{session()->has('notification-success-add')}}) {
            Swal.fire({
                icon: 'success',
                title: 'SUCCESS',
                text: 'Data berhasil di tambah!'
            })
        }
    </script>
    {{-- alert success edit --}}
    <script>
        if ({{session()->has('notification-success-edit')}}) {
            Swal.fire({
                icon: 'success',
                title: 'SUCCESS',
                text: 'Data berhasil di edit!'
            })
        }
    </script>
    {{-- alert success delete --}}
    <script>
        if ({{session()->has('notification-success-delete')}}) {
            Swal.fire({
                icon: 'success',
                title: 'SUCCESS',
                text: 'Data berhasil di hapus!'
            })
        }
    </script>
    {{-- alert success reset --}}
    <script>
        if ({{session()->has('notification-success-reset')}}) {
            Swal.fire({
                icon: 'success',
                title: 'SUCCESS',
                text: 'Password berhasil di reset!'
            })
        }
    </script>
@endpush

