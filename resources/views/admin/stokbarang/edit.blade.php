@include('admin.layouts.main')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="bi bi-ui-checks"></i> Edit Stok Barang</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
            <li class="breadcrumb-item">Stok Barang</li>
            <li class="breadcrumb-item"><a href="#">Edit Stok Barang</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="row">
                    <div class="col-lg-12">

                        <form role="form" id="form-update" method="post" action="{{ route('stokbarang.update', $stokBarang->id_barang) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="nama_barang">Nama Barang</label>
                                <input class="form-control" id="nama_barang" type="text" placeholder="Nama Barang"
                                    name="nama_barang" value="{{ $stokBarang->nama_barang }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="type_barang">Tipe Barang</label>
                                <input class="form-control" id="type_barang" type="text" placeholder="Tipe Barang"
                                    name="type_barang" value="{{ $stokBarang->type_barang }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="volume">Volume</label>
                                <input class="form-control" id="volume" type="text" placeholder="Volume"
                                    name="volume" value="{{ $stokBarang->volume }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="satuan">Satuan</label>
                                <input class="form-control" id="satuan" type="text" placeholder="Satuan"
                                    name="satuan" value="{{ $stokBarang->satuan }}">
                            </div>

                            <div class="tile-footer">
                                <a href="/dashboard/stokbarang"  class="btn btn-warning text-white" >Back</a>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</main>

@include('admin.layouts.footer')
