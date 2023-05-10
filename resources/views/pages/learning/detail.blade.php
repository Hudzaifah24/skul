@extends('layouts.app')

@section('title')
    Jadwal pelajaran
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
            <div class="title_left d-flex align-items-center">
                <h3>
                    <small>
                        Detail Jadwal pelajaran /&nbsp;<b>Kelas{{ $classId->name }}</b>
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
                        <a
                            class="mb-2 btn btn-dark btn-md"
                            href="{{ route('learning.index') }}"
                        >
                            <i class="fa fa-arrow-circle-left"></i>
                            &nbsp;Kembali
                        </a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{(request()->is('learning/'.$classId->id)) ? 'active' : ''}}" id="senin" data-toggle="tab" href="#hariSenin" role="tab" aria-controls="senin" aria-selected="{{(request()->is('learning/'.$classId->id)) ? 'true' : 'false'}}">Senin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{(request()->is('learning/'.$classId->id.'selasa')) ? 'active' : ''}}" id="selasa" data-toggle="tab" href="#hariSelasa" role="tab" aria-controls="selasa" aria-selected="{{(request()->is('learning/'.$classId->id.'selasa')) ? 'true' : 'false'}}">Selasa</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{(request()->is('learning/'.$classId->id.'rabu')) ? 'active' : ''}}" id="rabu" data-toggle="tab" href="#hariRabu" role="tab" aria-controls="rabu" aria-selected="{{(request()->is('learning/'.$classId->id.'rabu')) ? 'true' : 'false'}}">Rabu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{(request()->is('learning/'.$classId->id.'kamis')) ? 'active' : ''}}" id="kamis" data-toggle="tab" href="#hariKamis" role="tab" aria-controls="kamis" aria-selected="{{(request()->is('learning/'.$classId->id.'kamis')) ? 'true' : 'false'}}">Kamis</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{(request()->is('learning/'.$classId->id.'jumat')) ? 'active' : ''}}" id="jumat" data-toggle="tab" href="#hariJumat" role="tab" aria-controls="jumat" aria-selected="{{(request()->is('learning/'.$classId->id.'jumat')) ? 'true' : 'false'}}">Jum'at</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{(request()->is('learning/'.$classId->id.'sabtu')) ? 'active' : ''}}" id="sabtu" data-toggle="tab" href="#hariSabtu" role="tab" aria-controls="sabtu" aria-selected="{{(request()->is('learning/'.$classId->id.'sabtu')) ? 'true' : 'false'}}">Sabtu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{(request()->is('learning/'.$classId->id.'ahad')) ? 'active' : ''}}" id="ahad" data-toggle="tab" href="#hariAhad" role="tab" aria-controls="ahad" aria-selected="{{(request()->is('learning/'.$classId->id.'ahad')) ? 'true' : 'false'}}">Ahad</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            {{-- Hari Senin --}}
                            <div class="tab-pane fade {{(request()->is('learning/'.$classId->id)) ? 'show active' : ''}}" id="hariSenin" role="tabpanel" aria-labelledby="senin">
                                <div class="col-md-12 col-sm-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <a
                                                class="mb-2 btn btn-primary btn-sm"
                                                href="#createhariSenin"
                                                data-toggle="modal"
                                                data-toggle="tooltip"
                                            >
                                                <i class="fa fa-plus-square"></i>
                                                &nbsp;Tambah
                                            </a>
                                            <!-- Create modal -->
                                            <div class="modal fade" id="createhariSenin" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <form action="{{route('learning.store')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">
                                                                    Tambah Hari Senin
                                                                </h4>
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <input type="hidden" name="day" value="1">
                                                                        <input type="hidden" name="class_id" value="{{$classId->id}}">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Guru</label>
                                                                                <select name="user_id" class="form-control">
                                                                                    @foreach ($teachers as $teacher)
                                                                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Nama Pelajaran</label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="name"
                                                                                id="name"
                                                                                value="{{ old('name') }}"
                                                                            >
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="order">Jam Ke</label>
                                                                                <input
                                                                                    type="number"
                                                                                    class="form-control"
                                                                                    name="order"
                                                                                    id="order"
                                                                                    value="{{ old('order') }}"
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Mulai Pelajaran</label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="hour_from"
                                                                                id="hour_from"
                                                                                value="{{ old('hour_from') }}"
                                                                            >
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="hour_to">Selesai Pelajaran</label>
                                                                                <input
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    name="hour_to"
                                                                                    id="hour_to"
                                                                                    value="{{ old('hour_to') }}"
                                                                                >
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
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Jam Ke</th>
                                                        <th>Nama Pelajaran</th>
                                                        <th>Guru</th>
                                                        <th>Waktu</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($learnings as $data)
                                                        @if ($data->day==1)
                                                            <tr>
                                                                <td>{{$data->order}}</td>
                                                                <td>{{$data->name}}</td>
                                                                <td>{{$data->teachers->name}}</td>
                                                                <td>{{$data->hour_from.' - '.$data->hour_to}}</td>
                                                                <td>
                                                                    <a class="btn btn-warning btn-sm"
                                                                        href="#edithariSenin{{$data->id}}"
                                                                        data-toggle="modal"
                                                                        data-toggle="tooltip"
                                                                    >
                                                                        Ubah
                                                                    </a>
                                                                    <!-- Edit modal -->
                                                                    <div class="modal fade showModal" id="edithariSenin{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form action="{{route('learning.update', $data->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="modal-content">

                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title" id="myModalLabel">
                                                                                            Ubah Hari Senin
                                                                                        </h4>
                                                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                                        </button>
                                                                                    </div>

                                                                                    <div class="modal-body">
                                                                                        <div class="card-body">
                                                                                            <div class="row">
                                                                                                <input type="hidden" name="class_id" value="{{$classId->id}}">
                                                                                                <input type="hidden" name="day" value="1">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">
                                                                                                        <label>Guru</label>
                                                                                                        <select name="user_id" class="form-control">
                                                                                                            @foreach ($teachers as $teacher)
                                                                                                                <option value="{{ $teacher->id }}"{{ $teacher->id === $data->teachers->id ? 'selected' : '' }} >{{ $teacher->name }}</option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <label>Nama Pelajaran</label>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        name="name"
                                                                                                        value="{{$data->name}}"
                                                                                                        id="name"
                                                                                                    >
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="order">Jam Ke</label>
                                                                                                        <input
                                                                                                            type="number"
                                                                                                            class="form-control"
                                                                                                            name="order"
                                                                                                            value="{{$data->order}}"
                                                                                                            id="order"
                                                                                                        >
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <label>Mulai Pelajaran</label>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        name="hour_from"
                                                                                                        value="{{$data->hour_from}}"
                                                                                                        id="hour_from"
                                                                                                    >
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="hour_to">Selesai Pelajaran</label>
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            name="hour_to"
                                                                                                            value="{{$data->hour_to}}"
                                                                                                            id="hour_to"
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
                                                                    <a class="btn btn-danger btn-sm"
                                                                        href="#deletehariSenin{{$data->id}}"
                                                                        data-toggle="modal"
                                                                        data-toggle="tooltip"
                                                                    >
                                                                        Hapus
                                                                    </a>
                                                                    {{-- Modal Delete Data --}}
                                                                    <div id="deletehariSenin{{$data->id}}" class="modal fade">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <form class="d-inline-block" action="{{route('learning.destroy', $data->id)}}" method="POST">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title">Hapus Hari Senin</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p>Apakah Anda yakin ingin menghapus data <strong>{{$data->name}} ?</strong></p>
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
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Hari Selasa --}}
                            <div class="tab-pane fade {{(request()->is('learning/'.$classId->id.'selasa')) ? 'show active' : ''}}" id="hariSelasa" role="tabpanel" aria-labelledby="selasa">
                                <div class="col-md-12 col-sm-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <a
                                                class="mb-2 btn btn-primary btn-sm"
                                                href="#createhariSelasa"
                                                data-toggle="modal"
                                                data-toggle="tooltip"
                                            >
                                                <i class="fa fa-plus-square"></i>
                                                &nbsp;Tambah
                                            </a>
                                            <!-- Create modal -->
                                            <div class="modal fade" id="createhariSelasa" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <form action="{{route('learning.store')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">
                                                                    Tambah Hari Selasa
                                                                </h4>
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <input type="hidden" name="class_id" value="{{$classId->id}}">
                                                                        <input type="hidden" name="day" value="2">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Guru</label>
                                                                                <select name="user_id" class="form-control">
                                                                                    @foreach ($teachers as $teacher)
                                                                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Nama Pelajaran</label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="name"
                                                                                id="name"
                                                                                value="{{ old('name') }}"
                                                                            >
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="order">Jam Ke</label>
                                                                                <input
                                                                                    type="number"
                                                                                    class="form-control"
                                                                                    name="order"
                                                                                    id="order"
                                                                                    value="{{ old('order') }}"
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Mulai Pelajaran</label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="hour_from"
                                                                                id="hour_from"
                                                                                value="{{ old('hour_from') }}"
                                                                            >
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="hour_to">Selesai Pelajaran</label>
                                                                                <input
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    name="hour_to"
                                                                                    id="hour_to"
                                                                                    value="{{ old('hour_to') }}"
                                                                                >
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
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Jam Ke</th>
                                                        <th>Nama Pelajaran</th>
                                                        <th>Guru</th>
                                                        <th>Waktu</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($learnings as $data)
                                                        @if ($data->day==2)
                                                            <tr>
                                                                <td>{{$data->order}}</td>
                                                                <td>{{$data->name}}</td>
                                                                <td>{{$data->teachers->name}}</td>
                                                                <td>{{$data->hour_from.' - '.$data->hour_to}}</td>
                                                                <td>
                                                                    <a class="btn btn-warning btn-sm"
                                                                        href="#edithariSelasa{{$data->id}}"
                                                                        data-toggle="modal"
                                                                        data-toggle="tooltip"
                                                                    >
                                                                        Ubah
                                                                    </a>
                                                                    <!-- Edit modal -->
                                                                    <div class="modal fade showModal" id="edithariSelasa{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form action="{{route('learning.update', $data->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="modal-content">

                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title" id="myModalLabel">
                                                                                            Ubah Hari Selasa
                                                                                        </h4>
                                                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                                        </button>
                                                                                    </div>

                                                                                    <div class="modal-body">
                                                                                        <div class="card-body">
                                                                                            <div class="row">
                                                                                                <input type="hidden" name="day" value="2">
                                                                                                <input type="hidden" name="class_id" value="{{$classId->id}}">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">
                                                                                                        <label>Guru</label>
                                                                                                        <select name="user_id" class="form-control">
                                                                                                            @foreach ($teachers as $teacher)
                                                                                                                <option value="{{ $teacher->id }}"{{ $teacher->id === $data->teachers->id ? 'selected' : '' }} >{{ $teacher->name }}</option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <label>Nama Pelajaran</label>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        name="name"
                                                                                                        value="{{$data->name}}"
                                                                                                        id="name"
                                                                                                    >
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="order">Jam Ke</label>
                                                                                                        <input
                                                                                                            type="number"
                                                                                                            class="form-control"
                                                                                                            name="order"
                                                                                                            value="{{$data->order}}"
                                                                                                            id="order"
                                                                                                        >
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <label>Mulai Pelajaran</label>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        name="hour_from"
                                                                                                        value="{{$data->hour_from}}"
                                                                                                        id="hour_from"
                                                                                                    >
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="hour_to">Selesai Pelajaran</label>
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            name="hour_to"
                                                                                                            value="{{$data->hour_to}}"
                                                                                                            id="hour_to"
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
                                                                    <a class="btn btn-danger btn-sm"
                                                                        href="#deletehariSelasa{{$data->id}}"
                                                                        data-toggle="modal"
                                                                        data-toggle="tooltip"
                                                                    >
                                                                        Hapus
                                                                    </a>
                                                                    {{-- Modal Delete Data --}}
                                                                    <div id="deletehariSelasa{{$data->id}}" class="modal fade">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <form class="d-inline-block" action="{{route('learning.destroy', $data->id)}}" method="POST">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title">Hapus Hari Selasa</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p>Apakah Anda yakin ingin menghapus data <strong>{{$data->name}} ?</strong></p>
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
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Hari Rabu --}}
                            <div class="tab-pane fade {{(request()->is('learning/'.$classId->id.'rabu')) ? 'show active' : ''}}" id="hariRabu" role="tabpanel" aria-labelledby="rabu">
                                <div class="col-md-12 col-sm-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <a
                                                class="mb-2 btn btn-primary btn-sm"
                                                href="#createhariRabu"
                                                data-toggle="modal"
                                                data-toggle="tooltip"
                                            >
                                                <i class="fa fa-plus-square"></i>
                                                &nbsp;Tambah
                                            </a>
                                            <!-- Create modal -->
                                            <div class="modal fade" id="createhariRabu" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <form action="{{route('learning.store')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">
                                                                    Tambah Hari Rabu
                                                                </h4>
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <input type="hidden" name="class_id" value="{{$classId->id}}">
                                                                        <input type="hidden" name="day" value="3">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Guru</label>
                                                                                <select name="user_id" class="form-control">
                                                                                    @foreach ($teachers as $teacher)
                                                                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Nama Pelajaran</label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="name"
                                                                                id="name"
                                                                                value="{{ old('name') }}"
                                                                            >
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="order">Jam Ke</label>
                                                                                <input
                                                                                    type="number"
                                                                                    class="form-control"
                                                                                    name="order"
                                                                                    id="order"
                                                                                    value="{{ old('order') }}"
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Mulai Pelajaran</label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="hour_from"
                                                                                id="hour_from"
                                                                                value="{{ old('hour_from') }}"
                                                                            >
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="hour_to">Selesai Pelajaran</label>
                                                                                <input
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    name="hour_to"
                                                                                    id="hour_to"
                                                                                    value="{{ old('hour_to') }}"
                                                                                >
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
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Jam Ke</th>
                                                        <th>Nama Pelajaran</th>
                                                        <th>Guru</th>
                                                        <th>Waktu</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($learnings as $data)
                                                        @if ($data->day==3)
                                                            <tr>
                                                                <td>{{$data->order}}</td>
                                                                <td>{{$data->name}}</td>
                                                                <td>{{$data->teachers->name}}</td>
                                                                <td>{{$data->hour_from.' - '.$data->hour_to}}</td>
                                                                <td>
                                                                    <a class="btn btn-warning btn-sm"
                                                                        href="#edithariRabu{{$data->id}}"
                                                                        data-toggle="modal"
                                                                        data-toggle="tooltip"
                                                                    >
                                                                        Ubah
                                                                    </a>
                                                                    <!-- Edit modal -->
                                                                    <div class="modal fade showModal" id="edithariRabu{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form action="{{route('learning.update', $data->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="modal-content">

                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title" id="myModalLabel">
                                                                                            Ubah Hari Rabu
                                                                                        </h4>
                                                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                                        </button>
                                                                                    </div>

                                                                                    <div class="modal-body">
                                                                                        <div class="card-body">
                                                                                            <div class="row">
                                                                                                <input type="hidden" name="day" value="3">
                                                                                                <input type="hidden" name="class_id" value="{{$classId->id}}">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">
                                                                                                        <label>Guru</label>
                                                                                                        <select name="user_id" class="form-control">
                                                                                                            @foreach ($teachers as $teacher)
                                                                                                                <option value="{{ $teacher->id }}"{{ $teacher->id === $data->teachers->id ? 'selected' : '' }} >{{ $teacher->name }}</option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <label>Nama Pelajaran</label>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        name="name"
                                                                                                        value="{{$data->name}}"
                                                                                                        id="name"
                                                                                                    >
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="order">Jam Ke</label>
                                                                                                        <input
                                                                                                            type="number"
                                                                                                            class="form-control"
                                                                                                            name="order"
                                                                                                            value="{{$data->order}}"
                                                                                                            id="order"
                                                                                                        >
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <label>Mulai Pelajaran</label>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        name="hour_from"
                                                                                                        value="{{$data->hour_from}}"
                                                                                                        id="hour_from"
                                                                                                    >
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="hour_to">Selesai Pelajaran</label>
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            name="hour_to"
                                                                                                            value="{{$data->hour_to}}"
                                                                                                            id="hour_to"
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
                                                                    <a class="btn btn-danger btn-sm"
                                                                        href="#deletehariRabu{{$data->id}}"
                                                                        data-toggle="modal"
                                                                        data-toggle="tooltip"
                                                                    >
                                                                        Hapus
                                                                    </a>
                                                                    {{-- Modal Delete Data --}}
                                                                    <div id="deletehariRabu{{$data->id}}" class="modal fade">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <form class="d-inline-block" action="{{route('learning.destroy', $data->id)}}" method="POST">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title">Hapus Hari Rabu</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p>Apakah Anda yakin ingin menghapus data <strong>{{$data->name}} ?</strong></p>
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
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Hari Kamis --}}
                            <div class="tab-pane fade {{(request()->is('learning/'.$classId->id.'kamis')) ? 'show active' : ''}}" id="hariKamis" role="tabpanel" aria-labelledby="kamis">
                                <div class="col-md-12 col-sm-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <a
                                                class="mb-2 btn btn-primary btn-sm"
                                                href="#createhariKamis"
                                                data-toggle="modal"
                                                data-toggle="tooltip"
                                            >
                                                <i class="fa fa-plus-square"></i>
                                                &nbsp;Tambah
                                            </a>
                                            <!-- Create modal -->
                                            <div class="modal fade" id="createhariKamis" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <form action="{{route('learning.store')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">
                                                                    Tambah Hari Kamis
                                                                </h4>
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <input type="hidden" name="class_id" value="{{$classId->id}}">
                                                                        <input type="hidden" name="day" value="4">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Guru</label>
                                                                                <select name="user_id" class="form-control">
                                                                                    @foreach ($teachers as $teacher)
                                                                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Nama Pelajaran</label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="name"
                                                                                id="name"
                                                                                value="{{ old('name') }}"
                                                                            >
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="order">Jam Ke</label>
                                                                                <input
                                                                                    type="number"
                                                                                    class="form-control"
                                                                                    name="order"
                                                                                    id="order"
                                                                                    value="{{ old('order') }}"
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Mulai Pelajaran</label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="hour_from"
                                                                                id="hour_from"
                                                                                value="{{ old('hour_from') }}"
                                                                            >
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="hour_to">Selesai Pelajaran</label>
                                                                                <input
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    name="hour_to"
                                                                                    id="hour_to"
                                                                                    value="{{ old('hour_to') }}"
                                                                                >
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
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Jam Ke</th>
                                                        <th>Nama Pelajaran</th>
                                                        <th>Guru</th>
                                                        <th>Waktu</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($learnings as $data)
                                                        @if ($data->day==4)
                                                            <tr>
                                                                <td>{{$data->order}}</td>
                                                                <td>{{$data->name}}</td>
                                                                <td>{{$data->teachers->name}}</td>
                                                                <td>{{$data->hour_from.' - '.$data->hour_to}}</td>
                                                                <td>
                                                                    <a class="btn btn-warning btn-sm"
                                                                        href="#edithariKamis{{$data->id}}"
                                                                        data-toggle="modal"
                                                                        data-toggle="tooltip"
                                                                    >
                                                                        Ubah
                                                                    </a>
                                                                    <!-- Edit modal -->
                                                                    <div class="modal fade showModal" id="edithariKamis{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form action="{{route('learning.update', $data->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="modal-content">

                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title" id="myModalLabel">
                                                                                            Ubah Hari Kamis
                                                                                        </h4>
                                                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                                        </button>
                                                                                    </div>

                                                                                    <div class="modal-body">
                                                                                        <div class="card-body">
                                                                                            <div class="row">
                                                                                                <input type="hidden" name="day" value="4">
                                                                                                <input type="hidden" name="class_id" value="{{$classId->id}}">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">
                                                                                                        <label>Guru</label>
                                                                                                        <select name="user_id" class="form-control">
                                                                                                            @foreach ($teachers as $teacher)
                                                                                                                <option value="{{ $teacher->id }}"{{ $teacher->id === $data->teachers->id ? 'selected' : '' }} >{{ $teacher->name }}</option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <label>Nama Pelajaran</label>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        name="name"
                                                                                                        value="{{$data->name}}"
                                                                                                        id="name"
                                                                                                    >
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="order">Jam Ke</label>
                                                                                                        <input
                                                                                                            type="number"
                                                                                                            class="form-control"
                                                                                                            name="order"
                                                                                                            value="{{$data->order}}"
                                                                                                            id="order"
                                                                                                        >
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <label>Mulai Pelajaran</label>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        name="hour_from"
                                                                                                        value="{{$data->hour_from}}"
                                                                                                        id="hour_from"
                                                                                                    >
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="hour_to">Selesai Pelajaran</label>
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            name="hour_to"
                                                                                                            value="{{$data->hour_to}}"
                                                                                                            id="hour_to"
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
                                                                    <a class="btn btn-danger btn-sm"
                                                                        href="#deletehariKamis{{$data->id}}"
                                                                        data-toggle="modal"
                                                                        data-toggle="tooltip"
                                                                    >
                                                                        Hapus
                                                                    </a>
                                                                    {{-- Modal Delete Data --}}
                                                                    <div id="deletehariKamis{{$data->id}}" class="modal fade">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <form class="d-inline-block" action="{{route('learning.destroy', $data->id)}}" method="POST">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title">Hapus Hari Kamis</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p>Apakah Anda yakin ingin menghapus data <strong>{{$data->name}} ?</strong></p>
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
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Hari Jum'at --}}
                            <div class="tab-pane fade {{(request()->is('learning/'.$classId->id.'jumat')) ? 'show active' : ''}}" id="hariJumat" role="tabpanel" aria-labelledby="jumat">
                                <div class="col-md-12 col-sm-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <a
                                                class="mb-2 btn btn-primary btn-sm"
                                                href="#createhariJumat"
                                                data-toggle="modal"
                                                data-toggle="tooltip"
                                            >
                                                <i class="fa fa-plus-square"></i>
                                                &nbsp;Tambah
                                            </a>
                                            <!-- Create modal -->
                                            <div class="modal fade" id="createhariJumat" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <form action="{{route('learning.store')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">
                                                                    Tambah Hari Jum'at
                                                                </h4>
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <input type="hidden" name="class_id" value="{{$classId->id}}">
                                                                        <input type="hidden" name="day" value="5">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Guru</label>
                                                                                <select name="user_id" class="form-control">
                                                                                    @foreach ($teachers as $teacher)
                                                                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Nama Pelajaran</label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="name"
                                                                                id="name"
                                                                                value="{{ old('name') }}"
                                                                            >
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="order">Jam Ke</label>
                                                                                <input
                                                                                    type="number"
                                                                                    class="form-control"
                                                                                    name="order"
                                                                                    id="order"
                                                                                    value="{{ old('order') }}"
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Mulai Pelajaran</label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="hour_from"
                                                                                id="hour_from"
                                                                                value="{{ old('hour_from') }}"
                                                                            >
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="hour_to">Selesai Pelajaran</label>
                                                                                <input
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    name="hour_to"
                                                                                    id="hour_to"
                                                                                    value="{{ old('hour_to') }}"
                                                                                >
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
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Jam Ke</th>
                                                        <th>Nama Pelajaran</th>
                                                        <th>Guru</th>
                                                        <th>Waktu</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($learnings as $data)
                                                        @if ($data->day==5)
                                                            <tr>
                                                                <td>{{$data->order}}</td>
                                                                <td>{{$data->name}}</td>
                                                                <td>{{$data->teachers->name}}</td>
                                                                <td>{{$data->hour_from.' - '.$data->hour_to}}</td>
                                                                <td>
                                                                    <a class="btn btn-warning btn-sm"
                                                                        href="#edithariJumat{{$data->id}}"
                                                                        data-toggle="modal"
                                                                        data-toggle="tooltip"
                                                                    >
                                                                        Ubah
                                                                    </a>
                                                                    <!-- Edit modal -->
                                                                    <div class="modal fade showModal" id="edithariJumat{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form action="{{route('learning.update', $data->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="modal-content">

                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title" id="myModalLabel">
                                                                                            Ubah Hari Jum'at
                                                                                        </h4>
                                                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                                        </button>
                                                                                    </div>

                                                                                    <div class="modal-body">
                                                                                        <div class="card-body">
                                                                                            <div class="row">
                                                                                                <input type="hidden" name="day" value="5">
                                                                                                <input type="hidden" name="class_id" value="{{$classId->id}}">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">
                                                                                                        <label>Guru</label>
                                                                                                        <select name="user_id" class="form-control">
                                                                                                            @foreach ($teachers as $teacher)
                                                                                                                <option value="{{ $teacher->id }}"{{ $teacher->id === $data->teachers->id ? 'selected' : '' }} >{{ $teacher->name }}</option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <label>Nama Pelajaran</label>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        name="name"
                                                                                                        value="{{$data->name}}"
                                                                                                        id="name"
                                                                                                    >
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="order">Jam Ke</label>
                                                                                                        <input
                                                                                                            type="number"
                                                                                                            class="form-control"
                                                                                                            name="order"
                                                                                                            value="{{$data->order}}"
                                                                                                            id="order"
                                                                                                        >
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <label>Mulai Pelajaran</label>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        name="hour_from"
                                                                                                        value="{{$data->hour_from}}"
                                                                                                        id="hour_from"
                                                                                                    >
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="hour_to">Selesai Pelajaran</label>
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            name="hour_to"
                                                                                                            value="{{$data->hour_to}}"
                                                                                                            id="hour_to"
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
                                                                    <a class="btn btn-danger btn-sm"
                                                                        href="#deletehariJumat{{$data->id}}"
                                                                        data-toggle="modal"
                                                                        data-toggle="tooltip"
                                                                    >
                                                                        Hapus
                                                                    </a>
                                                                    {{-- Modal Delete Data --}}
                                                                    <div id="deletehariJumat{{$data->id}}" class="modal fade">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <form class="d-inline-block" action="{{route('learning.destroy', $data->id)}}" method="POST">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title">Hapus Hari Jum'at</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p>Apakah Anda yakin ingin menghapus data <strong>{{$data->name}} ?</strong></p>
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
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Hari Sabtu --}}
                            <div class="tab-pane fade {{(request()->is('learning/'.$classId->id.'sabtu')) ? 'show active' : ''}}" id="hariSabtu" role="tabpanel" aria-labelledby="sabtu">
                                <div class="col-md-12 col-sm-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <a
                                                class="mb-2 btn btn-primary btn-sm"
                                                href="#createhariSabtu"
                                                data-toggle="modal"
                                                data-toggle="tooltip"
                                            >
                                                <i class="fa fa-plus-square"></i>
                                                &nbsp;Tambah
                                            </a>
                                            <!-- Create modal -->
                                            <div class="modal fade" id="createhariSabtu" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <form action="{{route('learning.store')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">
                                                                    Tambah Hari Sabtu
                                                                </h4>
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <input type="hidden" name="class_id" value="{{$classId->id}}">
                                                                        <input type="hidden" name="day" value="6">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Guru</label>
                                                                                <select name="user_id" class="form-control">
                                                                                    @foreach ($teachers as $teacher)
                                                                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Nama Pelajaran</label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="name"
                                                                                id="name"
                                                                                value="{{ old('name') }}"
                                                                            >
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="order">Jam Ke</label>
                                                                                <input
                                                                                    type="number"
                                                                                    class="form-control"
                                                                                    name="order"
                                                                                    id="order"
                                                                                    value="{{ old('order') }}"
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Mulai Pelajaran</label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="hour_from"
                                                                                id="hour_from"
                                                                                value="{{ old('hour_from') }}"
                                                                            >
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="hour_to">Selesai Pelajaran</label>
                                                                                <input
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    name="hour_to"
                                                                                    id="hour_to"
                                                                                    value="{{ old('hour_to') }}"
                                                                                >
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
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Jam Ke</th>
                                                        <th>Nama Pelajaran</th>
                                                        <th>Guru</th>
                                                        <th>Waktu</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($learnings as $data)
                                                        @if ($data->day==6)
                                                            <tr>
                                                                <td>{{$data->order}}</td>
                                                                <td>{{$data->name}}</td>
                                                                <td>{{$data->teachers->name}}</td>
                                                                <td>{{$data->hour_from.' - '.$data->hour_to}}</td>
                                                                <td>
                                                                    <a class="btn btn-warning btn-sm"
                                                                        href="#edithariSabtu{{$data->id}}"
                                                                        data-toggle="modal"
                                                                        data-toggle="tooltip"
                                                                    >
                                                                        Ubah
                                                                    </a>
                                                                    <!-- Edit modal -->
                                                                    <div class="modal fade showModal" id="edithariSabtu{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form action="{{route('learning.update', $data->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="modal-content">

                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title" id="myModalLabel">
                                                                                            Ubah Hari Sabtu
                                                                                        </h4>
                                                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                                        </button>
                                                                                    </div>

                                                                                    <div class="modal-body">
                                                                                        <div class="card-body">
                                                                                            <div class="row">
                                                                                                <input type="hidden" name="day" value="6">
                                                                                                <input type="hidden" name="class_id" value="{{$classId->id}}">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">
                                                                                                        <label>Guru</label>
                                                                                                        <select name="user_id" class="form-control">
                                                                                                            @foreach ($teachers as $teacher)
                                                                                                                <option value="{{ $teacher->id }}"{{ $teacher->id === $data->teachers->id ? 'selected' : '' }} >{{ $teacher->name }}</option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <label>Nama Pelajaran</label>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        name="name"
                                                                                                        value="{{$data->name}}"
                                                                                                        id="name"
                                                                                                    >
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="order">Jam Ke</label>
                                                                                                        <input
                                                                                                            type="number"
                                                                                                            class="form-control"
                                                                                                            name="order"
                                                                                                            value="{{$data->order}}"
                                                                                                            id="order"
                                                                                                        >
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <label>Mulai Pelajaran</label>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        name="hour_from"
                                                                                                        value="{{$data->hour_from}}"
                                                                                                        id="hour_from"
                                                                                                    >
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="hour_to">Selesai Pelajaran</label>
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            name="hour_to"
                                                                                                            value="{{$data->hour_to}}"
                                                                                                            id="hour_to"
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
                                                                    <a class="btn btn-danger btn-sm"
                                                                        href="#deletehariSabtu{{$data->id}}"
                                                                        data-toggle="modal"
                                                                        data-toggle="tooltip"
                                                                    >
                                                                        Hapus
                                                                    </a>
                                                                    {{-- Modal Delete Data --}}
                                                                    <div id="deletehariSabtu{{$data->id}}" class="modal fade">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <form class="d-inline-block" action="{{route('learning.destroy', $data->id)}}" method="POST">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title">Hapus Hari Sabtu</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p>Apakah Anda yakin ingin menghapus data <strong>{{$data->name}} ?</strong></p>
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
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Hari Ahad --}}
                            <div class="tab-pane fade {{(request()->is('learning/'.$classId->id.'ahad')) ? 'show active' : ''}}" id="hariAhad" role="tabpanel" aria-labelledby="ahad">
                                <div class="col-md-12 col-sm-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <a
                                                class="mb-2 btn btn-primary btn-sm"
                                                href="#createhariAhad"
                                                data-toggle="modal"
                                                data-toggle="tooltip"
                                            >
                                                <i class="fa fa-plus-square"></i>
                                                &nbsp;Tambah
                                            </a>
                                            <!-- Create modal -->
                                            <div class="modal fade" id="createhariAhad" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <form action="{{route('learning.store')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">
                                                                    Tambah Hari Ahad
                                                                </h4>
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <input type="hidden" name="class_id" value="{{$classId->id}}">
                                                                        <input type="hidden" name="day" value="7">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Guru</label>
                                                                                <select name="user_id" class="form-control">
                                                                                    @foreach ($teachers as $teacher)
                                                                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Nama Pelajaran</label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="name"
                                                                                id="name"
                                                                                value="{{ old('name') }}"
                                                                            >
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="order">Jam Ke</label>
                                                                                <input
                                                                                    type="number"
                                                                                    class="form-control"
                                                                                    name="order"
                                                                                    id="order"
                                                                                    value="{{ old('order') }}"
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <label>Mulai Pelajaran</label>
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                name="hour_from"
                                                                                id="hour_from"
                                                                                value="{{ old('hour_from') }}"
                                                                            >
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="hour_to">Selesai Pelajaran</label>
                                                                                <input
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    name="hour_to"
                                                                                    id="hour_to"
                                                                                    value="{{ old('hour_to') }}"
                                                                                >
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
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Jam Ke</th>
                                                        <th>Nama Pelajaran</th>
                                                        <th>Guru</th>
                                                        <th>Waktu</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($learnings as $data)
                                                        @if ($data->day==7)
                                                            <tr>
                                                                <td>{{$data->order}}</td>
                                                                <td>{{$data->name}}</td>
                                                                <td>{{$data->teachers->name}}</td>
                                                                <td>{{$data->hour_from.' - '.$data->hour_to}}</td>
                                                                <td>
                                                                    <a class="btn btn-warning btn-sm"
                                                                        href="#edithariAhad{{$data->id}}"
                                                                        data-toggle="modal"
                                                                        data-toggle="tooltip"
                                                                    >
                                                                        Ubah
                                                                    </a>
                                                                    <!-- Edit modal -->
                                                                    <div class="modal fade showModal" id="edithariAhad{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <form action="{{route('learning.update', $data->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="modal-content">

                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title" id="myModalLabel">
                                                                                            Ubah Hari Ahad
                                                                                        </h4>
                                                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                                        </button>
                                                                                    </div>

                                                                                    <div class="modal-body">
                                                                                        <div class="card-body">
                                                                                            <div class="row">
                                                                                                <input type="hidden" name="day" value="7">
                                                                                                <input type="hidden" name="class_id" value="{{$classId->id}}">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">
                                                                                                        <label>Guru</label>
                                                                                                        <select name="user_id" class="form-control">
                                                                                                            @foreach ($teachers as $teacher)
                                                                                                                <option value="{{ $teacher->id }}"{{ $teacher->id === $data->teachers->id ? 'selected' : '' }} >{{ $teacher->name }}</option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <label>Nama Pelajaran</label>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        name="name"
                                                                                                        value="{{$data->name}}"
                                                                                                        id="name"
                                                                                                    >
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="order">Jam Ke</label>
                                                                                                        <input
                                                                                                            type="number"
                                                                                                            class="form-control"
                                                                                                            name="order"
                                                                                                            value="{{$data->order}}"
                                                                                                            id="order"
                                                                                                        >
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <label>Mulai Pelajaran</label>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        name="hour_from"
                                                                                                        value="{{$data->hour_from}}"
                                                                                                        id="hour_from"
                                                                                                    >
                                                                                                </div>
                                                                                                <div class="col-md-6 col-sm-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="hour_to">Selesai Pelajaran</label>
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            name="hour_to"
                                                                                                            value="{{$data->hour_to}}"
                                                                                                            id="hour_to"
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
                                                                    <a class="btn btn-danger btn-sm"
                                                                        href="#deletehariAhad{{$data->id}}"
                                                                        data-toggle="modal"
                                                                        data-toggle="tooltip"
                                                                    >
                                                                        Hapus
                                                                    </a>
                                                                    {{-- Modal Delete Data --}}
                                                                    <div id="deletehariAhad{{$data->id}}" class="modal fade">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <form class="d-inline-block" action="{{route('learning.destroy', $data->id)}}" method="POST">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title">Hapus Hari Ahad</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p>Apakah Anda yakin ingin menghapus data <strong>{{$data->name}} ?</strong></p>
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
                                                                </td>
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
