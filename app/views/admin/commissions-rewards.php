
	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>
					Commission & Rewards List
					<small>For <a href="#" target="_blank">Vaqra APP</a></small>
				</h2>
			</div>
			<!-- Commission Table -->.
			<form method="POST">
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="card">
							<div class="header">
								<h2>COMMISSIONS & REWARDS LIST<small>Changes may affect the running applications (IOS / Andr.).</small></h2>
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
										echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Well done!</strong> You successfully updated Commisssions and Rewards Settings.</div>';
									else
										echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>';
								}
								?>
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>Name</th>
												<th>Type</th>
												<th>Value</th>
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
												<td><?= $value['if_type'];?></td>
												<td>
													<div class="input-group">
														<div class="form-line">
															<input type="number" class="form-control" name="<?= $value['if_cms_name'];?>" value="<?= (!empty($value['if_commission'])) ? $value['if_commission'] : "";?>" placeholder="Type Here..." min="1" <?= ($value['if_type']=='Percentage') ? 'max="100"' : '';?>>
														</div>
														<?php
														if($value['if_type']=='Percentage')
														{
														?>
														<span class="input-group-addon">
															<i class="font-18">%</i>
														</span>
														<?php
														}
														?>
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
												<th>Type</th>
												<th>Value</th>
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