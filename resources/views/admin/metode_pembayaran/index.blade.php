@include('admin.layouts.main')

@include('sweetalert::alert')

@include('admin.metode_pembayaran.create')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-desktop"></i> Metode Pembayaran </h1>
            <p>Metode Pembayaran Kopi Zero</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Metode Pembayaran</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">Add
                        New</button><br> <br>

                    <div id="data-product">
                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        Nama Metode
                                    </th>
                                    <th>No Rek</th>
                                    <th>Atas Nama</th>
                                    <th>Logo</th>
                                    <th>Opsi</th>                               
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($metode_pembayarans as $metode)
                                    <tr>
                                        <td>
                                             {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $metode->nama_metode }}
                                        </td>

                                        <td>
                                            {{ $metode->norek }}
                                        </td>
                                        
                                        <td>
                                            {{ $metode->atas_nama }}
                                        </td>

                                        <td>
                                            <img src="{{ asset('storage/metode/' . $metode->logo) }}"" alt="" width="60%">
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('metode_pembayaran.edit', $metode->id) }}"
                                                    class="btn btn-primary">
                                                    <i class="bi bi-pencil-fill">
                                                    </i>
                                                </a>
                                                <form action="{{ route('metode_pembayaran.destroy', $metode->id) }}" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                                </form>
                                                
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $('.delete-form').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data Tidak Dapat Dikembalikan Setelah Dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });
</script>

<!-- Page specific javascripts-->
<link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css">
<!-- Data table plugin-->
<script src="/js/plugins/jquery.dataTables.min.js"></script>
<script src="/js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $('#table').DataTable();
</script>