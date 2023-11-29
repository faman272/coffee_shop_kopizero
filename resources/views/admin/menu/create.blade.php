<div id="modal-tambah" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form role="form" id="form-tambah" method="post" action="{{ route('menu.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Menambahkan Menu</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Menu</label>
                        <input class="form-control" id="nama_menu" name="nama_menu" required="required"
                            placeholder="Nama Menu">
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" id="kategori" name="kategori" required="required">
                            <option value="0" selected disabled="true">--Pilih Kategori Menu--</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id_kategori }}">{{ $category->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="harga_hot">Harga Hot</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Rp.</span></div>
                            <input class="form-control" id="harga_hot" type="number" placeholder="Harga Hot"
                                name="harga_hot">
                            <div class="input-group-append"><span class="input-group-text">.00</span></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="harga_hot">Harga Ice</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Rp.</span></div>
                            <input class="form-control" id="harga_hot" type="number" placeholder="Harga Ice"
                                name="harga_ice">
                            <div class="input-group-append"><span class="input-group-text">.00</span></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" id="deksripsi" name="deskripsi" required="required" placeholder="Deskripsi Menu"></textarea>
                    </div>
                   
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" required="required">
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
