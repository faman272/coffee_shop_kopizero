@include('admin.layouts.main')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="bi bi-ui-checks"></i> Change Role</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
            <li class="breadcrumb-item">Change Role</li>
            <li class="breadcrumb-item"><a href="#">Account</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="row">
                    <div class="col-lg-12">

                        <form role="form" id="form-update" method="post"
                            action="{{ route('manage_account.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="nama_kategori">Role saat ini :
                                    <b>{{ $user->role }}</b></label>
                                <select class="form-control" id="role" name="role" required="required">
                                    <option value="0" disabled="true" selected>--Pilih Role--</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="superadmin">SuperAdmin</option>
                                </select>
                            </div>
                            <a href="/dashboard/kategori" class="btn btn-warning text-white">Back</a>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

@include('admin.layouts.footer')
