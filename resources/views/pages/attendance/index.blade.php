@extends('layouts.app')

@section('title')
    Kehadiran
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
                <h3><small>Kehadiran <b>Kelas&nbsp;{{$clas->name}}</b></small></h3>
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
                            <form action="{{route('attendance.index')}}" method="GET" class="col-md-12">
                                <div class="form-group">
                                    <label>Pilih Kelas</label>
                                    <select name="class" onchange="this.form.submit()" class="form-control" style="width: 100%;">
                                        <option disabled="disabled">-- Pilih Kelas --</option>
                                        @foreach ($classes as $class)
                                            <option {{$clas->id == $class->id ? 'selected' : ''}} value="{{$class->id}}">Kelas&nbsp;{{$class->name}}</option>
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
                                                <th scope="row">#</th>
                                                <th>NISN</th>
                                                <th>Nama</th>
                                                <th>Ijin</th>
                                                <th>Sakit</th>
                                                <th>Alfa</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($students as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->student->nisn }}</td>
                                                <td>{{ $data->student->name }}</td>
                                                <td>{{ $data->student->presence->permission_count == null ? 0 : $data->student->presence->permission_count }}</td>
                                                <td>{{ $data->student->presence->sick_count == null ? 0 : $data->student->presence->sick_count }}</td>
                                                <td>{{ $data->student->presence->alpha_count == null ? 0 : $data->student->presence->alpha_count }}</td>
                                                <td>
                                                    <a href="{{route('attendance.show', $data->id)}}" class="btn btn-success btn-sm">Detail</a>
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
