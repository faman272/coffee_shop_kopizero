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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/checkout.css">


    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />


</head>

<body>
    <!-- HEADER -->
    @include('layouts.navigation')

    @include('sweetalert::alert')

    <!-- LOADING -->
    <div id="loading" style="display: none">
        <div class="cup">
            <div class="wave">
                <svg viewBox="0 0 500 500">
                    <path class="wave__path" d="M0,100 C150,200 350,0 500,100 L500,00 L0,0 Z"></path>
                </svg>
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

    <!-- BOOK -->
    <section class="book" id="book">

        @foreach ($orders as $order)
            <form action="{{ url('checkout') }}/{{ $order->no_order }}" class="form-checkout" method="POST"
                id="checkout-form">
                @csrf
                <h1 class="heading">Cart <span>Checkout</span></h1>
                <input type="text" class="box" value="{{ Auth::user()->name }}" disabled>

                <input type="email" class="box" value="{{ Auth::user()->email }}" disabled>

                <input type="number" class="box" value="{{ Auth::user()->no_telp }}" disabled>

                <input type="hidden" id="kode_transaksi" name="kode_transaksi" value="{{ $order->no_order }}">
                {{-- <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}"> --}}

                <select name="nomor_meja" id="nomor_meja" class="box">
                    <option value="" selected="selected">---Pilihan Meja---</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="">Tanpa Meja</option>
                </select>

                <textarea name="catatan" placeholder="Catatan Pesanan" class="box" id="catatan"></textarea>

                <h2>Metode Pembayaran : </h2>
                <div class="metode-pembayaran">
                    <label>
                        <input type="radio" name="metode_pembayaran" value="3">
                        Cash
                    </label>

                    <label>
                        <input type="radio" name="metode_pembayaran" value="1">
                        Bank Mandiri
                    </label>

                    <label>
                        <input type="radio" name="metode_pembayaran" value="2">
                        QRIS
                    </label>

                </div>

                <h2>Total Pembayaran</h2>
                <h1>Rp. {{ number_format($total, 0, ',', '.') }}</h1>
                <input type="hidden" name="total" id="total" value="{{ $total }}">

                <div class="btn-checkout">
                    <a href="/cart" class="btn">Back</a>
                    <button id="checkout-button" type="button" class="btn"
                    onclick=""
                    >Checkout Sekarang</button>
                </div>
            </form>
        @endforeach
    </section>


    <script>
        document.getElementById('checkout-button').addEventListener('click', function(e) {
            e.preventDefault();

            swal({
                    title: "Apakah anda yakin?",
                    text: "Checkout dan menuju pembayaran",
                    icon: "info",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willCheckout) => {
                    if (willCheckout) {
                        // Show the loading screen
                        document.getElementById('loading').style.display = 'block';

                        // Wait for 3 seconds
                        setTimeout(function() {
                            // Hide the loading screen
                            document.getElementById('loading').style.display = 'none';

                            // Submit the form
                            document.getElementById('checkout-form').submit();
                        }, 4000); // 3000 milliseconds = 3 seconds
                    }
                });
        });
    </script>
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
