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


        @if ($offre->status !== 'publie')
        <section class="content-inner position-relative">
            <div class="container text-center py-5">
                <h2 class="text-danger">Offre non publiée</h2>
                <p>Cette offre n'est pas encore disponible pour le public.</p>
            </div>
        </section>
        @elseif (\Carbon\Carbon::now()->greaterThan(\Carbon\Carbon::parse($offre->deadline)))
        <section class="content-inner position-relative">
            <div class="container text-center py-5">
                <h2 class="text-danger">Offre expirée</h2>
                <p>Cette offre n'est plus disponible car elle a expiré.</p>
            </div>
        </section>
        @else
        <div class="page-content">

            <!-- Blog Details -->
            <section class="content-inner position-relative">
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <div class="container">
                    <div class="row ">
                        <div class="col-xl-8 col-lg-8 m-b30">
                            <div class="blog-single pt-20 sidebar dz-card">
                                <div class="dz-info m-b30">
                                    <div class="job-detail-content">
                                        <h3 class="dz-title">{{ $offre->title }}</h3>
                                        <p class="job-address">
                                            @if(!empty($offre->city))
                                            <i class="fa-solid fa-city text-primary"></i>{{ $offre->city }}
                                            @endif

                                            @if(!empty($offre->localisation))
                                            <i class="text-primary fas fa-map-marker-alt me-2"></i>{{ $offre->localisation }}
                                            @endif
                                            @if(!empty($offre->contrat) && !empty($offre->contrat->name))
                                            <i class="text-primary fas fa-briefcase me-2"></i>{{ $offre->contrat->name }}
                                            @endif
                                        </p>
                                        <div class="income">
                                            @if(!empty($offre->salaire))
                                            <div class="jobs-amount">
                                                <i class="fas fa-money-bill-wave text-primary"></i> {{ $offre->salaire }}
                                            </div>
                                            @endif
                                            @php
                                            $deadline = \Carbon\Carbon::parse($offre->deadline)->locale('fr');
                                            @endphp

                                            <div class="apllication-area">
                                                Date d'expiration :
                                                <span class="apllication-date">
                                                    {{ $deadline->translatedFormat('d F Y') }}
                                                </span>
                                                <div>
                                                    @if ($deadline->isFuture())
                                                    <div class="text-success mt-2">
                                                        Il reste {{ $deadline->diffInDays(now()) }} jour(s) avant expiration
                                                    </div>
                                                    @else
                                                    <div class="text-danger mt-2">
                                                        Offre expirée
                                                    </div>
                                                    @endif

                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="dz-post-text">
                                        <h4 class="title"> Description:</h4>
                                        <p>
                                            {!! $offre->description !!}
                                        </p>

                                        @if(!empty($offre->skills))
                                        <h4 class="title">Compétences:</h4>
                                        <p>
                                            {!! $offre->skills !!}
                                        </p>
                                        @endif


                                        @if(!empty($offre->experience))
                                        <h4 class="title">Experience:</h4>
                                        <p>
                                            {!! $offre->experience !!}
                                        </p>
                                        @endif

                                        @if(!empty($offre->formation))
                                        <h4 class="title">Formations:</h4>
                                        <p>
                                            {!! $offre->formation !!}
                                        </p>
                                        @endif

                                        @if(!empty($offre->mission))
                                        <h4 class="title">Missions:</h4>
                                        <p>
                                            {!! $offre->mission !!}
                                        </p>
                                        @endif


                                        @if(!empty($offre->objective))
                                        <h4 class="title">Objectifs:</h4>
                                        <p>
                                            {!! $offre->objective !!}
                                        </p>
                                        @endif


                                        @if(!empty($offre->otherInformation))
                                        <h4 class="title">Autres Informations:</h4>
                                        <p>
                                            {!! $offre->otherInformation !!}
                                        </p>
                                        @endif
                                    </div>


                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('candidature.form',$offre->id) }}" class="btn btn-success">Postuler</a>
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-4 col-lg-4">
                            <aside class="side-bar sticky-top right ">

                                <div class="widget-title">
                                    <h4 class="title">Resumé de l'offre</h4>
                                </div>

                                <div class="widget widget_categories style-2">
                                    <ul>
                                        <li>
                                            <div class="info-inner">
                                                <i class="fas fa-calendar-alt"></i>
                                                <span class="title">Date du poste</span>
                                                <div class="info-discription">{{ $offre->publicationDate }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="info-inner">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span class="title">Lieu de travail</span>
                                                <div class="info-discription">{{ $offre->localisation }}</div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="info-inner">
                                                <i class="fas fa-money-bill-wave"></i>
                                                <span class="title">Salaire</span>
                                                <div class="info-discription">
                                                    <span class="badge bg-primary">{{ $offre->salaire ?? 'Non défini' }}</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            @if(!empty($offre->fiche))
                                            <a href="{{ route('telecharger.fiche', $offre->id) }}" class="btn btn-primary" target="_blank">Télécharger l'offre</a>
                                            @else
                                            <span class="text-muted">Aucun fichier disponible</span>
                                            @endif

                                        </li>
                                </div>
                                </li>
                                </ul>

                                <div>
                                    <h3>Informations sur l'entreprise</h3>
                                    @if($profilEntreprise)
                                    <p><strong>Nom de l'entreprise :</strong> {{ $profilEntreprise->user->firstname }}</p>

                                    <p><strong>Secteur d'activité :</strong> {{ $profilEntreprise->secteur_activite ?? 'Non renseigné' }}</p>
                                    <p><strong>Description :</strong> {{ $profilEntreprise->description ?? 'Non renseigné' }}</p>
                                    @else
                                    <p>Aucun profil d'entreprise trouvé.</p>
                                    @endif
                                </div>

                            </aside>

                        </div>
                    </div>
                </div>
        </div>
        </section>
        <!-- Blog Details -->
    </div>
    @endif
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