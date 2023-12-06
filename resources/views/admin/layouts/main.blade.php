@php

    use App\Models\Notification;

    $notifications = Notification::where('is_read', 0)
        ->orderBy('created_at', 'desc')
        ->get();
    $notificationCount = $notifications->count();

@endphp



<!DOCTYPE html>
<html lang="en">

<head>
    <title>KopiZero Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="/fa/css/font-awesome.min.css">

    <link rel="icon" href="/image/paw-img.png">

    {{-- pusher notification --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('b821eafe5695e9c22761', {
            cluster: 'ap1'
        });

        var notificationCount = 0;

        var channel = pusher.subscribe('kopi_zero');
        channel.bind('user-order', function(data) {
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                iconColor: '#443',
                title: 'New Order!',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                toast: true
            });

            // Check if the browser supports notifications
            if (!("Notification" in window)) {
                alert("This browser does not support desktop notification");
            }

            // Check if permission is already granted
            else if (Notification.permission === "granted") {
                // If it's okay let's create a notification
                var notification = new Notification('New Order!', {
                    body: data.message,
                    icon: '/image/paw.png' // optional
                });
            }

            // Otherwise, we need to ask the user for permission
            else if (Notification.permission !== 'denied') {
                Notification.requestPermission().then(function(permission) {
                    // If the user accepts, let's create a notification
                    if (permission === "granted") {
                        var notification = new Notification('New Order!', {
                            body: data.message,
                            icon: '/image/paw.png' // optional
                        });
                    }
                });
            }

            addNotification(data.message);
            updateNotificationCount();
        });

        function addNotification(message) {
            var notificationList = document.querySelector('.app-notification__content');
            var newNotification = document.createElement('li');
            newNotification.innerHTML = `
                <a class="app-notification__item" href="/dashboard/notification">
                    <span class="app-notification__icon">
                        <i class="bi bi-cash fs-4 text-primary"></i>
                    </span>
                    <div>
                        <p class="app-notification__message">${message}</p>
                        <p class="app-notification__meta">Just now</p>
                    </div>
                </a>
            `;
            notificationList.appendChild(newNotification);

            notificationCount++;
        }

        function updateNotificationCount() {
            var badge = document.querySelector('.app-nav__item .badge');
            var title = document.querySelector('.app-notification__title');

            badge.textContent = notificationCount;
            title.textContent = 'You have ' + notificationCount + ' new notifications.';
        }
    </script>


    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>

<body class="app sidebar-mini">


    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">Kopi Zero</a>
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
            aria-label="Hide Sidebar"></a>

        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            {{-- <li class="app-search">
                <input class="app-search__input" type="search" placeholder="Search">
                <button class="app-search__button"><i class="bi bi-search"></i></button>
            </li> --}}

            <!--Notification Menu-->
            <li class="dropdown"><a class="app-nav__item" href="#" data-bs-toggle="dropdown"
                    aria-label="Show notifications"><i class="bi bi-bell fs-5"></i>

                    <span class="badge bg-danger rounded-pill"></span>

                    @if ($notificationCount > 0)
                        <span class="badge bg-danger rounded-pill"> </span>
                    @endif
                </a>

                <ul class="app-notification dropdown-menu dropdown-menu-right">
                    <li class="app-notification__title">You Have {{ $notificationCount }} Notification</li>
                    <div class="app-notification__content">
                        {{--  --}}

                        @foreach ($notifications as $notif)
                            <a class="app-notification__item" href="/dashboard/notification">
                                <span class="app-notification__icon">
                                    <i class="bi bi-cash fs-4 text-primary"></i>
                                </span>
                                <div>
                                    <p class="app-notification__message">{{ $notif->message }}</p>
                                    <p class="app-notification__meta">{{ $notif->created_at->diffForHumans() }}</p>
                                </div>
                            </a>
                        @endforeach

                    </div>
                    <li class="app-notification__footer"><a href="/dashboard/notification">See all notifications.</a>
                    </li>
                </ul>

            </li>

            <!-- User Menu-->
            <li class="dropdown"><a class="app-nav__item" href="#" data-bs-toggle="dropdown"
                    aria-label="Open Profile Menu"><i class="bi bi-person fs-4"></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li>
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                        </form>

                        <a class="back dropdown-item" href="/">
                            <i class="bi bi-box-arrow-left me-2 fs-5"></i>
                            Back to Website
                        </a>

                        <a class="logout dropdown-item" href="#" onclick="myFunction()">
                            <i class="bi bi-box-arrow-right me-2 fs-5"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function myFunction() {
            $('.logout').click(function(event) {
                event.preventDefault(); // Mencegah tindakan bawaan dari tautan

                Swal.fire({
                    title: "Apakah anda yakin ingin keluar?",
                    showCancelButton: true,
                    confirmButtonColor: "#C3AE89",
                    confirmButtonText: "Keluar"
                }).then((value) => {
                    if (value.isConfirmed) {
                        $('#logout-form').submit();
                    }
                });
            });
        }
    </script>

    @include('admin.layouts.sidebar')
