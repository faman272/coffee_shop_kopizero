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
    <link rel="stylesheet" href="/css/checkout.css">


    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />


</head>

<body>

    @include('sweetalert::alert')

    <!-- HEADER -->
    @include('layouts.navigation')


    <!-- Detail -->
    <div class="book" id="book" method="POST">
        <div class="pembayaran">
            <h1>Transaksi</h1>

            <span class="box">Detail Transaksi :</span>

            <div class="box">
                <span>ID Transaksi :</span>
                <p>#{{ $order->no_order }}</p>
            </div>

            <div class="box">
                <span>Status :</span>
                <p>{{ $order->status }}</p>
            </div>

            <div class="box">
                <span>Tanggal Transaksi :</span>
                <p>{{ $order->tgl_order }}</p>
            </div>

            <div class="accordion">
                <span>Menu Yang Dibeli :</span>
            </div>
            {{-- Panel Accordion --}}
            <div class="panel">
                {{-- List Menu purchased --}}
                @foreach ($order->detail_orders as $detail)
                    <div class="box">
                        <span>{{ $detail->menus->nama_menu }}</span>
                        <span>Rp.{{ $detail->harga }} ({{ $detail->jenis_harga }}) X{{ $detail->qty }}</span>
                    </div>
                @endforeach
            </div>
            <span class="box">Informasi Pembayaran : </span>
            <div class="box">
                <span>Nama :</span>
                <p> {{ Auth::user()->name }}</p>
            </div>

            <div class="box">
                <span>No. Hp :</span>
                <p>{{ Auth::user()->no_telp }}</p>
            </div>
            <div class="box">
                <span>No. Meja :</span>
                <p>{{ $order->nomor_meja }}</p>
            </div>

            <div class="accordion">
                <span>Catatan :</span>
            </div>
            {{-- Panel Accordion --}}
            <div class="panel">
                {{-- List Menu purchased --}}
                <div class="box">
                    <p>{{ $order->catatan }}</p>
                </div>

            </div>

            <div class="box">
                <span>Metode Pembayaran :</span>
                <p>{{ $order->metode_pembayaran->nama_metode }}</p>
            </div>

            @if ($order->metode_pembayaran_id != 3 && $order->status !== 'Dibatalkan')
                <div class="box">
                    <span>Bukti Transaksi :</span>
                    <a href="#" class="btn" id="view">View</a>
                </div>
            @endif



            <a href="/history" class="btn">Back</a>


        </div>
    </div>


    <!-- SWIPER -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <!-- Custom JS File Link  -->
    <script src="js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }


        $(document).ready(function() {
            $('#view').on('click', function(e) {
                e.preventDefault();

                var imageUrl =
                    '{{ asset('storage/bukti_pembayaran/' . $order->pembayarans->bukti_pembayaran) }}'; // Replace with the actual image URL

                Swal.fire({
                    imageUrl: imageUrl,
                    imageAlt: 'Image',
                })
            });
        });
    </script>

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
</body>

</html>
