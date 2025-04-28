<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="Royal conception">
	<meta name="robots" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="keywords" content="Talentora, ATS, logiciel de recrutement, gestion des candidatures, recrutement automatisé, sourcing CV, outil RH, suivi des candidats, recrutement efficace, plateforme de recrutement, talents, employabilité, filtrage CV, analyse de profils, optimisation recrutement">
	<meta name="description" content="Talentora est une application web ATS innovant pour simplifier et optimiser votre recrutement. Gérez vos candidatures, automatisez le sourcing, analysez les profils et recrutez les meilleurs talents avec une plateforme intuitive et puissante. Découvrez une solution RH adaptée aux entreprises et cabinets de recrutement.">
	<meta property="og:description" content="🚀 Talentora révolutionne le recrutement avec son ATS intelligent ! Automatisez le sourcing, gérez vos candidatures en un clic et identifiez les meilleurs talents grâce à l'IA. La solution tout-en-un pour les RH et recruteurs. Essayez gratuitement !">

	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Page Title -->
	<title>Talentora : Plateforme ATS | Gestion de Recrutement </title>

	<!-- Favicon icon -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png">

	<!-- All StyleSheet -->
	<link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">

	@section('styles')
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

	<!-- Globle CSS -->
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	@livewireStyles
</head>

<body>

	@yield('content')

	@livewireScripts

</body>

</html>


<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{ asset('vendor/global/global.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>

<!-- Apex Chart -->
<script src="{{ asset('vendor/apexchart/apexchart.js') }}"></script>
<script src="{{ asset('vendor/chartjs/chart.bundle.min.js') }}"></script>

<!-- Chart piety plugin files -->
<script src="{{ asset('vendor/peity/jquery.peity.min.js') }}"></script>

<!-- Dashboard 1 -->
<script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>

<script src="{{ asset('vendor/owl-carousel/owl.carousel.js') }}"></script>

<script src="{{ asset('js/custom.min.js') }}"></script>
<script src="{{ asset('js/dlabnav-init.js') }}"></script>
<!-- Datatable -->
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>

<!-- pour les alertes -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	function JobickCarousel() {

		/*  testimonial one function by = owl.carousel.js */
		jQuery('.front-view-slider').owlCarousel({
			loop: false,
			margin: 30,
			nav: true,
			autoplaySpeed: 3000,
			navSpeed: 3000,
			autoWidth: true,
			paginationSpeed: 3000,
			slideSpeed: 3000,
			smartSpeed: 3000,
			autoplay: false,
			animateOut: 'fadeOut',
			dots: true,
			navText: ['', ''],
			responsive: {
				0: {
					items: 1,

					margin: 10
				},

				480: {
					items: 1
				},

				767: {
					items: 3
				},
				1750: {
					items: 3
				}
			}
		})
	}

	jQuery(window).on('load', function() {
		setTimeout(function() {
			JobickCarousel();
		}, 1000);
	});
</script>