<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link rel="stylesheet" href="<?=base_url('assets/plugins/datatables-custom/datatables.min.css')?>">

<div class="card-header d-flex justify-content-between">
	<h4 class="mb-0">Invoices</h4>
	<div class="buttons">
		<button type="button" onclick="sync(this)" class="btn btn-sm btn-primary"> Sync Invoices</button>
	</div>
</div>
<div class="card-body">

	<div class="table-responsive">
		<table class="table table-striped" id="datatable">
			<thead>
				<tr>
					<th>S.no</th>
					<th>Invoice No</th>
					<th>Customer</th>
					<th>Date</th>
					<th>Due Date</th>
					<th>Status</th>
					<th>Amount</th>
					<th>Customer Contact</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>

</div>


<!-- Items modal -->

<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="invoiceModalLabel">Invoice Items</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script src="<?=base_url('assets/plugins/datatables-custom/datatables.min.js')?>"></script>
<script>
  //---------------------------------------------------
  var table = $('#datatable').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "",
    "order": [[0,'desc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true}, 
    { "targets": 1, "name": "invoice_no", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "customer_name", 'searchable':true, 'orderable':true},
    { "targets": 3, "name": "date", 'searchable':true, 'orderable':true},
    { "targets": 4, "name": "due_date", 'searchable':true, 'orderable':true},
    { "targets": 5, "name": "status", 'searchable':true, 'orderable':true},
    { "targets": 6, "name": "total_amount", 'searchable':true, 'orderable':true},
	{ "targets": 7, "name": "customer_phone", 'searchable':true, 'orderable':true},
    { "targets": 8, "name": "action", 'searchable':false, 'orderable':false}
    ]
  });


  function sync(btn)
  {
	$(btn).attr('disabled',true);
	$(btn).html('<i class="fa-solid fa-rotate fa-spin-pulse"></i> Sync in progress');
	
	$.ajax({
		url:"<?=base_url('sync-invoices')?>",
		success:function(data){
			let res = JSON.parse(data);

			if(res.status == 1)
			{
				table.ajax.reload();
				toastr.success(res.msg);
			}
			else
			{
				toastr.error(res.msg);
			}

			if(res.redirect_url != '')
			{
				setTimeout(() => {
					location.href = res.redirect_url;
				}, 2000);
			}

		},
		error:function(reponse)
		{
			toastr.error("Unable to login, Please reload and try again");
		},
		complete:function()
		{
			setTimeout(() => {
				$(btn).html('Sync invoice');
				$(btn).attr('disabled',false);
			}, 1000);
		},
	})
  }


  function view_items(id)
  {
	showLoader();

	$.ajax({
		url:"<?=base_url('get-invoice-items')?>/"+id,
		success:function(response){
			$("#invoiceModal").find('.modal-body').html(response);
			
			$("#invoiceModal").modal('show');

		},
		error:function(reponse)
		{
			toastr.error("Unable to load data, Please reload and try again");
		},
		complete:function(){
			hideLoader();
		}
	})

  }

</script>