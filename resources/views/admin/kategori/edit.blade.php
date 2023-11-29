@include('admin.layouts.main')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="bi bi-ui-checks"></i> Edit Kategori</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
            <li class="breadcrumb-item">Kategori</li>
            <li class="breadcrumb-item"><a href="#">Edit Kategori</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="row">
                    <div class="col-lg-12">

                        <form role="form" id="form-update" method="post" action="{{ route('kategori.update', $kategori->id_kategori) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="nama_kategori">Nama Kategori</label>
                                <input class="form-control" id="nama_kategori" type="text" placeholder="Nama Menu"
                                    name="nama_kategori" value="{{ $kategori->nama_kategori }}">
                            </div>
                            
                            <div class="tile-footer">
                                <a href="/dashboard/kategori"  class="btn btn-warning text-white" >Back</a>
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
