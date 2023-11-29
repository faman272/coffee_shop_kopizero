@include('admin.layouts.main')


<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-desktop"></i> Log Cart</h1>
            <p>Log Cart</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Log Cart</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">

                    <div id="data-product">
                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th>
                                        Waktu
                                    </th>
                                    <th>Aksi</th>
                                    <th>Keterangan</th>                               
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($logs as $log)
                                    <tr>
                                        <td>
                                            {{ $log->created_at }}
                                        </td>

                                        <td>
                                            <div style="color: 
                                            
                                            {{ $log->aksi == 'INSERT' ? 'green' : '' }}
                                            {{ $log->aksi == 'UPDATE' ? 'blue' : '' }}
                                            {{ $log->aksi == 'DELETE' ? 'red' : '' }}
                                            
                                            ">
                                                {{ $log->aksi }}
                                            </div>
                                        </td>
                                        
                                        <td>
                                            {{ $log->keterangan }}
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