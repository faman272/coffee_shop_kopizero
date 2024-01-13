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
    <link rel="stylesheet" href="/css/email.css">

    {{-- favicon --}}
    <link rel="shortcut icon" href="/image/paw.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />


</head>

<body>
    <!-- HEADER -->
    @include('layouts.navigation')

    <div class="email-container">
        <img src="/image/email.png" alt="" width="10%">
        <span>Verify your email to finish signing up</span>
        <div class="message">
            <br>
            <p>
                Thank You for choosing Kopi Zero
            </p>
            <br>
            <p style="text-transform:none;">
                We have sent an email verification to
                <b style="text-transform:none;">{{ Auth::user()->email }}</b>
                please confirm your email address to continue
            </p>
            <br>
            <p style="text-transform:none;">
                Didn't receive the email? check your spam folder or 
            </p>
            <form method="POST" action="{{ route('verification.send') }}" id="resend-verification">
                @csrf
                <button class="btn" type="submit">Resend Verification</button>
            </form>

            <script>
                $(document).ready(function() {
                    $('#resend-verification').on('submit', function(e) {
                        e.preventDefault();

                        $.ajax({
                            type: $(this).attr('method'),
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            success: function() {
                                Swal.fire(
                                    'Sent!',
                                    'The verification email has been resent.',
                                    'success'
                                );
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'There was a problem resending the verification email.',
                                    'error'
                                );
                            }
                        });
                    });
                });
            </script>

        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>
