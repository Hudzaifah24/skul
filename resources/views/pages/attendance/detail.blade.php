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
                <h3><small>Detail Kehadiran</small></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">

                <div class="x_panel">
                    <div class="x_title d-flex justify-content-center justify-content-around">
                        <div class="clearfix"></div>
                        <div class="card" style="width: 18rem;">
                            <div class="card-body text-center">
                              <h5 class="card-title text-primary font-weight-bold">{{$presences != null ? $presences->permission_count : 0 || $presences->permission_count != NULL ? $presences->permission_count : 0 }}</h5>
                              <h6 class="card-subtitle mb-2  text-primary font-weight-bold">Izin</h6>
                            </div>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <div class="card-body text-center">
                              <h5 class="card-title text-warning font-weight-bold">{{$presences != null ? $presences->sick_count : 0 || $presences->sick_count != NULL ? $presences->sick_count : 0 }}</h5>
                              <h6 class="card-subtitle mb-2  text-warning font-weight-bold">Sakit</h6>
                            </div>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <div class="card-body text-center">
                              <h5 class="card-title text-danger font-weight-bold">{{$presences != null ? $presences->alpha_count : 0 || $presences->alpha_count != NULL ? $presences->alpha_count : 0 }}</h5>
                              <h6 class="card-subtitle mb-2  text-danger font-weight-bold">Alpha</h6>
                            </div>
                        </div>
                    </div>

                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th scope="row">#</th>
                                                <th>Pelajaran</th>
                                                <th>Status</th>
                                                <th>Alasan</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($presenceDetail as $data)
                                                <tr>
                                                    <th scope="row">{{$loop->iteration}}</th>
                                                    <td>{{$data->learning->name}}</td>
                                                    <td>
                                                        @if ($data->status == 'permission')
                                                            Izin
                                                        @elseif ($data->status == 'sick')
                                                            Sakit
                                                        @elseif ($data->status == 'alpha')
                                                            Alpha
                                                        @endif
                                                    </td>
                                                    <td>{{$data->reason == null ? '-' : $data->reason}}</td>
                                                    <td>{{$data->date}}</td>
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

