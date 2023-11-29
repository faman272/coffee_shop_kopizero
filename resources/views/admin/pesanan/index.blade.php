@include('admin.layouts.main')
@include('sweetalert::alert')


<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="bi bi-table"></i> Data Pesanan</h1>
            <p>Data Pesanan Kopi Zero</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
            <li class="breadcrumb-item">Pesanan</li>
            <li class="breadcrumb-item active"><a href="#">All</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th>No. Order</th>
                                    <th>Tgl Order</th>
                                    <th>Nama Customer</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            #{{ $order->no_order }}
                                        </td>
                                        <td>
                                            {{ date('d M Y H:i', strtotime($order->tgl_order)) }}
                                        </td>
                                        <td>
                                            {{ $order->user->name }}
                                        </td>
                                        <td>
                                            Rp. {{ number_format($order->pembayarans->total_pembayaran, 0, ',', '.') }}
                                        </td>

                                        <td>
                                            {{ $order->status }}
                                        </td>
                                        
                                        <td>
                                            <a href="{{ route('pesanan.edit', $order->no_order) }}" class="btn btn-primary">Detail Order</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('admin.layouts.footer')

<!-- Page specific javascripts-->
<link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css">
<!-- Data table plugin-->
<script src="/js/plugins/jquery.dataTables.min.js"></script>
<script src="/js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $('#table').DataTable();
</script>