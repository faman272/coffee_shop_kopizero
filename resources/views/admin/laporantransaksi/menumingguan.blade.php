@include('admin.layouts.main')

@include('sweetalert::alert')

@include('admin.kategori.create')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-desktop"></i> Penjualan Mingguan</h1>

            <p>Laporan Mingguan</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Laporan Menu Mingguan</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">

                    <div id="data-product">
                        <table class="table table-bordered" id="table">

                            <thead>
                                <h3>
                                    <b id="weekRange"></b>
                                    <script>
                                        var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
                                            'November', 'Desember'
                                        ];
                                        var date = new Date();
                                        var startOfWeek = new Date(date.setDate(date.getDate() - date.getDay()));
                                        var endOfWeek = new Date(date.setDate(date.getDate() - date.getDay() + 6));
                                        var weekRange = startOfWeek.getDate() + ', ' + months[startOfWeek.getMonth()] + ' ' + startOfWeek.getFullYear() +
                                            ' - ' + endOfWeek.getDate() + ', ' + months[endOfWeek.getMonth()] + ' ' + endOfWeek.getFullYear();
                                        document.getElementById('weekRange').textContent = weekRange;
                                    </script>
                                </h3>

                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        Nama Menu
                                    </th>
                                    <th>Jumlah Terjual</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $row)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $row->nama_menu }}
                                        </td>
                                        <td>
                                            {{ $row->jumlah_terjual }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <a href="#" onclick="window.print()" class="btn btn-primary no-print">Print</a>

                        <style>
                            @media print {
                                .no-print {
                                    display: none;
                                }
                            }
                        </style>
                    </div>

                </div>
            </div>

        </div>

    </div>

</main>

@include('admin.layouts.footer')

{{-- <!-- Page specific javascripts-->
<link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css">
<!-- Data table plugin-->
<script src="/js/plugins/jquery.dataTables.min.js"></script>
<script src="/js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $('#table').DataTable();
</script> --}}
