
	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>
					Points Management
					<small>For <a href="#" target="_blank">Vaqra APP</a></small>
				</h2>
			</div>
			<!-- Commission Table -->.
			<form method="POST">
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="card">
							<div class="header">
								<h2>Points Management<small>Changes may affect the running applications (IOS / Andr.).</small></h2>
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
										echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Well done!</strong> You successfully updated Reward points.</div>';
									else
										echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>';
								}
								?>
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>Points Rewarded For...</th>
												<th>Reward</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if($points)
												foreach ($points as $key => $point)
												{
											?>
											<tr>
												<td><?= $point['if_pname']?></td>
												<td>
													<div class="input-group">
														<div class="form-line">
															<input type="text" class="form-control" name="<?= $point['if_code'];?>" value="<?= (!empty($point['if_points'])) ? $point['if_points'] : "";?>" placeholder="Type Here..." min="0">
														</div>
														<span class="input-group-addon">
															<i class="material-icons">account_balance_wallet</i>
														</span>
													</div>
												</td>
											</tr>
											<?php
												}
											else
												echo '<tr><td colspan="3" class="text-center font-bold font-18">Please Contact Your Developer to add Points related data.</td></tr>';
											?>
										</tbody>
										<thead>
											<tr>
												<th>Points Rewarded For...</th>
												<th>Reward</th>
											</tr>
										</thead>
									</table>
								</div>
								<div class="row">
									<div class="col-md-12 text-right">
										<button type="submit" class="btn bg-green waves-effect waves-green">Update</button>
									</div>
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