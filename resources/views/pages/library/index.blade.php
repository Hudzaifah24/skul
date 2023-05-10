@extends('layouts.app')

@section('title')
    Perpustakaan
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
                <h3><small>Perpustakaan</small></h3>
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
                                <form action="{{route('loan.store')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                    @csrf
                                    @method('POST')
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">
                                                Tambah Peminjam
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nama Siswa</label>
                                                            <select name="student_id" class="form-control selectpicker" data-live-search="true" style="width: 100%;">
                                                                <option selected="selected" disabled="disabled">-- Pilih Data --</option>
                                                                @foreach ($students as $student)
                                                                    <option value="{{$student->id}}">{{$student->nis}} - {{$student->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Judul Buku</label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="book"
                                                                value="{{ old('book') }}"
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Penulis</label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="author"
                                                                value="{{ old('author') }}"
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Penerbit</label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="publiser"
                                                                value="{{ old('publiser') }}"
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <label>Tanggal Pinjam</label>
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
                                                            name="loan_date"
                                                        >
                                                        <script>
                                                            function timeFunctionLong(input) {
                                                                setTimeout(function() {
                                                                    input.type = 'text';
                                                                }, 60000);
                                                            }
                                                        </script>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <div class="form-group">
                                                            <label>Tanggal Kembali</label>
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
                                                                name="return_date"
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
                                                    <input type="hidden" name="status" value="not yet">
                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <br>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input
                                                                    type="radio"
                                                                    class="custom-control-input"
                                                                    name="status"
                                                                    id="sudah_kembali"
                                                                    value="already"
                                                                >
                                                                <label for="sudah_kembali" class="custom-control-label">
                                                                    Sudah Kembali
                                                                </label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input
                                                                    type="radio"
                                                                    class="custom-control-input"
                                                                    name="status"
                                                                    id="belum_kembali"
                                                                    value="not yet"
                                                                >
                                                                <label for="belum_kembali" class="custom-control-label">
                                                                    Belum Kembali
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div> --}}
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
                        @foreach ($loans as $data)
                            <!-- Show modal -->
                            <div class="modal fade showModal" id="showData{{ $data->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">
                                                Detail Peminjam
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Nama</th>
                                                            <td>{{ $data->student->name }}</td>
                                                        </tr>
                                                        @foreach ($data->student->clas as $class)
                                                        <tr>
                                                            <th>Kelas</th>
                                                            <td>Kelas&nbsp;{{ $class->name }}</td>
                                                        </tr>
                                                        @endforeach
                                                       
                                                        <tr>
                                                            <th>Judul Buku</th>
                                                            <td>{{ $data->book }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Penulis</th>
                                                            <td>{{ $data->author }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Penerbit</th>
                                                            <td>{{ $data->publiser }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tanggal Pinjam</th>
                                                            <td>{{ $data->loan_date }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tanggal Kembali</th>
                                                            <td>{{ $data->return_date }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status</th>
                                                            <td>
                                                                @if ($data->status=='already')
                                                                    <span class="badge badge-success">
                                                                        Sudah kembali
                                                                    </span>
                                                                @else
                                                                    <span class="badge badge-danger">
                                                                        Belum kembali
                                                                    </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                                                <th>Judul Buku</th>
                                                <th>Status</th>
                                                <th>Kelas</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($loans as $data)
                                                <!-- Edit modal -->
                                                <div class="modal fade showModal" id="editData{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <form action="{{route('loan.update', $data->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel">
                                                                        Ubah Peminjam
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nama Siswa</label>
                                                                                    <select name="student_id" class="form-control selectpicker d-block" data-live-search="true" style="width: 100%;">
                                                                                        @foreach ($students as $student)
                                                                                            <option {{$data->student_id==$student->id?'selected':''}} value="{{$student->id}}">{{$student->nis}} - {{$student->name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Judul Buku</label>
                                                                                    <input
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        name="book"
                                                                                        value="{{$data->book}}"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Penulis</label>
                                                                                    <input
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        name="author"
                                                                                        value="{{$data->author}}"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Penerbit</label>
                                                                                    <input
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        name="publiser"
                                                                                        value="{{$data->publiser}}"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-sm-6 ">
                                                                                <label>Tanggal Pinjam</label>
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
                                                                                    value="{{$data->loan_date}}"
                                                                                    name="loan_date"
                                                                                >
                                                                                <script>
                                                                                    function timeFunctionLong(input) {
                                                                                        setTimeout(function() {
                                                                                            input.type = 'text';
                                                                                        }, 60000);
                                                                                    }
                                                                                </script>
                                                                            </div>
                                                                            <div class="col-md-6 col-sm-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Tanggal Kembali</label>
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
                                                                                        value="{{$data->return_date}}"
                                                                                        name="return_date"
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
                                                                                    <label>Status</label>
                                                                                    <br>
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <input
                                                                                            type="radio"
                                                                                            class="custom-control-input"
                                                                                            name="status"
                                                                                            id="already{{ $data->id }}"
                                                                                            value="already"
                                                                                            {{$data->status=='already'?'checked':''}}
                                                                                        >
                                                                                        <label for="already{{ $data->id }}" class="custom-control-label">
                                                                                            Sudah Kembali
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                                        <input
                                                                                            type="radio"
                                                                                            class="custom-control-input"
                                                                                            name="status"
                                                                                            id="not yet{{ $data->id }}"
                                                                                            value="not yet"
                                                                                            {{$data->status=='not yet'?'checked':''}}
                                                                                        >
                                                                                        <label for="not yet{{ $data->id }}" class="custom-control-label">
                                                                                            Belum Kembali
                                                                                        </label>
                                                                                    </div>
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
                                                            <form class="d-inline-block" action="{{route('loan.destroy', $data->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus Peminjam</h4>
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
                                                    <td>{{$data->student->name}}</td>
                                                    <td>{{$data->book}}</td>
                                                    <td>
                                                        @if ($data->status=='already')
                                                            <span class="badge badge-success">
                                                                Sudah kembali
                                                            </span>
                                                        @else
                                                            <span class="badge badge-danger">
                                                                Belum kembali
                                                            </span>
                                                        @endif
                                                    </td>
                                                    @foreach ($data->student->clas as $class)
                                                    <td>Kelas&nbsp;{{$class->name}}</td>
                                                    @endforeach
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
