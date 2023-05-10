@extends('layouts.app')

@section('title')
    Pembayaran SPP
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
                <h3><small>Pembayaran SPP</small></h3>
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
                        <form action="{{route('spppayment.index')}}" method="GET">
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
                                <a class="btn btn-primary" href="{{route('spppayment.index')}}">All</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
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
                                                <th>Biaya SPP</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($spps as $index => $data)
                                                <tr>
                                                    <th>{{$loop->iteration}}</th>
                                                    <td>{{$data->class->name}}</td>
                                                    <td>{{number_format($data->amount)}}</td>
                                                    <td>
                                                        <a class="btn btn-success btn-sm" href="{{ route('spppayment.show', $data->id) }}">Detail</a>
                                                        <a href="#pay{{$data->id}}" class="btn btn-sm btn-primary" data-toggle="modal">
                                                            Bayar
                                                        </a>
                                                    </td>
                                                    <!-- Bayar modal -->
                                                    <div class="modal fade showModal" id="pay{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <form action="{{route('spppayment.update', $data->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myModalLabel">
                                                                            Bayar SPP Manual
                                                                        </h4>
                                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label for="besaran">Besaran bayar</label>
                                                                                        <input id="besaran" type="number" class="form-control" name="amount" placeholder="Max: {{$data->amount}}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label for="student">Murid</label>
                                                                                        <select class="form-control" name="student_id" id="student">
                                                                                            <option selected disabled>-- Pilih Murid --</option>
                                                                                            @foreach ($students as $key => $student)
                                                                                                @if ($student->class_id == $data->class_id)
                                                                                                    <option value="{{$student->student->id}}">{{$student->student->nisn.' - '.$student->student->name}}</option>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label for="proof">Bukti</label>
                                                                                        <input id="proof" type="file" class="form-control" name="proof">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Bayar</button>
                                                                    </div>

                                                                </div>
                                                            </form>
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
        if ({{session()->has('notification-success-lunas')}}) {
            Swal.fire({
                icon: 'warning',
                title: 'PERINGATAN',
                text: 'Murid ini sudah membayar lunas!'
            })
        }
    </script>
@endpush
