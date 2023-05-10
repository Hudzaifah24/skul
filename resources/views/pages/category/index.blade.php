@extends('layouts.app')

@section('title')
    Kategori
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
        <div class="page-title mb-5">
            <div class="title_left">
                <h3><small>Kategori</small></h3>
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
                            class="btn btn-primary btn-md mb-2" 
                            href="#createData"
                            data-toggle="modal" 
                            data-toggle="tooltip"   
                        >
                            <i class="fa fa-plus-square"></i>
                            &nbsp;Tambah
                        </a>
                        
                        {{-- Start Modal --}}
                        @include('pages.category.create')

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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category)
                                                <!-- Edit modal -->
                                                <div class="modal fade" id="editData{{ $category->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <form action="{{ route('category.update',$category->id) }}" method="POST"  data-parsley-validate class="form-horizontal form-label-left">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel">
                                                                        <i class="fa fa-edit"></i>  
                                                                        Ubah Kategori
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Nama</label>
                                                                                    <input 
                                                                                        type="text"
                                                                                        class="form-control" 
                                                                                        name="name"
                                                                                        value="{{ $category->name }}" 

                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                        </form>
                                                    {{-- End Edit Category --}}
                                                    </div>
                                                </div>
                                                {{-- Modal Delete Data --}}
                                                <div id="deleteData{{$category->id}}" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form class="d-inline-block" action="{{route('category.destroy', $category->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus Kategori</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah Anda yakin ingin menghapus data <strong>{{ $category->name }} ?</strong></p>
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
                                                    <td>{{ $category->id }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td class="d-flex">
                                                        <a class="btn btn-warning btn-sm"
                                                            href="#editData{{ $category->id }}"
                                                            data-toggle="modal"
                                                            data-toggle="tooltip"
                                                        >
                                                            Ubah
                                                        </a>
                                                        <a class="btn btn-danger btn-sm"
                                                            href="#deleteData{{$category->id}}"
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
