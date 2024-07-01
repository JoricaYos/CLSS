<!doctype html>
<html lang="en">

<head>
	<title>Dashboard</title>
	<meta charset="utf-8">
	<link rel="icon" href="../../assets/smcc-logo.png" type="image/png">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

	<link rel="stylesheet" href="../../css/style.css">
	<link rel="stylesheet" href="../../css/table.css">
</head>

<body style="background-color: #EBF4F6">
	<div class="wrapper d-flex align-items-stretch">

		<!-- Sidebar hehe -->
		<?php include ($_SERVER['DOCUMENT_ROOT'] . '/views/includes/nav.php'); ?>
		<!-- Sidebar hehe -->

		<!-- Main Content diri hihi -->
		<div id="content" class="p-4 p-md-5 pt-5">
		<?php include '../includes/user-container.php'; ?>
		<div class="row mt-4">
		<div class="col-md-8">
		<h1 class="text-left">Hello <?php echo htmlspecialchars($_SESSION['name']); ?>,</h1>
		<p>This is what we've got for you today.</p>
</div>

</div>
		<br><br>
		<p class="dashboard-text">Semestral Schedules</p>
		<div class="row mt-4">
		<!-- First card -->
		<div class="col mb-4">
				<a href="#" class="card-link">
						<div class="card-custom">
								<div class="card-body">
										<p class="card-text">Computer<br>Laboratory 1</p>
										<h1 class="card-title">10</h1>
										<img src="../../assets/computer-one.png" alt="Pending Justification" class="card-image">
								</div>
						</div>
				</a>
		</div>

		<!-- Second card -->
		<div class="col mb-4">
				<a href="#" class="card-link">
						<div class="card-custom">
								<div class="card-body">
										<p class="card-text">Computer<br>Laboratory 2</p>
										<h1 class="card-title">13</h1>
										<img src="../../assets/computer-two.png" alt="Pending Assessments" class="card-image">
								</div>
						</div>
				</a>
		</div>

		<!-- Third card -->
		<div class="col mb-4">
				<a href="#" class="card-link">
						<div class="card-custom">
								<div class="card-body">
										<p class="card-text">Computer<br>Laboratory 3</p>
										<h1 class="card-title">28</h1>
										<img src="../../assets/computer-three.png" alt="Approved Assessments" class="card-image">
								</div>
						</div>
				</a>
		</div>
		
		<!-- Fourth card -->
		<div class="col mb-4">
				<a href="#" class="card-link">
						<div class="card-custom">
								<div class="card-body">
										<p class="card-text">Computer<br>Laboratory 4</p>
										<h1 class="card-title">28</h1>
										<img src="../../assets/computer-four.png" alt="Approved Assessments" class="card-image">
								</div>
						</div>
				</a>
		</div>
</div>

		<br>
		<p class="dashboard-text">Reservations</p>
		<div class="row mt-4">
		<!-- First card -->
		<div class="col mb-4">
				<a href="#" class="card-link">
						<div class="card-custom">
								<div class="card-body">
										<p class="card-text">Computer<br>Laboratory 1</p>
										<h1 class="card-title">10</h1>
										<img src="../../assets/reserve-one.png" alt="Pending Justification" class="card-image">
								</div>
						</div>
				</a>
		</div>

		<!-- Second card -->
		<div class="col mb-4">
				<a href="#" class="card-link">
						<div class="card-custom">
								<div class="card-body">
										<p class="card-text">Computer<br>Laboratory 2</p>
										<h1 class="card-title">13</h1>
										<img src="../../assets/reserve-two.png" alt="Pending Assessments" class="card-image">
								</div>
						</div>
				</a>
		</div>

		<!-- Third card -->
		<div class="col mb-4">
				<a href="#" class="card-link">
						<div class="card-custom">
								<div class="card-body">
										<p class="card-text">Computer<br>Laboratory 3</p>
										<h1 class="card-title">28</h1>
										<img src="../../assets/reserve-three.png" alt="Approved Assessments" class="card-image">
								</div>
						</div>
				</a>
		</div>
		
		<!-- Fourth card -->
		<div class="col mb-4">
				<a href="#" class="card-link">
						<div class="card-custom">
								<div class="card-body">
										<p class="card-text">Computer<br>Laboratory 4</p>
										<h1 class="card-title">28</h1>
										<img src="../../assets/reserve-four.png" alt="Approved Assessments" class="card-image">
								</div>
						</div>
				</a>
		</div>
</div>
		
</div>
	</div>
	<!-- Main Content diri hihi -->

	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script src="../../js/popper.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/main.js"></script>
	<script src="../../js/table.js"></script>
</body>

</html>