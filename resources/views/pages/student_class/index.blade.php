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
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kelas</th>
                                                <th>Jumlah Siswa</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($classes as $class)
                                                <tr>
                                                    <td>
                                                        {{$loop->iteration}}
                                                        <!-- Pilih Siswa modal -->
                                                        <div class="modal fade showModal" id="pilihSiswa{{$class->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <form action="{{route('studentClass.store')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                                    @csrf
                                                                    @method('POST')
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
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <input type="hidden" name="class_id" id="class_id" value="{{$class->id}}">
                                                                                            <label>Period</label>
                                                                                            <select name="period_id" class="form-control" style="width: 100%;" required>
                                                                                                <option selected="selected" disabled="disabled">-- Pilih Data --</option>
                                                                                                @foreach ($periods as $period)
                                                                                                    <option value="{{$period->id}}">{{$period->year_start}}/{{$period->year_end}}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label class="d-block">Nama Siswa</label>
                                                                                            <select class="form-control selectpicker" name="student_id[]" multiple="multiple" style="width: 100%;">
                                                                                                @foreach ($students as $student)
                                                                                                    <option value="{{$student->id}}">{{$student->nis}} - {{$student->name}}</option>
                                                                                                @endforeach
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
                                                    </td>
                                                    <td>Kelas&nbsp;{{$class->name}}</td>
                                                    <td>{{!$class->studentClass->count()==NULL ? $class->studentClass->count() : 'NOL'}}&nbsp;Murid</td>
                                                    <td>
                                                        <a class="btn btn-success btn-sm"
                                                            href="{{ route('studentClass.show', $class->id) }}"
                                                        >
                                                            Detail
                                                        </a>
                                                        <a
                                                            class="btn btn-primary btn-sm"
                                                            href="#pilihSiswa{{$class->id}}"
                                                            data-toggle="modal"
                                                        >
                                                            Pilih Siswa
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
