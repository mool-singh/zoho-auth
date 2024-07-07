<!DOCTYPE html>
<html lang="en-us">

<head>
	<meta charset="utf-8">
	<title><?=SITE_NAME?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">

	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
	<link rel="icon" href="images/favicon.png" type="image/x-icon">
  


	<!-- # Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?=base_url('assets')?>/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/toastr/toastr.min.css">
	<!-- # CSS Plugins -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

	<!-- # Custom Style Sheet -->
  <link rel="stylesheet" href="<?=base_url()?>/assets/css/custom.css">
  <script src="<?=base_url()?>assets/plugins/jquery/jquery.min.js"></script>
</head>


<body class="hold-transition sidebar-mini">

<div class="loader-container ">
    <div class="loader"></div>
</div>

<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php $this->load->view('includes/top-nav.php'); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $this->load->view('includes/sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1><?=@$title?></h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="card">
    


  
