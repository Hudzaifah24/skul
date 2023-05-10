@extends('layouts.app')

@section('title')
    Absen
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
                    <small>
                        Absen
                        <strong>
                            @if (date('m') == 1)
                                {{date('d')}}&nbsp;Januari&nbsp;{{date('Y')}}
                            @elseif (date('m') == 2)
                                {{date('d')}}&nbsp;Februari&nbsp;{{date('Y')}}
                            @elseif (date('m') == 3)
                                {{date('d')}}&nbsp;Maret&nbsp;{{date('Y')}}
                            @elseif (date('m') == 4)
                                {{date('d')}}&nbsp;April&nbsp;{{date('Y')}}
                            @elseif (date('m') == 5)
                                {{date('d')}}&nbsp;Mei&nbsp;{{date('Y')}}
                            @elseif (date('m') == 6)
                                {{date('d')}}&nbsp;Juni&nbsp;{{date('Y')}}
                            @elseif (date('m') == 7)
                                {{date('d')}}&nbsp;Juli&nbsp;{{date('Y')}}
                            @elseif (date('m') == 8)
                                {{date('d')}}&nbsp;Agustus&nbsp;{{date('Y')}}
                            @elseif (date('m') == 9)
                                {{date('d')}}&nbsp;September&nbsp;{{date('Y')}}
                            @elseif (date('m') == 10)
                                {{date('d')}}&nbsp;Oktober&nbsp;{{date('Y')}}
                            @elseif (date('m') == 11)
                                {{date('d')}}&nbsp;November&nbsp;{{date('Y')}}
                            @elseif (date('m') == 12)
                                {{date('d')}}&nbsp;Desember&nbsp;{{date('Y')}}
                            @endif
                            /&nbsp;Kelas&nbsp;{{ $class->name }}
                        </strong>
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
                @if (session()->has('failed-learning'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>Pilih Jadwal Pelajaran</li>
                        </ul>
                    </div>
                @endif
                <div class="x_panel">
                    <div class="x_title">
                        <a
                            class="mb-2 btn btn-dark btn-md"
                            href="{{ route('presence.index') }}"
                        >
                            <i class="fa fa-arrow-circle-left"></i>
                            &nbsp;Kembali
                        </a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                            <div class="tab-pane fade show active" id="murid" role="tabpanel" aria-labelledby="home-tab">
                                <div class="col-md-12 col-sm-12">
                                    <div class="x_panel">
                                        <form action="{{route('presenceDetail.store')}}" method="POST" class="x_content">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <label for="learning">Jadwal Pelajaran</label>
                                                <select class="form-control" name="learning" id="learning">
                                                    <option selected disabled>-- Pilih Jadwal Pelajaran --</option>
                                                    @forelse ($learnings as $learning)
                                                        <option value="{{$learning->id}}">{{$learning->name}}</option>
                                                    @empty
                                                        <option disabled>Tidak ada jadwal dihari ini</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                            <label>Absen</label>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>NIS</th>
                                                        <th>Nama</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($studentClasses as $data)
                                                        <tr>
                                                            <th scope="row">{{$loop->iteration}}</th>
                                                            <td>{{$data->student->nisn}}</td>
                                                            <th>{{$data->student->name}}</th>
                                                            <td class="text-center">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="class" id="class" value="{{$class->id}}">
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input
                                                                            type="radio"
                                                                            class="custom-control-input"
                                                                            name="status[{{ $data->student->id }}]"
                                                                            id="hadir{{$data->id}}"
                                                                            value="hadir"
                                                                            checked
                                                                        >
                                                                        <label for="hadir{{$data->id}}" class="custom-control-label">
                                                                            Hadir
                                                                        </label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input
                                                                            type="radio"
                                                                            class="custom-control-input"
                                                                            name="status[{{ $data->student->id }}]"
                                                                            id="sick{{$data->id}}"
                                                                            value="sick"
                                                                        >
                                                                        <label for="sick{{$data->id}}" class="custom-control-label">
                                                                            Sakit
                                                                        </label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input
                                                                            type="radio"
                                                                            class="custom-control-input"
                                                                            name="status[{{ $data->student->id }}]"
                                                                            id="permission{{$data->id}}"
                                                                            value="permission"
                                                                        >
                                                                        <label for="permission{{$data->id}}" class="custom-control-label">
                                                                            Izin
                                                                        </label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input
                                                                            type="radio"
                                                                            class="custom-control-input"
                                                                            name="status[{{ $data->student->id }}]"
                                                                            id="alpha{{$data->id}}"
                                                                            value="alpha"
                                                                        >
                                                                        <label for="alpha{{$data->id}}" class="custom-control-label">
                                                                            Alfa
                                                                        </label>
                                                                        {{-- <label>Deskripsi</label> --}}
                                                                        <input
                                                                            type="text"
                                                                            class="form-control mx-3"
                                                                            name="reason[{{ $data->student->id }}]"
                                                                            placeholder="keterangan"
                                                                            value="{{ old('reason', '') }}"
                                                                        >
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <button class="btn mb-3 btn-primary btn-sm" type="submit">Kirim</button>
                                        </form>
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
