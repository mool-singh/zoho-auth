</div>
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<footer class="main-footer">
   
    <strong><?=SITE_NAME?> &copy; 2014-<?=date('Y')?> 
  </footer>


  </div>

<!-- # JS Plugins -->
<script src="<?=base_url('assets/plugins/bootstrap/js/')?>bootstrap.bundle.min.js"></script>
<script src="<?=base_url('assets/dist/js/')?>adminlte.min.js"></script>
<script src="<?=base_url()?>assets/plugins/toastr/toastr.min.js"></script>

<!-- Main Script -->
<script src="<?=base_url()?>assets/js/custom.js"></script>



<?php if($this->session->flashdata('error')): ?>
	<script>
		$(document).ready(function(){
			toastr.error('<?= $this->session->flashdata('error')?>');
		})
		<?php  $this->session->unset_userdata('error'); ?>
	</script>
<?php endif; ?>


<?php if($this->session->flashdata('success')): ?>
	<script>
		$(document).ready(function(){
			toastr.success('<?= $this->session->flashdata('success')?>');
		})
		<?php  $this->session->unset_userdata('success'); ?>
	</script>
<?php endif; ?>


<?php if($this->session->flashdata('warning')): ?>
	<script>
		$(document).ready(function(){
			toastr.warning('<?= $this->session->flashdata('warning')?>');
		})
		<?php  $this->session->unset_userdata('warning'); ?>
	</script>
<?php endif; ?>

  



</body>
</html>
