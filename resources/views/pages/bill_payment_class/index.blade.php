@extends('layouts.app')

@section('title')
    Pembayaran Tagihan
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
                <h3><small>Pembayaran Tagihan Kelas</small></h3>
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
                    <div class="x_title">
                        <form action="" method="GET" class="col-md-2">
                            <div class="form-group">
                                <label>Pilih Kelas</label>
                                <select name="class" onchange="this.form.submit()" class="form-control" style="width: 100%;">
                                    <option selected disabled="disabled">-- Pilih Kelas --</option>
                                    @foreach ($classes as $class)
                                        <option {{$filter == $class->id ? 'selected' : ''}} value="{{$class->id}}">Kelas&nbsp;{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
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
                                                <th>Nama Tagihan</th>
                                                <th>Biaya Tagihan</th>
                                                <th>Untuk</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($billClasses as $data)
                                                <tr>
                                                    <th>{{$loop->iteration}}</th>
                                                    <td>{{$data->bill->name}}</td>
                                                    <td>{{'Rp '.number_format($data->bill->sum)}}</td>
                                                    <td>{{'Kelas '.$data->class->name}}</td>
                                                    <td>
                                                        <a class="btn btn-success btn-sm" href="{{ route('billPaymentClass.show', $data->bill->id) }}">Detail</a>
                                                        <a href="#pay{{$data->id}}" class="btn btn-sm btn-primary" data-toggle="modal">
                                                            Bayar
                                                        </a>
                                                    </td>
                                                    <!-- Bayar modal -->
                                                    <div class="modal fade showModal" id="pay{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <form action="{{route('billPaymentClass.update', $data->id)}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
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
                                                                                        <input id="besaran" type="number" class="form-control" name="amount" placeholder="Max: {{$data->bill->sum}}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label for="student">Murid</label>
                                                                                        <select class="form-control" name="student_id" id="student">
                                                                                            <option selected disabled>-- Pilih Santri --</option>
                                                                                            @php
                                                                                                $class = App\Models\StudentClass::where('class_id', $data->class_id)->get();
                                                                                            @endphp
                                                                                            @foreach ($class as $student)
                                                                                                <option value="{{$student->student_id}}">{{$student->student->nisn.' - '.$student->student->name}}</option>
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
