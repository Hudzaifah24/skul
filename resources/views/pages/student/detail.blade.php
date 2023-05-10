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
                <h3>
                    <small>Detail Siswa
                        <b>{{ $students->name }}</b>
                    </small>
                </h3>
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
                    @if (Auth::user()->role == 'Admin')
                        <a
                            class="mb-2 btn btn-dark btn-md"
                            href="{{ route('student.index') }}"
                        >
                            <i class="fa fa-arrow-circle-left"></i>
                            &nbsp;Kembali
                        </a>
                    @else
                        <a
                            class="mb-2 btn btn-dark btn-md"
                            href="{{ route('memorization.index') }}"
                        >
                            <i class="fa fa-arrow-circle-left"></i>
                            &nbsp;Kembali
                        </a>
                    @endif
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @if (Auth::user()->role == 'Admin')
                        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{(request()->is('student/'.$students->id)) ? 'active' : ''}}" id="home-tab" data-toggle="tab" href="#biodata" role="tab" aria-controls="home" aria-selected="{{(request()->is('student/'.$students->id)) ? 'true' : 'false'}}">Biodata</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{(request()->is('student/'.$students->id.'orangTua')) ? 'active' : ''}}" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="{{(request()->is('student/'.$students->id.'orangTua')) ? 'true' : 'false'}}">Orang Tua</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{(request()->is('student/'.$students->id.'guardians')) ? 'active' : ''}}" id="card-pills-2" data-toggle="tab" href="#waliSantri" role="tab" aria-controls="card-2" aria-selected="{{(request()->is('student/'.$students->id.'guardians')) ? 'true' : 'false'}}">Wali Murid</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{(request()->is('student/'.$students->id.'hafalan')) ? 'active' : ''}}" id="contact-tab" data-toggle="tab" href="#hafalan" role="tab" aria-controls="contact" aria-selected="{{(request()->is('student/'.$students->id.'hafalan')) ? 'true' : 'false'}}">Hafalan</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">

                            {{-- Biodata --}}
                            <div class="tab-pane fade {{(request()->is('student/'.$students->id)) ? 'show active' : ''}}" id="biodata" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card-body">
                                    <div class="row">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">NISN</th>
                                                    <td>{{ $students->nisn }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">NIK</th>
                                                    <td>{{ $students->nik }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Nama</th>
                                                    <td>{{ $students->name }}</td>
                                                </tr>

                                                <tr>
                                                    <th scope="row">TTL</th>
                                                    <td>{{ $students->place_of_birth }}, {{ $students->born }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Agama</th>
                                                    <td>{{ $students->religion }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Alamat</th>
                                                    <td>{{ $students->address }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Jenis Kelamin</th>
                                                    <td>{{ $students->gender }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Periode</th>
                                                    <td>{{ $studentClass->period->year_start }}/{{ $studentClass->period->year_end }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- Orang Tua --}}
                            <div class="tab-pane fade {{(request()->is('student/'.$students->id.'orangTua')) ? 'show active' : ''}}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <!-- Create modal Ayah -->
                                        <div class="modal fade showModal" id="createAyah" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <form action="{{route('fossil.store')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">
                                                                Tambah Ayah
                                                            </h4>
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="card-body">
                                                                <div class="row">
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
                                                                            <label>Nomor Telepon<span class="text-danger">*</span> </label>
                                                                            <input
                                                                                type="number"
                                                                                class="form-control"
                                                                                name="phone_number"
                                                                                placeholder="Contoh : 085895568876"
                                                                                value="{{ old('phone_number') }}"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Penghasilan<span class="text-danger">*</span> </label>
                                                                            <input
                                                                                type="number"
                                                                                class="form-control"
                                                                                name="income"
                                                                                placeholder="penghasilah"
                                                                                value="{{ old('income') }}"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Agama<span class="text-danger">*</span> </label>
                                                                            <select name="religion" class="form-control" style="width: 100%;">
                                                                                <option selected="selected" disabled="disabled">-- Pilih --</option>
                                                                                <option value="Islam">Islam</option>
                                                                                <option value="Kristen">Kristen</option>
                                                                                <option value="Hindu">Hindu</option>
                                                                                <option value="Budha">Budha</option>
                                                                                <option value="Prostestan">Protestan</option>
                                                                                <option value="Konghocu">Konghocu</option>
                                                                                <option value="Katolik">Katolik</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Pendidikan Terakhir<span class="text-danger">*</span> </label>
                                                                            <select name="education" class="form-control" style="width: 100%;">
                                                                                <option selected="selected" disabled="disabled">-- Pilih --</option>
                                                                                <option value="SD">SD</option>
                                                                                <option value="SMP">SMP</option>
                                                                                <option value="SMA">SMA</option>
                                                                                <option value="S1">S1</option>
                                                                                <option value="S2">S2</option>
                                                                                <option value="S3">S3</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Pekerjaan<span class="text-danger">*</span> </label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="work"
                                                                                value="{{ old('work') }}"
                                                                                placeholder="pekerjaan"
                                                                            >
                                                                        </div>
                                                                    </div>

                                                                    <input type="hidden" name="status" value="Ayah" >
                                                                    <input type="hidden" name="student_id" value="{{ $students->id }}" >
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
                                        @foreach ($fossils as $fossil)
                                            @if ($fossil->status == "Ayah")
                                                <!-- Edit modal Ayah -->
                                                <div class="modal fade showModal" id="editAyah" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <form action="{{ route('fossil.update',$fossil->id) }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel">
                                                                        Ubah Ayah
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nama<span class="text-danger">*</span> </label>
                                                                                    <input
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        name="name"
                                                                                        value="{{ $fossil->name }}"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Telepon<span class="text-danger">*</span> </label>
                                                                                    <input
                                                                                        type="number"
                                                                                        class="form-control"
                                                                                        name="income"
                                                                                        placeholder="Contoh : 085895568876"
                                                                                        value="{{ $fossil->phone_number }}"

                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Penghasilan<span class="text-danger">*</span> </label>
                                                                                    <input
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        name="income"
                                                                                        placeholder="Rp 2.200.000"
                                                                                        value="{{ $fossil->income }}"

                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Agama<span class="text-danger">*</span> </label>
                                                                                    <select name="religion" class="form-control"  style="width: 100%;">
                                                                                        <option selected="selected" disabled="disabled">-- Pilih --</option>
                                                                                        <option value="Islam" {{ $fossil->religion == 'Islam' ? 'selected' : ''}}>Islam</option>
                                                                                        <option value="Kristen" {{ $fossil->religion == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                                                        <option value="Hindu" {{ $fossil->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                                                        <option value="Budha" {{ $fossil->religion == 'Budha' ? 'selected' : '' }}>Budha</option>
                                                                                        <option value="Prostestan" {{ $fossil->religion == 'Prostestan' ? 'selected' : ''}}>Protestan</option>
                                                                                        <option value="Konghocu" {{ $fossil->religion == 'Konghocu' ? 'selected' : '' }}>Konghocu</option>
                                                                                        <option value="Katolik" {{ $fossil->religion == 'Katolik' ? 'selected' : ''}}>Katolik</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Pendidikan Terakhir<span class="text-danger">*</span> </label>
                                                                                    <select name="education" class="form-control" style="width: 100%;">
                                                                                        <option selected="selected" disabled="disabled">-- Pilih --</option>
                                                                                        <option value="SD" {{ $fossil->education == 'SD' ? 'selected' : ''}}>SD</option>
                                                                                        <option value="SMP" {{ $fossil->education == 'SMP' ? 'selected' : ''}}>SMP</option>
                                                                                        <option value="SMA" {{ $fossil->education == 'SMA' ? 'selected' : ''}}>SMA</option>
                                                                                        <option value="S1" {{ $fossil->education == 'S1' ? 'selected' : ''}}>S1</option>
                                                                                        <option value="S2" {{ $fossil->education == 'S2' ? 'selected' : ''}}>S2</option>
                                                                                        <option value="S3" {{ $fossil->education == 'S3' ? 'selected' : ''}}>S3</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>pekerjaan<span class="text-danger">*</span> </label>
                                                                                    <input
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        name="work"
                                                                                        value="{{ $fossil->work }}"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                {{-- Modal Delete Ayah --}}
                                                <div id="deleteAyah" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form class="d-inline-block" action="{{ route('fossil.destroy',$fossil->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus Ayah</h4>
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
                                            @endif
                                        @endforeach

                                        <!-- Create modal Ibu -->
                                        <div class="modal fade showModal" id="createIbu" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <form action="{{ route('fossil.store') }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">
                                                                Tambah Ibu
                                                            </h4>
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="card-body">
                                                                <div class="row">
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
                                                                            <label>Nomor Telepon<span class="text-danger">*</span> </label>
                                                                            <input
                                                                                type="number"
                                                                                class="form-control"
                                                                                name="phone_number"
                                                                                placeholder="Contoh : 085895568876"
                                                                                value="{{ old('phone_number') }}"
                                                                                placeholder="nomor telepon"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Penghasilan<span class="text-danger">*</span> </label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="income"
                                                                                placeholder="Rp 2.200.000"
                                                                                value="{{ old('income') }}"
                                                                                placeholder="penghasilan"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Agama<span class="text-danger">*</span> </label>
                                                                            <select name="religion" class="form-control" style="width: 100%;">
                                                                                <option selected="selected" disabled="disabled">-- Pilih --</option>
                                                                                <option value="Islam">Islam</option>
                                                                                <option value="Kristen">Kristen</option>
                                                                                <option value="Hindu">Hindu</option>
                                                                                <option value="Budha">Budha</option>
                                                                                <option value="Prostestan">Protestan</option>
                                                                                <option value="Konghocu">Konghocu</option>
                                                                                <option value="Katolik">Katolik</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Pendidikan Terakhir<span class="text-danger">*</span> </label>
                                                                            <select name="education" class="form-control" style="width: 100%;">
                                                                                <option selected="selected" disabled="disabled">-- Pilih --</option>
                                                                                <option value="SD">SD</option>
                                                                                <option value="SMP">SMP</option>
                                                                                <option value="SMA">SMA</option>
                                                                                <option value="S1">S1</option>
                                                                                <option value="S2">S2</option>
                                                                                <option value="S3">S3</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Pekerjaan<span class="text-danger">*</span> </label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="work"
                                                                                value="{{ old('work') }}"
                                                                                placeholder="pekerjaan"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="status" value="Ibu">
                                                                    <input type="hidden" name="student_id" value="{{ $students->id }}">
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
                                        @foreach ($fossils as $fossil)
                                            @if ($fossil->status == "Ibu")
                                                <!-- Edit modal Ibu -->
                                                <div class="modal fade showModal" id="editIbu" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <form action="{{route('fossil.update',$fossil->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel">
                                                                        Ubah Ibu
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nama<span class="text-danger">*</span> </label>
                                                                                    <input
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        name="name"
                                                                                        value="{{ $fossil->name }}"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Telepon<span class="text-danger">*</span> </label>
                                                                                    <input
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        name="phone_number"
                                                                                        placeholder="Contoh : 085895568876"
                                                                                        value="{{ $fossil->phone_number }}"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Penghasilan<span class="text-danger">*</span> </label>
                                                                                    <input
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        name="income"
                                                                                        placeholder="Rp 2.200.000"
                                                                                        value="{{ $fossil->income }}"

                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Agama<span class="text-danger">*</span> </label>
                                                                                    <select name="religion" class="form-control"  style="width: 100%;">
                                                                                        <option selected="selected" disabled="disabled">-- Pilih --</option>
                                                                                            <option value="Islam" {{ $fossil->religion == 'Islam' ? 'selected' : ''}}>Islam</option>
                                                                                            <option value="Kristen" {{ $fossil->religion == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                                                            <option value="Hindu" {{ $fossil->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                                                            <option value="Budha" {{ $fossil->religion == 'Budha' ? 'selected' : '' }}>Budha</option>
                                                                                            <option value="Prostestan" {{ $fossil->religion == 'Prostestan' ? 'selected' : ''}}>Protestan</option>
                                                                                            <option value="Konghocu" {{ $fossil->religion == 'Konghocu' ? 'selected' : '' }}>Konghocu</option>
                                                                                            <option value="Katolik" {{ $fossil->religion == 'Katolik' ? 'selected' : ''}}>Katolik</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Pendidikan Terakhir<span class="text-danger">*</span> </label>
                                                                                    <select name="education" class="form-control" style="width: 100%;">
                                                                                        <option selected="selected" disabled="disabled">-- Pilih --</option>
                                                                                        <option value="SD" {{ $fossil->education == 'SD' ? 'selected' : ''}}>SD</option>
                                                                                        <option value="SMP" {{ $fossil->education == 'SMP' ? 'selected' : ''}}>SMP</option>
                                                                                        <option value="SMA" {{ $fossil->education == 'SMA' ? 'selected' : ''}}>SMA</option>
                                                                                        <option value="S1" {{ $fossil->education == 'S1' ? 'selected' : ''}}>S1</option>
                                                                                        <option value="S2" {{ $fossil->education == 'S2' ? 'selected' : ''}}>S2</option>
                                                                                        <option value="S3" {{ $fossil->education == 'S3' ? 'selected' : ''}}>S3</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>pekerjaan<span class="text-danger">*</span> </label>
                                                                                    <input
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        name="work"
                                                                                        value="{{ $fossil->work }}"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                {{-- Modal Delete Ibu --}}
                                                <div id="deleteIbu" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form class="d-inline-block" action="{{ route('fossil.destroy',$fossil->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus Ibu</h4>
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
                                            @endif
                                        @endforeach

                                    </div>
                                    <div class="x_content" id="accordion3">

                                        {{-- Ayah --}}
                                        <div class="card">
                                            <div class="card-header" id="heading-0">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link " data-toggle="collapse" data-target="#collapse-0" aria-expanded=" true" aria-controls="collapse-0">
                                                        <span class="mr-3 fa fa-angle-down"></span>
                                                            DATA AYAH
                                                    </button>
                                                    @if ($ayah==NULL)
                                                        <a
                                                            class="mb-2 btn btn-primary btn-sm"
                                                            href="#createAyah"
                                                            data-toggle="modal"
                                                            data-toggle="tooltip"
                                                        >
                                                            <i class="fa fa-plus-square"></i>
                                                            &nbsp;Tambah
                                                        </a>
                                                    @else
                                                        <form action="{{route('fossil.guardian', $ayah->id)}}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('POST')
                                                            @if ($guardian == NULL)
                                                                <input type="hidden" value="Ayah" name="status">
                                                                <button type="submit" class="btn btn-success btn-sm">
                                                                    Jadikan Wali Murid
                                                                </button>
                                                            @endif
                                                            <a class="btn btn-warning btn-sm"
                                                                href="#editAyah"
                                                                data-toggle="modal"
                                                                data-toggle="tooltip"
                                                            >
                                                                Ubah
                                                            </a>
                                                            <a class="btn btn-danger btn-sm"
                                                                    href="#deleteAyah"
                                                                    data-toggle="modal"
                                                                    data-toggle="tooltip"
                                                                >
                                                                Hapus
                                                            </a>
                                                        </form>
                                                    @endif
                                                </h5>
                                            </div>
                                            <div id="collapse-0" class="collapse show" aria-labelledby="heading-0" data-parent="#accordion3">
                                                <div class="card-body">
                                                    <table class="table">
                                                        <tbody>
                                                            @foreach ($students->fossil as $fossil)
                                                                @if ($fossil->status == 'Ayah')
                                                                    <tr>
                                                                        <th scope="row">Nama</th>
                                                                        <td>{{ $fossil->name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Penghasilan</th>
                                                                        <td>{{ $fossil->income }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Pekerjaan</th>
                                                                        <td>{{ $fossil->work }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Agama</th>
                                                                        <td>{{ $fossil->religion }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Pendidikan Terakhir</th>
                                                                        <td>{{ $fossil->education }}</td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Ibu --}}
                                        <div class="mb-2 card">
                                            <div class="card-header" id="heading-1">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-1" aria-expanded=" false" aria-controls="collapse-1">
                                                        <span class="mr-3 fa fa-angle-down"></span>
                                                            DATA IBU
                                                    </button>
                                                    @if ($ibu==NULL)
                                                        <a
                                                            class="mb-2 btn btn-primary btn-sm"
                                                            href="#createIbu"
                                                            data-toggle="modal"
                                                            data-toggle="tooltip"
                                                        >
                                                            <i class="fa fa-plus-square"></i>
                                                            &nbsp;Tambah
                                                        </a>
                                                    @else
                                                        <form action="{{route('fossil.guardian', $ibu->id)}}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('POST')
                                                            @if ($guardian == NULL)
                                                                <input type="hidden" value="Ibu" name="status">
                                                                <button type="submit" class="btn btn-success btn-sm">
                                                                    Jadikan Wali Murid
                                                                </button>
                                                            @endif
                                                            <a class="btn btn-warning btn-sm"
                                                                href="#editIbu"
                                                                data-toggle="modal"
                                                                data-toggle="tooltip"
                                                            >
                                                                Ubah
                                                            </a>
                                                            <a class="btn btn-danger btn-sm"
                                                                href="#deleteIbu"
                                                                data-toggle="modal"
                                                                data-toggle="tooltip"
                                                            >
                                                                Hapus
                                                            </a>
                                                        </form>
                                                    @endif
                                            </div>
                                            <div id="collapse-1" class="collapse " aria-labelledby="heading-1" data-parent="#accordion3">
                                                <div class="card-body">
                                                    <table class="table">
                                                        <tbody>
                                                            @foreach ($students->fossil as $fossil)
                                                            @if ($fossil->status == 'Ibu')
                                                            <tr>
                                                                <th scope="row">Nama</th>
                                                                <td>{{ $fossil->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Penghasilan</th>
                                                                <td>{{ $fossil->income }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Pekerjaan</th>
                                                                <td>{{ $fossil->work }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Agama</th>
                                                                <td>{{ $fossil->religion }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Pendidikan Terakhir</th>
                                                                <td>{{ $fossil->education }}</td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Wali Murid --}}
                            <div class="tab-pane fade {{(request()->is('student/'.$students->id.'guardians')) ? 'show active' : ''}}" id="waliSantri" role="tabpanel" aria-labelledby="card-tab-2">
                                <div class="card">
                                    <!-- Create modal Wali Murid -->
                                    <div class="modal fade showModal" id="createWaliMurid" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <form action="{{ route('guardian.store') }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">
                                                            Tambah Wali Murid
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Nama<span class="text-danger">*</span> </label>
                                                                        <input
                                                                            type="text"
                                                                            class="form-control"
                                                                            name="name"
                                                                            value="{{old('name')}}"
                                                                            placeholder="nama"
                                                                        >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Nomor Telepon<span class="text-danger">*</span> </label>
                                                                        <input
                                                                            type="number"
                                                                            class="form-control"
                                                                            name="phone_number"
                                                                            value="{{old('phone_number')}}"
                                                                            placeholder="Contoh : 085895568876"
                                                                        >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Agama<span class="text-danger">*</span> </label>
                                                                        <select name="religion" class="form-control"  style="width: 100%;">
                                                                            <option selected="selected" disabled="disabled">-- Pilih --</option>
                                                                            <option value="Islam">Islam</option>
                                                                            <option value="Kristen">Kristen</option>
                                                                            <option value="Hindu">Hindu</option>
                                                                            <option value="Budha">Budha</option>
                                                                            <option value="Prostestan">Protestan</option>
                                                                            <option value="Konghocu">Konghocu</option>
                                                                            <option value="Katolik">Katolik</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Pendidikan Terakhir<span class="text-danger">*</span> </label>
                                                                        <select name="education" class="form-control" style="width: 100%;">
                                                                            <option selected="selected" disabled="disabled">-- Pilih --</option>
                                                                            <option value="SD">SD</option>
                                                                            <option value="SMP">SMP</option>
                                                                            <option value="SMA">SMA</option>
                                                                            <option value="S1">S1</option>
                                                                            <option value="S2">S2</option>
                                                                            <option value="S3">S3</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Pekerjaan<span class="text-danger">*</span> </label>
                                                                        <input
                                                                            type="text"
                                                                            class="form-control"
                                                                            name="work"
                                                                            value="{{old('work')}}"
                                                                            placeholder="pekerjaan"
                                                                        >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Hubungan<span class="text-danger">*</span> </label>
                                                                        <select name="relationship" class="form-control" style="width: 100%;">
                                                                            <option selected="selected" disabled="disabled">-- Pilih --</option>
                                                                            {{-- <option value="Ayah" {{ $guardians->relationship == 'Ayah' ? 'selected' : ''}}>Ayah</option> --}}
                                                                            <option value="Ayah">Ayah</option>
                                                                            <option value="Ibu">Ibu</option>
                                                                            <option value="Paman">Paman</option>
                                                                            <option value="Bibi">Bibi</option>
                                                                            <option value="Kakek">Kakek</option>
                                                                            <option value="Nenek">Nenek</option>
                                                                            <option value="Kakak">Kakak</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="student_id" value="{{ $students->id }}" >

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
                                    <div class="card-header" id="heading-0">
                                        <h5 class="mb-0">
                                            @if ($students->guardian == null)
                                                <a
                                                    class="mb-2 btn btn-primary btn-sm"
                                                    href="#createWaliMurid"
                                                    data-toggle="modal"
                                                    data-toggle="tooltip"
                                                >
                                                    <i class="fa fa-plus-square"></i>
                                                    &nbsp;Tambah
                                                </a>
                                            @else
                                                Wali murid dari <strong>{{$students->name}}</strong>
                                            @endif
                                        </h5>
                                    </div>
                                    <div>
                                        <div class="card-body">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <th scope="row">Nama</th>
                                                    <td>{{ $students->guardian === null ? '' : $students->guardian->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Hubungan</th>
                                                    <td>{{ $students->guardian === null ? '' : $students->guardian->relationship }}</td>
                                                </tr>

                                                <tr>
                                                    <th scope="row">Pekerjaan</th>
                                                    <td>{{ $students->guardian === null ? '' : $students->guardian->work }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Agama</th>
                                                    <td>{{ $students->guardian === null ? '' : $students->guardian->religion }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Pendidikan Terakhir</th>
                                                    <td>{{ $students->guardian === null ? '' : $students->guardian->education }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        @if ($students->guardian != null)
                                            <div class="card-footer">

                                                <a class="btn btn-warning btn-sm"
                                                href="#editWaliMurid{{ $students->guardian->id }}"
                                                data-toggle="modal"
                                                data-toggle="tooltip"
                                                >
                                                Ubah
                                                </a>


                                                <!-- Edit modal Wali Murid -->
                                                <div class="modal fade showModal" id="editWaliMurid{{ $students->guardian->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <form action="{{ route('guardian.update',$students->guardian->id) }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel">
                                                                        Ubah Wali Murid
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nama<span class="text-danger">*</span> </label>
                                                                                    <input
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        name="name"
                                                                                        value="{{ $students->guardian->name }} "
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Telpon<span class="text-danger">*</span> </label>
                                                                                    <input
                                                                                        type="number"
                                                                                        class="form-control"
                                                                                        name="phone_number"
                                                                                        placeholder="Contoh : 085895568876"
                                                                                        value="{{ $students->guardian->phone_number }}"

                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Agama<span class="text-danger">*</span> </label>
                                                                                    <select name="religion" class="form-control"  style="width: 100%;">
                                                                                        <option selected="selected" disabled="disabled">-- Pilih --</option>
                                                                                        <option value="Islam" {{ $students->guardian->religion === 'Islam' ? 'selected' : '' }}>Islam</option>
                                                                                        <option value="Kristen" {{ $students->guardian->religion === 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                                                        <option value="Hindu" {{ $students->guardian->religion === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                                                        <option value="Budha" {{ $students->guardian->religion === 'Budha' ? 'selected' : '' }}>Budha</option>
                                                                                        <option value="Prostestan" {{ $students->guardian->religion === 'Protestan' ? 'selected' : '' }}>Protestan</option>
                                                                                        <option value="Konghocu" {{ $students->guardian->religion === 'Konghucu' ? 'selected' : '' }}>Konghocu</option>
                                                                                        <option value="Katolik" {{ $students->guardian->religion === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Pendidikan Terakhir<span class="text-danger">*</span> </label>
                                                                                    <select name="education" class="form-control" style="width: 100%;">
                                                                                        <option value="SD" {{ $students->guardian->education === 'SD' ? 'selected' : ''}}>SD</option>
                                                                                        <option value="SMP" {{ $students->guardian->education === 'SMP' ? 'selected' : ''}}>SMP</option>
                                                                                        <option value="SMA" {{ $students->guardian->education === 'SMA' ? 'selected' : ''}}>SMA</option>
                                                                                        <option value="S1" {{ $students->guardian->education === 'S1' ? 'selected' : ''}}>S1</option>
                                                                                        <option value="S2" {{ $students->guardian->education === 'S2' ? 'selected' : ''}}>S2</option>
                                                                                        <option value="S3" {{ $students->guardian->education === 'S3' ? 'selected' : ''}}>S3</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Pekerjaan<span class="text-danger">*</span> </label>
                                                                                    <input
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        name="work"
                                                                                        value="{{ $students->guardian->work }}"

                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Hubungan<span class="text-danger">*</span> </label>
                                                                                    <select name="relationship" class="form-control" style="width: 100%;">
                                                                                        <option selected="selected" disabled="disabled">-- Pilih --</option>
                                                                                        {{-- <option value="Ayah" {{ $students->guardians->relationship == 'Ayah' ? 'selected' : ''}}>Ayah</option> --}}
                                                                                        <option value="Ayah" {{ $students->guardian->relationship === 'Ayah' ? 'selected' : '' }}>Ayah</option>
                                                                                        <option value="Ibu" {{ $students->guardian->relationship === 'Ibu' ? 'selected' : '' }}>Ibu</option>
                                                                                        <option value="Paman" {{ $students->guardian->relationship === 'Paman' ? 'selected' : '' }}>Paman</option>
                                                                                        <option value="Bibi"  {{ $students->guardian->relationship === 'Bibi' ? 'selected' : '' }}>Bibi</option>
                                                                                        <option value="Kakek" {{ $students->guardian->relationship === 'Kakek' ? 'selected' : '' }}>Kakek</option>
                                                                                        <option value="Nenek" {{ $students->guardian->relationship === 'Nenek' ? 'selected' : '' }}>Nenek</option>
                                                                                        <option value="Kakak" {{ $students->guardian->relationship === 'Kakak' ? 'selected' : '' }}>Kakak</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <a class="btn btn-danger btn-sm"
                                                        href="#deleteWaliMurid{{ $students->guardian->id }}"
                                                        data-toggle="modal"
                                                        data-toggle="tooltip"
                                                    >
                                                    Hapus
                                                </a>
                                                {{-- Modal Delete Wali Murid --}}
                                                <div id="deleteWaliMurid{{ $students->guardian->id }}" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form class="d-inline-block" action="{{ route('guardian.destroy',$students->guardian->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus Wali Murid</h4>
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
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            {{-- Hafalan --}}
                            <div class="tab-pane fade {{(request()->is('student/'.$students->id.'hafalan')) ? 'show active' : ''}}" id="hafalan" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="col-md-12 col-sm-12 ">
                                    <div class="x_panel">
                                        <!-- Create modal -->
                                        <div class="modal fade showModal" id="createHafalan" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <form action="{{ route('memorization.store') }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">
                                                                Tambah Hafalan
                                                            </h4>
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <input type="hidden" value="{{ $students->id }}" name="student_id">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Surah<span class="text-danger">*</span> </label>
                                                                            <select name="surah" class="form-control selectpicker" data-live-search="true" style="width: 100%; color: black;">
                                                                                <option selected="selected" disabled="disabled">-- Pilih Surah --</option>
                                                                                <option value="Al-fatihah">Al-fatihah</option>
                                                                                <option value="Al-baqarah">Al-baqarah</option>
                                                                                <option value="Ali-imran">Ali-imran</option>
                                                                                <option value="An-nisa">An-nisa</option>
                                                                                <option value="Al-Maidah">Al-Maidah</option>
                                                                                <option value="Al-an`am">Al-an`am</option>
                                                                                <option value="Al-a`raf">Al-a`raf</option>
                                                                                <option value="Al-anfal">Al-anfal</option>
                                                                                <option value="At-taubah">At-taubah</option>
                                                                                <option value="Yunus">Yunus</option>
                                                                                <option value="Hud">Hud</option>
                                                                                <option value="Yusuf">Yusuf</option>
                                                                                <option value="Ar-ra`d">Ar-ra`d</option>
                                                                                <option value="Ibrahim">Ibrahim</option>
                                                                                <option value="Al-hijr">Al-hijr</option>
                                                                                <option value="An-nahl">An-nahl</option>
                                                                                <option value="Al-isra`">Al-isra`</option>
                                                                                <option value="Al-kahfi">Al-kahfi</option>
                                                                                <option value="Maryam">Maryam</option>
                                                                                <option value="Thaha">Thaha</option>
                                                                                <option value="Al-anbiya">Al-anbiya</option>
                                                                                <option value="Al-hajj">Al-hajj</option>
                                                                                <option value="Al-mu`minun">Al-mu`minun</option>
                                                                                <option value="An-nur">An-nur</option>
                                                                                <option value="Al-furqan">Al-furqan</option>
                                                                                <option value="Asy-syu`ara">Asy-syu`ara</option>
                                                                                <option value="An-naml">An-naml</option>
                                                                                <option value="Al-qashash">Al-qashash</option>
                                                                                <option value="Al-ankabut">Al-ankabut</option>
                                                                                <option value="Ar-rum">Ar-rum</option>
                                                                                <option value="Luqman">Luqman</option>
                                                                                <option value="As-sajdah">As-sajdah</option>
                                                                                <option value="Al-ahzab">Al-ahzab</option>
                                                                                <option value="Saba`">Saba`</option>
                                                                                <option value="Fathir">Fathir</option>
                                                                                <option value="Yasin">Yasin</option>
                                                                                <option value="Ash-shoffat">Ash-shoffat</option>
                                                                                <option value="Shad">Shad</option>
                                                                                <option value="Az-zumar">Az-zumar</option>
                                                                                <option value="Ghafir">Ghafir</option>
                                                                                <option value="Al-fushilat">Al-fushilat</option>
                                                                                <option value="Asy-syura`">Asy-syura`</option>
                                                                                <option value="Az-zukhruf">Az-zukhruf</option>
                                                                                <option value="Ad-dukhan">Ad-dukhan</option>
                                                                                <option value="Al-jatsiyah">Al-jatsiyah</option>
                                                                                <option value="Al-ahqaf">Al-ahqaf</option>
                                                                                <option value="Muhammad">Muhammad</option>
                                                                                <option value="Al-fath">Al-fath</option>
                                                                                <option value="Al-hujurat">Al-hujurat</option>
                                                                                <option value="Qaaf">Qaaf</option>
                                                                                <option value="Adz-dzariyat">Adz-dzariyat</option>
                                                                                <option value="Ath-thur">Ath-thur</option>
                                                                                <option value="An-najm">An-najm</option>
                                                                                <option value="Al-qamar">Al-qamar</option>
                                                                                <option value="Ar-rahman">Ar-rahman</option>
                                                                                <option value="Al-waqi`ah">Al-waqi`ah</option>
                                                                                <option value="Al-hadid">Al-hadid</option>
                                                                                <option value="Al-mujadalah">Al-mujadalah</option>
                                                                                <option value="Al-hasyr">Al-hasyr</option>
                                                                                <option value="Al-Mumtahanah">Al-Mumtahanah</option>
                                                                                <option value="Ash-shaff">Ash-shaff</option>
                                                                                <option value="Al-jumu`ah">Al-jumu`ah</option>
                                                                                <option value="Al-munafiqun">Al-munafiqun</option>
                                                                                <option value="At-taghabun">At-taghabun</option>
                                                                                <option value="Ath-thalaq">Ath-thalaq</option>
                                                                                <option value="At-tahrim">At-tahrim</option>
                                                                                <option value="Al-mulk">Al-mulk</option>
                                                                                <option value="Al-qalam">Al-qalam</option>
                                                                                <option value="Al-haqqah">Al-haqqah</option>
                                                                                <option value="Al-maarij">Al-maarij</option>
                                                                                <option value="Nuh">Nuh</option>
                                                                                <option value="Jin">Jin</option>
                                                                                <option value="Al-muzammil">Al-muzammil</option>
                                                                                <option value="Al-muddatsir">Al-muddatsir</option>
                                                                                <option value="Al-qiyamah">Al-qiyamah</option>
                                                                                <option value="Al-insan">Al-insan</option>
                                                                                <option value="Al-mursalat">Al-mursalat</option>
                                                                                <option value="An-naba`">An-naba`</option>
                                                                                <option value="An-naziat">An-naziat</option>
                                                                                <option value="`Abasa">`Abasa</option>
                                                                                <option value="At-takwir">At-taqwir</option>
                                                                                <option value="Al-mutaffifin">Al-mutaffifin</option>
                                                                                <option value="Al-insyiqaq">Al-insyiqaq</option>
                                                                                <option value="Al-buruj">Al-buruj</option>
                                                                                <option value="At-thoriq">At-thoriq</option>
                                                                                <option value="Al-a`la">Al-a`la</option>
                                                                                <option value="Al-gasyiyah">Al-gasyiyah</option>
                                                                                <option value="Al-fajr">Al-fajr</option>
                                                                                <option value="Al-balad">Al-balad</option>
                                                                                <option value="Asy-syams">Asy-syams</option>
                                                                                <option value="Al-lail">Al-lail</option>
                                                                                <option value="Adh-dhuha">Adh-dhuha</option>
                                                                                <option value="Asy-syarh">Asy-syarh</option>
                                                                                <option value="At-tin">At-tin</option>
                                                                                <option value="Al-alaq">Al-alaq</option>
                                                                                <option value="Al-qadr">Al-qadr</option>
                                                                                <option value="Al-bayyinah">Al-bayyinah</option>
                                                                                <option value="Az-zalzalah">Az-zalzalah</option>
                                                                                <option value="Al-adiyat">Al-adiyat</option>
                                                                                <option value="Al-qari`ah">Al-qari`ah</option>
                                                                                <option value="At-takatsur">At-takatsur</option>
                                                                                <option value="Al-asr">Al-asr</option>
                                                                                <option value="Al-humazah">Al-humazah</option>
                                                                                <option value="Al-fil">Al-fil</option>
                                                                                <option value="Al-quraisy">Al-quraisy</option>
                                                                                <option value="Al-ma`un">Al-ma`un</option>
                                                                                <option value="Al-kautsar">Al-kautsar</option>
                                                                                <option value="Al-kafirun">Al-kafirun</option>
                                                                                <option value="An-nashr">An-nashr</option>
                                                                                <option value="Al-lahab">Al-lahab</option>
                                                                                <option value="Al-ikhlas">Al-ikhlas</option>
                                                                                <option value="Al-falaq">Al-falaq</option>
                                                                                <option value="An-nas">An-nas</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Juz<span class="text-danger">*</span> </label>
                                                                            <input
                                                                                type="number"
                                                                                class="form-control"
                                                                                name="juz"
                                                                                value="{{old('juz')}}"
                                                                                placeholder="juz"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Mulai Ayat<span class="text-danger">*</span> </label>
                                                                            <input
                                                                                type="number"
                                                                                class="form-control"
                                                                                name="ayat_from"
                                                                                value="{{old('ayat_from')}}"
                                                                                placeholder="mulai ayat"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Sampai Ayat<span class="text-danger">*</span> </label>
                                                                            <input
                                                                                type="number"
                                                                                class="form-control"
                                                                                name="ayat_to"
                                                                                value="{{old('ayat_to')}}"
                                                                                placeholder="sampai ayat"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Penyimak<span class="text-danger">*</span> </label>
                                                                            <select name="user_id" class="form-control selectpicker" data-live-search="true" style="width: 100%;">
                                                                            @foreach ($teachers as $teacher)
                                                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                                            @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6 ">
                                                                        <label>Tanggal Setoran<span class="text-danger">*</span> </label>
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
                                                                            name="date"
                                                                            value="{{old('date')}}"
                                                                            placeholder="tanggal setoran"
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
                                        <div class="x_title">
                                            <a
                                                class="btn btn-primary btn-sm"
                                                href="#createHafalan"
                                                data-toggle="modal"
                                                data-toggle="tooltip"
                                            >
                                                <i class="fa fa-plus-square"></i>
                                                &nbsp;Tambah
                                            </a>
                                            <button type="button" class="btn btn-success btn-sm" data-target="#juz" data-toggle="modal">{{$students->memorization_juz == NULL ? '0 Juz' : $students->memorization_juz.' Juz'}}</button>
                                            <button type="button" class="btn btn-success btn-sm" data-target="#halaman" data-toggle="modal">{{$students->memorization_page == NULL ? '0 Halaman' : $students->memorization_page.' Halaman'}}</button>
                                            <!-- Modal Juz -->
                                            <div class="modal fade" id="juz" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm" role="document">
                                                    <form action="{{route('ganti.total.hafalan', $students->id)}}" method="POST" class="modal-content">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Jumlah Juz</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="juz">Juz</label>
                                                                <input type="number" value="{{$students->memorization_juz}}" class="form-control" name="memorization_juz">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Ubah</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Modal Halaman -->
                                            <div class="modal fade" id="halaman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm" role="document">
                                                    <form action="{{route('ganti.total.hafalan', $students->id)}}" method="POST" class="modal-content">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Jumlah Halaman</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="halaman">Halaman</label>
                                                                <input id="halaman" type="number" value="{{$students->memorization_page}}" class="form-control" name="memorization_page">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Ubah</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                    <th>#</th>
                                                    <th>Surah</th>
                                                    <th>Juz</th>
                                                    <th>Mulai Ayat</th>
                                                    <th>Berakhir Ayat</th>
                                                    <th>Penyimak</th>
                                                    <th>Tanggal Setoran</th>
                                                    <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($memorizations as $memorization)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $memorization->surah }}</td>
                                                    <td>{{ $memorization->juz }}</td>
                                                    <td>{{ $memorization->ayat_from }}</td>
                                                    <td>{{ $memorization->ayat_to }}</td>
                                                    <td>{{ $memorization->teacher->name }}</td>
                                                    <td>{{ $memorization->date }}</td>
                                                    <td>
                                                        <a class="btn btn-warning btn-sm"
                                                            href="#editHafalan{{ $memorization->id }}"
                                                            data-toggle="modal"
                                                            data-toggle="tooltip"
                                                        >
                                                            Ubah
                                                        </a>

                                                        <!-- Edit modal -->
                                                        <div class="modal fade showModal" id="editHafalan{{ $memorization->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <form action="{{ route('memorization.update',$memorization->id) }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-content">

                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel">
                                                                                Ubah Hafalan
                                                                            </h4>
                                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Surah<span class="text-danger">*</span> </label>
                                                                                            <select name="surah" class="form-control selectpicker" data-live-search="true" style="width: 100%;">
                                                                                                <option disabled="disabled">-- Pilih Surah --</option>
                                                                                                <option value="Al-fatihah" {{ $memorization->surah == 'Al-fatihah' ? 'selected' : '' }}>Al-fatihah</option>
                                                                                                <option value="Al-baqarah" {{ $memorization->surah == 'Al-baqarah' ? 'selected' : '' }}>Al-baqarah</option>
                                                                                                <option value="Ali-imran" {{ $memorization->surah == 'Ali-imran' ? 'selected' : '' }}>Ali-imran</option>
                                                                                                <option value="An-nisa" {{ $memorization->surah == 'An-nisa' ? 'selected' : '' }}>An-nisa</option>
                                                                                                <option value="Al-Maidah" {{ $memorization->surah == 'Al-Maidah' ? 'selected' : '' }}>Al-Maidah</option>
                                                                                                <option value="Al-an`am" {{ $memorization->surah == 'Al-an`am' ? 'selected' : '' }}>Al-an`am</option>
                                                                                                <option value="Al-a`raf" {{ $memorization->surah == 'Al-a`raf' ? 'selected' : '' }}>Al-a`raf</option>
                                                                                                <option value="Al-anfal" {{ $memorization->surah == 'Al-anfal' ? 'selected' : '' }}>Al-anfal</option>
                                                                                                <option value="At-taubah" {{ $memorization->surah == 'At-taubah' ? 'selected' : '' }}>At-taubah</option>
                                                                                                <option value="Yunus" {{ $memorization->surah == 'Yunus' ? 'selected' : '' }}>Yunus</option>
                                                                                                <option value="Hud" {{ $memorization->surah == 'Hud' ? 'selected' : '' }}>Hud</option>
                                                                                                <option value="Yusuf" {{ $memorization->surah == 'Yusuf' ? 'selected' : '' }}>Yusuf</option>
                                                                                                <option value="Ar-ra`d" {{ $memorization->surah == 'Ar-ra`d' ? 'selected' : '' }}>Ar-ra`d</option>
                                                                                                <option value="Ibrahim" {{ $memorization->surah == 'Ibrahim' ? 'selected' : '' }}>Ibrahim</option>
                                                                                                <option value="Al-hijr" {{ $memorization->surah == 'Al-hijr' ? 'selected' : '' }}>Al-hijr</option>
                                                                                                <option value="An-nahl" {{ $memorization->surah == 'An-nahl' ? 'selected' : '' }}>An-nahl</option>
                                                                                                <option value="Al-isra`" {{ $memorization->surah == 'Al-isra`' ? 'selected' : '' }}>Al-isra`</option>
                                                                                                <option value="Al-kahfi" {{ $memorization->surah == 'Al-kahfi' ? 'selected' : '' }}>Al-kahfi</option>
                                                                                                <option value="Maryam" {{ $memorization->surah == 'Maryam' ? 'selected' : '' }}>Maryam</option>
                                                                                                <option value="Thaha" {{ $memorization->surah == 'Thaha' ? 'selected' : '' }}>Thaha</option>
                                                                                                <option value="Al-anbiya" {{ $memorization->surah == 'Al-anbiya' ? 'selected' : '' }}>Al-anbiya</option>
                                                                                                <option value="Al-hajj" {{ $memorization->surah == 'Al-hajj' ? 'selected' : '' }}>Al-hajj</option>
                                                                                                <option value="Al-mu`minun" {{ $memorization->surah == 'Al-mu`minun' ? 'selected' : '' }}>Al-mu`minun</option>
                                                                                                <option value="An-nur" {{ $memorization->surah == 'An-nur' ? 'selected' : '' }}>An-nur</option>
                                                                                                <option value="Al-furqan" {{ $memorization->surah == 'Al-furqan' ? 'selected' : '' }}>Al-furqan</option>
                                                                                                <option value="Asy-syu`ara" {{ $memorization->surah == 'Asy-syu`ara' ? 'selected' : '' }}>Asy-syu`ara</option>
                                                                                                <option value="An-naml" {{ $memorization->surah == 'An-naml' ? 'selected' : '' }}>An-naml</option>
                                                                                                <option value="Al-qashash" {{ $memorization->surah == 'Al-qashash' ? 'selected' : '' }}>Al-qashash</option>
                                                                                                <option value="Al-ankabut" {{ $memorization->surah == 'Al-ankabut' ? 'selected' : '' }}>Al-ankabut</option>
                                                                                                <option value="Ar-rum" {{ $memorization->surah == 'Ar-rum' ? 'selected' : '' }}>Ar-rum</option>
                                                                                                <option value="Luqman" {{ $memorization->surah == 'Luqman' ? 'selected' : '' }}>Luqman</option>
                                                                                                <option value="As-sajdah" {{ $memorization->surah == 'As-sajdah' ? 'selected' : '' }}>As-sajdah</option>
                                                                                                <option value="Al-ahzab" {{ $memorization->surah == 'Al-ahzab' ? 'selected' : '' }}>Al-ahzab</option>
                                                                                                <option value="Saba`" {{ $memorization->surah == 'Saba`' ? 'selected' : '' }}>Saba`</option>
                                                                                                <option value="Fathir" {{ $memorization->surah == 'Fathir' ? 'selected' : '' }}>Fathir</option>
                                                                                                <option value="Yasin" {{ $memorization->surah == 'Yasin' ? 'selected' : '' }}>Yasin</option>
                                                                                                <option value="Ash-shoffat" {{ $memorization->surah == 'Ash-shoffat' ? 'selected' : '' }}>Ash-shoffat</option>
                                                                                                <option value="Shad" {{ $memorization->surah == 'Shad' ? 'selected' : '' }}>Shad</option>
                                                                                                <option value="Az-zumar" {{ $memorization->surah == 'Az-zumar' ? 'selected' : '' }}>Az-zumar</option>
                                                                                                <option value="Ghafir" {{ $memorization->surah == 'Ghafir' ? 'selected' : '' }}>Ghafir</option>
                                                                                                <option value="Al-fushilat" {{ $memorization->surah == 'Al-fushilat' ? 'selected' : '' }}>Al-fushilat</option>
                                                                                                <option value="Asy-syura`" {{ $memorization->surah == 'Asy-syura' ? 'selected' : '' }}>Asy-syura`</option>
                                                                                                <option value="Az-zukhruf" {{ $memorization->surah == 'Az-zukhruf' ? 'selected' : '' }}>Az-zukhruf</option>
                                                                                                <option value="Ad-dukhan" {{ $memorization->surah == 'Ad-dukhan' ? 'selected' : '' }}>Ad-dukhan</option>
                                                                                                <option value="Al-jatsiyah" {{ $memorization->surah == 'Al-jatsiyah' ? 'selected' : '' }}>Al-jatsiyah</option>
                                                                                                <option value="Al-ahqaf" {{ $memorization->surah == 'Al-ahqaf' ? 'selected' : '' }}>Al-ahqaf</option>
                                                                                                <option value="Muhammad" {{ $memorization->surah == 'Muhammad' ? 'selected' : '' }}>Muhammad</option>
                                                                                                <option value="Al-fath" {{ $memorization->surah == 'Al-fath' ? 'selected' : '' }}>Al-fath</option>
                                                                                                <option value="Al-hujurat" {{ $memorization->surah == 'Al-hujurat' ? 'selected' : '' }}>Al-hujurat</option>
                                                                                                <option value="Qaaf" {{ $memorization->surah == 'Qaaf' ? 'selected' : '' }}>Qaaf</option>
                                                                                                <option value="Adz-dzariyat" {{ $memorization->surah == 'Adz-dzariyat' ? 'selected' : '' }}>Adz-dzariyat</option>
                                                                                                <option value="Ath-thur" {{ $memorization->surah == 'Ath-thur' ? 'selected' : '' }}>Ath-thur</option>
                                                                                                <option value="An-najm" {{ $memorization->surah == 'An-najm' ? 'selected' : '' }}>An-najm</option>
                                                                                                <option value="Al-qamar" {{ $memorization->surah == 'Al-qamar' ? 'selected' : '' }}>Al-qamar</option>
                                                                                                <option value="Ar-rahman" {{ $memorization->surah == 'Ar-rahman' ? 'selected' : '' }}>Ar-rahman</option>
                                                                                                <option value="Al-waqi`ah" {{ $memorization->surah == 'Al-waqi`ah' ? 'selected' : '' }}>Al-waqi`ah</option>
                                                                                                <option value="Al-hadid" {{ $memorization->surah == 'Al-hadid' ? 'selected' : '' }}>Al-hadid</option>
                                                                                                <option value="Al-mujadalah" {{ $memorization->surah == 'Al-mujadalah' ? 'selected' : '' }}>Al-mujadalah</option>
                                                                                                <option value="Al-hasyr" {{ $memorization->surah == 'Al-hasyr' ? 'selected' : '' }}>Al-hasyr</option>
                                                                                                <option value="Al-Mumtahanah" {{ $memorization->surah == 'Al-Mumtahanah' ? 'selected' : '' }}>Al-Mumtahanah</option>
                                                                                                <option value="Ash-shaff" {{ $memorization->surah == 'Ash-shaff' ? 'selected' : '' }}>Ash-shaff</option>
                                                                                                <option value="Al-jumu`ah" {{ $memorization->surah == 'Al-jumu`ah' ? 'selected' : '' }}>Al-jumu`ah</option>
                                                                                                <option value="Al-munafiqun" {{ $memorization->surah == 'Al-munafiqun' ? 'selected' : '' }}>Al-munafiqun</option>
                                                                                                <option value="At-taghabun" {{ $memorization->surah == 'At-taghabun' ? 'selected' : '' }}>At-taghabun</option>
                                                                                                <option value="Ath-thalaq" {{ $memorization->surah == 'Ath-thalaq' ? 'selected' : '' }}>Ath-thalaq</option>
                                                                                                <option value="At-tahrim" {{ $memorization->surah == 'At-tahrim' ? 'selected' : '' }}>At-tahrim</option>
                                                                                                <option value="Al-mulk" {{ $memorization->surah == 'Al-mulk' ? 'selected' : '' }}>Al-mulk</option>
                                                                                                <option value="Al-qalam" {{ $memorization->surah == 'Al-qalam' ? 'selected' : '' }}>Al-qalam</option>
                                                                                                <option value="Al-haqqah" {{ $memorization->surah == 'Al-haqqah' ? 'selected' : '' }}>Al-haqqah</option>
                                                                                                <option value="Al-maarij" {{ $memorization->surah == 'Al-maarij' ? 'selected' : '' }}>Al-maarij</option>
                                                                                                <option value="Nuh" {{ $memorization->surah == 'Nuh' ? 'selected' : '' }}>Nuh</option>
                                                                                                <option value="Jin" {{ $memorization->surah == 'Jin' ? 'selected' : '' }}>Jin</option>
                                                                                                <option value="Al-muzammil" {{ $memorization->surah == 'Al-muzammil' ? 'selected' : '' }}>Al-muzammil</option>
                                                                                                <option value="Al-muddatsir" {{ $memorization->surah == 'Al-muddatsir' ? 'selected' : '' }}>Al-muddatsir</option>
                                                                                                <option value="Al-qiyamah" {{ $memorization->surah == 'Al-qiyamah' ? 'selected' : '' }}>Al-qiyamah</option>
                                                                                                <option value="Al-insan" {{ $memorization->surah == 'Al-insan' ? 'selected' : '' }}>Al-insan</option>
                                                                                                <option value="Al-mursalat" {{ $memorization->surah == 'Al-mursalat' ? 'selected' : '' }}>Al-mursalat</option>
                                                                                                <option value="An-naba`" {{ $memorization->surah == 'An-naba`' ? 'selected' : '' }}>An-naba`</option>
                                                                                                <option value="An-naziat" {{ $memorization->surah == 'An-naziat' ? 'selected' : '' }}>An-naziat</option>
                                                                                                <option value="`Abasa" {{ $memorization->surah == '`Abasa' ? 'selected' : '' }}>`Abasa</option>
                                                                                                <option value="At-takwir" {{ $memorization->surah == 'At-takwir' ? 'selected' : '' }}>At-takwir</option>
                                                                                                <option value="Al-mutaffifin" {{ $memorization->surah == 'Al-mutaffifin' ? 'selected' : '' }}>Al-mutaffifin</option>
                                                                                                <option value="Al-insyiqaq" {{ $memorization->surah == 'Al-insyiqaq' ? 'selected' : '' }}>Al-insyiqaq</option>
                                                                                                <option value="Al-buruj" {{ $memorization->surah == 'Al-buruj' ? 'selected' : '' }}>Al-buruj</option>
                                                                                                <option value="At-thoriq" {{ $memorization->surah == 'At-thoriq' ? 'selected' : '' }}>At-thoriq</option>
                                                                                                <option value="Al-a`la" {{ $memorization->surah == 'Al-a`la' ? 'selected' : '' }}>Al-a`la</option>
                                                                                                <option value="Al-gasyiyah" {{ $memorization->surah == 'Al-gasyiyah' ? 'selected' : '' }}>Al-gasyiyah</option>
                                                                                                <option value="Al-fajr" {{ $memorization->surah == 'Al-fajr' ? 'selected' : '' }}>Al-fajr</option>
                                                                                                <option value="Al-balad" {{ $memorization->surah == 'Al-balad' ? 'selected' : '' }}>Al-balad</option>
                                                                                                <option value="Asy-syams" {{ $memorization->surah == 'Asy-syams' ? 'selected' : '' }}>Asy-syams</option>
                                                                                                <option value="Al-lail" {{ $memorization->surah == 'Al-lail' ? 'selected' : '' }}>Al-lail</option>
                                                                                                <option value="Adh-dhuha" {{ $memorization->surah == 'Adh-dhuha' ? 'selected' : '' }}>Adh-dhuha</option>
                                                                                                <option value="Asy-syarh" {{ $memorization->surah == 'Asy-syarh' ? 'selected' : '' }}>Asy-syarh</option>
                                                                                                <option value="At-tin" {{ $memorization->surah == 'At-tin' ? 'selected' : '' }}>At-tin</option>
                                                                                                <option value="Al-alaq" {{ $memorization->surah == 'Al-alaq' ? 'selected' : '' }}>Al-alaq</option>
                                                                                                <option value="Al-qadr" {{ $memorization->surah == 'Al-qadr' ? 'selected' : '' }}>Al-qadr</option>
                                                                                                <option value="Al-bayyinah" {{ $memorization->surah == 'Al-bayyinah' ? 'selected' : '' }}>Al-bayyinah</option>
                                                                                                <option value="Az-zalzalah" {{ $memorization->surah == 'Az-zalzalah' ? 'selected' : '' }}>Az-zalzalah</option>
                                                                                                <option value="Al-adiyat" {{ $memorization->surah == 'Al-adiyat' ? 'selected' : '' }}>Al-adiyat</option>
                                                                                                <option value="Al-qari`ah" {{ $memorization->surah == 'Al-qari`ah' ? 'selected' : '' }}>Al-qari`ah</option>
                                                                                                <option value="At-takatsur" {{ $memorization->surah == 'At-takatsur' ? 'selected' : '' }}>At-takatsur</option>
                                                                                                <option value="Al-asr" {{ $memorization->surah == 'Al-asr' ? 'selected' : '' }}>Al-asr</option>
                                                                                                <option value="Al-humazah" {{ $memorization->surah == 'Al-humazah' ? 'selected' : '' }}>Al-humazah</option>
                                                                                                <option value="Al-fil" {{ $memorization->surah == 'Al-fil' ? 'selected' : '' }}>Al-fil</option>
                                                                                                <option value="Al-quraisy" {{ $memorization->surah == 'Al-quraisy' ? 'selected' : '' }}>Al-quraisy</option>
                                                                                                <option value="Al-ma`un" {{ $memorization->surah == 'Al-ma`un' ? 'selected' : '' }}>Al-ma`un</option>
                                                                                                <option value="Al-kautsar" {{ $memorization->surah == 'Al-kautsar' ? 'selected' : '' }}>Al-kautsar</option>
                                                                                                <option value="Al-kafirun" {{ $memorization->surah == 'Al-kafirun' ? 'selected' : '' }}>Al-kafirun</option>
                                                                                                <option value="An-nashr" {{ $memorization->surah == 'An-nashr' ? 'selected' : '' }}>An-nashr</option>
                                                                                                <option value="Al-lahab" {{ $memorization->surah == 'Al-lahab' ? 'selected' : '' }}>Al-lahab</option>
                                                                                                <option value="Al-ikhlas" {{ $memorization->surah == 'Al-ikhlas' ? 'selected' : '' }}>Al-ikhlas</option>
                                                                                                <option value="Al-falaq" {{ $memorization->surah == 'Al-falaq' ? 'selected' : '' }}>Al-falaq</option>
                                                                                                <option value="An-nas" {{ $memorization->surah == 'An-nas' ? 'selected' : '' }}>An-nas</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Juz<span class="text-danger">*</span> </label>
                                                                                            <input
                                                                                                type="number"
                                                                                                class="form-control"
                                                                                                name="juz"
                                                                                                value="{{ $memorization->juz  }}"
                                                                                            >
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Mulai Ayat<span class="text-danger">*</span> </label>
                                                                                            <input
                                                                                                type="number"
                                                                                                class="form-control"
                                                                                                name="ayat_from"
                                                                                                value="{{ $memorization->ayat_from }}"
                                                                                            >
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Sampai Ayat<span class="text-danger">*</span> </label>
                                                                                            <input
                                                                                                type="number"
                                                                                                class="form-control"
                                                                                                name="ayat_to"
                                                                                                value="{{ $memorization->ayat_to }}"
                                                                                            >
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Penyimak<span class="text-danger">*</span> </label>
                                                                                            <select name="user_id" class="form-control selectpicker" data-live-search="true" style="width: 100%;" value>
                                                                                            @foreach ($teachers as $teacher)
                                                                                            <option value="{{ $teacher->id }}"{{ $teacher->name === $memorization->teacher->name ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                                                                            @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 col-sm-6 ">
                                                                                        <label>Tanggal Setoran<span class="text-danger">*</span> </label>
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
                                                                                            name="date"
                                                                                            value="{{ $memorization->date }}"
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
                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                                        </div>

                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                        <a class="btn btn-danger btn-sm"
                                                            href="#deleteHafalan{{ $memorization->id }}"
                                                            data-toggle="modal"
                                                            data-toggle="tooltip"
                                                        >
                                                            Hapus
                                                        </a>
                                                    </td>

                                                    {{-- Modal Delete Data --}}
                                                    <div id="deleteHafalan{{ $memorization->id }}" class="modal fade">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form class="d-inline-block" action="{{ route('memorization.destroy', $memorization->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Hapus Hafalan</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Apakah Anda yakin ingin menghapus data <strong>{{ $memorization->surah }} ? </strong></p>
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
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel">
                                <!-- Create modal -->
                                <div class="modal fade showModal" id="createHafalan" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <form action="{{ route('memorization.store') }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                            @csrf
                                            @method('POST')
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">
                                                        Tambah Hafalan
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <input type="hidden" value="{{ $students->id }}" name="student_id">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Surah<span class="text-danger">*</span> </label>
                                                                    <select name="surah" class="form-control selectpicker" data-live-search="true" style="width: 100%; color: black;">
                                                                        <option selected="selected" disabled="disabled">-- Pilih Surah --</option>
                                                                        <option value="Al-fatihah">Al-fatihah</option>
                                                                        <option value="Al-baqarah">Al-baqarah</option>
                                                                        <option value="Ali-imran">Ali-imran</option>
                                                                        <option value="An-nisa">An-nisa</option>
                                                                        <option value="Al-Maidah">Al-Maidah</option>
                                                                        <option value="Al-an`am">Al-an`am</option>
                                                                        <option value="Al-a`raf">Al-a`raf</option>
                                                                        <option value="Al-anfal">Al-anfal</option>
                                                                        <option value="At-taubah">At-taubah</option>
                                                                        <option value="Yunus">Yunus</option>
                                                                        <option value="Hud">Hud</option>
                                                                        <option value="Yusuf">Yusuf</option>
                                                                        <option value="Ar-ra`d">Ar-ra`d</option>
                                                                        <option value="Ibrahim">Ibrahim</option>
                                                                        <option value="Al-hijr">Al-hijr</option>
                                                                        <option value="An-nahl">An-nahl</option>
                                                                        <option value="Al-isra`">Al-isra`</option>
                                                                        <option value="Al-kahfi">Al-kahfi</option>
                                                                        <option value="Maryam">Maryam</option>
                                                                        <option value="Thaha">Thaha</option>
                                                                        <option value="Al-anbiya">Al-anbiya</option>
                                                                        <option value="Al-hajj">Al-hajj</option>
                                                                        <option value="Al-mu`minun">Al-mu`minun</option>
                                                                        <option value="An-nur">An-nur</option>
                                                                        <option value="Al-furqan">Al-furqan</option>
                                                                        <option value="Asy-syu`ara">Asy-syu`ara</option>
                                                                        <option value="An-naml">An-naml</option>
                                                                        <option value="Al-qashash">Al-qashash</option>
                                                                        <option value="Al-ankabut">Al-ankabut</option>
                                                                        <option value="Ar-rum">Ar-rum</option>
                                                                        <option value="Luqman">Luqman</option>
                                                                        <option value="As-sajdah">As-sajdah</option>
                                                                        <option value="Al-ahzab">Al-ahzab</option>
                                                                        <option value="Saba`">Saba`</option>
                                                                        <option value="Fathir">Fathir</option>
                                                                        <option value="Yasin">Yasin</option>
                                                                        <option value="Ash-shoffat">Ash-shoffat</option>
                                                                        <option value="Shad">Shad</option>
                                                                        <option value="Az-zumar">Az-zumar</option>
                                                                        <option value="Ghafir">Ghafir</option>
                                                                        <option value="Al-fushilat">Al-fushilat</option>
                                                                        <option value="Asy-syura`">Asy-syura`</option>
                                                                        <option value="Az-zukhruf">Az-zukhruf</option>
                                                                        <option value="Ad-dukhan">Ad-dukhan</option>
                                                                        <option value="Al-jatsiyah">Al-jatsiyah</option>
                                                                        <option value="Al-ahqaf">Al-ahqaf</option>
                                                                        <option value="Muhammad">Muhammad</option>
                                                                        <option value="Al-fath">Al-fath</option>
                                                                        <option value="Al-hujurat">Al-hujurat</option>
                                                                        <option value="Qaaf">Qaaf</option>
                                                                        <option value="Adz-dzariyat">Adz-dzariyat</option>
                                                                        <option value="Ath-thur">Ath-thur</option>
                                                                        <option value="An-najm">An-najm</option>
                                                                        <option value="Al-qamar">Al-qamar</option>
                                                                        <option value="Ar-rahman">Ar-rahman</option>
                                                                        <option value="Al-waqi`ah">Al-waqi`ah</option>
                                                                        <option value="Al-hadid">Al-hadid</option>
                                                                        <option value="Al-mujadalah">Al-mujadalah</option>
                                                                        <option value="Al-hasyr">Al-hasyr</option>
                                                                        <option value="Al-Mumtahanah">Al-Mumtahanah</option>
                                                                        <option value="Ash-shaff">Ash-shaff</option>
                                                                        <option value="Al-jumu`ah">Al-jumu`ah</option>
                                                                        <option value="Al-munafiqun">Al-munafiqun</option>
                                                                        <option value="At-taghabun">At-taghabun</option>
                                                                        <option value="Ath-thalaq">Ath-thalaq</option>
                                                                        <option value="At-tahrim">At-tahrim</option>
                                                                        <option value="Al-mulk">Al-mulk</option>
                                                                        <option value="Al-qalam">Al-qalam</option>
                                                                        <option value="Al-haqqah">Al-haqqah</option>
                                                                        <option value="Al-maarij">Al-maarij</option>
                                                                        <option value="Nuh">Nuh</option>
                                                                        <option value="Jin">Jin</option>
                                                                        <option value="Al-muzammil">Al-muzammil</option>
                                                                        <option value="Al-muddatsir">Al-muddatsir</option>
                                                                        <option value="Al-qiyamah">Al-qiyamah</option>
                                                                        <option value="Al-insan">Al-insan</option>
                                                                        <option value="Al-mursalat">Al-mursalat</option>
                                                                        <option value="An-naba`">An-naba`</option>
                                                                        <option value="An-naziat">An-naziat</option>
                                                                        <option value="`Abasa">`Abasa</option>
                                                                        <option value="At-takwir">At-taqwir</option>
                                                                        <option value="Al-mutaffifin">Al-mutaffifin</option>
                                                                        <option value="Al-insyiqaq">Al-insyiqaq</option>
                                                                        <option value="Al-buruj">Al-buruj</option>
                                                                        <option value="At-thoriq">At-thoriq</option>
                                                                        <option value="Al-a`la">Al-a`la</option>
                                                                        <option value="Al-gasyiyah">Al-gasyiyah</option>
                                                                        <option value="Al-fajr">Al-fajr</option>
                                                                        <option value="Al-balad">Al-balad</option>
                                                                        <option value="Asy-syams">Asy-syams</option>
                                                                        <option value="Al-lail">Al-lail</option>
                                                                        <option value="Adh-dhuha">Adh-dhuha</option>
                                                                        <option value="Asy-syarh">Asy-syarh</option>
                                                                        <option value="At-tin">At-tin</option>
                                                                        <option value="Al-alaq">Al-alaq</option>
                                                                        <option value="Al-qadr">Al-qadr</option>
                                                                        <option value="Al-bayyinah">Al-bayyinah</option>
                                                                        <option value="Az-zalzalah">Az-zalzalah</option>
                                                                        <option value="Al-adiyat">Al-adiyat</option>
                                                                        <option value="Al-qari`ah">Al-qari`ah</option>
                                                                        <option value="At-takatsur">At-takatsur</option>
                                                                        <option value="Al-asr">Al-asr</option>
                                                                        <option value="Al-humazah">Al-humazah</option>
                                                                        <option value="Al-fil">Al-fil</option>
                                                                        <option value="Al-quraisy">Al-quraisy</option>
                                                                        <option value="Al-ma`un">Al-ma`un</option>
                                                                        <option value="Al-kautsar">Al-kautsar</option>
                                                                        <option value="Al-kafirun">Al-kafirun</option>
                                                                        <option value="An-nashr">An-nashr</option>
                                                                        <option value="Al-lahab">Al-lahab</option>
                                                                        <option value="Al-ikhlas">Al-ikhlas</option>
                                                                        <option value="Al-falaq">Al-falaq</option>
                                                                        <option value="An-nas">An-nas</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Juz<span class="text-danger">*</span> </label>
                                                                    <input
                                                                        type="number"
                                                                        class="form-control"
                                                                        name="juz"
                                                                        value="{{old('juz')}}"
                                                                        placeholder="juz"
                                                                    >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Mulai Ayat<span class="text-danger">*</span> </label>
                                                                    <input
                                                                        type="number"
                                                                        class="form-control"
                                                                        name="ayat_from"
                                                                        value="{{old('ayat_from')}}"
                                                                        placeholder="mulai ayat"
                                                                    >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Sampai Ayat<span class="text-danger">*</span> </label>
                                                                    <input
                                                                        type="number"
                                                                        class="form-control"
                                                                        name="ayat_to"
                                                                        value="{{old('ayat_to')}}"
                                                                        placeholder="sampai ayat"
                                                                    >
                                                                </div>
                                                            </div>
                                                            <!-- PENYIMAK -->
                                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                            <div class="col-md-6 col-sm-6 ">
                                                                <label>Tanggal Setoran<span class="text-danger">*</span> </label>
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
                                                                    name="date"
                                                                    value="{{old('date')}}"
                                                                    placeholder="tanggal setoran"
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
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="x_title">
                                    <a
                                        class="mb-2 btn btn-primary btn-sm"
                                        href="#createHafalan"
                                        data-toggle="modal"
                                        data-toggle="tooltip"
                                    >
                                        <i class="fa fa-plus-square"></i>
                                        &nbsp;Tambah
                                    </a>
                                    <button type="button" class="btn btn-success btn-sm" data-target="#juz" data-toggle="modal">{{$students->memorization_juz == NULL ? '0 Juz' : $students->memorization_juz.' Juz'}}</button>
                                    <button type="button" class="btn btn-success btn-sm" data-target="#surah" data-toggle="modal">{{$students->memorization_page == NULL ? '0 halaman' : $students->memorization_page.' Halaman'}}</button>
                                    <!-- Modal Juz -->
                                    <div class="modal fade" id="juz" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <form action="{{route('ganti.total.hafalan', $students->id)}}" method="POST" class="modal-content">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ubah Jumlah Juz</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="juz">Juz</label>
                                                        <input type="number" value="{{$students->memorization_juz}}" class="form-control" name="memorization_juz">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Modal Surah -->
                                    <div class="modal fade" id="surah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <form action="{{route('ganti.total.hafalan', $students->id)}}" method="POST" class="modal-content">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ubah Jumlah Halaman</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="surah">Surah</label>
                                                        <input type="number" value="{{$students->memorization_page}}" class="form-control" name="memorization_page">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Surah</th>
                                            <th>Juz</th>
                                            <th>Mulai ayat</th>
                                            <th>Berakhir Ayat</th>
                                            <th>Penyimak</th>
                                            <th>Tanggal Setoran</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($memorizations as $memorization)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $memorization->surah }}</td>
                                            <td>{{ $memorization->juz }}</td>
                                            <td>{{ $memorization->ayat_from }}</td>
                                            <td>{{ $memorization->ayat_to }}</td>
                                            <td>{{ $memorization->teacher->name }}</td>
                                            <td>{{ $memorization->date }}</td>
                                            <td>
                                                <a class="btn btn-warning btn-sm"
                                                    href="#editHafalan{{ $memorization->id }}"
                                                    data-toggle="modal"
                                                    data-toggle="tooltip"
                                                >
                                                    Edit
                                                </a>

                                                <!-- Edit modal -->
                                                <div class="modal fade showModal" id="editHafalan{{ $memorization->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <form action="{{ route('memorization.update',$memorization->id) }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel">
                                                                        Ubah Hafalan
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Surah<span class="text-danger">*</span> </label>
                                                                                    <select name="surah" class="form-control selectpicker" data-live-search="true" style="width: 100%;">
                                                                                        <option disabled="disabled">-- Pilih Surah --</option>
                                                                                        <option value="Al-fatihah" {{ $memorization->surah == 'Al-fatihah' ? 'selected' : '' }}>Al-fatihah</option>
                                                                                        <option value="Al-baqarah" {{ $memorization->surah == 'Al-baqarah' ? 'selected' : '' }}>Al-baqarah</option>
                                                                                        <option value="Ali-imran" {{ $memorization->surah == 'Ali-imran' ? 'selected' : '' }}>Ali-imran</option>
                                                                                        <option value="An-nisa" {{ $memorization->surah == 'An-nisa' ? 'selected' : '' }}>An-nisa</option>
                                                                                        <option value="Al-Maidah" {{ $memorization->surah == 'Al-Maidah' ? 'selected' : '' }}>Al-Maidah</option>
                                                                                        <option value="Al-an`am" {{ $memorization->surah == 'Al-an`am' ? 'selected' : '' }}>Al-an`am</option>
                                                                                        <option value="Al-a`raf" {{ $memorization->surah == 'Al-a`raf' ? 'selected' : '' }}>Al-a`raf</option>
                                                                                        <option value="Al-anfal" {{ $memorization->surah == 'Al-anfal' ? 'selected' : '' }}>Al-anfal</option>
                                                                                        <option value="At-taubah" {{ $memorization->surah == 'At-taubah' ? 'selected' : '' }}>At-taubah</option>
                                                                                        <option value="Yunus" {{ $memorization->surah == 'Yunus' ? 'selected' : '' }}>Yunus</option>
                                                                                        <option value="Hud" {{ $memorization->surah == 'Hud' ? 'selected' : '' }}>Hud</option>
                                                                                        <option value="Yusuf" {{ $memorization->surah == 'Yusuf' ? 'selected' : '' }}>Yusuf</option>
                                                                                        <option value="Ar-ra`d" {{ $memorization->surah == 'Ar-ra`d' ? 'selected' : '' }}>Ar-ra`d</option>
                                                                                        <option value="Ibrahim" {{ $memorization->surah == 'Ibrahim' ? 'selected' : '' }}>Ibrahim</option>
                                                                                        <option value="Al-hijr" {{ $memorization->surah == 'Al-hijr' ? 'selected' : '' }}>Al-hijr</option>
                                                                                        <option value="An-nahl" {{ $memorization->surah == 'An-nahl' ? 'selected' : '' }}>An-nahl</option>
                                                                                        <option value="Al-isra`" {{ $memorization->surah == 'Al-isra`' ? 'selected' : '' }}>Al-isra`</option>
                                                                                        <option value="Al-kahfi" {{ $memorization->surah == 'Al-kahfi' ? 'selected' : '' }}>Al-kahfi</option>
                                                                                        <option value="Maryam" {{ $memorization->surah == 'Maryam' ? 'selected' : '' }}>Maryam</option>
                                                                                        <option value="Thaha" {{ $memorization->surah == 'Thaha' ? 'selected' : '' }}>Thaha</option>
                                                                                        <option value="Al-anbiya" {{ $memorization->surah == 'Al-anbiya' ? 'selected' : '' }}>Al-anbiya</option>
                                                                                        <option value="Al-hajj" {{ $memorization->surah == 'Al-hajj' ? 'selected' : '' }}>Al-hajj</option>
                                                                                        <option value="Al-mu`minun" {{ $memorization->surah == 'Al-mu`minun' ? 'selected' : '' }}>Al-mu`minun</option>
                                                                                        <option value="An-nur" {{ $memorization->surah == 'An-nur' ? 'selected' : '' }}>An-nur</option>
                                                                                        <option value="Al-furqan" {{ $memorization->surah == 'Al-furqan' ? 'selected' : '' }}>Al-furqan</option>
                                                                                        <option value="Asy-syu`ara" {{ $memorization->surah == 'Asy-syu`ara' ? 'selected' : '' }}>Asy-syu`ara</option>
                                                                                        <option value="An-naml" {{ $memorization->surah == 'An-naml' ? 'selected' : '' }}>An-naml</option>
                                                                                        <option value="Al-qashash" {{ $memorization->surah == 'Al-qashash' ? 'selected' : '' }}>Al-qashash</option>
                                                                                        <option value="Al-ankabut" {{ $memorization->surah == 'Al-ankabut' ? 'selected' : '' }}>Al-ankabut</option>
                                                                                        <option value="Ar-rum" {{ $memorization->surah == 'Ar-rum' ? 'selected' : '' }}>Ar-rum</option>
                                                                                        <option value="Luqman" {{ $memorization->surah == 'Luqman' ? 'selected' : '' }}>Luqman</option>
                                                                                        <option value="As-sajdah" {{ $memorization->surah == 'As-sajdah' ? 'selected' : '' }}>As-sajdah</option>
                                                                                        <option value="Al-ahzab" {{ $memorization->surah == 'Al-ahzab' ? 'selected' : '' }}>Al-ahzab</option>
                                                                                        <option value="Saba`" {{ $memorization->surah == 'Saba`' ? 'selected' : '' }}>Saba`</option>
                                                                                        <option value="Fathir" {{ $memorization->surah == 'Fathir' ? 'selected' : '' }}>Fathir</option>
                                                                                        <option value="Yasin" {{ $memorization->surah == 'Yasin' ? 'selected' : '' }}>Yasin</option>
                                                                                        <option value="Ash-shoffat" {{ $memorization->surah == 'Ash-shoffat' ? 'selected' : '' }}>Ash-shoffat</option>
                                                                                        <option value="Shad" {{ $memorization->surah == 'Shad' ? 'selected' : '' }}>Shad</option>
                                                                                        <option value="Az-zumar" {{ $memorization->surah == 'Az-zumar' ? 'selected' : '' }}>Az-zumar</option>
                                                                                        <option value="Ghafir" {{ $memorization->surah == 'Ghafir' ? 'selected' : '' }}>Ghafir</option>
                                                                                        <option value="Al-fushilat" {{ $memorization->surah == 'Al-fushilat' ? 'selected' : '' }}>Al-fushilat</option>
                                                                                        <option value="Asy-syura`" {{ $memorization->surah == 'Asy-syura' ? 'selected' : '' }}>Asy-syura`</option>
                                                                                        <option value="Az-zukhruf" {{ $memorization->surah == 'Az-zukhruf' ? 'selected' : '' }}>Az-zukhruf</option>
                                                                                        <option value="Ad-dukhan" {{ $memorization->surah == 'Ad-dukhan' ? 'selected' : '' }}>Ad-dukhan</option>
                                                                                        <option value="Al-jatsiyah" {{ $memorization->surah == 'Al-jatsiyah' ? 'selected' : '' }}>Al-jatsiyah</option>
                                                                                        <option value="Al-ahqaf" {{ $memorization->surah == 'Al-ahqaf' ? 'selected' : '' }}>Al-ahqaf</option>
                                                                                        <option value="Muhammad" {{ $memorization->surah == 'Muhammad' ? 'selected' : '' }}>Muhammad</option>
                                                                                        <option value="Al-fath" {{ $memorization->surah == 'Al-fath' ? 'selected' : '' }}>Al-fath</option>
                                                                                        <option value="Al-hujurat" {{ $memorization->surah == 'Al-hujurat' ? 'selected' : '' }}>Al-hujurat</option>
                                                                                        <option value="Qaaf" {{ $memorization->surah == 'Qaaf' ? 'selected' : '' }}>Qaaf</option>
                                                                                        <option value="Adz-dzariyat" {{ $memorization->surah == 'Adz-dzariyat' ? 'selected' : '' }}>Adz-dzariyat</option>
                                                                                        <option value="Ath-thur" {{ $memorization->surah == 'Ath-thur' ? 'selected' : '' }}>Ath-thur</option>
                                                                                        <option value="An-najm" {{ $memorization->surah == 'An-najm' ? 'selected' : '' }}>An-najm</option>
                                                                                        <option value="Al-qamar" {{ $memorization->surah == 'Al-qamar' ? 'selected' : '' }}>Al-qamar</option>
                                                                                        <option value="Ar-rahman" {{ $memorization->surah == 'Ar-rahman' ? 'selected' : '' }}>Ar-rahman</option>
                                                                                        <option value="Al-waqi`ah" {{ $memorization->surah == 'Al-waqi`ah' ? 'selected' : '' }}>Al-waqi`ah</option>
                                                                                        <option value="Al-hadid" {{ $memorization->surah == 'Al-hadid' ? 'selected' : '' }}>Al-hadid</option>
                                                                                        <option value="Al-mujadalah" {{ $memorization->surah == 'Al-mujadalah' ? 'selected' : '' }}>Al-mujadalah</option>
                                                                                        <option value="Al-hasyr" {{ $memorization->surah == 'Al-hasyr' ? 'selected' : '' }}>Al-hasyr</option>
                                                                                        <option value="Al-Mumtahanah" {{ $memorization->surah == 'Al-Mumtahanah' ? 'selected' : '' }}>Al-Mumtahanah</option>
                                                                                        <option value="Ash-shaff" {{ $memorization->surah == 'Ash-shaff' ? 'selected' : '' }}>Ash-shaff</option>
                                                                                        <option value="Al-jumu`ah" {{ $memorization->surah == 'Al-jumu`ah' ? 'selected' : '' }}>Al-jumu`ah</option>
                                                                                        <option value="Al-munafiqun" {{ $memorization->surah == 'Al-munafiqun' ? 'selected' : '' }}>Al-munafiqun</option>
                                                                                        <option value="At-taghabun" {{ $memorization->surah == 'At-taghabun' ? 'selected' : '' }}>At-taghabun</option>
                                                                                        <option value="Ath-thalaq" {{ $memorization->surah == 'Ath-thalaq' ? 'selected' : '' }}>Ath-thalaq</option>
                                                                                        <option value="At-tahrim" {{ $memorization->surah == 'At-tahrim' ? 'selected' : '' }}>At-tahrim</option>
                                                                                        <option value="Al-mulk" {{ $memorization->surah == 'Al-mulk' ? 'selected' : '' }}>Al-mulk</option>
                                                                                        <option value="Al-qalam" {{ $memorization->surah == 'Al-qalam' ? 'selected' : '' }}>Al-qalam</option>
                                                                                        <option value="Al-haqqah" {{ $memorization->surah == 'Al-haqqah' ? 'selected' : '' }}>Al-haqqah</option>
                                                                                        <option value="Al-maarij" {{ $memorization->surah == 'Al-maarij' ? 'selected' : '' }}>Al-maarij</option>
                                                                                        <option value="Nuh" {{ $memorization->surah == 'Nuh' ? 'selected' : '' }}>Nuh</option>
                                                                                        <option value="Jin" {{ $memorization->surah == 'Jin' ? 'selected' : '' }}>Jin</option>
                                                                                        <option value="Al-muzammil" {{ $memorization->surah == 'Al-muzammil' ? 'selected' : '' }}>Al-muzammil</option>
                                                                                        <option value="Al-muddatsir" {{ $memorization->surah == 'Al-muddatsir' ? 'selected' : '' }}>Al-muddatsir</option>
                                                                                        <option value="Al-qiyamah" {{ $memorization->surah == 'Al-qiyamah' ? 'selected' : '' }}>Al-qiyamah</option>
                                                                                        <option value="Al-insan" {{ $memorization->surah == 'Al-insan' ? 'selected' : '' }}>Al-insan</option>
                                                                                        <option value="Al-mursalat" {{ $memorization->surah == 'Al-mursalat' ? 'selected' : '' }}>Al-mursalat</option>
                                                                                        <option value="An-naba`" {{ $memorization->surah == 'An-naba`' ? 'selected' : '' }}>An-naba`</option>
                                                                                        <option value="An-naziat" {{ $memorization->surah == 'An-naziat' ? 'selected' : '' }}>An-naziat</option>
                                                                                        <option value="`Abasa" {{ $memorization->surah == '`Abasa' ? 'selected' : '' }}>`Abasa</option>
                                                                                        <option value="At-takwir" {{ $memorization->surah == 'At-takwir' ? 'selected' : '' }}>At-takwir</option>
                                                                                        <option value="Al-mutaffifin" {{ $memorization->surah == 'Al-mutaffifin' ? 'selected' : '' }}>Al-mutaffifin</option>
                                                                                        <option value="Al-insyiqaq" {{ $memorization->surah == 'Al-insyiqaq' ? 'selected' : '' }}>Al-insyiqaq</option>
                                                                                        <option value="Al-buruj" {{ $memorization->surah == 'Al-buruj' ? 'selected' : '' }}>Al-buruj</option>
                                                                                        <option value="At-thoriq" {{ $memorization->surah == 'At-thoriq' ? 'selected' : '' }}>At-thoriq</option>
                                                                                        <option value="Al-a`la" {{ $memorization->surah == 'Al-a`la' ? 'selected' : '' }}>Al-a`la</option>
                                                                                        <option value="Al-gasyiyah" {{ $memorization->surah == 'Al-gasyiyah' ? 'selected' : '' }}>Al-gasyiyah</option>
                                                                                        <option value="Al-fajr" {{ $memorization->surah == 'Al-fajr' ? 'selected' : '' }}>Al-fajr</option>
                                                                                        <option value="Al-balad" {{ $memorization->surah == 'Al-balad' ? 'selected' : '' }}>Al-balad</option>
                                                                                        <option value="Asy-syams" {{ $memorization->surah == 'Asy-syams' ? 'selected' : '' }}>Asy-syams</option>
                                                                                        <option value="Al-lail" {{ $memorization->surah == 'Al-lail' ? 'selected' : '' }}>Al-lail</option>
                                                                                        <option value="Adh-dhuha" {{ $memorization->surah == 'Adh-dhuha' ? 'selected' : '' }}>Adh-dhuha</option>
                                                                                        <option value="Asy-syarh" {{ $memorization->surah == 'Asy-syarh' ? 'selected' : '' }}>Asy-syarh</option>
                                                                                        <option value="At-tin" {{ $memorization->surah == 'At-tin' ? 'selected' : '' }}>At-tin</option>
                                                                                        <option value="Al-alaq" {{ $memorization->surah == 'Al-alaq' ? 'selected' : '' }}>Al-alaq</option>
                                                                                        <option value="Al-qadr" {{ $memorization->surah == 'Al-qadr' ? 'selected' : '' }}>Al-qadr</option>
                                                                                        <option value="Al-bayyinah" {{ $memorization->surah == 'Al-bayyinah' ? 'selected' : '' }}>Al-bayyinah</option>
                                                                                        <option value="Az-zalzalah" {{ $memorization->surah == 'Az-zalzalah' ? 'selected' : '' }}>Az-zalzalah</option>
                                                                                        <option value="Al-adiyat" {{ $memorization->surah == 'Al-adiyat' ? 'selected' : '' }}>Al-adiyat</option>
                                                                                        <option value="Al-qari`ah" {{ $memorization->surah == 'Al-qari`ah' ? 'selected' : '' }}>Al-qari`ah</option>
                                                                                        <option value="At-takatsur" {{ $memorization->surah == 'At-takatsur' ? 'selected' : '' }}>At-takatsur</option>
                                                                                        <option value="Al-asr" {{ $memorization->surah == 'Al-asr' ? 'selected' : '' }}>Al-asr</option>
                                                                                        <option value="Al-humazah" {{ $memorization->surah == 'Al-humazah' ? 'selected' : '' }}>Al-humazah</option>
                                                                                        <option value="Al-fil" {{ $memorization->surah == 'Al-fil' ? 'selected' : '' }}>Al-fil</option>
                                                                                        <option value="Al-quraisy" {{ $memorization->surah == 'Al-quraisy' ? 'selected' : '' }}>Al-quraisy</option>
                                                                                        <option value="Al-ma`un" {{ $memorization->surah == 'Al-ma`un' ? 'selected' : '' }}>Al-ma`un</option>
                                                                                        <option value="Al-kautsar" {{ $memorization->surah == 'Al-kautsar' ? 'selected' : '' }}>Al-kautsar</option>
                                                                                        <option value="Al-kafirun" {{ $memorization->surah == 'Al-kafirun' ? 'selected' : '' }}>Al-kafirun</option>
                                                                                        <option value="An-nashr" {{ $memorization->surah == 'An-nashr' ? 'selected' : '' }}>An-nashr</option>
                                                                                        <option value="Al-lahab" {{ $memorization->surah == 'Al-lahab' ? 'selected' : '' }}>Al-lahab</option>
                                                                                        <option value="Al-ikhlas" {{ $memorization->surah == 'Al-ikhlas' ? 'selected' : '' }}>Al-ikhlas</option>
                                                                                        <option value="Al-falaq" {{ $memorization->surah == 'Al-falaq' ? 'selected' : '' }}>Al-falaq</option>
                                                                                        <option value="An-nas" {{ $memorization->surah == 'An-nas' ? 'selected' : '' }}>An-nas</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Juz<span class="text-danger">*</span> </label>
                                                                                    <input
                                                                                        type="number"
                                                                                        class="form-control"
                                                                                        name="juz"
                                                                                        value="{{ $memorization->juz  }}"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Mulai Ayat<span class="text-danger">*</span> </label>
                                                                                    <input
                                                                                        type="number"
                                                                                        class="form-control"
                                                                                        name="ayat_from"
                                                                                        value="{{ $memorization->ayat_from }}"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Sampai Ayat<span class="text-danger">*</span> </label>
                                                                                    <input
                                                                                        type="number"
                                                                                        class="form-control"
                                                                                        name="ayat_to"
                                                                                        value="{{ $memorization->ayat_to }}"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Penyimak<span class="text-danger">*</span> </label>
                                                                                    <select name="user_id" class="form-control selectpicker" data-live-search="true" style="width: 100%;" value>
                                                                                        @foreach ($teachers as $teacher)
                                                                                            <option value="{{ $teacher->id }}"{{ $teacher->name === $memorization->teacher->name ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-sm-6 ">
                                                                                <label>Tanggal Setoran<span class="text-danger">*</span> </label>
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
                                                                                    name="date"
                                                                                    value="{{ $memorization->date }}"
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
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <a class="btn btn-danger btn-sm"
                                                    href="#deleteHafalan{{ $memorization->id }}"
                                                    data-toggle="modal"
                                                    data-toggle="tooltip"
                                                >
                                                    Delete
                                                </a>
                                            </td>

                                            {{-- Modal Delete Data --}}
                                            <div id="deleteHafalan{{ $memorization->id }}" class="modal fade">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form class="d-inline-block" action="{{ route('memorization.destroy', $memorization->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Delete Hafalan</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin menghapus data <strong>{{ $memorization->surah }} ? </strong></p>
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
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
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
@endpush
