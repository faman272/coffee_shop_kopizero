@include('admin.layouts.main')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="bi bi-ui-checks"></i> Edit Metode Pembayaran</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
            <li class="breadcrumb-item">Metode Pembayaran</li>
            <li class="breadcrumb-item"><a href="#">Edit Metode</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="row">
                    <div class="col-lg-12">

                        <form role="form" id="form-update" method="post" action="{{ route('metode_pembayaran.update', $metodePembayaran->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="nama_metode">Nama Metode</label>
                                <input class="form-control" id="nama_metode" type="text" placeholder="Nama Metode"
                                    name="nama_metode" value="{{ $metodePembayaran->nama_metode }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="norek">No Rekening</label>
                                <input class="form-control" id="norek" type="text" placeholder="No Rekening"
                                    name="norek" value="{{ $metodePembayaran->norek }}">
                            </div>
                            

                            <div class="mb-3">
                                <label class="form-label" for="atas_nama">Atas Nama</label>
                                <input class="form-control" id="atas_nama" type="text" placeholder="No Rekening"
                                    name="atas_nama" value="{{ $metodePembayaran->atas_nama }}">
                            </div>


                            <div class="mb-3">
                                <label class="form-label" for="logo">Logo</label> <br>
                                <img src="{{ asset('storage/metode/' . $metodePembayaran->logo) }}" alt="" width="30%">
                                <br><br><br>
                                <input class="form-control" id="logo" type="file" name="logo">
                            </div>



                            
                            <div class="tile-footer">
                                <a href="/dashboard/metode_pembayaran"  class="btn btn-warning text-white" >Back</a>
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
