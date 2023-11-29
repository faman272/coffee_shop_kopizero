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


    <!-- BOOK -->

    <form action="{{ url('pembayaran') }}/{{ $order->no_order }}" class="book" id="book" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="pembayaran">
            <h1>Pembayaran</h1>

            {{-- <div class="clock-container">
                <div id="clockdiv">
                    <div><span class="minutes"></span>
                    </div>
                    <div><span class="seconds"></span>
                    </div>
                </div>
            </div> --}}

            {{-- <script>
                var countdownElementMinutes = document.querySelector('#clockdiv .minutes');
                var countdownElementSeconds = document.querySelector('#clockdiv .seconds');
                var timeRemaining = 10 * 60;

                var countdown = setInterval(function() {
                    timeRemaining--;
                    var minutes = Math.floor(timeRemaining / 60);
                    var seconds = timeRemaining % 60;

                    countdownElementMinutes.textContent = minutes < 10 ? '0' + minutes : minutes;
                    countdownElementSeconds.textContent = seconds < 10 ? '0' + seconds : seconds;

                    if (timeRemaining <= 0) {
                        clearInterval(countdown);
                    }
                }, 1000);
            </script> --}}


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
                <p>{{ date('d M Y H:i', strtotime($order->tgl_order)) }}</p>
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
                <p>{{ Auth::user()->name }}</p>
            </div>

            <div class="box">
                <span>No. Hp :</span>
                <p>{{ Auth::user()->no_telp }}</p>
            </div>
            <div class="box">
                <span>No. Meja :</span>
                <p>
                    @if ($order->nomor_meja == 0)
                        Tanpa Meja
                    @else
                        {{ $order->nomor_meja }}
                    @endif
                </p>
            </div>

            <div class="accordion">
                <span>Catatan :</span>
            </div>
            {{-- Panel Accordion --}}
            <div class="panel">
                {{-- List Menu purchased --}}
                <div class="box">
                    <p>{{ $order->catatan }} </p>
                </div>

            </div>


            <div class="transaksi">
                @if ($order->metode_pembayaran_id === 1)
                    <p>* Silahkan Transfer sebesar <span>Rp.{{ number_format($total, 0, ',', '.') }}</span> Pada Kode
                        Rekening ini: </p>
                    <img src="/image/logo-mandiri.png" alt="" width="40%" class="qris">
                    <p>A/N GEBOY DONNY AURORA S</p>
                    <p>Bank Mandiri</p>
                    <h1>1070016020127</h1>
                @elseif($order->metode_pembayaran_id === 2)
                    <p>* Silahkan Melakukan Pembayaran sebesar <span>Rp.{{ number_format($total, 0, ',', '.') }}</span>
                        Pada Kode QRIS ini: </p>
                    <img src="/image/qris.png" alt="" width="40%" class="qris">
                    <a href="#" class="btn">Download</a>
                    <p>QR ini bisa di scan untuk :</p>
                    <img src="/image/qris-sup.png" alt="" class="qris-sup">
                @else
                    <p>* Silahkan Klik tombol Bayar, dan Bayar sebesar
                        <span>Rp.{{ number_format($total, 0, ',', '.') }}</span> Pada Kasir
                    </p>
                @endif
            </div>

            {{-- Cekkk kalo cash ini tidak tampil --}}
            @if ($order->metode_pembayaran_id !== 3)
                <div class="box">
                    <span>Upload Bukti Transaksi :</span>
                    <input type="file" id="bukti_pembayaran" name="bukti_pembayaran">
                </div>
            @endif

            @if ($order->metode_pembayaran_id === 3)
                <input type="hidden" name="cash" id="cash" value="Pending">
            @endif

            <div class="btn-pembayaran">
                <button type="button" class="btn" id="cancel-button">Batalkan Pesanan</button>
                <button id="payment-button" type="button" class="btn">Bayar</button>
            </div>
        </div>
    </form>

    <form action="{{ url('pembayaran/cancel/' . $order->no_order) }}" method="POST" id="cancel-form">
        @csrf
        <input type="hidden" id="status_cancel" name="status_cancel" value="Dibatalkan">
    </form>



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


        document.getElementById('payment-button').addEventListener('click', function(e) {
            e.preventDefault();

            swal({
                    text: "Apakah anda yakin ingin membayar pesanan?",
                    icon: "info",
                    buttons: true,
                })
                .then((willPay) => {
                    if (willPay) {
                        // Show the loading screen
                        document.getElementById('loading').style.display = 'block';

                        // Wait for 3 seconds
                        setTimeout(function() {
                            // Hide the loading screen
                            document.getElementById('loading').style.display = 'none';

                            // Submit the form
                            document.getElementById('book').submit();
                        }, 3000); // 3000 milliseconds = 3 seconds
                    }
                });
        });


        document.getElementById('cancel-button').addEventListener('click', function(e) {
            e.preventDefault();

            swal({
                    title: "Apakah anda yakin untuk membatalkan pesanan?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willCancel) => {
                    if (willCancel) {
                        // Submit the form
                        document.getElementById('cancel-form').submit();
                    }
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
