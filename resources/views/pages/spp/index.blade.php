@extends('layouts.app')

@section('title')
    SPP
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
                <h3><small>SPP</small></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
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
                    <div class="x_content">
                        <form action="{{route('spp.index')}}" method="GET">
                            <div class="form-group row">
                                {{-- <label class="col-12 col-sm-1 col-form-label text-sm-right"><b>FILTER :</b></label> --}}
                                <label class="col-12 col-sm-1 col-form-label text-sm-right">BULAN</label>
                                <div class="col-sm-4 col-lg-3">
                                    <select name="month" class="form-control" onchange='this.form.submit()'>
                                        <option {{$month==1?'selected':''}} value="1">Januari</option>
                                        <option {{$month==2?'selected':''}} value="2">Februari</option>
                                        <option {{$month==3?'selected':''}} value="3">Maret</option>
                                        <option {{$month==4?'selected':''}} value="4">April</option>
                                        <option {{$month==5?'selected':''}} value="5">Mei</option>
                                        <option {{$month==6?'selected':''}} value="6">Juni</option>
                                        <option {{$month==7?'selected':''}} value="7">Juli</option>
                                        <option {{$month==8?'selected':''}} value="8">Agustus</option>
                                        <option {{$month==9?'selected':''}} value="9">Sepetember</option>
                                        <option {{$month==10?'selected':''}} value="10">Oktober</option>
                                        <option {{$month==11?'selected':''}} value="11">November</option>
                                        <option {{$month==12?'selected':''}} value="12">Desember</option>
                                    </select>
                                </div>
                                <a class="btn btn-primary" href="{{route('spp.index')}}">All</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <!-- Create modal -->
                    <div class="modal fade" id="createData" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form action="{{route('spp.store')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                @csrf
                                @method('POST')
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Tambah SPP
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nama Kelas</label>
                                                        <select name="class_id" class="form-control selectpicker" data-live-search="true" style="width: 100%;">
                                                            <option selected="selected" disabled="disabled">-- Pilih Data --</option>
                                                            @foreach ($classes as $class)
                                                                <option value="{{$class->id}}">Kelas&nbsp;{{$class->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Besaran</label>
                                                        <input
                                                            type="number"
                                                            class="form-control"
                                                            name="amount"
                                                            placeholder="Rp.250.000.00"
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tanggal</label>
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Periode</label>
                                                        <select name="period" class="form-control" style="width: 100%;">
                                                            <option selected="selected" disabled="disabled">-- Pilih Data --</option>
                                                            @foreach ($periods as $period)
                                                                <option value="{{$period->year_start}}/{{$period->year_end}}">{{$period->year_start}}/{{$period->year_end}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Bulan</label>
                                                        <select name="month" class="form-control" style="width: 100%;">
                                                            <option value="1">Januari</option>
                                                            <option value="2">Februari</option>
                                                            <option value="3">Maret</option>
                                                            <option value="4">April</option>
                                                            <option value="5">Mei</option>
                                                            <option value="6">Juni</option>
                                                            <option value="7">Juli</option>
                                                            <option value="8">Agustus</option>
                                                            <option value="9">Sepetember</option>
                                                            <option value="10">Oktober</option>
                                                            <option value="11">November</option>
                                                            <option value="12">Desember</option>
                                                        </select>
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
                            class="mb-2 btn btn-primary btn-md"
                            href="#createData"
                            data-toggle="modal"
                            data-toggle="tooltip"
                        >
                            <i class="fa fa-plus-square"></i>
                            &nbsp;Tambah
                        </a>
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
                                            <th>Kelas</th>
                                            <th>Besaran</th>
                                            <th>Dibuat Oleh</th>
                                            <th>Tenggat Waktu</th>
                                            <th>Priode</th>
                                            <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($spps as $data)
                                                {{-- Modal Delete Data --}}
                                                <div id="deleteData{{$data->id}}" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form class="d-inline-block" action="{{route('spp.destroy', $data->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus SPP</h4>
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
                                                    <td>
                                                        {{$loop->iteration}}
                                                        <!-- Edit modal -->
                                                        <div class="modal fade showModal" id="editData{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <form action="{{route('spp.update', $data->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-content">

                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel">
                                                                                Ubah SPP
                                                                            </h4>
                                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label style="display: block">Nama Kelas</label>
                                                                                            <select name="class_id" class="form-control selectpicker" data-live-search="true" style="width: 100%;">
                                                                                                <option selected="selected" disabled="disabled">-- Pilih Data --</option>
                                                                                                @foreach ($classes as $class)
                                                                                                    <option {{$class->id==$data->class_id?'selected':''}} value="{{$class->id}}">{{$class->name}}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Besaran</label>
                                                                                            <input
                                                                                                type="number"
                                                                                                class="form-control"
                                                                                                name="amount"
                                                                                                placeholder="Rp.250.000.00"
                                                                                                value="{{$data->amount}}"
                                                                                            >
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 col-sm-6">
                                                                                        <div class="form-group">
                                                                                            <label>Tanggal</label>
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
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Periode</label>
                                                                                            <select name="period" class="form-control" style="width: 100%;">
                                                                                                <option disabled="disabled">-- Pilih Data --</option>
                                                                                                @foreach ($periods as $period)
                                                                                                    @php
                                                                                                        $default = $period->year_start.'/'.$period->year_end;
                                                                                                    @endphp
                                                                                                    <option {{$default==$data->period ? 'selected' : ''}} value="{{$period->year_start}}/{{$period->year_end}}">{{$period->year_start}}/{{$period->year_end}}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>Bulan</label>
                                                                                            <select name="month" class="form-control" style="width: 100%;">
                                                                                                <option {{$data->month=='1'?'selected':''}} value="1">Januari</option>
                                                                                                <option {{$data->month=='2'?'selected':''}} value="2">Februari</option>
                                                                                                <option {{$data->month=='3'?'selected':''}} value="3">Maret</option>
                                                                                                <option {{$data->month=='4'?'selected':''}} value="4">April</option>
                                                                                                <option {{$data->month=='5'?'selected':''}} value="5">Mei</option>
                                                                                                <option {{$data->month=='6'?'selected':''}} value="6">Juni</option>
                                                                                                <option {{$data->month=='7'?'selected':''}} value="7">Juli</option>
                                                                                                <option {{$data->month=='8'?'selected':''}} value="8">Agustus</option>
                                                                                                <option {{$data->month=='9'?'selected':''}} value="9">Sepetember</option>
                                                                                                <option {{$data->month=='10'?'selected':''}} value="10">Oktober</option>
                                                                                                <option {{$data->month=='11'?'selected':''}} value="11">November</option>
                                                                                                <option {{$data->month=='12'?'selected':''}} value="12">Desember</option>
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
                                                    </td>
                                                    <td>Kelas&nbsp;{{$data->class->name}}</td>
                                                    <td>Rp {{ number_format($data->amount) }}</td>
                                                    <td>{{$data->user->name}}</td>
                                                    <td>{{$data->deadline}}</td>
                                                    <td>{{$data->period}}</td>
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
