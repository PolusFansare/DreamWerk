	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2><?= $active?></h2>
			</div>
			<!-- Hover Rows -->
			<div class="row clearfix">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 orders">
					<div class="card">
						<div class="header">
							<h2>
								<span class="text-uppercase">Order History</span>
								<small>Below is the list of payments that every user paid while ordering at Vaqra.</small>
							</h2>
							<ul class="header-dropdown m-r--5">
								<li class="dropdown">
									<a href="<?= base_url()?>assets/admin/javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<i class="material-icons">more_vert</i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a href="<?= base_url('admin/orderslist')?>">View Orders</a></li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="body table-responsive">
							<table class="table table-striped table-bordered table-hover dataTable js-exportable">
								<thead>
									<tr>
										<th>Sr.</th>
										<th>Package</th>
										<th>Price</th>
										<th>Type</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($orders)
										foreach ($orders as $key => $payment)
										{
									?>
									<tr>
										<th scope="row"><?=$key+1?></th>
										<td><?= "ORD-".$payment['if_id']?></td>
										<td><?= $payment['if_total_amt']?></td>
										<td><?= "CREDITED"?></td>
										<td class="text-center">
											<button type="button" class="btn bg-green waves-effect m-r-20" data-toggle="modal" data-target="#largeModal<?= $payment['if_id'];?>"><i class="material-icons">visibility</i> View</button>
											<div class="modal fade text-left" id="largeModal<?= $payment['if_id'];?>" tabindex="-1" role="dialog">
												<div class="modal-dialog modal-lg" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title text-primary" id="largeModalLabel"><?= "@".$payment['user']['if_username']?></h4>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="col-md-6">
																	<p class="text-dark"><?= $payment['user']['if_email']?></p>
																</div>
																<div class="col-md-5">
																	<?php
																	if($payment['user']['if_role']!='Stylist')
																	{
																	?>
																	<a href="<?= base_url()."admin/userlist/".(($payment['user']['if_role']=='User') ? 'user-list' : ($payment['user']['if_role']=='Stylist') ? 'stylist-list' : 'brand-list')."/posts/".urlencode($payment['user']['if_username'])."/".$payment['user']['if_id'];?>" target="_blank" class="btn bg-green waves-effect" ><i class="material-icons">insert_photo</i> <?= $this->db->select('if_post.if_id')->from('if_post')->join('if_post_images', 'if_post_images.if_post_id = if_post.if_id')->where(array("if_post.if_user_id" => $payment['user']['if_id']))->group_by('if_post_images.if_post_id')->get()->num_rows();?> Posts</a>
																	<?php
																	}
																	$json=json_decode($payment['if_json'], true);
																	?>
																	<a href="<?= base_url()."admin/userlist/profile/view/".urlencode($payment['user']['if_username'])."/".$payment['user']['if_id'];?>" target="_blank" class="btn bg-green waves-effect"><i class="material-icons">person</i>  Profile</a>
																</div>
																<div class="col-md-12">
																	<table class="table table-bordered">
																		<tbody>
																			<tr>
																				<th>Status</th>
																				<td><?= (!empty($json['status'])) ? '<span class="col-green">Success</span>' : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Paid</th>
																				<td><?= (!empty($json['amount'])) ? $json['amount'] : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Currency</th>
																				<td><?= (!empty($json['currencyIsoCode'])) ? $json['currencyIsoCode'] : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Card Type</th>
																				<td><?= (!empty($json['paymentInstrumentType'])) ? (($json['paymentInstrumentType']=='credit_card') ? 'Credit Card '.((!empty($json['creditCard']['imageUrl'])) ? '<img src="'.$json['creditCard']['imageUrl'].'" height="25">' : '') : 'Debit Card' ) : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Transaction ID</th>
																				<td><?= (!empty($json['networkTransactionId'])) ? $json['networkTransactionId'] : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Merchant Account ID</th>
																				<td><?= (!empty($json['merchantAccountId'])) ? $json['merchantAccountId'] : '<i>NA</i>';?></td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<!-- <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button> -->
															<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
									<?php
										}
									else
										echo '<tr><th colspan="4" class="text-center">There are currently no packages available at the moment. Please contact support to add a a package or want more information about that.</tr>';
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 post-promotions">
					<div class="card">
						<div class="header">
							<h2>
								<span class="text-uppercase">Post Promote History</span>
								<small>Below is the list of payments that every user paid while promoting a post.</small>
							</h2>
							<!-- <ul class="header-dropdown m-r--5">
								<li class="dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<i class="material-icons">more_vert</i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a href="javascript:void(0);" class=" waves-effect waves-green">Action</a></li>
										<li><a href="javascript:void(0);" class=" waves-effect waves-green">Another action</a></li>
										<li><a href="javascript:void(0);" class=" waves-effect waves-green">Something else here</a></li>
									</ul>
								</li>
							</ul> -->
						</div>
						<div class="body table-responsive">
							<table class="table table-striped table-bordered table-hover dataTable js-exportable">
								<thead>
									<tr>
										<th>Sr.</th>
										<th>Package</th>
										<th>Price</th>
										<th>Type</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($post_projects)
										foreach ($post_projects as $key => $payment)
										{
									?>
									<tr>
										<th scope="row"><?=$key+1?></th>
										<td><?= $payment['package']['if_pkg_name']?></td>
										<td><?= $payment['if_price']?></td>
										<td><?= "CREDITED"?></td>
										<td class="text-center">
											<button type="button" class="btn bg-green waves-effect m-r-20" data-toggle="modal" data-target="#largeModal<?= $payment['if_id'];?>"><i class="material-icons">visibility</i> View</button>
											<div class="modal fade text-left" id="largeModal<?= $payment['if_id'];?>" tabindex="-1" role="dialog">
												<div class="modal-dialog modal-lg" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title text-primary" id="largeModalLabel"><?= "@".$payment['user']['if_username']?></h4>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="col-md-6">
																	<p class="text-dark"><?= $payment['user']['if_email']?></p>
																</div>
																<div class="col-md-5">
																	<?php
																	if($active!='stylist-list')
																	{
																	?>
																	<a href="<?= base_url()."admin/userlist/".(($payment['user']['if_role']=='User') ? 'user-list' : ($payment['user']['if_role']=='Stylist') ? 'stylist-list' : 'brand-list')."/posts/".urlencode($payment['user']['if_username'])."/".$payment['user']['if_id'];?>" target="_blank" class="btn bg-green waves-effect" ><i class="material-icons">insert_photo</i> <?= $this->db->select('if_post.if_id')->from('if_post')->join('if_post_images', 'if_post_images.if_post_id = if_post.if_id')->where(array("if_post.if_user_id" => $payment['user']['if_id']))->group_by('if_post_images.if_post_id')->get()->num_rows();?> Posts</a>
																	<?php
																	}
																	$json=json_decode($payment['json'], true);
																	?>
																	<a href="<?= base_url()."admin/userlist/profile/view/".urlencode($payment['user']['if_username'])."/".$payment['user']['if_id'];?>" target="_blank" class="btn bg-green waves-effect"><i class="material-icons">person</i>  Profile</a>
																</div>
																<div class="col-md-12">
																	<table class="table table-bordered">
																		<tbody>
																			<tr>
																				<th>Status</th>
																				<td><?= (!empty($json['status'])) ? '<span class="col-green">Success</span>' : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Paid</th>
																				<td><?= (!empty($json['amount'])) ? $json['amount'] : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Currency</th>
																				<td><?= (!empty($json['currencyIsoCode'])) ? $json['currencyIsoCode'] : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Card Type</th>
																				<td><?= (!empty($json['paymentInstrumentType'])) ? (($json['paymentInstrumentType']=='credit_card') ? 'Credit Card '.((!empty($json['creditCard']['imageUrl'])) ? '<img src="'.$json['creditCard']['imageUrl'].'" height="25">' : '') : 'Debit Card' ) : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Transaction ID</th>
																				<td><?= (!empty($json['networkTransactionId'])) ? $json['networkTransactionId'] : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Merchant Account ID</th>
																				<td><?= (!empty($json['merchantAccountId'])) ? $json['merchantAccountId'] : '<i>NA</i>';?></td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<!-- <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button> -->
															<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
									<?php
										}
									else
										echo '<tr><th colspan="4" class="text-center">There are currently no packages available at the moment. Please contact support to add a a package or want more information about that.</tr>';
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 user-packages">
					<div class="card">
						<div class="header">
							<h2>
								<span class="text-uppercase">Stylist Hire History</span>
								<small>Below is the list of payments that every user paid while hiring a stylist.</small>
							</h2>
							<!-- <ul class="header-dropdown m-r--5">
								<li class="dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<i class="material-icons">more_vert</i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a href="javascript:void(0);" class=" waves-effect waves-green">Action</a></li>
										<li><a href="javascript:void(0);" class=" waves-effect waves-green">Another action</a></li>
										<li><a href="javascript:void(0);" class=" waves-effect waves-green">Something else here</a></li>
									</ul>
								</li>
							</ul> -->
						</div>
						<div class="body table-responsive">
							<table class="table table-striped table-bordered table-hover dataTable js-exportable">
								<thead>
									<tr>
										<th>Sr.</th>
										<th>Package</th>
										<th>Price</th>
										<th>Type</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($stylist_hires)
										foreach ($stylist_hires as $key => $payment)
										{
									?>
									<tr>
										<th scope="row"><?=$key+1?></th>
										<td><?= $payment['package']['if_name']?></td>
										<td><?= $payment['if_price']?></td>
										<td><?= "CREDITED"?></td>
										<td class="text-center">
											<button type="button" class="btn bg-green waves-effect m-r-20" data-toggle="modal" data-target="#largeModal<?= $payment['if_id'];?>"><i class="material-icons">visibility</i> View</button>
											<div class="modal fade text-left" id="largeModal<?= $payment['if_id'];?>" tabindex="-1" role="dialog">
												<div class="modal-dialog modal-lg" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title text-primary" id="largeModalLabel"><?= "@".$payment['user']['if_username']?></h4>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="col-md-6">
																	<p class="text-dark"><?= $payment['user']['if_email']?></p>
																</div>
																<div class="col-md-5">
																	<?php
																	if($active!='stylist-list')
																	{
																	?>
																	<a href="<?= base_url()."admin/userlist/".(($payment['user']['if_role']=='User') ? 'user-list' : ($payment['user']['if_role']=='Stylist') ? 'stylist-list' : 'brand-list')."/posts/".urlencode($payment['user']['if_username'])."/".$payment['user']['if_id'];?>" target="_blank" class="btn bg-green waves-effect" ><i class="material-icons">insert_photo</i> <?= $this->db->select('if_post.if_id')->from('if_post')->join('if_post_images', 'if_post_images.if_post_id = if_post.if_id')->where(array("if_post.if_user_id" => $payment['user']['if_id']))->group_by('if_post_images.if_post_id')->get()->num_rows();?> Posts</a>
																	<?php
																	}
																	$json=json_decode($payment['if_json'], true);
																	?>
																	<a href="<?= base_url()."admin/userlist/profile/view/".urlencode($payment['user']['if_username'])."/".$payment['user']['if_id'];?>" target="_blank" class="btn bg-green waves-effect"><i class="material-icons">person</i>  Profile</a>
																</div>
																<div class="col-md-12">
																	<table class="table table-bordered">
																		<tbody>
																			<tr>
																				<th>Status</th>
																				<td><?= (!empty($json['status'])) ? '<span class="col-green">Success</span>' : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Paid</th>
																				<td><?= (!empty($json['amount'])) ? $json['amount'] : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Currency</th>
																				<td><?= (!empty($json['currencyIsoCode'])) ? $json['currencyIsoCode'] : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Card Type</th>
																				<td><?= (!empty($json['paymentInstrumentType'])) ? (($json['paymentInstrumentType']=='credit_card') ? 'Credit Card '.((!empty($json['creditCard']['imageUrl'])) ? '<img src="'.$json['creditCard']['imageUrl'].'" height="25">' : '') : 'Debit Card' ) : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Transaction ID</th>
																				<td><?= (!empty($json['networkTransactionId'])) ? $json['networkTransactionId'] : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Merchant Account ID</th>
																				<td><?= (!empty($json['merchantAccountId'])) ? $json['merchantAccountId'] : '<i>NA</i>';?></td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<!-- <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button> -->
															<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
									<?php
										}
									else
										echo '<tr><th colspan="4" class="text-center">There are currently no packages available at the moment. Please contact support to add a a package or want more information about that.</tr>';
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 brand-promotions">
					<div class="card">
						<div class="header">
							<h2>
								<span class="text-uppercase">Brand Profile Projection History</span>
								<small>Below is the list of payments that every Retail brand paid on registering on Vaqra.</small>
							</h2>
							<!-- <ul class="header-dropdown m-r--5">
								<li class="dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<i class="material-icons">more_vert</i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a href="javascript:void(0);" class=" waves-effect waves-green">Action</a></li>
										<li><a href="javascript:void(0);" class=" waves-effect waves-green">Another action</a></li>
										<li><a href="javascript:void(0);" class=" waves-effect waves-green">Something else here</a></li>
									</ul>
								</li>
							</ul> -->
						</div>
						<div class="body table-responsive">
							<table class="table table-striped table-bordered table-hover dataTable js-exportable">
								<thead>
									<tr>
										<th>Sr.</th>
										<th>Package</th>
										<th>Price</th>
										<th>Type</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($brand_projection)
										foreach ($brand_projection as $key => $payment)
										{
									?>
									<tr>
										<th scope="row"><?=$key+1?></th>
										<td><?= $payment['package']['if_package_name']?></td>
										<td><?= $payment['if_price']?></td>
										<td><?= "CREDITED"?></td>
										<td class="text-center">
											<button type="button" class="btn bg-green waves-effect m-r-20" data-toggle="modal" data-target="#largeModal<?= $payment['if_id'];?>"><i class="material-icons">visibility</i> View</button>
											<div class="modal fade text-left" id="largeModal<?= $payment['if_id'];?>" tabindex="-1" role="dialog">
												<div class="modal-dialog modal-lg" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title text-primary" id="largeModalLabel"><?= "@".$payment['user']['if_username']?></h4>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="col-md-6">
																	<p class="text-dark"><?= $payment['user']['if_email']?></p>
																</div>
																<div class="col-md-5">
																	<?php
																	if($active!='stylist-list')
																	{
																	?>
																	<a href="<?= base_url()."admin/userlist/".(($payment['user']['if_role']=='User') ? 'user-list' : ($payment['user']['if_role']=='Stylist') ? 'stylist-list' : 'brand-list')."/posts/".urlencode($payment['user']['if_username'])."/".$payment['user']['if_id'];?>" target="_blank" class="btn bg-green waves-effect" ><i class="material-icons">insert_photo</i> <?= $this->db->select('if_post.if_id')->from('if_post')->join('if_post_images', 'if_post_images.if_post_id = if_post.if_id')->where(array("if_post.if_user_id" => $payment['user']['if_id']))->group_by('if_post_images.if_post_id')->get()->num_rows();?> Posts</a>
																	<?php
																	}
																	$json=json_decode($payment['if_json'], true);
																	?>
																	<a href="<?= base_url()."admin/userlist/profile/view/".urlencode($payment['user']['if_username'])."/".$payment['user']['if_id'];?>" target="_blank" class="btn bg-green waves-effect"><i class="material-icons">person</i>  Profile</a>
																</div>
																<div class="col-md-12">
																	<table class="table table-bordered">
																		<tbody>
																			<tr>
																				<th>Status</th>
																				<td><?= (!empty($json['status'])) ? '<span class="col-green">Success</span>' : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Paid</th>
																				<td><?= (!empty($json['amount'])) ? $json['amount'] : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Currency</th>
																				<td><?= (!empty($json['currencyIsoCode'])) ? $json['currencyIsoCode'] : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Card Type</th>
																				<td><?= (!empty($json['paymentInstrumentType'])) ? (($json['paymentInstrumentType']=='credit_card') ? 'Credit Card '.((!empty($json['creditCard']['imageUrl'])) ? '<img src="'.$json['creditCard']['imageUrl'].'" height="25">' : '') : 'Debit Card' ) : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Transaction ID</th>
																				<td><?= (!empty($json['networkTransactionId'])) ? $json['networkTransactionId'] : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Merchant Account ID</th>
																				<td><?= (!empty($json['merchantAccountId'])) ? $json['merchantAccountId'] : '<i>NA</i>';?></td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<!-- <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button> -->
															<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
									<?php
										}
									else
										echo '<tr><th colspan="4" class="text-center">There are currently no packages available at the moment. Please contact support to add a a package or want more information about that.</tr>';
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 brand-promotions">
					<div class="card">
						<div class="header">
							<h2>
								<span class="text-uppercase">Bidding History</span>
								<small>Below is the list of payments that every brand paid to bid on Vaqra.</small>
							</h2>
							<ul class="header-dropdown m-r--5">
								<li class="dropdown">
									<a href="<?= base_url()?>assets/admin/javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<i class="material-icons">more_vert</i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a href="<?= base_url('admin/bids')?>">View Bids</a></li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="body table-responsive">
							<table class="table table-striped table-bordered table-hover dataTable js-exportable">
								<thead>
									<tr>
										<th>Sr.</th>
										<th>Brand</th>
										<th>Price</th>
										<th>Type</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($bids)
										foreach ($bids as $key => $payment)
										{
									?>
									<tr>
										<th scope="row"><?=$key+1?></th>
										<td><?= $payment['user']['if_username']?></td>
										<td><?= $payment['if_bid']?></td>
										<td><?= "CREDITED"?></td>
										<td class="text-center">
											<button type="button" class="btn bg-green waves-effect m-r-20" data-toggle="modal" data-target="#largeModal<?= $payment['if_id'];?>"><i class="material-icons">visibility</i> View</button>
											<div class="modal fade text-left" id="largeModal<?= $payment['if_id'];?>" tabindex="-1" role="dialog">
												<div class="modal-dialog modal-lg" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title text-primary" id="largeModalLabel"><?= "@".$payment['user']['if_username']?></h4>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="col-md-6">
																	<p class="text-dark"><?= $payment['user']['if_email']?></p>
																</div>
																<div class="col-md-5">
																	<?php
																	if($active!='stylist-list')
																	{
																	?>
																	<a href="<?= base_url()."admin/userlist/".(($payment['user']['if_role']=='User') ? 'user-list' : ($payment['user']['if_role']=='Stylist') ? 'stylist-list' : 'brand-list')."/posts/".urlencode($payment['user']['if_username'])."/".$payment['user']['if_id'];?>" target="_blank" class="btn bg-green waves-effect" ><i class="material-icons">insert_photo</i> <?= $this->db->select('if_post.if_id')->from('if_post')->join('if_post_images', 'if_post_images.if_post_id = if_post.if_id')->where(array("if_post.if_user_id" => $payment['user']['if_id']))->group_by('if_post_images.if_post_id')->get()->num_rows();?> Posts</a>
																	<?php
																	}
																	$json=json_decode($payment['if_json'], true);
																	?>
																	<a href="<?= base_url()."admin/userlist/profile/view/".urlencode($payment['user']['if_username'])."/".$payment['user']['if_id'];?>" target="_blank" class="btn bg-green waves-effect"><i class="material-icons">person</i>  Profile</a>
																</div>
																<div class="col-md-12">
																	<table class="table table-bordered">
																		<tbody>
																			<tr>
																				<th>Status</th>
																				<td><?= (!empty($json['status'])) ? '<span class="col-green">Success</span>' : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Paid</th>
																				<td><?= (!empty($json['amount'])) ? $json['amount'] : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Currency</th>
																				<td><?= (!empty($json['currencyIsoCode'])) ? $json['currencyIsoCode'] : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Card Type</th>
																				<td><?= (!empty($json['paymentInstrumentType'])) ? (($json['paymentInstrumentType']=='credit_card') ? 'Credit Card '.((!empty($json['creditCard']['imageUrl'])) ? '<img src="'.$json['creditCard']['imageUrl'].'" height="25">' : '') : 'Debit Card' ) : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Transaction ID</th>
																				<td><?= (!empty($json['networkTransactionId'])) ? $json['networkTransactionId'] : '<i>NA</i>';?></td>
																			</tr>
																			<tr>
																				<th>Merchant Account ID</th>
																				<td><?= (!empty($json['merchantAccountId'])) ? $json['merchantAccountId'] : '<i>NA</i>';?></td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<!-- <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button> -->
															<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
									<?php
										}
									else
										echo '<tr><th colspan="4" class="text-center">There are currently no packages available at the moment. Please contact support to add a a package or want more information about that.</tr>';
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- #END# Hover Rows -->
		</div>
	</section>
	<style type="text/css">
	.table-hover > tbody > tr:hover {
		background-color: #4caf4f24;
	}
	.dataTables_wrapper .dt-buttons
	{
		height: 40px;
	}
	div.dataTables_wrapper div.dataTables_filter
	{
		text-align: left;
	}
	.card .body
	{
		height: 500px
	}
	</style>