<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kopi Zero</title>

    <!-- SWIPER -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- Font Awesome CDN Link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Custom CSS File Link  -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/history.css">


    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

    @include('sweetalert::alert')

    <!-- HEADER -->
    @include('layouts.navigation')

    <!-- HISTORY -->
    <section class="history" id="history">

        @if ($orders->isEmpty())
            <a href="/" class="btn">No History, Back </a>
        @else
            @foreach ($orders as $order)
                <a href="
                @if ($order->status == 'Menunggu Pembayaran') {{ url('pembayaran') }}/{{ $order->no_order }}
                @else
                {{ url('detailhistory') }}/{{ $order->no_order }} @endif
                "
                    class="btn">
                    <div class="tgl-harga">
                        <p>#{{ $order->no_order }}</p>
                        <p>{{ $order->tgl_order }}</p>
                        <h1>Rp. {{ number_format($order->pembayarans->total_pembayaran, 0, ',', '.') }}</h1>
                    </div>
                    <div class="status">
                        @if ($order->status == 'Dibatalkan')
                            <h2 class="dibatalkan">Dibatalkan</h2>
                        @elseif ($order->status == 'Diterima')
                            <h2 class="diterima">Diterima</h2>
                        @elseif ($order->status == 'Menunggu Pembayaran')
                            <h2 class="diproses">Menunggu Pembayaran</h2>
                        @elseif ($order->status == 'Pending')
                            <h2 class="diproses">Pending</h2>
                        @else
                            <h2 class="diproses">Diproses</h2>
                        @endif
                    </div>
                </a>
            @endforeach
        @endif

    </section>




    <!-- SWIPER -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <!-- Custom JS File Link  -->
    <script src="js/script.js"></script>

    <!-- Custom JS File Link  -->
    <script>
        let menu = document.querySelector('#menu-btn');
        let navbar = document.querySelector('.navbar');

        menu.onclick = () => {
            menu.classList.toggle('fa-times');
            navbar.classList.toggle('active');
        };

        window.onscroll = () => {
            menu.classList.remove('fa-times');
            navbar.classList.remove('active');
        };

        document.querySelectorAll('.image-slider img').forEach(images => {
            images.onclick = () => {
                var src = images.getAttribute('src');
                document.querySelector('.main-home-image').src = src;
            };
        });

        var swiper = new Swiper(".review-slider", {
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            loop: true,
            grabCursor: true,
            autoplay: {
                delay: 7500,
                disableOnInteraction: false,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                }
            },
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>
