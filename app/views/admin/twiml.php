
	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>
					TwiML Settings
					<small>For <a href="#" target="_blank">Vaqra APP</a></small>
				</h2>
			</div>
			<!-- Commission Table -->.
			<form method="POST">
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="card">
							<div class="header">
								<h2>TwiML Settings<small>Changes may affect the running applications (IOS / Andr.).</small></h2>
								<p></p>
								<ul class="header-dropdown m-r--5">
									<li class="dropdown">
										<button type="submit" class="btn bg-green waves-effect waves-green">Update</button>
									</li>
								</ul>
							</div>
							<div class="body">
								<?php
								if(isset($updated))
								{
									if($updated)
										echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Well done!</strong> You successfully updated TwiML Keys.</div>';
									else
										echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>';
								}
								?>
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>Name</th>
												<th>Encrypted Key</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if($data)
												foreach ($data as $key => $value)
												{
											?>
											<tr>
												<td><?= $value['if_name']?></td>
												<td>
													<div class="input-group">
														<div class="form-line">
															<input type="text" class="form-control" name="<?= $value['if_code'];?>" value="<?= (!empty($value['if_prod_key'])) ? $value['if_prod_key'] : "";?>" placeholder="Type Here...">
														</div>
														<span class="input-group-addon">
															<i class="material-icons">phonelink_lock</i>
														</span>
													</div>
												</td>
											</tr>
											<?php
												}
											else
												echo '<tr><td colspan="3" class="text-center font-bold font-18">Please Contact Your Developer to add commisssions and rewards.</td></tr>';
											?>
										</tbody>
										<thead>
											<tr>
												<th>Name</th>
												<th>Encrypted Key</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			<!-- #END# Exportable Table -->
		</div>
		<style type="text/css">
		.table-hover > tbody > tr:hover {
			background-color: #4caf4f24;
		}
		</style>
	</section>