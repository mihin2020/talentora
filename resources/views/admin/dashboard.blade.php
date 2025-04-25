@extends('admin.layouts.main')
@section('content')


<!--**********************************
        Main wrapper start
    ***********************************-->
<div id="main-wrapper">

	<!--**********************************
            Nav header start
        ***********************************-->

	<!--**********************************
            Nav header end
        ***********************************-->
	<div class="nav-header">
		@include('admin.components.logo')
		@include('admin.components.header')
	</div>
	<!--**********************************
            Sidebar start
        ***********************************-->
	@include('admin.components.sidebar')
	<!--**********************************
            Sidebar end
        ***********************************-->

	<!--**********************************
            Content body start
        ***********************************-->
	<div class="content-body">
		<!-- row -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="row">
						<div class="col-xl-12">
							<div class="card" id="user-activity1">
								<div class="card-header border-0 pb-0">
									<h4 class="fs-20 mb-0">Nombre de candidatures par offre</h4>
								</div>
								<div class="card-body">
									<canvas id="candidaturesChart" class="chartjs"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('admin.components.footer')
</div>

@endsection


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		const ctx = document.getElementById('candidaturesChart').getContext('2d');

		const chart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: {
					!!json_encode($labels) !!
				},
				datasets: [{
					label: 'Nombre de candidatures',
					data: {
						!!json_encode($data) !!
					},
					backgroundColor: '#0d6efd',
					borderRadius: 5,
				}]
			},
			options: {
				responsive: true,
				plugins: {
					legend: {
						display: false
					},
					title: {
						display: true,
						text: 'Candidatures par offre'
					}
				},
				scales: {
					x: {
						ticks: {
							autoSkip: false,
							maxRotation: 45,
							minRotation: 0
						}
					},
					y: {
						beginAtZero: true
					}
				}
			}
		});
	});
</script>