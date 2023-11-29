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
                                    <th>No.</th>
                                    <th>No Order</th>
                                    <th>Pelanggan</th>
                                    <th>Tanggal</th>
                                    <th>Metode</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($semuadata as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>#{{ $data->no_order }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ date('d M Y H:i', strtotime($data->tgl_order)) }}</td>
                                        <td>{{ $data->nama_metode }}</td>
                                        <td>Rp. {{ number_format($data->total_pembayaran, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    @if (count($semuadata) == 0)
                                        <th colspan="2"></th>
                                        <th>Tidak Ada Data</th>
                                        <th colspan="2"></th>
                                    @else
                                        @php
                                            $total = array_sum(array_column($semuadata, 'total_pembayaran'));
                                        @endphp
                                        <th colspan="5">Total</th>
                                        <th>Rp. {{ number_format($total, 0, ',', '.') }}</th>
                                        <th></th>
                                    @endif

                                    <a href="#" onclick="window.open('{{ route('laporantransaksi.print') }}', 'newwindow','width=800,height=500'); 
                                        return false;"
                                    class="btn btn-primary my-3"
                                        >Print</a>
                                </tr>
                                <tr>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@include('admin.layouts.footer')
