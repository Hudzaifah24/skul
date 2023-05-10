@extends('layouts.app')

@section('title')
    Tagihan
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
                <h3><small>Tagihan</small></h3>
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
                    <!-- Create modal -->
                    <div class="modal fade" id="createData" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form action="{{route('bill.store')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                @csrf
                                @method('POST')
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Tambah Tagihan
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Untuk</label>
                                                        <select name="class_id" class="form-control selectpicker" data-live-search="true" style="width: 100%;">
                                                            <option selected="selected" disabled="disabled">-- Pilih Data --</option>
                                                            <option value="all">Semua Kelas</option>
                                                            @foreach ($classes as $class)
                                                                <option value="{{$class->id}}">Kelas&nbsp;{{$class->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Periode</label>
                                                        <select name="period_id" class="form-control" style="width: 100%;">
                                                            <option selected="selected" disabled="disabled">-- Pilih Data --</option>
                                                            @foreach ($periods as $period)
                                                                <option value="{{$period->id}}">{{$period->year_start.'/'.$period->year_end}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nama Tagihan</label>
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
                                                        <label>Besaran</label>
                                                        <input
                                                            type="number"
                                                            class="form-control"
                                                            name="sum"
                                                            value="{{ old('sum') }}"
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 ">
                                                    <div class="form-group">
                                                        <label>Tenggat Waktu</label>
                                                        <input
                                                            id="deadline"
                                                            class="date-picker form-control"
                                                            placeholder="dd-mm-yyyy"
                                                            type="text"
                                                            onfocus="this.type='date'"
                                                            onmouseover="this.type='date'"
                                                            onclick="this.type='date'"
                                                            onblur="this.type='text'"
                                                            onmouseout="timeFunctionLong(this)"
                                                            name="deadline"
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
                            class="mt-4 btn btn-primary btn-md"
                            href="#createData"
                            data-toggle="modal"
                            data-toggle="tooltip"
                        >
                            <i class="fa fa-plus-square"></i>
                            &nbsp;Tambah
                        </a>
                        <ul class="nav navbar-right panel_toolbox">
                            <form action="{{route('bill.index')}}" method="GET" class="form-group col">
                                <label class="d-inline">Kelas</label>
                                <div class="d-flex align-items-center">
                                    <select name="class" class="form-control d-inline" onchange="this.form.submit()">
                                        <option disabled selected>Pilih Kelas</option>
                                        <option {{$filter == 'all' ? 'selected' : ''}} value="all">Semua Kelas</option>
                                        @foreach ($classes as $class)
                                            @if ($filter != NULL && $filter != 'all')
                                                <option {{$filter->id == $class->id ? 'selected' : ''}} value="{{$class->id}}">{{$class->name}}</option>
                                            @else
                                                <option value="{{$class->id}}">{{$class->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <a class="m-2 btn btn-primary" href="{{route('bill.index')}}">All</a>
                                </div>
                            </form>
                        </ul>
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
                                            <th>Besaran</th>
                                            <th>Untuk</th>
                                            <th>Tenggat Waktu</th>
                                            <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bills as $data)
                                                <!-- Edit modal -->
                                                <div class="modal fade showModal" id="editData{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <form action="{{route('bill.update', $data->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel">
                                                                        Ubah Tagihan
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Untuk</label>
                                                                                    <select name="class_id" class="form-control
                                                                                    {{-- selectpicker --}}
                                                                                    " data-live-search="true" style="width: 100%;">
                                                                                        <option selected="selected" disabled="disabled">-- Pilih Data --</option>
                                                                                        <option {{$data->billClass == NULL ? 'selected' : ''}} value="all">Semua Kelas</option>
                                                                                        @foreach ($classes as $class)
                                                                                            @if ($data->billClass != NULL)
                                                                                                <option {{$data->billClass->class_id == $class->id ? 'selected' : ''}} value="{{$class->id}}">Kelas&nbsp;{{$class->name}}</option>
                                                                                            @else
                                                                                                <option value="{{$class->id}}">Kelas&nbsp;{{$class->name}}</option>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Periode</label>
                                                                                    <select name="period_id" class="form-control" style="width: 100%;">
                                                                                        <option selected="selected" disabled="disabled">-- Pilih Data --</option>
                                                                                        @foreach ($periods as $period)
                                                                                            @if ($data->billClass != NULL)
                                                                                                <option {{$data->billClass->period_id == $period->id ? 'selected' : ''}} value="{{$period->id}}">{{$period->year_start.'/'.$period->year_end}}</option>
                                                                                            @else
                                                                                                <option value="{{$period->id}}">{{$period->year_start.'/'.$period->year_end}}</option>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nama Tagihan</label>
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
                                                                                    <label>Besaran</label>
                                                                                    <input
                                                                                        type="number"
                                                                                        class="form-control"
                                                                                        name="sum"
                                                                                        value="{{ $data->sum }}"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-sm-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Tenggat Waktu</label>
                                                                                    <input
                                                                                        id="deadline"
                                                                                        class="date-picker form-control"
                                                                                        placeholder="dd-mm-yyyy"
                                                                                        type="text"
                                                                                        onfocus="this.type='date'"
                                                                                        onmouseover="this.type='date'"
                                                                                        onclick="this.type='date'"
                                                                                        onblur="this.type='text'"
                                                                                        onmouseout="timeFunctionLong(this)"
                                                                                        name="deadline"
                                                                                        value="{{$data->deadline}}"
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
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
                                                            <form class="d-inline-block" action="{{route('bill.destroy', $data->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus Tagihan</h4>
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
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$data->name}}</td>
                                                    <td>Rp {{number_format($data->sum)}}</td>
                                                    <td>{{$data->billClass != NULL ? 'Kelas '.$data->billClass->class->name : 'Semua Kelas'}}</td>
                                                    <td>{{$data->deadline}}</td>
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
@endpush
