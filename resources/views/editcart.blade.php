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
    <link rel="stylesheet" href="/css/detail.css">


    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />


</head>

<body>
    <!-- HEADER -->
    @include('layouts.navigation')

    <div class="box-detail">
        <div class="container-detail">
            <img src="/image/menu-img.png" alt="">


            <fieldset>
                <h1>{{ $cartItem->menu->nama_menu }}</h1>
                <form action="{{ url('/cart/update/' . $cartItem->id_keranjang) }}" method="POST">
                    @csrf
                    <input type="hidden" name="menu_id" value="{{ $cartItem->menu->id_menu }}">

                    <div class="radio-item-container">
                        @if ($cartItem->menu->H_Hot > 0)
                            <div class="radio-item">
                                <label for="hot">
                                    <input type="radio" id="hot" name="jenis_harga" value="hot"
                                        {{ $cartItem->harga == $cartItem->menu->H_Hot ? 'checked' : '' }}>
                                    <span>Hot : Rp. {{ number_format($cartItem->menu->H_Hot, 0, ',', '.') }}</span>
                                </label>
                            </div>
                        @endif

                        @if ($cartItem->menu->H_Ice > 0)
                            <div class="radio-item">
                                <label for="ice">
                                    <input type="radio" id="ice" name="jenis_harga" value="ice"
                                        {{ $cartItem->harga == $cartItem->menu->H_Ice ? 'checked' : '' }}>
                                    <span>Ice : Rp. {{ number_format($cartItem->menu->H_Ice, 0, ',', '.') }}</span>
                                </label>
                            </div>
                        @endif
                    </div>


                    <div class="desc-container">
                        <h2>Deskripsi : </h2>
                        <p>{{ $cartItem->menu->deskripsi }}</p>
                    </div>
                    <div class="quantity-container">
                        <h2>Qty : </h2>
                        <input type="number" id="quantity" name="quantity" min="1"
                            value="{{ $cartItem->qty }}">
                    </div>
                    <div class="btn-container">
                        <a href="/cart" class="btn">Back</a>
                        <button type="submit" class="btn">Update</button>
                    </div>
                </form>
            </fieldset>
        </div>

    </div>


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
