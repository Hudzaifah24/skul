@extends('layouts.app')

@section('title')
    Kelas
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
                <h3><small>Kelas</small></h3>
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
                                <form action="{{ route('class.store') }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                    @csrf
                                    @method('POST')
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">
                                                Tambah Kelas
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Nama Kelas</label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="name"
                                                                placeholder="contoh: 1A, 1B, 1C"
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
                        @foreach ($classes as $data)
                            <!-- Show modal -->
                            <div class="modal fade showModal" id="showData{{ $data->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h3><small><strong>Kelas {{ $data->name }}</strong></small></h3>
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card-box table-responsive">
                                                            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                                <thead>
                                                                    <th>#</th>
                                                                    <th>NISN</th>
                                                                    <th>Nama</th>
                                                                    <th>Jenis Kelamin</th>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($classDetail as $student)
                                                                        @if ($student->class_id==$data->id)
                                                                            <tr>
                                                                                <td>{{$loop->iteration}}</td>
                                                                                <td>{{$student->student->nisn}}</td>
                                                                                <td>{{$student->student->name}}</td>
                                                                                <td>{{$student->student->gender}}</td>
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
                        @endforeach

                        <ul class="nav navbar-right panel_toolbox">
                            <form action="{{route('class.index')}}" method="GET" class="col-md-12">
                                <div class="form-group">
                                    <label>Periode</label>
                                    <select name="period" onchange="this.form.submit()" class="form-control" style="width: 100%;">
                                        <option selected="selected" disabled="disabled">-- Pilih Data --</option>
                                        @foreach ($periods as $period)
                                            <option {{$period->id==$filter?'selected':''}} value="{{$period->id}}">{{$period->year_start}}/{{$period->year_end}}</option>
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
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($classes as $data)
                                                <!-- Edit modal -->
                                                <div class="modal fade showModal" id="editData{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <form action="{{route('class.update', $data->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel">
                                                                        Ubah Kelas
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Nama Kelas</label>
                                                                                    <input
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        name="name"
                                                                                        placeholder="contoh: 1A, 1B, 1C"
                                                                                        value="{{ $data->name }}"
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
                                                {{-- Modal Delete Data --}}
                                                <div id="deleteData{{$data->id}}" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form class="d-inline-block" action="{{route('class.destroy', $data->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus Kelas</h4>
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
                                                    <td>Kelas&nbsp;{{$data->name}}</td>
                                                    <td>
                                                        <a class="btn btn-success btn-sm"
                                                            href="#showData{{ $data->id }}"
                                                            data-toggle="modal"
                                                            data-toggle="tooltip"
                                                        >
                                                            Detail
                                                        </a>
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
