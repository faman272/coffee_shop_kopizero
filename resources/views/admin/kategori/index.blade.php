@include('admin.layouts.main')

@include('sweetalert::alert')

@include('admin.kategori.create')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-desktop"></i> Kategori </h1>
            <p>Kategori Menu Kopi Zero</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Kategori</a></li>
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
                                        Nama Kategori
                                    </th>
                                    <th>Opsi</th>                               
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($kategoris as $kategori)
                                    <tr>
                                        <td>
                                             {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $kategori->nama_kategori }}
                                        </td>
                                
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('kategori.edit', $kategori->id_kategori) }}"
                                                    class="btn btn-primary">
                                                    <i class="bi bi-pencil-fill">
                                                    </i>
                                                </a>
                                                <form action="{{ route('kategori.destroy', $kategori->id_kategori) }}" method="POST" class="delete-form">
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