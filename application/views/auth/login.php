<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<div class="card card-outline card-success">
    <div class="card-header text-center">
      <a href="<?=base_url()?>" class="h1"><b><?=SITE_NAME?></b></a>
    </div>
    <div class="card-body">
      <h4 class="login-box-msg text-uppercase"> <b>Login</b> </h4>

      <form id="loginForm" action="" method="post">
			<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

			<div class="form-group mb-3">
			<input r type="text" autocomplete="off" name="email" id="email" class="form-control" placeholder="Email">
			
			</div>
			<div class="form-group mb-3">
			<input type="password" name="password" id="password" class="form-control" placeholder="Password">
			
			</div>
			<div class="row">
			
			

			<div class="col-12">

			

			<button id="submit-btn" class="btn btn-success w-100 mb-3" type="submit">
										Login
									</button>

			</div>

			
       
       
			
			</div>

      </form>
    </div>
    <!-- /.card-body -->
  </div>




  <script >

$(document).ready(function()
{
	$("#loginForm").validate({
		rules: {
			email:{
				required:true,
			},
			password:{
				required:true,
			}
		},
		submitHandler:function(form)
		{
			submitForm();
		}
	})
})


function submitForm()
{
	let form_data = $("#loginForm").serializeArray();
	showLoader();
	$.ajax({
		type:"POST",
		data:form_data,
		success:function(reponse)
		{
			let response = JSON.parse(reponse);

			if(response.status)
			{
				toastr.success(response.msg);
				$("#contactForm").trigger('reset');
				
				setTimeout(() => {
					window.location.href = '<?=base_url('dashboard')?>';
				}, 2000);
			}
			else
			{
				toastr.error(response.msg);
				if(response.errors)
				{
					const errors = response.errors;
					for (const key in errors) {
						if (errors.hasOwnProperty(key))
						{
							$("#"+key+'-error').remove();
							$("#"+key).after('<label id="'+key+'-error" class="error" for="'+key+'">'+errors[key]+'</label>');
						}
					}
				}
			}
		},
		error:function(reponse)
		{
			toastr.error("Unable to login, Please reload and try again");
		},
		complete:function()
		{
			hideLoader();
			$("#submit-btn").html('Login');
			$("#submit-btn").attr('disabled',false);
		},
		beforeSend:function()
		{
			$("#submit-btn").attr('disabled',true);
			$("#submit-btn").html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Submitting...');
		}
		
	})
}




</script>