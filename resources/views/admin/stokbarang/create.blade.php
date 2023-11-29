<div id="modal-tambah" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form role="form" id="form-tambah" method="post" action="{{ route('stokbarang.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Menambahkan Stok Barang</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input class="form-control" id="nama_barang" name="nama_barang" required="required"
                            placeholder="Nama Barang">
                    </div>

                    <div class="form-group">
                        <label>Tipe Barang</label>
                        <input class="form-control" id="type_barang" name="type_barang" required="required"
                            placeholder="Tipe Barang">
                    </div>

                    <div class="form-group">
                        <label>Volume</label>
                        <input class="form-control" id="volume" name="volume" required="required"
                            placeholder="Volume">
                    </div>

                    <div class="form-group">
                        <label>Satuan</label>
                        <input class="form-control" id="satuan" name="satuan" required="required"
                            placeholder="Satuan">
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
