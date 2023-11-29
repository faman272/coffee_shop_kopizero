@include('admin.layouts.main')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-desktop"></i> Laporan Transaksi</h1>
            <p>Data Laporan Transaksi Kopi Zero</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Laporan Transaksi</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <h2 class="text-center">Laporan Transaksi KopiZero Tanggal {{ date('d M Y', strtotime($mulai)) }} - {{ date('d M Y', strtotime($selesai)) }}</h2>
                    <hr><br><br>
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

<script type="text/javascript">
        window.print();
</script>

@include('admin.layouts.footer')