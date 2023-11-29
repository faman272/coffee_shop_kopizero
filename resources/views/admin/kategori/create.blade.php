<div id="modal-tambah" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form role="form" id="form-tambah" method="post" action="{{ route('kategori.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Menambahkan Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input class="form-control" id="nama_kategori" name="nama_kategori" required="required"
                            placeholder="Nama Kategori">
                    </div>               
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning text-white" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
