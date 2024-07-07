<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<div class="card-body">

		<div class="row">

			<div class="col-lg-3 col-6">
				<!-- small box -->
				<a href="<?=base_url('invoices')?>" class="small-box-footer">
				<div class="small-box bg-info">
				<div class="inner">
					<h3><?=$invoices?></h3>

					<p>Invoices</p>
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
				</div></a>
			</div>
		
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-<?=$token_status ? 'success' :'danger' ?>">
				<div class="inner">
					<h3><?=$token_status ? 'Valid' : 'Expired'?> <a title="Grant Permission" class="fs-6 fw-light text-light" href="<?=base_url('request-token')?>"><small class="fs-6 fw-normal fa fa-arrows-rotate"></small></a> </h3>

					<p>Token Status  </p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
				
				</div>
			</div>

        </div>

</div>