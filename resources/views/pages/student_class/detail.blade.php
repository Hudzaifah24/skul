@extends('layouts.app')

@section('title')
    Detail Kelas
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
                <h3><small>Detail Kelas, <strong>Kelas {{ $class->name }}</small></h3>
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
                        <ul class="nav navbar-right panel_toolbox">
                            <form action="{{route('studentClass.show', $id)}}" method="GET" class="col-md-12">
                                <div class="form-group">
                                    <label>Periode</label>
                                    <select name="period" onchange="this.form.submit()" class="form-control" style="width: 100%;">
                                        <option selected="selected" disabled="disabled">-- Pilih Priode --</option>
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
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Umur</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studentClasses as $data)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$data->student->nisn}}</td>
                                                    <td>{{$data->student->name}}</td>
                                                    <td>{{$data->student->age .' Tahun'}}</td>
                                                    <td>
                                                        <a class="btn btn-danger btn-sm"
                                                            href="#deleteData{{$data->id}}"
                                                            data-toggle="modal"
                                                        >
                                                            Hapus
                                                        </a>
                                                    </td>
                                                    {{-- Modal Delete Data --}}
                                                    <div id="deleteData{{$data->id}}" class="modal fade">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form class="d-inline-block" action="{{route('studentClass.destroy', $data->id)}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Hapus Siswa</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Apakah Anda yakin ingin menghapus data <strong>{{$data->student->name}} ?</strong></p>
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
