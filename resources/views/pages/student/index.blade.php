@extends('layouts.app')

@section('title')
    Siswa&nbsp;@if(Auth::user()->role == 'Teacher')(Hafalan)@endif
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
                <h3><small>Siswa<b>&nbsp;Kelas&nbsp;{{$filter != 'all' ? $clas->name : 'Semua'}}</b> </small></h3>
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
                    <div class="x_content x_title col-sm-12">
                        @if (Auth::user()->role == 'Admin')
                            <a
                                class="mt-3 btn btn-primary btn-md"
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
                                    <form action="{{ route('student.store') }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                        @method('POST')
                                        @csrf
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">
                                                    Tambah Siswa
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <input type="hidden" name="class_id" value="{{$clas != 'all' ? $clas->id : 'all'}}">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>NISN<span class="text-danger">*</span> </label>
                                                                <input
                                                                    type="number"
                                                                    class="form-control"
                                                                    name="nisn"
                                                                    value="{{ old('nisn') }}"
                                                                    placeholder="nisn"
                                                                >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>NIK<span class="text-danger">*</span> </label>
                                                                <input
                                                                    type="number"
                                                                    class="form-control"
                                                                    name="nik"
                                                                    value="{{ old('nik') }}"
                                                                    placeholder="nik"
                                                                >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Nama<span class="text-danger">*</span> </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    name="name"
                                                                    value="{{ old('name') }}"
                                                                    placeholder="nama"
                                                                >
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tempat Lahir<span class="text-danger">*</span> </label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    name="place_of_birth"
                                                                    value="{{ old('place_of_birth') }}"
                                                                    placeholder="tempat lahir"
                                                                >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <label>Tanggal Lahir<span class="text-danger">*</span> </label>
                                                            <input
                                                                id="birthday"
                                                                class="date-picker form-control"
                                                                placeholder="dd-mm-yyyy"
                                                                type="text"
                                                                onfocus="this.type='date'"
                                                                onmouseover="this.type='date'"
                                                                onclick="this.type='date'"
                                                                onblur="this.type='text'"
                                                                onmouseout="timeFunctionLong(this)"
                                                                name="born"
                                                            >
                                                            <script>
                                                                function timeFunctionLong(input) {
                                                                    setTimeout(function() {
                                                                        input.type = 'text';
                                                                    }, 60000);
                                                                }
                                                            </script>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Agama<span class="text-danger">*</span> </label>
                                                                <select name="religion" class="form-control"  style="width: 100%;">
                                                                    <option value="Islam">Islam</option>
                                                                    <option value="Kristen">Kristen</option>
                                                                    <option value="Prostestan">Prostestan</option>
                                                                    <option value="Hinddu">Hindu</option>
                                                                    <option value="Buddha">Buddha</option>
                                                                    <option value="Konghocu">Konghocu</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Alamat<span class="text-danger">*</span> </label>
                                                                <textarea name="address" class="form-control">{{old('address')}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mt-2">
                                                            <div class="form-group">
                                                                <label>Jenis Kelamin<span class="text-danger">*</span> </label>
                                                                <br>
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input
                                                                        type="radio"
                                                                        class="custom-control-input"
                                                                        name="gender"
                                                                        id="laki"
                                                                        value="Laki-Laki"
                                                                    >
                                                                    <label for="laki" class="custom-control-label">
                                                                        Laki-laki
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input
                                                                        type="radio"
                                                                        class="custom-control-input"
                                                                        name="gender"
                                                                        id="Cewe"
                                                                        value="Perempuan"
                                                                    >
                                                                    <label for="Cewe" class="custom-control-label">
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

                            <!-- Import -->
                            <a
                                class="mt-3 btn btn-warning btn-md"
                                href="#import"
                                data-toggle="modal"
                                data-toggle="tooltip"
                            >
                                <i class="fa fa-print"></i>
                                &nbsp;Import
                            </a>
                            <!-- Create modal -->
                            <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{ route('student.import') }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">
                                                    Import Siswa
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Pilih File (Excel)<span class="text-danger">*</span> </label>
                                                    <input
                                                        type="file"
                                                        class="form-control"
                                                        name="file"
                                                    >
                                                </div>
                                                <a class="my-5" href="{{route('student.template')}}">Download Template <i class="fa fa-download"></i></a>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Kirim</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Export -->
                            <a
                                class="mt-3 btn btn-info btn-md"
                                href="{{route('student.export')}}"
                                target="black"
                            >
                                <i class="fa fa-print"></i>
                                &nbsp;Export
                            </a>

                            @if ($filter != 'all')
                                <!-- Export Per kelas -->
                                <a
                                    class="mt-3 btn btn-success btn-md"
                                    href="{{route('student.class.export', $clas->id)}}"
                                    target="black"
                                >
                                    <i class="fa fa-print"></i>
                                    &nbsp;Export {{$clas->name}}
                                </a>
                            @endif
                        @endif

                        <ul class="nav navbar-right panel_toolbox">
                            <form action="{{route('student.index')}}" method="GET" class="col-md-12">
                                <div class="form-group">
                                    <label>Pilih Kelas</label>
                                    <select name="class" onchange="this.form.submit()" class="form-control" style="width: 100%;">
                                        <option disabled="disabled">-- Pilih Kelas --</option>
                                        <option {{$clas == 'all' ? 'selected' : ''}} selected value="all">-- Semua Murid --</option>
                                        @foreach ($classes as $class)
                                            @if ($filter != 'all')
                                                <option {{$clas->id == $class->id ? 'selected' : ''}} value="{{$class->id}}">Kelas&nbsp;{{$class->name}}</option>
                                            @else
                                                <option value="{{$class->id}}">Kelas&nbsp;{{$class->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </ul>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    @if ($filter == 'all')
                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>NISN</th>
                                                    <th>Nama</th>
                                                    <th>Umur</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Kelas</th>
                                                    <th>Jumlah Hafalan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($students as $data)
                                                    @if (Auth::user()->role == 'Admin')
                                                        <!-- Edit modal -->
                                                        <div class="modal fade showModal" id="editData{{ $data->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <form id="edit" action="{{ route('student.update',$data->id) }}" method="POST"  data-parsley-validate class="form-horizontal form-label-left">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel">
                                                                                <i class="fa fa-edit"></i>
                                                                                Ubah Siswa
                                                                            </h4>
                                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                    <input type="hidden" value="{{$data->class_id}}" name="class_id">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Nisn<span class="text-danger">*</span> </label>
                                                                                            <input
                                                                                                type="number"
                                                                                                class="form-control"
                                                                                                name="nisn"
                                                                                                value="{{ $data->nisn }}"
                                                                                            >
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Nik<span class="text-danger">*</span> </label>
                                                                                            <input
                                                                                                type="number"
                                                                                                class="form-control"
                                                                                                name="nik"
                                                                                                value="{{ $data->nik }}"
                                                                                            >
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Nama<span class="text-danger">*</span> </label>
                                                                                            <input
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                name="name"
                                                                                                value="{{ $data->name }}"

                                                                                            >
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Tempat Lahir<span class="text-danger">*</span> </label>
                                                                                            <input
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                name="place_of_birth"
                                                                                                value="{{ $data->place_of_birth }}"
                                                                                            >
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Periode<span class="text-danger">*</span> </label>
                                                                                            <select name="period_id" class="form-control"  style="width: 100%;">
                                                                                                @foreach ($periods as $period)
                                                                                                    <option {{$period->id == $data->period_id ? 'selected' : ''}} value="{{$period->id}}">{{$period->year_start}}/{{$period->year_end}}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 col-sm-6 ">
                                                                                        <div class="form-group">
                                                                                            <label>Tanggal Lahir<span class="text-danger">*</span> </label>
                                                                                            <input
                                                                                                id="birthday"
                                                                                                class="date-picker form-control"
                                                                                                placeholder="dd-mm-yyyy"
                                                                                                type="text"
                                                                                                onfocus="this.type='date'"
                                                                                                onmouseover="this.type='date'"
                                                                                                onclick="this.type='date'"
                                                                                                onblur="this.type='text'"
                                                                                                onmouseout="timeFunctionLong(this)"
                                                                                                name="born"
                                                                                                value="{{ $data->born }}"
                                                                                            >
                                                                                            <script>
                                                                                                function timeFunctionLong(input) {
                                                                                                    setTimeout(function() {
                                                                                                        input.type = 'text';
                                                                                                    }, 60000);
                                                                                                }
                                                                                            </script>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Agama<span class="text-danger">*</span> </label>
                                                                                            <select name="religion" class="form-control"  style="width: 100%;">
                                                                                                <option value="Islam" {{ $data->religion == 'Islam' ? 'selected' : ''}}>Islam</option>
                                                                                                <option value="Kristen" {{ $data->religion == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                                                                <option value="Prostestan" {{ $data->religion == 'Prostestan' ? 'selected' : ''}}>Prostestan</option>
                                                                                                <option value="Hinddu" {{ $data->religion == 'Hinddu' ? 'selected' : '' }}>Hinddu</option>
                                                                                                <option value="Buddha" {{ $data->religion == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                                                                <option value="Konghocu" {{ $data->religion == 'Konghocu' ? 'selected' : '' }}>Konghocu</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Jenis Kelamin<span class="text-danger">*</span> </label>
                                                                                            <br>
                                                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                                                <input
                                                                                                    type="radio"
                                                                                                    class="custom-control-input"
                                                                                                    name="gender"
                                                                                                    id="Laki-Laki{{$data->id}}"
                                                                                                    value="Laki-Laki" {{ old('gender',$data->gender) == 'Laki-Laki' ? 'checked' : ''}}
                                                                                                >
                                                                                                <label for="Laki-Laki{{$data->id}}" class="custom-control-label">
                                                                                                    Laki-laki
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                                                <input
                                                                                                    type="radio"
                                                                                                    class="custom-control-input"
                                                                                                    name="gender"
                                                                                                    id="Perempuan{{$data->id}}"
                                                                                                    value="Perempuan" {{ old('gender',$data->gender) == 'Perempuan' ? 'checked' : ''}}
                                                                                                >
                                                                                                <label for="Perempuan{{$data->id}}" class="custom-control-label">
                                                                                                    Perempuan
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Alamat<span class="text-danger">*</span> </label>
                                                                                            <textarea name="address" class="form-control">{{ $data->address }}</textarea>
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
                                                        <div id="deleteData{{ $data->id }}" class="modal fade">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form class="d-inline-block" action="{{route('student.destroy', $data->id)}}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Hapus Siswa</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Apakah Anda yakin ingin menghapus data <strong>?</p>
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
                                                                    <form class="d-inline-block" action="{{route('reset.password.student', $data->id)}}" method="POST">
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
                                                    @endif
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $data->nisn }}</td>
                                                        <td>{{ $data->name }}</td>
                                                        <td>{{ $data->age }}</td>
                                                        <td>{{ $data->gender }}</td>
                                                        <td>{{ $data->clas->first() != NULL ? 'Kelas '.$data->clas->first()->name : '-' }}</td>
                                                        <td>
                                                            <li class="list-unstyled">
                                                                <b>{{ $data->memorization_juz == null ? 0 : $data->memorization_juz }}</b>&nbsp;Juz
                                                            <b>{{ $data->memorization_page == null ? 0 : $data->memorization_page }}</b>&nbsp;Halaman
                                                            </li>
                                                        </td>
                                                        <td>
                                                            @if (Auth::user()->role == 'Admin')
                                                                <a class="btn btn-success btn-sm"
                                                                    href="{{ route('student.show',$data->id) }}"
                                                                >
                                                                    Detail
                                                                </a>
                                                                <a class="btn btn-warning btn-sm"
                                                                    href="#editData"
                                                                    data-toggle="modal"
                                                                    data-target="#editData{{ $data->id }}"
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
                                                            @else
                                                                <a class="btn btn-success btn-sm"
                                                                    href="{{ route('memorization.show',$data->id) }}"
                                                                >
                                                                    Show
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>NISN</th>
                                                    <th>Nama</th>
                                                    <th>Umur</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Jumlah Hafalan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($students as $data)
                                                    @if (Auth::user()->role == 'Admin')
                                                        <!-- Edit modal -->
                                                        <div class="modal fade showModal" id="editData{{ $data->student->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <form id="edit" action="{{ route('student.update',$data->student->id) }}" method="POST"  data-parsley-validate class="form-horizontal form-label-left">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel">
                                                                                <i class="fa fa-edit"></i>
                                                                                Ubah Siswa
                                                                            </h4>
                                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                    <input type="hidden" value="{{$data->class_id}}" name="class_id">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Nisn</label>
                                                                                            <input
                                                                                                type="number"
                                                                                                class="form-control"
                                                                                                name="nisn"
                                                                                                value="{{ $data->student->nisn }}"
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
                                                                                                value="{{ $data->student->nik }}"
                                                                                            >
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Nama</label>
                                                                                            <input
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                name="name"
                                                                                                value="{{ $data->student->name }}"

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
                                                                                                value="{{ $data->student->phone_number }}"

                                                                                            >
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Tempat Lahir</label>
                                                                                            <input
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                name="place_of_birth"
                                                                                                value="{{ $data->student->place_of_birth }}"
                                                                                            >
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Periode</label>
                                                                                            <select name="period_id" class="form-control"  style="width: 100%;">
                                                                                                @foreach ($periods as $period)
                                                                                                    <option {{$period->id == $data->period_id ? 'selected' : ''}} value="{{$period->id}}">{{$period->year_start}}/{{$period->year_end}}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 col-sm-6 ">
                                                                                        <div class="form-group">
                                                                                            <label>Tanggal Lahir</label>
                                                                                            <input
                                                                                                id="birthday"
                                                                                                class="date-picker form-control"
                                                                                                placeholder="dd-mm-yyyy"
                                                                                                type="text"
                                                                                                onfocus="this.type='date'"
                                                                                                onmouseover="this.type='date'"
                                                                                                onclick="this.type='date'"
                                                                                                onblur="this.type='text'"
                                                                                                onmouseout="timeFunctionLong(this)"
                                                                                                name="born"
                                                                                                value="{{ $data->student->born }}"
                                                                                            >
                                                                                            <script>
                                                                                                function timeFunctionLong(input) {
                                                                                                    setTimeout(function() {
                                                                                                        input.type = 'text';
                                                                                                    }, 60000);
                                                                                                }
                                                                                            </script>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Agama</label>
                                                                                            <select name="religion" class="form-control"  style="width: 100%;">
                                                                                                <option value="Islam" {{ $data->student->religion == 'Islam' ? 'selected' : ''}}>Islam</option>
                                                                                                <option value="Kristen" {{ $data->student->religion == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                                                                <option value="Prostestan" {{ $data->student->religion == 'Prostestan' ? 'selected' : ''}}>Prostestan</option>
                                                                                                <option value="Hinddu" {{ $data->student->religion == 'Hinddu' ? 'selected' : '' }}>Hinddu</option>
                                                                                                <option value="Buddha" {{ $data->student->religion == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                                                                <option value="Konghocu" {{ $data->student->religion == 'Konghocu' ? 'selected' : '' }}>Konghocu</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Alamat</label>
                                                                                            <textarea name="address" class="form-control">{{ $data->student->address }}</textarea>
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
                                                                                                    id="Laki-Laki{{$data->student->id}}"
                                                                                                    value="Laki-Laki" {{ old('gender',$data->student->gender) == 'Laki-Laki' ? 'checked' : ''}}
                                                                                                >
                                                                                                <label for="Laki-Laki{{$data->student->id}}" class="custom-control-label">
                                                                                                    Laki-laki
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                                                <input
                                                                                                    type="radio"
                                                                                                    class="custom-control-input"
                                                                                                    name="gender"
                                                                                                    id="Perempuan{{$data->student->id}}"
                                                                                                    value="Perempuan" {{ old('gender',$data->student->gender) == 'Perempuan' ? 'checked' : ''}}
                                                                                                >
                                                                                                <label for="Perempuan{{$data->student->id}}" class="custom-control-label">
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
                                                                                href="#reset{{$data->student->id}}"
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
                                                        <div id="deleteData{{ $data->student->id }}" class="modal fade">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form class="d-inline-block" action="{{route('student.destroy', $data->student->id)}}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Hapus Siswa</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Apakah Anda yakin ingin menghapus data <strong>?</p>
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
                                                    @endif
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $data->student->nisn }}</td>
                                                        <td>{{ $data->student->name }}</td>
                                                        <td>{{ $data->student->age }}</td>
                                                        <td>{{ $data->student->gender }}</td>
                                                        <td>
                                                        <li class="list-unstyled">
                                                            <b>{{ $data->student->memorization_juz == null ? 0 : $data->student->memorization_juz }}</b>&nbsp;Juz
                                                        <b>{{ $data->student->memorization_page == null ? 0 : $data->student->memorization_page }}</b>&nbsp;Halaman
                                                        </li>
                                                        </td>
                                                        <td>
                                                            @if (Auth::user()->role == 'Admin')
                                                                <a class="btn btn-success btn-sm"
                                                                    href="{{ route('student.show',$data->student->id) }}"
                                                                >
                                                                    Detail
                                                                </a>
                                                                <a class="btn btn-warning btn-sm"
                                                                    href="#editData"
                                                                    data-toggle="modal"
                                                                    data-target="#editData{{ $data->student->id }}"
                                                                >
                                                                    Ubah
                                                                </a>
                                                                <a class="btn btn-danger btn-sm"
                                                                    href="#deleteData{{$data->student->id}}"
                                                                    data-toggle="modal"
                                                                    data-toggle="tooltip"
                                                                >
                                                                    Hapus
                                                                </a>
                                                            @else
                                                                <a class="btn btn-success btn-sm"
                                                                    href="{{ route('memorization.show',$data->student->id) }}"
                                                                >
                                                                    Show
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
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
    {{-- alert success import --}}
    <script>
        if ({{session()->has('notification-success-import')}}) {
            Swal.fire({
                icon: 'success',
                title: 'SUCCESS',
                text: 'Data berhasil di import!'
            })
        }
    </script>
    {{-- alert success Export --}}
    <script>
        if ({{session()->has('notification-success-export')}}) {
            Swal.fire({
                icon: 'success',
                title: 'SUCCESS',
                text: 'Data berhasil di export!'
            })
        }
    </script>
@endpush
