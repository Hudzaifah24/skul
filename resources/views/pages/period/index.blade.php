@extends('layouts.app')

@section('title')
    Priode
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
                <h3><small>Priode</small></h3>
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
                                <form action="{{route('period.store')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                    @csrf
                                    @method('POST')
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">
                                                Tambah Periode
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Awal Tahun Ajaran</label>
                                                            <input
                                                                type="number"
                                                                class="form-control"
                                                                name="year_start"
                                                                value="{{ old('year_start') }}"
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Akhir Tahun Ajaran</label>
                                                            <input
                                                                type="number"
                                                                class="form-control"
                                                                name="year_end"
                                                                value="{{ old('year_end') }}"
                                                            >
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
                                                                    id="Active"
                                                                    value="Active"
                                                                >
                                                                <label for="Active" class="custom-control-label">
                                                                    Aktif
                                                                </label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input
                                                                    type="radio"
                                                                    class="custom-control-input"
                                                                    name="status"
                                                                    id="Not active"
                                                                    value="Not active"
                                                                >
                                                                <label for="Not active" class="custom-control-label">
                                                                    Tidak Aktif
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
                                            <th>Periode</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($periods as $data)
                                                <!-- Edit modal -->
                                                <div class="modal fade showModal" id="editData{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <form action="{{route('period.update', $data->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel">
                                                                        Ubah Periode
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Awal Tahun Ajaran</label>
                                                                                    <input
                                                                                        type="number"
                                                                                        class="form-control"
                                                                                        name="year_start"
                                                                                        value="{{$data->year_start}}"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Akhir Tahun Ajaran</label>
                                                                                    <input
                                                                                        type="number"
                                                                                        class="form-control"
                                                                                        name="year_end"
                                                                                        value="{{$data->year_end}}"
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Status</label>
                                                                                    <select name="status" class="form-control" id="status">
                                                                                        <option {{$data->status=='Active'?'selected':''}} value="Active">Aktif</option>
                                                                                        <option {{$data->status=='Not active'?'selected':''}} value="Not active">Tidak Aktif</option>
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
                                                {{-- Modal Delete Data --}}
                                                <div id="deleteData{{$data->id}}" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form class="d-inline-block" action="{{route('period.destroy', $data->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus Periode</h4>
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
                                                {{-- Active --}}
                                                <div id="active{{$data->id}}" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form class="d-inline-block" action="{{route('period.is.active', $data->id)}}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" value="active" name="status">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Aktifkan Priode</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah Anda yakin ingin Mengaktifkan Priod <strong>?</strong></p>
                                                                    <p class="text-warning"><small>Tindakan ini tidak bisa dibatalkan.</small></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="button" class="btn btn-primary" data-dismiss="modal" value="Batal">
                                                                    <button type="submit" class="btn btn-success btn-small">Aktifkan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Non Active --}}
                                                <div id="notactive{{$data->id}}" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form class="d-inline-block" action="{{route('period.is.active', $data->id)}}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" value="notactive" name="status">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Non Aktifkan Priode</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah Anda yakin ingin menonaktifkan Priod <strong>?</strong></p>
                                                                    <p class="text-warning"><small>Tindakan ini tidak bisa dibatalkan.</small></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="button" class="btn btn-primary" data-dismiss="modal" value="Batal">
                                                                    <button type="submit" class="btn btn-danger btn-small">Non aktifkan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$data->year_start}}/{{$data->year_end}}</td>
                                                    <td>
                                                        @if ($data->status=="Active")
                                                            <span class="badge badge-success">
                                                                Aktif
                                                            </span>
                                                        @else
                                                            <span class="badge badge-danger">
                                                                Tidak Aktif
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-success btn-sm"
                                                            href="#active{{$data->id}}"
                                                            data-toggle="modal"
                                                        >
                                                            <i class="fa fa-check"></i>
                                                        </a>
                                                        <a class="btn btn-danger btn-sm"
                                                            href="#notactive{{$data->id}}"
                                                            data-toggle="modal"
                                                        >
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                        <a class="btn btn-warning btn-sm"
                                                            href="#editData{{$data->id}}"
                                                            data-toggle="modal"
                                                        >
                                                            Ubah
                                                        </a>
                                                        <a class="btn btn-danger btn-sm"
                                                            href="#deleteData{{$data->id}}"
                                                            data-toggle="modal"
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
    {{-- alert success active --}}
    <script>
        if ({{session()->has('notification-success-active')}}) {
            Swal.fire({
                icon: 'success',
                title: 'SUCCESS',
                text: 'Priode berhasil di aktifkan!'
            })
        }
    </script>
    {{-- alert success not active --}}
    <script>
        if ({{session()->has('notification-success-notactive')}}) {
            Swal.fire({
                icon: 'success',
                title: 'SUCCESS',
                text: 'Priode berhasil tidak di aktifkan!'
            })
        }
    </script>
@endpush
