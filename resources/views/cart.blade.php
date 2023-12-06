<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kopi Zero</title>

    <link rel="icon" href="/image/paw-img.png">


    <!-- SWIPER -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- Font Awesome CDN Link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Custom CSS File Link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">


    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />


</head>

<body>
    @include('sweetalert::alert')
    <!-- HEADER -->
    @include('layouts.navigation')

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

    <section class="cart" id="cart">>
        <h1>Keranjang</h1>
        <div class="active-state">
            <a href="/" class="active-home">
                <span class="material-symbols-outlined">
                    home
                </span>
                Home
            </a>
            <span> > </span>
            <a href="">Cart</a>
        </div>
        <div class="table-container">
            @if ($cartItems && count($cartItems) > 0)
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Menu</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>SubTotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($cartItems as $item)
                            <tr>
                                <td>
                                    <img src="/image/menu-img.png" alt="">
                                </td>

                                <td>{{ $item->menu->nama_menu }}</td>

                                <td>{{ $item->qty }}</td>
                                <td>Rp. {{ number_format($item->harga, 0, ',', '.') }}
                                    ({{ $item->jenis_harga }})
                                </td>
                                <td>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                <td>
                                    <div class="btn-action">
                                        <a href="{{ url('editcart') }}/{{ $item->id_keranjang }}" class="btn">
                                            <span class="material-symbols-outlined">
                                                edit
                                            </span>
                                        </a>
                                        <form action="{{ route('cart.delete', $item->id_keranjang) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn">
                                                <span class="material-symbols-outlined">
                                                    delete
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="4" style="text-align: right"> Total Belanja</td>
                            <td colspan="2" style="text-align: left">
                                <h3>
                                    Rp. {{ number_format($total, 0, ',', '.') }}
                                </h3>
                            </td>
                        </tr>
                    </tbody>

                </table>

        </div>
        <div class="button-container">
            <a href="/" class="btn">Kembali ke menu awal</a>
            <form action="{{ route('checkout.store') }}" method="POST" id="my-form">
                @csrf
                <!-- Add your form fields here -->
                <button type="submit" class="btn" id="submit-button">Checkout</button>
            </form>
        </div>
    @else
        <div class="empty-cart">
            <h1>Your cart is empty. <a href="/" class="btn">Go back to the menu</a></h1>
        </div>
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
    <script>
        document.getElementById('submit-button').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the form submission
            document.getElementById('loading').style.display = 'block'; // Show the loading screen

            setTimeout(function() {
                document.getElementById('loading').style.display = 'none'; // Hide the loading screen
                document.getElementById('my-form').submit(); // Submit the form
            }, 3000); // 3000 milliseconds = 3 seconds
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>
