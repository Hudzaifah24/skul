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
                <h3><small>Pembayaran Tagihan <b>{{$bill->name}}</b>&nbsp;<br>Rp <b>{{number_format($bill->sum)}}</b></small></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <a
                            class="mb-2 btn btn-dark btn-md"
                            href="{{ route('billPaymentGeneral.index') }}"
                        >
                            <i class="fa fa-arrow-circle-left"></i>
                            &nbsp;Kembali
                        </a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#sudahBayar" role="tab" aria-controls="home" aria-selected="true">Lunas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="home-tab" data-toggle="tab" href="#cicil" role="tab" aria-controls="home" aria-selected="false">Cicil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#murid" role="tab" aria-controls="profile" aria-selected="false">Murid</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            {{-- Lunas --}}
                            <div class="tab-pane fade active show" id="sudahBayar" role="tabpanel" aria-labelledby="home-tab">
                                <div class="col-md-12 col-sm-12 ">
                                    <div class="x_panel">
                                        <div class="x_content">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>NIS</th>
                                                        <th>Nama</th>
                                                        <th>Umur</th>
                                                        <th>Total Pembayaran</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($lunas as $index => $data)
                                                        @php
                                                            foreach ($data->student->billPayment as $key => $amount[$data->student_id]) {
                                                                $result[$index][] = $amount[$data->student_id]->amount;
                                                            }
                                                        @endphp
                                                        <tr>
                                                            <th scope="row">
                                                                {{$loop->iteration}}
                                                                <!-- Show modal -->
                                                                <div class="modal fade showModal" id="showData{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">

                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myModalLabel">
                                                                                    Detail Pembayaran Tagihan
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
                                                                                                <td>{{$data->student->name}}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>Bank</th>
                                                                                                <td>{{$data->bank != NULL ? $data->bank->name_bank : '-'}}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>Pemilik Rekening</th>
                                                                                                <td>{{$data->bank != NULL ? $data->bank->nasabah : '-'}}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>Nomor Rekening</th>
                                                                                                <td>{{$data->bank != NULL ? $data->bank->account_number : '-'}}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>Total Bayar</th>
                                                                                                <td>{{'Rp '.number_format(array_sum($result[$index]))}}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>Bukti</th>
                                                                                                <td><a href="{{asset('bukti/tagihan/'. $data->proof)}}" target="blank"><i class="fa fa-eye"></i>&nbsp;Lihat</a></td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <td>{{$data->student->nisn}}</td>
                                                            <td>{{$data->student->name}}</td>
                                                            <td>{{$data->student->age}}</td>
                                                            <td>{{'Rp '.number_format(array_sum($result[$index]))}}</td>
                                                            <td>
                                                                <a class="btn btn-success btn-sm"
                                                                    href="#showData{{$data->id}}"
                                                                    data-toggle="modal"
                                                                    data-toggle="tooltip"
                                                                >
                                                                    Detail
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

                            {{-- Cicil --}}
                            <div class="tab-pane fade" id="cicil" role="tabpanel" aria-labelledby="home-tab">
                                <div class="col-md-12 col-sm-12 ">
                                    <div class="x_panel">
                                        <div class="x_content">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>NIS</th>
                                                        <th>Nama</th>
                                                        <th>Umur</th>
                                                        <th>Total Pembayaran</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no2 = 1;
                                                    @endphp
                                                    @foreach ($cicil as $data)
                                                        @php
                                                            $student = App\Models\BillPayment::where('student_id', $data->student_id)->orderBy('id', 'desc')->first();
                                                        @endphp
                                                        @if ($student != NULL && $student->status != 'lunas')
                                                            <tr>
                                                                <th scope="row">
                                                                    {{$no2++}}
                                                                    <!-- Show modal -->
                                                                    <div class="modal fade showModal" id="showData-cicil{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">

                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title" id="myModalLabel">
                                                                                        Detail Pembayaran Tagihan
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
                                                                                                    <td>{{$data->student->name}}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th>Bank</th>
                                                                                                    <td>{{$data->bank != NULL ? $data->bank->name_bank : '-'}}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th>Pemilik Rekening</th>
                                                                                                    <td>{{$data->bank != NULL ? $data->bank->nasabah : '-'}}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th>Nomor Rekening</th>
                                                                                                    <td>{{$data->bank != NULL ? $data->bank->account_number : '-'}}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th>Total Bayar</th>
                                                                                                    <td>{{'Rp '.number_format($data->amount)}}</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <th>Bukti</th>
                                                                                                    <td><a href="{{asset('bukti/tagihan/'. $data->proof)}}" target="blank"><i class="fa fa-eye"></i>&nbsp;Lihat</a></td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <td>{{$data->student->nisn}}</td>
                                                                <td>{{$data->student->name}}</td>
                                                                <td>{{$data->student->age}}</td>
                                                                <td>{{'Rp '.number_format($data->amount)}}</td>
                                                                <td>
                                                                    <a class="btn btn-success btn-sm"
                                                                        href="#showData-cicil{{$data->id}}"
                                                                        data-toggle="modal"
                                                                        data-toggle="tooltip"
                                                                    >
                                                                        Detail
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Murid --}}
                            <div class="tab-pane fade" id="murid" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="col-md-12 col-sm-12 ">
                                    <div class="x_panel">
                                        <div class="x_content">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                    <th>#</th>
                                                    <th>NIS</th>
                                                    <th>Nama</th>
                                                    <th>Umur</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no3 = 1;
                                                    @endphp
                                                    @foreach ($belum as $data)
                                                        <tr>
                                                            <th scope="row">{{$no3++}}</th>
                                                            <td>{{$data->nisn}}</td>
                                                            <td>{{$data->name}}</td>
                                                            <td>{{$data->age}}</td>
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
        </div>
    </div>
@endsection
