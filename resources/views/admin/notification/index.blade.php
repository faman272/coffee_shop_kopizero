@include('admin.layouts.main')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="bi bi-bell"></i> Notification</h1>
            <p>All Notification</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
            <li class="breadcrumb-item"><a href="#">Notification</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="mailbox-controls">
                    <div class="form-check">
                        <label>
                            <input class="form-check-input" type="checkbox" id="markAll"><span class="label-text">
                                <a href="#" id="markAsRead">Mark as read</a></span>
                        </label>
                    </div>
                    <div class="btn-group">
                        {{-- <button class="btn btn-primary btn-sm" type="button"><i class="bi bi-trash fs-5"></i></button> --}}
                        <a href="/dashboard/notification" class="btn btn-primary btn-sm" type="button"><i
                                class="bi bi-arrow-clockwise fs-5"></i></a>
                    </div>
                </div>
                <div class="table-responsive mailbox-messages">
                    <table class="table table-hover">
                        <tbody>

                            @foreach ($notifications as $notification)
                                <tr>

                                    <td>
                                        @if ($notification->is_read == 0)
                                            <div class="form-check">
                                                <label>
                                                    <input class="form-check-input checkboxItem" type="checkbox"
                                                        value="{{ $notification->id }}"><span class="label-text">
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                    </td>
                                    <td><a
                                            href="{{ route('pesanan.edit', $notification->no_order) }}">{{ $notification->no_order }}</a>
                                    </td>
                                    <td>
                                        @if ($notification->is_read == 1)
                                            <div style="color: grey">
                                                {{ $notification->message }}
                                            </div>
                                        @else
                                            {{ $notification->message }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($notification->is_read == 1)
                                            <div style="color: grey">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </div>
                                        @else
                                            {{ $notification->created_at->diffForHumans() }}
                                        @endif
                                    </td>
                                    @if ($notification->is_read == 0)
                                        <td><a href="{{ route('notifications.read', $notification->id) }}">Mark as
                                                read</a></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-end"><span class="text-muted mr-2">Showing 1-10</span>
                    <div class="btn-group ms-3">
                        <button class="btn btn-primary btn-sm" type="button"><i
                                class="bi bi-chevron-left"></i></button>
                        <button class="btn btn-primary btn-sm" type="button"><i
                                class="bi bi-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.getElementById('markAll').addEventListener('change', function(e) {
        var checkboxes = document.querySelectorAll('.checkboxItem');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = e.target.checked;
        });
    });

    document.getElementById('markAsRead').addEventListener('click', function(e) {
        e.preventDefault();

        var checkboxes = document.querySelectorAll('.checkboxItem:checked');
        var ids = Array.from(checkboxes).map(function(checkbox) {
            return checkbox.value;
        });

        fetch('/notifications/read', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                ids: ids
            })
        }).then(function(response) {
            if (response.ok) {
                location.reload();
            }
        });
    });
</script>

@include('admin.layouts.footer')
