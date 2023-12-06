@php
    use App\Models\Cart;
    use App\Models\UserNotification;

    use Illuminate\Support\Facades\Auth;

    $cartCount = 0;
    $notifCount = 0;
    if (Auth::check()) {
        $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        $notifCount = UserNotification::where('user_id', Auth::user()->id)->count();
    }
@endphp


<header class="header">
    <div id="menu-btn" class="fas fa-bars"></div>

    <a href="/" class="logo">Kopi Zero <span class="material-symbols-outlined">pets</span></a>

    <nav class="navbar">
        <a href="/">home</a>
        <a href="#about">about</a>
        <a href="#menu">menu</a>
        <a href="#map">location</a>
    </nav>
    @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth

                <ul>

                    <li>
                        <a href="/notification">
                            <div class="notif2" style="display: none;"></div>
                            @if ($notifCount > 0)
                                <div class="notif2"></div>
                            @endif
                            <span class="material-icons-outlined">
                                notifications
                            </span>
                        </a>
                    </li>
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

                        var userId = '{{ Auth::user()->id }}'; // Get the user ID from Laravel
                        var channel = pusher.subscribe('user-notification-' + userId);
                        channel.bind('user-notification', function(data) {
                            Swal.fire({
                                position: 'top-start',
                                icon: 'info',
                                iconColor: '#443',
                                title: 'Your order has been processed by admin!',
                                showConfirmButton: false,
                                timer: 10000,
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
                                var notification = new Notification('Order Processed!', {
                                    body: data.pesan,
                                    icon: '/image/paw.png' // optional
                                });
                            }

                            // Otherwise, we need to ask the user for permission
                            else if (Notification.permission !== 'denied') {
                                Notification.requestPermission().then(function(permission) {
                                    // If the user accepts, let's create a notification
                                    if (permission === "granted") {
                                        var notification = new Notification('Order Proccessed!', {
                                            body: data.pesan,
                                            icon: '/image/paw.png' // optional
                                        });
                                    }
                                });
                            }

                            var notifDiv = document.querySelector('.notif2');
                            notifDiv.style.display = 'block';

                        });
                    </script>


                    <li>
                        <a href="{{ route('cart') }}">
                            @if ($cartCount > 0)
                                <p class="notif">{{ $cartCount }}</p>
                            @endif
                            <span class="material-icons-outlined"> shopping_cart </span>
                        </a>

                    </li>





                    <li>
                        <img src="/image/profile.png" class="profile" />

                        <ul>

                            @auth
                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                    <li class="sub-item">
                                        <span class="material-icons-outlined"> grid_view </span>
                                        <a href="/dashboard">Dashboard</a>
                                    </li>
                                @endif
                            @endauth

                            <li class="sub-item">
                                <span class="material-icons-outlined">
                                    format_list_bulleted
                                </span>
                                <a id="history-link">History Transaksi</a>
                            </li>

                            {{-- <li class="sub-item">
                                <span class="material-icons-outlined"> manage_accounts </span>
                                <a href="{{ route('profile.edit') }}">
                                    {{ __('Update Profile') }}
                                </a>
                            </li> --}}

                            <li class="sub-item">
                                <span class="material-icons-outlined"> logout </span>
                                <a href="#" onclick="myFunction()" class="logout">Logout</a>

                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                </form>

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
                                </form>
                            </li>

                        </ul>
                    </li>
                </ul>
            @else
                @if (Route::has('register'))
                    <a href="{{ route('login') }}" class="btn">Login</a>
                    <a href="{{ route('register') }}" class="btn">Register</a>
                @endif

            @endauth
        </div>
    @endif

</header>


 <!-- LOADING -->
 <div id="loading" style="display: none">
    <div class="cup">
        <div class="wave">
        </div>
        <img class="cup-image"
            src="/image/cup.png"
            alt="coffee cup">
        <div class="smoke">
            @foreach ([1, 2, 3] as $smoke)
                <div class="smoke__item"></div>
            @endforeach
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script>
    document.getElementById('history-link').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default action (navigation)
        document.getElementById('loading').style.display = 'block'; // Show the loading screen

        setTimeout(function() {
            document.getElementById('loading').style.display = 'none'; // Hide the loading screen
            window.location.href = '/history'; // Navigate to the history page
        }, 2000); // 3000 milliseconds = 3 seconds
    });
</script>