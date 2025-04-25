<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="admin dashboard, admin template, analytics, bootstrap, bootstrap 5, bootstrap 5 admin template, job board admin, job portal admin,
	modern, responsive admin dashboard, sales dashboard, sass, ui kit, web app, frontent">
    <meta name="author" content="DexignLab">
    <meta name="robots" content="">
    <meta name="description" content="We proudly present a job portal, a job posting, and the bootstrap 5 admin & frontend HTML template, If you are a job expert and 
	would like to build a superb and top-notch website for your business or a posting center for jobs, then job admin is the best choice.">
    <meta property="og:title" content="Jobick : Job Admin Dashboard Bootstrap 5 Template + FrontEnd">
    <meta property="og:description" content="We proudly present a job portal, a job posting, and the bootstrap 5 admin & frontend HTML template, If you are a job expert 
	and would like to build a superb and top-notch website for your business or a posting center for jobs, then job admin is the best choice.">
    <meta property="og:image" content="https://Jobick.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Jobick : Job Admin Dashboard Bootstrap 5 Template + FrontEnd</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">

    <!-- Stylesheet -->
    <link href="{{ asset('frontend/assets/vendor/animate/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link class="skin" rel="stylesheet" href="{{ asset('frontend/assets/css/skin/skin-1.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>

<body id="bg">

    <!--loader start -->
    <div id="loading-area" class="loading-page-1">
        <div class="loader">
            <div class="ball one"></div>
            <div class="ball two"></div>
            <div class="ball three"></div>
            <div class="ball four"></div>
        </div>
    </div>
    <!--loader start -->

    <div class="page-wraper">

        <div class="page-content">
            <!-- Banner  -->

            <!-- Banner End -->

            <!-- Map Iframe -->
            <section class="map-wrapper1 overflow-hidden  content-inner">
                <!-- Vérifier si un message d'erreur est présent dans la session -->

                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-xl-8 col-lg-8 col-sm-12 m-b30 offset-xl-2 offset-lg-2">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                     
                            <div class="form-wrapper style-1">
                                <h2 class="title m-a0 wow ">Formulaire de candidature</h2>
                                <p class="font-text text-primary p-b10 wow ">NB:Assurez vous que vous informations soient correctes et que les fichiers <br>à télécharger soit en PDF</p>
                                <div class="contact-area">
                                    <form action="{{ route('candidature.inscrire') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                        @csrf

                                        <!-- ID de l'offre caché -->
                                        <input type="hidden" name="offre_id" value="{{ $offre_id }}">

                                        <!-- Prénom -->
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Prénom :</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                                            <div class="invalid-feedback">
                                                Veuillez entrer votre prénom.
                                            </div>
                                        </div>

                                        <!-- Nom -->
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Nom :</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                                            <div class="invalid-feedback">
                                                Veuillez entrer votre nom.
                                            </div>
                                        </div>

                                        <!-- Téléphone -->
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Téléphone :</label>
                                            <input type="text" class="form-control" id="phone" name="phone" required>
                                            <div class="invalid-feedback">
                                                Veuillez entrer votre numéro de téléphone.
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email :</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                            <div class="invalid-feedback">
                                                Veuillez entrer votre adresse email valide.
                                            </div>
                                        </div>

                                        <!-- CV -->
                                        <div class="mb-3">
                                            <label for="cv" class="form-label">CV :</label>
                                            <input type="file" class="form-control" id="cv" name="cv" required>
                                            <div class="invalid-feedback">
                                                Veuillez télécharger votre CV.
                                            </div>
                                        </div>

                                        <!-- Autre document (optionnel) -->
                                        <div class="mb-3">
                                            <label for="autre_document" class="form-label">Autre document (optionnel) :</label>
                                            <input type="file" class="form-control" id="autre_document" name="autre_document">
                                        </div>

                                        <!-- Bouton soumettre -->
                                        <button type="submit" class="btn btn-primary">S'inscrire et Postuler</button>
                                    </form>


                                    <script>
                                        // Bootstrap validation script
                                        (function() {
                                            'use strict'
                                            var forms = document.querySelectorAll('.needs-validation')
                                            Array.prototype.slice.call(forms).forEach(function(form) {
                                                form.addEventListener('submit', function(event) {
                                                    if (!form.checkValidity()) {
                                                        event.preventDefault()
                                                        event.stopPropagation()
                                                    }
                                                    form.classList.add('was-validated')
                                                }, false)
                                            })
                                        })()
                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Map Iframe End -->

        </div>
    </div>

    <button class="scroltop icon-up" type="button"><i class="fas fa-arrow-up"></i></button>

    </div>
    <!-- JAVASCRIPT FILES ========================================= -->
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script><!-- JQUERY.MIN JS -->
    <script src="{{ asset('frontend/assets/vendor/wow/wow.js') }}"></script><!-- WOW.JS -->
    <script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script><!-- OWL silder -->
    <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script><!-- WOW.JS -->
    <script src="{{ asset('frontend/assets/vendor/magnific-popup/magnific-popup.js') }}"></script><!-- OWL SLIDER -->
    <script src="{{ asset('frontend/assets/js/dz.carousel.js') }}"></script><!-- OWL SLIDER -->
    <script src="{{ asset('frontend/assets/js/dz.ajax.js') }}"></script><!-- AJAX -->
    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script><!-- CUSTOM JS -->
</body>

</html>