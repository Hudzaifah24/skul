{{-- Edit Modal Category --}}
<form id="edit" action="{{ route('category.update',$category->id) }}" method="POST"  data-parsley-validate class="form-horizontal form-label-left">
    @method('PUT')
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">  
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="edit">Submit</button>
            </div>
        </div>
    </div>
</form>
{{-- End Edit Category --}}
