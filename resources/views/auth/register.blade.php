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
    <link rel="stylesheet" href="/css/login.css">


    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />


</head>

<body>
    <!-- HEADER -->
    @include('layouts.navigation')

    <div class="login-container">

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="img-container">
                <img src="/image/logo.png" alt="" width="40%">
            </div>

            <div class="input-container">

                <div class="label-container">
                    <label for="name">Nama</label>
                    <input id="name" type="text" name="name" class="box" placeholder="Nama"
                        value="{{ old('name') }}" @error('name') is-invalid @enderror>

                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                    <script>
                        @error('name')
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: '{{ $message }}',
                            });
                        @enderror
                    </script>
                </div>

                <div class="label-container">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" class="box" placeholder="Email"
                        value="{{ old('email') }}" @error('email') is-invalid @enderror>

                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                    <script>
                        @error('email')
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: '{{ $message }}',
                            });
                        @enderror
                    </script>
                </div>

                <div class="label-container">
                    <label for="no_telp">No Telepon</label>
                    <input id="no_telp" type="text" name="no_telp" class="box" placeholder="No Telepon"
                        value="{{ old('no_telp') }}" @error('no_telp') is-invalid @enderror>

                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                    <script>
                        @error('no_telp')
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: '{{ $message }}',
                            });
                        @enderror
                    </script>
                </div>

                <div class="label-container">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" class="box" placeholder="Password" required
                        autocomplete="current-password" @error('password') is-invalid @enderror>
                    <script>
                        @error('password')
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: '{{ $message }}',
                            });
                        @enderror
                    </script>
                </div>

                <div class="label-container">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="box" placeholder="Password" required
                        autocomplete="current-password" @error('password_confirmation') is-invalid @enderror>
                    <script>
                        @error('password_confirmation')
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: '{{ $message }}',
                            });
                        @enderror
                    </script>
                </div>



            </div>

            <div class="btn-container">
                <a href="{{ route('login') }}">Already Registered?</a>
                <button type="submit" class="btn">Register</button>
            </div>

        </form>

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
