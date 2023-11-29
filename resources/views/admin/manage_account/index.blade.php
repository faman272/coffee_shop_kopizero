@include('admin.layouts.main')

@include('sweetalert::alert')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-desktop"></i> Manage Account </h1>
            <p>Manage Account</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Manage Account</a></li>
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
                                        No.
                                    </th>
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        Nama
                                    </th>
                                    <th>Email</th>
                                    <th>No Telp</th>
                                    <th>Role</th>
                                    <th>Action</th>                               
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                             {{ $user->id }}
                                        </td>
                                        <td>
                                            {{ $user->name }}
                                        </td>

                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        
                                        <td>
                                            {{ $user->no_telp }}
                                        </td>

                                        <td>
                                            {{ $user->role }}
                                        </td>

                                        <td>
                                            <div class="d-flex justify-center align-center">
                                                <a href="{{ route('manage_account.show', $user->id) }}"
                                                    class="btn btn-primary">
                                                   Change Role
                                                    </i>
                                                </a>
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