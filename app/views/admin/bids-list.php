
	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2><?= ucfirst($active)?></h2>
			</div>
			<!-- Hover Rows -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>
								<span class="text-uppercase"><?= $active?></span>
								<small>Below is the list of bids that every user offered for this month.</small>
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
							<table class="table table-striped table-bordered table-hover ">
								<thead>
									<tr>
										<th>Sr.</th>
										<th>Bidder</th>
										<th>Bid</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($bids)
										foreach ($bids as $key => $bid)
										{
									?>
									<tr>
										<th scope="row"><?=$key+1?></th>
										<td><?= ($bid['user']['if_role']=='Retail-Brand' && isset($bid['retail']['if_brand_name'])) ? $bid['retail']['if_brand_name'] : (($bid['user']['if_role']=='Market-Brand' && isset($bid['market']['if_shop_name'])) ? $bid['market']['if_shop_name'] : $bid['user_details']['if_full_name']); ?></td>
										<td>₨ <?=$bid['if_bid']?></td>
										<td>
											<!-- <a href="<?= base_url()?>admin/stylisthirepackages/edit/<?= $bid['if_user_id']?>/<?=$bid['if_bid']?>" class="btn bg-green waves-effect waves-green"><i class="material-icons">visibility</i> View</a> -->
											<button type="button" class="btn bg-green waves-effect m-r-20" data-toggle="modal" data-target="#largeModal<?= $bid['if_id'];?>"><i class="material-icons">visibility</i> View</button>
											<div class="modal fade" id="largeModal<?= $bid['if_id'];?>" tabindex="-1" role="dialog">
												<div class="modal-dialog modal-lg" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title text-primary" id="largeModalLabel"><?= "@".$bid['user']['if_username']?></h4>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="col-md-6">
																	<p class="text-dark"><?= $bid['user']['if_email']?></p>
																</div>
																<div class="col-md-5">
																	<?php
																	if($active!='stylist-list')
																	{
																	?>
																	<a href="<?= base_url()."admin/userlist/".(($bid['user']['if_role']=='User') ? 'user-list' : ($bid['user']['if_role']=='Stylist') ? 'stylist-list' : 'brand-list')."/posts/".urlencode($bid['user']['if_username'])."/".$bid['user']['if_id'];?>" target="_blank" class="btn bg-green waves-effect" ><i class="material-icons">insert_photo</i> <?= $this->db->select('if_post.if_id')->from('if_post')->join('if_post_images', 'if_post_images.if_post_id = if_post.if_id')->where(array("if_post.if_user_id" => $bid['user']['if_id']))->group_by('if_post_images.if_post_id')->get()->num_rows();?> Posts</a>
																	<?php
																	}
																	$json=json_decode($bid['if_json'], true);
																	?>
																	<a href="<?= base_url()."admin/userlist/profile/view/".urlencode($bid['user']['if_username'])."/".$bid['user']['if_id'];?>" target="_blank" class="btn bg-green waves-effect"><i class="material-icons">person</i>  Profile</a>
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
										echo '<tr><th colspan="4" class="text-center">There are currently no bids available for this month. if there will be any bids then it will be shown here.</tr>';
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>
								<span class="text-uppercase">Last Month <?= $active?></span>
								<small>Below is the list of last month bids that were offered for the previous month.</small>
							</h2>
						</div>
						<div class="body table-responsive">
							<table class="table table-striped table-bordered table-hover ">
								<thead>
									<tr>
										<th>Sr.</th>
										<th>Bidder</th>
										<th>Bid</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($last_bids)
										foreach ($last_bids as $key => $bid)
										{
									?>
									<tr>
										<th scope="row"><?=$key+1?></th>
										<td><?= ($bid['user']['if_role']=='Retail-Brand' && isset($bid['retail']['if_brand_name'])) ? $bid['retail']['if_brand_name'] : (($bid['user']['if_role']=='Market-Brand' && isset($bid['market']['if_shop_name'])) ? $bid['market']['if_shop_name'] : $bid['user_details']['if_full_name']); ?></td>
										<td>₨ <?=$bid['if_bid']?></td>
										<td>
											<!-- <a href="<?= base_url()?>admin/stylisthirepackages/edit/<?= $bid['if_user_id']?>/<?=$bid['if_bid']?>" class="btn bg-green waves-effect waves-green"><i class="material-icons">mode_edit</i> Edit</a> -->
											<button type="button" class="btn bg-green waves-effect m-r-20" data-toggle="modal" data-target="#largeModal<?= $bid['if_id'];?>"><i class="material-icons">visibility</i> View</button>
											<div class="modal fade" id="largeModal<?= $bid['if_id'];?>" tabindex="-1" role="dialog">
												<div class="modal-dialog modal-lg" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title text-primary" id="largeModalLabel"><?= "@".$bid['user']['if_username']?></h4>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="col-md-6">
																	<p class="text-dark"><?= $bid['user']['if_email']?></p>
																</div>
																<div class="col-md-5">
																	<?php
																	if($active!='stylist-list')
																	{
																	?>
																	<a href="<?= base_url()."admin/userlist/".(($bid['user']['if_role']=='User') ? 'user-list' : ($bid['user']['if_role']=='Stylist') ? 'stylist-list' : 'brand-list')."/posts/".urlencode($bid['user']['if_username'])."/".$bid['user']['if_id'];?>" target="_blank" class="btn bg-green waves-effect" ><i class="material-icons">insert_photo</i> <?= $this->db->select('if_post.if_id')->from('if_post')->join('if_post_images', 'if_post_images.if_post_id = if_post.if_id')->where(array("if_post.if_user_id" => $bid['user']['if_id']))->group_by('if_post_images.if_post_id')->get()->num_rows();?> Posts</a>
																	<?php
																	}
																	$json=json_decode($bid['if_json'], true);
																	?>
																	<a href="<?= base_url()."admin/userlist/profile/view/".urlencode($bid['user']['if_username'])."/".$bid['user']['if_id'];?>" target="_blank" class="btn bg-green waves-effect"><i class="material-icons">person</i>  Profile</a>
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
										echo '<tr><th colspan="4" class="text-center">There are currently no bids available for the last month.</tr>';
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
	</style>