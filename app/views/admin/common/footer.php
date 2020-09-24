	<!-- Jquery Core Js -->
	<script src="<?= base_url()?>assets/admin/plugins/jquery/jquery.min.js"></script>

	<!-- Bootstrap Core Js -->
	<script src="<?= base_url()?>assets/admin/plugins/bootstrap/js/bootstrap.js"></script>

	<!-- Select Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/bootstrap-select/js/bootstrap-select.js"></script>

	<!-- Slimscroll Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

	<!-- Waves Effect Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/node-waves/waves.js"></script>
	
	<!-- SweetAlert Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/sweetalert/sweetalert.min.js"></script>
	<?php
	if(isset($active))
	{
		if($active=='Html')
		{
	?>
	<!-- Jquery DataTable Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

	<!-- Ckeditor -->
	<script src="<?= base_url()?>assets/admin/plugins/ckeditor/ckeditor.js"></script>

	<!-- TinyMCE -->
	<script src="<?= base_url()?>assets/admin/plugins/tinymce/tinymce.js"></script>
	<!-- Custom Js -->
	<script src="<?= base_url()?>assets/admin/js/admin.js"></script>
	<script src="<?= base_url()?>assets/admin/js/pages/forms/editors.js"></script>
	<script src="<?= base_url()?>assets/admin/js/pages/tables/jquery-datatable.js"></script>
	<script src="<?= base_url()?>assets/admin/js/pages/ui/tooltips-popovers.js"></script>

	<!-- Demo Js -->
	<script src="<?= base_url()?>assets/admin/js/demo.js"></script>
	<?php
		}
		elseif($active=='user-list' || $active=='Videos' || $active=='pendingVideos' || $active=='Feedbacks')
		{
	?>
	<!-- Jquery DataTable Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

	<!-- Custom Js -->
	<script src="<?= base_url()?>assets/admin/js/admin.js"></script>
	<script src="<?= base_url()?>assets/admin/js/pages/ui/dialogs.js"></script>
	<script src="<?= base_url()?>assets/admin/js/pages/tables/jquery-datatable.js"></script>
	<script src="<?= base_url()?>assets/admin/js/pages/ui/tooltips-popovers.js"></script>

	<!-- Demo Js -->
	<script src="<?= base_url()?>assets/admin/js/demo.js"></script>
	<script type="text/javascript">
		$(".blockThisUser").click(function(){
			var thiss=$(this);
			swal({
				title: "Are you sure you want to "+thiss.data('type').toLowerCase()+" this user?",
				text: "User might gain/loose access to DreamWerk.!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#f44336",
				confirmButtonText: "Yes",
				cancelButtonColor: "#4caf50",
				cancelButtonText: "Cancel",
				closeOnConfirm: false,
				showLoaderOnConfirm: true,
				closeOnCancel: false
			}, function (isConfirm) {
				if (isConfirm)
				{
					$.ajax({
						url: "<?= base_url('ajax/blockUnblock');?>",
						type:"POST",
						data:{
							"datatype"		: 'Block/Unblock User',
							"userid"		: thiss.data('userid'),
							"userstatus"	: thiss.data('userstatus')
						},
						success: function (msg2)
						{
							if(msg2==404)
								setTimeout(function () {
									swal({title:"User "+thiss.data('type')+"ing un-successfull!", text:"Cannot change the status of this user with fewer details.", type:"warning", confirmButtonColor: "#fb483a"});
								}, 1000);
							else if(msg2==500)
								setTimeout(function () {
									swal({title:"User "+thiss.data('type')+"ing un-successfull!", text:"An error occured during changing the user status. Please try after sometime.", type:"error", confirmButtonColor: "#fb483a"});
								}, 1000);
							else if(msg2==1)
								setTimeout(function () {
									swal({title:"User "+thiss.data('type')+"ed successfully !", text:"User status is changed to "+thiss.data('type')+"!", type:"success", confirmButtonColor: "#fb483a"}, function () {
										if(thiss.data("type")=="unblock")
										{
											thiss.data("type","block");
											thiss.removeClass("bg-red");
											thiss.addClass("btn-default");
											thiss.find("i").text("lock_open");
											thiss.attr("data-original-title","Block this User.");
										}
										else
										{
											thiss.data("type","unblock");
											thiss.removeClass("btn-default");
											thiss.addClass("bg-red");
											thiss.find("i").text("lock_outline");
											thiss.attr("data-original-title","Unblock this User.");
										}
										// location.reload(true);
									});
								}, 1000);
							else
								setTimeout(function () {
									swal({title:"Status unknown!", text:"May be an error occured during changing the status of this user. Please try after sometime or contact your developer to solve it.", type:"warning", confirmButtonColor: "#fb483a"});
								}, 1000);
						}
					});
				}
				else
					swal({title:"You saved this user for later.", text:"You cancelled the change user blocked status process :)", type:"error", confirmButtonColor: "#fb483a"});
			});
		});
		function printElement(elem) {
			var domClone = elem.cloneNode(true);
			
			var $printSection = document.getElementById("printSection");
			
			if (!$printSection) {
				var $printSection = document.createElement("div");
				$printSection.id = "printSection";
				document.body.appendChild($printSection);
			}
			
			$printSection.innerHTML = "";
			$printSection.appendChild(domClone);
			window.print();
		}
	</script>
	<style type="text/css">
		@media screen {
			#printSection {
				display: none;
			}
		}

		@media print {
			body * {
				visibility:hidden;
			}
			#printSection, #printSection * {
				visibility:visible;
			}
			#printSection {
				position:absolute;
				left:0;
				top:0;
			}
		}
	</style>
	<?php
		}
		else
		{
	?>
	<!-- Jquery CountTo Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/jquery-countto/jquery.countTo.js"></script>

	<!-- Morris Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/raphael/raphael.min.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/morrisjs/morris.js"></script>

	<!-- ChartJs -->
	<script src="<?= base_url()?>assets/admin/plugins/chartjs/Chart.bundle.js"></script>

	<!-- Flot Charts Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/flot-charts/jquery.flot.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/flot-charts/jquery.flot.resize.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/flot-charts/jquery.flot.pie.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/flot-charts/jquery.flot.categories.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/flot-charts/jquery.flot.time.js"></script>

	<!-- Sparkline Chart Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/jquery-sparkline/jquery.sparkline.js"></script>

	<!-- Autosize Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/autosize/autosize.js"></script>

	<!-- Moment Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/momentjs/moment.js"></script>

	<!-- Bootstrap Material Datetime Picker Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

	<!-- Bootstrap Datepicker Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


	<!-- Custom Js -->
	<script src="<?= base_url()?>assets/admin/js/admin.js"></script>
	<script src="<?= base_url()?>assets/admin/js/pages/forms/basic-form-elements.js"></script>
	<script src="<?= base_url()?>assets/admin/js/pages/index.js"></script>
	<script src="<?= base_url()?>assets/admin/js/pages/ui/dialogs.js"></script>
	<script src="<?= base_url()?>assets/admin/js/pages/ui/tooltips-popovers.js"></script>

	<!-- Demo Js -->
	<script src="<?= base_url()?>assets/admin/js/demo.js"></script>
	<?php
		}
	}
	else
	{
?>
	<!-- Jquery CountTo Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/jquery-countto/jquery.countTo.js"></script>

	<!-- Morris Plugin Js -->
	<!-- <script src="<?= base_url()?>assets/admin/plugins/raphael/raphael.min.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/morrisjs/morris.js"></script> -->

	<!-- ChartJs -->
	<!-- <script src="<?= base_url()?>assets/admin/plugins/chartjs/Chart.bundle.js"></script> -->

	<!-- Flot Charts Plugin Js -->
	<!-- <script src="<?= base_url()?>assets/admin/plugins/flot-charts/jquery.flot.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/flot-charts/jquery.flot.resize.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/flot-charts/jquery.flot.pie.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/flot-charts/jquery.flot.categories.js"></script>
	<script src="<?= base_url()?>assets/admin/plugins/flot-charts/jquery.flot.time.js"></script> -->

	<!-- Sparkline Chart Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/jquery-sparkline/jquery.sparkline.js"></script>

	<!-- Autosize Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/autosize/autosize.js"></script>

	<!-- Moment Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/momentjs/moment.js"></script>

	<!-- Bootstrap Material Datetime Picker Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

	<!-- Bootstrap Datepicker Plugin Js -->
	<script src="<?= base_url()?>assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


	<!-- Custom Js -->
	<script src="<?= base_url()?>assets/admin/js/admin.js"></script>
	<script src="<?= base_url()?>assets/admin/js/pages/forms/basic-form-elements.js"></script>
	<script src="<?= base_url()?>assets/admin/js/pages/index.js"></script>
	<script src="<?= base_url()?>assets/admin/js/pages/ui/dialogs.js"></script>
	<script src="<?= base_url()?>assets/admin/js/pages/ui/tooltips-popovers.js"></script>

	<!-- Demo Js -->
	<script src="<?= base_url()?>assets/admin/js/demo.js"></script>
<?php
	}
?>
</body>

</html>