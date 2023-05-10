@extends('layouts.app')

@section('title')
    Info
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
                <h3><small>Info</small></h3>
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
                    @if (Auth::user()->role == 'Admin')
                        <div class="x_title">
                            <a class="mb-2 btn btn-primary btn-md"
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
                                    <form class="modal-content" action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">
                                                Tambah Info
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nama Penulis</label>
                                                            <select name="user_id" class="form-control">
                                                                @foreach ($users as $user )
                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Judul</label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="title">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Kategori</label>
                                                            <select name="category_id" class="form-control">
                                                                @foreach ($categories as $category )
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Konten</label>
                                                            <textarea name="content" id="editorCreate" class="ckeditor1"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Gambar</label>
                                                            <input
                                                                type="file"
                                                                class="form-control"
                                                                name="image"
                                                                v-model="name"
                                                                autofocus
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    @endif
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Penulis</th>
                                                <th>Judul</th>
                                                <th>Status</th>
                                                @if (Auth::user()->role == 'Admin')
                                                    <th>Aksi</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($articles as $article)
                                                <!-- Detail modal -->
                                                <div class="modal fade showModal" id="showData{{ $article->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">
                                                                    Detail Info
                                                                </h4>
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Nama Penulis</label>
                                                                                <input
                                                                                    disabled
                                                                                    class="form-control"
                                                                                    value="{{ $article->user_id }}"
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Judul</label>
                                                                                <input
                                                                                    disabled
                                                                                    class="form-control"
                                                                                    value="{{ $article->title }}"
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Kategori</label>
                                                                                <input
                                                                                    disabled
                                                                                    class="form-control"
                                                                                    value="{{ $article->category->name }}"
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Gambar</label>
                                                                                <div class="image-cell">
                                                                                    <div class="image">
                                                                                    <img src="/profile/{{ $article->image }}" class="w-100">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Konten</label>
                                                                                {{-- <textarea disabled class="form-control" style="height: 200px;">{{$article->content }}</textarea> --}}
                                                                                <div class="form-control" style="height: 200px;">
                                                                                    {!! $article->content !!}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Edit modal -->
                                                <div class="modal fade showModal" id="editData{{ $article->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel">
                                                                    Ubah Info
                                                                </h4>
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form action="{{ route('article.update',$article->id) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nama Penulis</label>
                                                                                    <select name="user_id" class="form-control">
                                                                                    @foreach ($users as $user)
                                                                                        <option value="{{ $user->id }}" {{ $user->id === $article->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                                                    @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Judul</label>
                                                                                    <input
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        name="title"
                                                                                        value="{{ $article->title }}">

                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Kategori</label>
                                                                                    <select name="category_id" class="form-control">
                                                                                    @foreach ($categories as $category)
                                                                                        <option value="{{ $category->id }}"{{ $category->id === $article->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                                                    @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Konten</label>
                                                                                    <textarea name="content" id="editorShow" class="ckeditor">{{ $article->content }} </textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Gambar</label>
                                                                                    <input
                                                                                        type="file"
                                                                                        class="form-control"
                                                                                        name="image"
                                                                                        v-model="name"
                                                                                        autofocus
                                                                                    >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <a class="btn btn-success"
                                                                            href="#active{{$article->id}}"
                                                                            data-toggle="modal"
                                                                        >
                                                                            <i class="fa fa-check"></i>
                                                                        </a>
                                                                        <a class="btn btn-danger"
                                                                            href="#notactive{{$article->id}}"
                                                                            data-toggle="modal"
                                                                        >
                                                                            <i class="fa fa-close"></i>
                                                                        </a>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Modal Delete Data --}}
                                                <div id="deleteData{{ $article->id }}" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form class="d-inline-block" action="{{ route('article.destroy',$article->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus Info</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah Anda yakin ingin menghapus data <strong>{{ $article->title }} ?</strong></p>
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
                                                <div id="active{{$article->id}}" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form class="d-inline-block" action="{{route('article.is.active', $article->id)}}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" value="active" name="status">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Aktifkan Artikel</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah Anda yakin ingin Mengaktifkan Artikel <strong>?</strong></p>
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
                                                <div id="notactive{{$article->id}}" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form class="d-inline-block" action="{{route('article.is.active', $article->id)}}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" value="notactive" name="status">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Non Aktifkan Artikel</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah Anda yakin ingin menonaktifkan Artikel <strong>?</strong></p>
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
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $article->user->name }}</td>
                                                    <td>{{ $article->title }}</td>
                                                    <td>
                                                        @if ($article->status=="Active")
                                                            <span class="badge badge-success">
                                                                Aktif
                                                            </span>
                                                        @else
                                                            <span class="badge badge-danger">
                                                                Tidak Aktif
                                                            </span>
                                                        @endif
                                                    </td>
                                                    @if (Auth::user()->role == 'Admin')
                                                        <td>
                                                            <a class="btn btn-success btn-sm"
                                                                href="#active{{$article->id}}"
                                                                data-toggle="modal"
                                                            >
                                                                <i class="fa fa-check"></i>
                                                            </a>
                                                            <a class="btn btn-danger btn-sm"
                                                                href="#notactive{{$article->id}}"
                                                                data-toggle="modal"
                                                            >
                                                                <i class="fa fa-close"></i>
                                                            </a>
                                                            <a class="btn btn-success btn-sm"
                                                                href="#showData{{ $article->id }}"
                                                                data-toggle="modal"
                                                                data-toggle="tooltip"
                                                            >
                                                                Detail
                                                            </a>
                                                            <a class="btn btn-warning btn-sm"
                                                                href="#editData{{ $article->id }}"
                                                                data-toggle="modal"
                                                                data-toggle="tooltip"
                                                            >
                                                                Ubah
                                                            </a>
                                                            <a class="btn btn-danger btn-sm"
                                                                href="#deleteData{{$article->id}}"
                                                                data-toggle="modal"
                                                                data-toggle="tooltip"
                                                            >
                                                                Hapus
                                                            </a>
                                                        </td>
                                                    @endif
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

    {{-- Ckeditor --}}
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( "editorCreate" );
    </script>
    <script>
        CKEDITOR.replace( "editorShow" );
    </script>

    <script>
        ClassicEditor
        .create( document.querySelector( '.ckeditor' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );
    </script>
@endpush
