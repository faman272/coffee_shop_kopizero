<div id="modal-tambah" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form role="form" id="form-tambah" method="post" action="{{ route('metode_pembayaran.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Menambahkan Metode Pembayaran</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Metode</label>
                        <input class="form-control" id="nama_metode" name="nama_metode" required="required"
                            placeholder="Nama Metode">
                    </div>
                    
                    <div class="form-group">
                        <label>No rekening</label>
                        <input class="form-control" id="norek" name="norek" required="required"
                            placeholder="No Rekening">
                    </div>  
                    
                    <div class="form-group">
                        <label>Atas Nama</label>
                        <input class="form-control" id="atas_nama" name="atas_nama" required="required"
                            placeholder="Atas Nama">
                    </div> 

                    <div class="form-group">
                        <label>Logo</label>
                        <input type="file" class="form-control" id="logo" name="logo" required="required">
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
