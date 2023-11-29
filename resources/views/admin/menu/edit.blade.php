@include('admin.layouts.main')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="bi bi-ui-checks"></i> Edit Menu</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
            <li class="breadcrumb-item">Menu</li>
            <li class="breadcrumb-item"><a href="#">Edit Menu</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="row">
                    <div class="col-lg-12">

                        <form role="form" id="form-update" method="post" action="{{ route('menu.update', $menu->id_menu) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="nama_menu">Nama Menu</label>
                                <input class="form-control" id="nama_menu" type="text" placeholder="Nama Menu"
                                    name="nama_menu" value="{{ $menu->nama_menu }}">
                            </div>
                            <div class="mb-3">
                                <label>Kategori</label>
                                <select class="form-control" id="kategori" name="kategori" required="required">
                                    <option value="0" disabled="true">--Pilih Kategori Menu--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id_kategori }}"
                                            {{ $menu->kategori_id == $category->id_kategori ? 'selected' : '' }}>
                                            {{ $category->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga Hot</label>
                                <div class="mb-3">
                                    <label class="sr-only" for="harga_hot">Harga Hot</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">Rp.</span></div>
                                        <input class="form-control" id="harga_hot" type="number"
                                            placeholder="Harga Hot" name="harga_hot" value="{{ number_format($menu->H_Hot, 0, '.', '') }}">
                                        <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga Ice</label>
                                <div class="mb-3">
                                    <label class="sr-only" for="harga_hot">Harga Ice</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">Rp.</span></div>
                                        <input class="form-control" id="harga_hot" type="number"
                                            placeholder="Harga Ice" name="harga_ice" value="{{ number_format($menu->H_Ice, 0, '.', '') }}">
                                        <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi">{{ $menu->deskripsi }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="gambar">Gambar</label>
                                <input class="form-control" id="gambar" type="file" name="gambar">
                            </div>
                            <div class="tile-footer">
                                <a href="/dashboard/menu"  class="btn btn-warning text-white" >Back</a>
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
