@include('admin.layouts.main')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-desktop"></i> Laporan Penghasilan</h1>
            <p>Data Laporan Penghasilan Kopi Zero</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Laporan Penghasilan</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">

                    <form method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" name="tglm" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Tanggal Selesai</label>
                                    <input type="date" name="tgls" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>&nbsp;</label><br>
                                <button class="btn btn-primary" name="lihat">Lihat</button>
                            </div>
                        </div>
                    </form>
                    <div id="laporan_transaksi">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pelanggan</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</main>

@include('admin.layouts.footer')
