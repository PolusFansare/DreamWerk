	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>
					Deletion Requests
					<small>Taken from <a href="#" target="_blank">Vaqra APP</a></small>
					<br>
				</h2>
			</div>
			<!-- User Table -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>DELETION REQUEST</h2>
							<p></p>
							<ul class="header-dropdown m-r--5">
								<li class="dropdown">
									<!-- <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<i class="material-icons">more_vert</i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a href="javascript:void(0);">Action</a></li>
										<li><a href="javascript:void(0);">Another action</a></li>
										<li><a href="javascript:void(0);">Something else here</a></li>
									</ul> -->
								</li>
							</ul>
						</div>
						<div class="body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover dataTable js-exportable">
									<thead>
										<tr>
											<th>Sr.</th>
											<th>Username</th>
											<th>Image</th>
											<th>Date</th>
											<th></th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Sr.</th>
											<th>Username</th>
											<th>Image</th>
											<th>Date</th>
											<th></th>
										</tr>
									</tfoot>
									<tbody>
										<?php
										$deletions=$this->mysql->get_data('if_deleted_account', '');
										if($deletions)
											foreach ($deletions as $key => $delete)
											{
												$user=$this->mysql->get_data('if_user_login', array('if_id' => $delete['if_user_id']));
												$profile=$this->mysql->get_data('if_profile_image', array('if_user_id' => $delete['if_user_id']));
										?>
										<tr>
											<td><?= $key+1?></td>
											<td><?= $user[0]['if_username']?></td>
											<td><img width="120" src="<?= ($profile) ? '/fashion_app_api/'.$profile[0]['if_image'] : base_url().'assets/admin/images/default-image.jpg';?>"></td>
											<td><?= date('d F Y', strtotime($delete['timestamp']))?></td>
											<td><a href="" class="btn btn-default waves-effect">Accept</a></td>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- #END# Exportable Table -->
		</div>
	</section>