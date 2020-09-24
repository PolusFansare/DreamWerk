	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2><?= ucfirst(str_replace("-", " ", $active));?></h2>
			</div>
			<!-- Hover Rows -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>Filter Orders</h2>
							<!-- <small></small> -->
						</div>
						<div class="body">
							<form method="GET" id="filter-orders" class="filter-orders">
								<div class="row">
									<div class="col-sm-4">
										<b>Order Number</b>
										<div class="form-group">
											<div class="form-line">
												<input class="form-control order_num" type="text" name="order_num" value="<?= ($this->input->get('order_num')) ? $this->input->get('order_num'): "";?>">
											</div>
										</div>
									</div>
									<?php
									if(!empty($statuses))
									{
									?>
									<div class="col-sm-4">
										<b>Statuses</b>
										<select class="form-control show-tick order_status" name="order_status">
											<option value="">-- Select Status --</option>
											<?php
											foreach ($statuses as $key => $status)
												echo '<option value="'.$status['if_code'].'" '.(($this->input->get('order_status')) ? (($this->input->get('order_status')==$status['if_code']) ? 'selected' : '') : "").'>'.$status['if_name'].'</option>';
											?>
										</select>
									</div>
									<?php
									}
									?>
									<!-- <div class="col-sm-6">
										<b>HEX CODE</b>
										<div class="form-group">
											<div class="form-line">
												<input type="text" class="form-control" placeholder="Password">
											</div>
										</div>
									</div> -->
									<div class="col-sm-12 text-right">
										<button class="btn bg-green">Filter Now</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="card">
						<div class="header">
							<h2>
								<span class="text-uppercase"><?= str_replace("-", " ", $active)?></span>
								<small>Orders on Vaqra are listed here.</small>
							</h2>
						</div>
						<div class="body table-responsive">
							<table class="table table-striped table-bordered table-hover dataTable js-exportable">
								<thead>
									<tr>
										<th>Sr.</th>
										<th>Order ID</th>
										<th>Cart Total</th>
										<th>Total</th>
										<th>Location</th>
										<th>Payment Status</th>
										<th>Order Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($orders)
										foreach ($orders as $key => $order)
										{
									?>
									<tr>
										<th scope="row"><?=$key+1?></th>
										<td class="col-blue" role="button" data-toggle="modal" data-target="#largeModal<?= $order['if_id'];?>">ORD-<?=$order['if_id']?></td>
										<td>₨ <?=$order['if_cart_total']?></td>
										<td>₨ <?=$order['if_total_amt']?></td>
										<td><?= $order['if_location']?></td>
										<td><?= $order['if_payment_status']?></td>
										<td class="<?= ($order['if_order_status']=="PROCESSING") ? 'col-cyan': (($order['if_order_status']=="PACKAGED") ? 'col-blue' : (($order['if_order_status']=="DISPATCHED") ? 'col-light-green' : (($order['if_order_status']=="SHIPPED") ? 'col-green' : (($order['if_order_status']=="DELIVERED") ? 'col-teal' : (($order['if_order_status']=="CANCELED") ? 'col-red' : '')))))?>"><?= ucfirst(strtolower($order['if_order_status']));?></td>
										<td>
											<button type="button" class="btn bg-green waves-effect m-r-20" data-toggle="modal" data-target="#largeModal<?= $order['if_id'];?>"><i class="material-icons">visibility</i> View</button>
											<div class="modal fade" id="largeModal<?= $order['if_id'];?>" tabindex="-1" role="dialog">
												<div class="modal-dialog modal-xl modal-lg" role="document">
													<div class="modal-content">
														<div class="modal-header border-bottom">
															<div class="row">
																<div class="col-md-11 mb-0">
																	<h4 class="modal-title col-green" id="largeModalLabel">ORD-<?= $order['if_id']?></h4>
																</div>
																<div class="col-md-1 mb-0 text-right">
																	<button type="button" class="btn btn-default btn-circle waves-effect waves-circle waves-float waves-green" data-dismiss="modal"><i class="material-icons">close</i></button>
																</div>
															</div>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="col-md-9">
																	<p class="text-dark">ORD-<?= $order['if_id']?></p>
																</div>
																<div class="col-md-3 text-right">
																	<?php
																	if($active!='stylist-list')
																	{
																	?>
																	<a href="<?= base_url()."admin/userlist/".(($order['user']['if_role']=='User') ? 'user-list' : ($order['user']['if_role']=='Stylist') ? 'stylist-list' : 'brand-list')."/posts/".urlencode($order['user']['if_username'])."/".$order['user']['if_id'];?>" target="_blank" class="btn bg-green waves-effect" role="button" data-toggle="tooltip" data-placement="top" title="<?= $this->db->select('if_post.if_id')->from('if_post')->join('if_post_images', 'if_post_images.if_post_id = if_post.if_id')->where(array("if_post.if_user_id" => $order['user']['if_id']))->group_by('if_post_images.if_post_id')->get()->num_rows();?> Posts">
																		<i class="material-icons">insert_photo</i>
																		<span></span>
																	</a>
																	<?php
																	}
																	?>
																	<a href="<?= base_url()."admin/userlist/profile/view/".urlencode($order['user']['if_username'])."/".$order['user']['if_id'];?>" target="_blank" class="btn bg-light-green waves-effect" data-toggle="tooltip" data-placement="top" title="Go to Buyers Profile"><i class="material-icons">person</i></a>
																	<button class="btn bg-orange waves-effect" role="button" onclick="printElement(document.getElementById('largeModal<?= $order['if_id'];?>'));" data-toggle="tooltip" data-placement="top" title="Print Order">
																		<i class="material-icons">print</i>
																	</button>
																	<button type="button" class="btn bg-red waves-effect deleteOrder" data-toggle="tooltip" data-placement="top" title="Delete this Order" data-orderid="<?= $order['if_id']?>">
																		<i class="material-icons">delete</i>
																	</button>
																</div>
																<div class="col-md-12 text-right">
																	<?php
																	if($statuses && empty($order['tcs_details']))
																		foreach ($statuses as $key => $status)
																		{
																	?>
																	<button type="button" class="btn bg-<?= ($status['if_code']=="PROCESSING") ? 'cyan': (($status['if_code']=="PACKAGED") ? 'blue' : (($status['if_code']=="DISPATCHED") ? 'light-green' : (($status['if_code']=="SHIPPED") ? 'green' : (($status['if_code']=="DELIVERED") ? 'teal' : (($status['if_code']=="CANCELED") ? 'red' : '')))))?> waves-effect changeOrderStatus" data-toggle="tooltip" data-placement="top" title="Change status to <?= $status['if_name']?>" data-orderid="<?= $order['if_id']?>" data-status="<?= $status['if_code']?>">
																		<?= ($status['if_code']==$order['if_order_status']) ? '<i class="material-icons">check_circle</i>' : '';?>
																		<span><?= $status['if_name']?></span>
																	</button>
																	<?php
																		}
																	?>																	
																</div>
																<?php
																if(!empty($order['tcs_details']))
																{
																?>
																<div class="col-md-12">
																	<table class="table table-bordered table-striped table-hover">
																		<tbody>
																			<tr>
																				<th>Consignment Number</th>
																				<td><?= $order['tcs_details']['if_consignment_num']?></a></td>
																			</tr>
																			<tr>
																				<th>Buyer Full Name</th>
																				<td><a href="<?= base_url()."admin/userlist/profile/view/".urlencode($order['tcs_details']['if_seller_costCenterCode'])."/".$order['tcs_details']['if_buyer_id'];?>" target="_blank"><?= $order['tcs_details']['if_buyer_fullname']?></a></td>
																			</tr>
																			<tr>
																				<th>Buyer Email</th>
																				<td><?= $order['tcs_details']['if_buyer_email']?></a></td>
																			</tr>
																			<tr>
																				<th>Buyer Mob</th>
																				<td><?= $order['tcs_details']['if_buyer_mob']?></a></td>
																			</tr>
																			<tr>
																				<th>Buyer Address</th>
																				<td><?= $order['tcs_details']['if_buyer_address']?></a></td>
																			</tr>
																			<tr>
																				<th>Pickup City</th>
																				<td><?= $order['tcs_details']['if_pickup_city']?></a></td>
																			</tr>
																			<tr>
																				<th>Delivery City</th>
																				<td><?= $order['tcs_details']['if_delivery_city']?></a></td>
																			</tr>
																			<tr>
																				<th>Weight</th>
																				<td><?= $order['tcs_details']['if_weight']?></a></td>
																			</tr>
																			<tr>
																				<th>Pieces</th>
																				<td><?= $order['tcs_details']['if_qty']?></a></td>
																			</tr>
																			<tr>
																				<th>Product Details</th>
																				<td><?= $order['tcs_details']['if_product_details']?></a></td>
																			</tr>
																			<tr>
																				<th>Is Fragile</th>
																				<td><?= $order['tcs_details']['if_fragile']?></a></td>
																			</tr>
																			<tr>
																				<th>Insurance</th>
																				<td><?= $order['tcs_details']['if_insurance']?></a></td>
																			</tr>
																			<tr>
																				<th>Remarks</th>
																				<td><?= $order['tcs_details']['if_remarks']?></a></td>
																			</tr>
																			</tr>
																		</tbody>
																	</table>
																</div>
																	<?php
																	if(!empty($order['tcs_track']) && false)
																	{
																	?>
																	<div class="col-md-12">
																		<h4>Order Tracking Details</h4>
																		<table class="table table-bordered table-striped table-hover">
																			<tbody>
																				<tr>
																					<th>Consignment Number</th>
																					<td><?= $order['tcs_track'][0]['if_consignment_num']?></a></td>
																				</tr>
																				<tr>
																					<th>Buyer Full Name</th>
																					<td><a href="<?= base_url()."admin/userlist/profile/view/".urlencode($order['tcs_details']['if_seller_costCenterCode'])."/".$order['tcs_details']['if_buyer_id'];?>" target="_blank"><?= $order['tcs_details']['if_buyer_fullname']?></a></td>
																				</tr>
																				<tr>
																					<th>Buyer Email</th>
																					<td><?= $order['tcs_details']['if_buyer_email']?></a></td>
																				</tr>
																				<tr>
																					<th>Buyer Mob</th>
																					<td><?= $order['tcs_details']['if_buyer_mob']?></a></td>
																				</tr>
																				<tr>
																					<th>Buyer Address</th>
																					<td><?= $order['tcs_details']['if_buyer_address']?></a></td>
																				</tr>
																				<tr>
																					<th>Pickup City</th>
																					<td><?= $order['tcs_details']['if_pickup_city']?></a></td>
																				</tr>
																				<tr>
																					<th>Delivery City</th>
																					<td><?= $order['tcs_details']['if_delivery_city']?></a></td>
																				</tr>
																				<tr>
																					<th>Weight</th>
																					<td><?= $order['tcs_details']['if_weight']?></a></td>
																				</tr>
																				<tr>
																					<th>Pieces</th>
																					<td><?= $order['tcs_details']['if_qty']?></a></td>
																				</tr>
																				<tr>
																					<th>Product Details</th>
																					<td><?= $order['tcs_details']['if_product_details']?></a></td>
																				</tr>
																				<tr>
																					<th>Is Fragile</th>
																					<td><?= $order['tcs_details']['if_fragile']?></a></td>
																				</tr>
																				<tr>
																					<th>Insurance</th>
																					<td><?= $order['tcs_details']['if_insurance']?></a></td>
																				</tr>
																				<tr>
																					<th>Remarks</th>
																					<td><?= $order['tcs_details']['if_remarks']?></a></td>
																				</tr>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																	<?php
																	}
																	?>
																<?php
																}
																else
																{
																?>
																<div class="col-md-12">
																	<table class="table table-bordered table-striped table-hover">
																		<tbody>
																			<tr>
																				<th>Username</th>
																				<td><a href="<?= base_url()."admin/userlist/profile/view/".urlencode($order['user']['if_username'])."/".$order['user']['if_id'];?>" target="_blank"><?= "@".$order['user']['if_username']?></a></td>
																			</tr>
																			<tr>
																				<th>Full Name</th>
																				<td><a href="<?= base_url()."admin/userlist/profile/view/".urlencode($order['user']['if_username'])."/".$order['user']['if_id'];?>" target="_blank"><?= $order['user']['if_full_name']." (".$order['user']['if_gender'].")";?></a></td>
																			</tr>
																			<tr>
																				<th>Mobile</th>
																				<td><?= $order['user']['if_mob']?></td>
																			</tr>
																			<tr>
																				<th>Billing Address</th>
																				<td><?php if($order['user']['if_city_id'] || $order['user']['if_state_id'] || $order['user']['if_country_id']){ if($order['user']['if_city_id']) echo '<span class="label col-grey" data-toggle="tooltip" data-placement="top" title="Home"><i class="material-icons font-18">home</i></span> '.$this->mysql->get_row('if_all_cities', array("id"=>$order['user']['if_city_id']), 'id')['city'].", "; if($order['user']['if_state_id']) echo $this->mysql->get_row('if_all_states', array("id"=>$order['user']['if_state_id']), 'id')['state'].", "; if($order['user']['if_country_id']) echo $this->mysql->get_row('if_all_countries', array("id"=>$order['user']['if_country_id']), 'id')['country_name'].".";} else echo '<i>NA</i>';?>
																					<?php if($order['user']['if_role']=='Market-Brand' || $order['user']['if_role']=='Retail-Brand'){if($order['user']['if_city'] || $order['user']['if_state'] || $order['user']['if_country']){ if($order['user']['if_city']) echo '<br><br><span class="label col-grey" data-toggle="tooltip" data-placement="top" title="Main office"><i class="material-icons font-18">store_mall_directory</i></span> '.$this->mysql->get_row('if_all_cities', array("id"=>$order['user']['if_city']), 'id')['city'].", "; if($order['user']['if_state']) echo $this->mysql->get_row('if_all_states', array("id"=>$order['user']['if_state']), 'id')['state'].", "; if($order['user']['if_country']) echo $this->mysql->get_row('if_all_countries', array("id"=>$order['user']['if_country']), 'id')['country_name'].".";} else echo '<br><br><i>NA</i>';}?></td>
																			</tr>
																			<tr>
																				<th>Shipping Address</th>
																				<td>
																					<div class="input-group">
																						<span class="input-group-addon" style="width: 4%">
																							<i class="material-icons font-18">local_shipping</i>
																						</span>
																						<input type="text" class="form-control" name="shippingAddress" value="<?= (!empty($order['if_location'])) ? $order['if_location'] : "";?>" placeholder="Shipping Address">
																						<span class="input-group-addon p-0" style="width: 4%">
																							<button class="btn bg-green updateShippingAddress" data-orderid="<?= $order['if_id']?>">Update</button>
																						</span>
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<th>Order Status</th>
																				<td class="<?= ($order['if_order_status']=="PROCESSING") ? 'col-cyan': (($order['if_order_status']=="PACKAGED") ? 'col-blue' : (($order['if_order_status']=="DISPATCHED") ? 'col-light-green' : (($order['if_order_status']=="SHIPPED") ? 'col-green' : (($order['if_order_status']=="DELIVERED") ? 'col-teal' : (($order['if_order_status']=="CANCELED") ? 'col-red' : '')))))?>"><?= ucfirst(strtolower($order['if_order_status']))?></td>
																			</tr>
																		</tbody>
																	</table>
																</div>
																<?php
																}
																?>
															</div>
															<div class="row border-bottom border-top">
																<div class="col-md-12 border-bottom">
																	<h4 class="col-green">Cart Items</h4>
																</div>
																<hr>
																<?php
																if($order['cart'])
																	foreach ($order['cart'] as $key => $item)
																	{
																?>
																<div class="col-md-3">
																	<div class="panel panel-default panel-post mb-0">
																		<div class="panel-heading">
																			<div class="media">
																				<div class="media-left">
																					<a target="_blank" href="<?= base_url()."admin/userlist/profile/view/".urlencode($item['user']['if_username'])."/".$item['user']['if_id'];?>">
																						<img src="<?= ($item['profile_image']['if_image']) ? '/fashion_app_api/'.$item['profile_image']['if_image'] : base_url().'assets/admin/images/user_default.png';?>" />
																					</a>
																				</div>
																				<div class="media-body">
																					<h4 class="media-heading">
																						<a target="_blank" href="<?= base_url()."admin/userlist/profile/view/".urlencode($item['user']['if_username'])."/".$item['user']['if_id'];?>"><?= ($item['profile']['if_full_name']) ? $item['profile']['if_full_name'] : $item['profile']['if_username'];?></a>
																					</h4>
																					Shared publicly - <?= date("d M Y", strtotime($item['post']['timestamp']));?>
																				</div>
																			</div>
																		</div>
																		<div class="panel-body">
																			<div class="post">
																				<div class="post-heading">
																					<p><?= ($item['post']['if_description']) ? $item['post']['if_description'] : '<i>NA</i>';?></p>
																					<p class="col-cyan"><?php $hashes=explode(" ", $item['post']['if_hash_tag']); foreach ($hashes as $key => $hash) echo (strpos($hash, '#') !== false) ? $hash." " : "#".$hash." "?></p>
																				</div>
																				<div class="post-content">
																					<?php
																					if (isset($item['post_images'][1]))
																					{
																					?>
																					<div id="postcarousel<?= $item['if_id']?>" class="carousel slide" data-ride="carousel" data-interval="false">
																						<!-- Indicators -->
																						<ol class="carousel-indicators">
																							<?php
																							foreach ($item['post_images'] as $key => $image)
																								echo '<li data-target="#postcarousel'.$item['if_id'].'" data-slide-to="'.$key.'" class="'.(($key==0)?'active':'').'"></li>';
																							?>
																						</ol>

																						<!-- Wrapper for slides -->
																						<div class="carousel-inner shadow-sm" role="listbox">
																							<?php
																							foreach ($item['post_images'] as $key => $image)
																							{
																							?>
																							<div class="item <?= ($key==0)? 'active' :'';?>">
																								<a class="show-light-gallery" href="/fashion_app_api/<?= $image['if_post_image']?>" data-sub-html="<?= $item['post']['if_description']?>" target="_blank">
																									<?php
																									if($image['if_post_filetype']=='Image')
																										echo '<img src="/fashion_app_api/'.$image['if_post_image'].'">';
																									elseif($image['if_post_filetype']=='Video')
																									{
																									?>
																									<video>
																										<source src="<?= '/fashion_app_api/'.$image['if_post_image'];?>" type="<?= mime_content_type(APPPATH.'../../fashion_app_api/'.$image['if_post_image']);?>">
																										Your browser does not support HTML5 video.
																									</video>
																									<?php
																									}
																									?>
																									
																								</a>
																							</div>
																							<?php
																							}
																							?>
																						</div>

																						<!-- Controls -->
																						<a class="left carousel-control" href="#postcarousel<?= $item['if_id']?>" role="button" data-slide="prev" data-toggle="tooltip" data-placement="top" title="" data-original-title="Previous">
																							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
																							<span class="sr-only">Previous</span>
																						</a>
																						<a class="right carousel-control" href="#postcarousel<?= $item['if_id']?>" role="button" data-slide="next" data-toggle="tooltip" data-placement="top" title="" data-original-title="Next">
																							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
																							<span class="sr-only">Next</span>
																						</a>
																					</div>
																					<?php
																					}
																					else
																					{
																					?>
																					<div class="shadow-sm">
																						<?php
																						if($item['post_images'][0]['if_post_filetype']=='Image')
																							echo '<img class="single-image-post"  src="/fashion_app_api/'.$item['post_images'][0]['if_post_image'].'">';
																						elseif($item['post_images'][0]['if_post_filetype']=='Video')
																						{
																						?>
																						<video class="single-image-post" >
																							<source src="<?= '/fashion_app_api/'.$item['post_images'][0]['if_post_image'];?>" type="<?= mime_content_type(APPPATH.'../../fashion_app_api/'.$item['post_images'][0]['if_post_image']);?>">
																							Your browser does not support HTML5 video.
																						</video>
																						<?php
																						}
																						?>
																						<!-- <img class="single-image-post" src="<?= (!empty($item['post_images'][0]['if_post_image'])) ? "/fashion_app_api/".$item['post_images'][0]['if_post_image'] : base_url().'assets/admin/images/default-image.png';?>"> -->
																					</div>
																					<?php
																					}

																					?>
																				</div>
																			</div>
																		</div>
																		<div class="panel-footer">
																			<ul class="border-bottom mb-4 pb-2">
																				<li>
																					<a href="#">
																						<i class="material-icons">thumb_up</i>
																						<span><?= ($count=$this->mysql->get_count('if_likes', array("if_post_id"=> $item['post']['if_id'], "if_status"=> 1))) ? $count : '0' ;?> Likes</span>
																					</a>
																				</li>
																				<li>
																					<a href="#">
																						<i class="material-icons">comment</i>
																						<span><?= ($count=$this->mysql->get_count('if_comments', array("if_post_id"=> $item['post']['if_id']))) ? $count : '0' ;?> Comments</span>
																					</a>
																				</li>
																				<li>
																					<!-- <a href="#">
																						<i class="material-icons">share</i>
																						<span>Share</span>
																					</a> -->
																				</li>
																			</ul>
																			<ul class="border-bottom mb-2 pb-2">
																				<li>
																					<span>Current Price</span>
																				</li>
																				<li>
																					<span><?= ($item['post']['if_currency']) ? $item['post']['if_currency'] : '₨' ;?> <?= ($item['post']['if_price']) ? $item['post']['if_price'] : '0' ;?></span>
																				</li>
																			</ul>
																			<ul class="border-bottom mb-2 pb-2">
																				<li>
																					<span>On Purchase</span>
																				</li>
																				<li>
																					<span><?= ($item['post']['if_currency']) ? $item['post']['if_currency'] : '₨' ;?> <?= ($item['if_price']) ? $item['if_price'] : '0' ;?></span>
																				</li>
																			</ul>
																			<ul class="border-bottom mb-2 pb-2">
																				<li>
																					<span>Quantity</span>
																				</li>
																				<li>
																					<a href="#">
																						<i class="material-icons">add_shopping_cart</i>
																						<span><?= $item['if_qty'];?></span>
																					</a>
																				</li>
																			</ul>
																			<ul class="border-bottom mb-2 pb-2">
																				<li>
																					<span>Size</span>
																				</li>
																				<li>
																					<a href="#">
																						<span><?= $item['if_size'];?></span>
																					</a>
																				</li>
																			</ul>
																			<ul class="">
																				<li>
																					<span>Sub Total</span>
																				</li>
																				<li>
																					<a href="#">
																						<span><?= ($item['post']['if_currency']) ? $item['post']['if_currency'] : '₨' ;?> <?= ($item['if_sub_total']) ? $item['if_sub_total'] : '0' ;?></span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</div>
																<?php
																	}
																?>
															</div>
															<?php
															if($order['dispat_details'])
															{
															?>
															<div class="row border-bottom mt-2">
																<div class="col-md-6"></div>
																<div class="col-md-6">
																	<p><span class="font-bold">Tracking ID :</span> <?= $order['dispat_details']['if_tracking_company']?></p>
																	<p><span class="font-bold">Company :</span> <?= $order['dispat_details']['if_tracking_id']?></p>
																	<p><span class="font-bold">Receipts :</span></p>
																	<img class="img-thumbnail receipt" src="<?= '/fashion_app_api/'.$order['dispat_details']['if_receipt1']?>">
																	<img class="img-thumbnail receipt" src="<?= '/fashion_app_api/'.$order['dispat_details']['if_receipt2']?>">
																</div>
															</div>
															<?php
															}
															?>
															<div class="row">
																<div class="col-md-7 mt-4"></div>
																<div class="col-md-5 mt-4">
																	<table class="table table-bordered table-hover shadow-sm">
																		<tbody>
																			<tr>
																				<th>Cart Total</th>
																				<td class="text-right"><?= ($item['post']['if_currency']) ? $item['post']['if_currency'] : '₨' ;?> <?= $order['if_cart_total']?></td>
																			</tr>
																			<?php
																			if($order['promo'])
																			{
																			?>
																			<tr>
																				<th>Promo Codes Discount <?= ($order['promo']['if_discount_type']=='Percent') ? "(".$order['if_promo_code'].")" : ''?></th>
																				<td class="text-right"><?= ($order['promo']['if_discount_type']=='Percent') ? $order['promo']['if_discount']."%" : $order['promo']['if_discount']; ?></td>
																			</tr>
																			<?php
																			}
																			?>
																			<?php
																			if($order['if_points'])
																			{
																			?>
																			<tr>
																				<th>Points Discount</th>
																				<td class="text-right"><?= $order['if_points']?></td>
																			</tr>
																			<?php
																			}
																			?>
																			<tr>
																				<th>Sub Total</th>
																				<td class="text-right"><?= ($item['post']['if_currency']) ? $item['post']['if_currency'] : '₨' ;?> <?= $order['if_subtotal']?></td>
																			</tr>
																			<tr>
																				<th>Shipping amt.</th>
																				<td class="text-right"><?= ($item['post']['if_currency']) ? $item['post']['if_currency'] : '₨' ;?> <?= $order['if_shipping_amt']?></td>
																			</tr>
																		</tbody>
																	</table>
																	<table class="table table-bordered table-hover shadow-sm">
																		<tbody>
																			<tr>
																				<th>Total</th>
																				<td class="text-right"><?= ($item['post']['if_currency']) ? $item['post']['if_currency'] : '₨' ;?> <?= $order['if_total_amt']?></td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default waves-effect" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Close">
																<i class="material-icons">expand_less</i>
															</button>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
									<?php
										}
									else
										echo '<tr><th colspan="8" class="text-center">There are currently no Orders available at the moment. Please try after sometimes or contact support to know more information about that.</tr>';
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
		.carousel-inner .item {
			height: 176px;
			margin: auto;
		}
		/*.thumbnail {
			height: 450px;
		}*/
		.carousel-inner .item img, .carousel-inner .item a img {
			height: inherit;
			width: 100%;
			object-fit: contain;
		}
		a.carousel-control.right, a.carousel-control.left {
			background-image: unset;
		}
		img.single-image-post {
			height: 176px;
			width: 100%;
			object-fit: contain;
		}
		.post-video
		{
			height: 260px;
			width: 100%;
		}
		.item a
		{
			height: inherit;
			width: 100%;
		}
		.receipt
		{
			width: 49%;
			float: left;
			margin: 0px 2px;
		}
	</style>