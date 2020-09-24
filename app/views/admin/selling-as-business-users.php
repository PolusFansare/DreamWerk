	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>
					Selling as a Business List List
					<small>Taken from <a href="#" target="_blank">Vaqra APP</a></small>
				</h2>
			</div>
			<!-- User Table -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>SELLING AS A BUSINESS LIST</h2>
							<p></p>
							<!-- <ul class="header-dropdown m-r--5">
								<li class="dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<i class="material-icons">more_vert</i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a href="javascript:void(0);">Action</a></li>
										<li><a href="javascript:void(0);">Another action</a></li>
										<li><a href="javascript:void(0);">Something else here</a></li>
									</ul>
								</li>
							</ul> -->
						</div>
						<div class="body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover dataTable js-exportable">
									<thead>
										<tr>
											<th>Username</th>
											<th>Email</th>
											<th>Blocked</th>
											<th>Status</th>
											<th>Role</th>
											<th>Date</th>
											<th>Action</th>
											<th></th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Username</th>
											<th>Email</th>
											<th>Blocked</th>
											<th>Status</th>
											<th>Role</th>
											<th>Date</th>
											<th>Action</th>
											<th></th>
										</tr>
									</tfoot>
									<tbody>
										<?php

										if($users)
											foreach ($users as $key => $user)
											{
												$user['details']=$this->mysql->get_row('if_user_details', 'if_user_id ="'.$user['if_id'].'"');
												if($active=='stylist-list')
												{
													$user['stylist']	= $this->mysql->get_row('if_stylist_details', 'if_user_id ="'.$user['if_id'].'"');
													$user['stylist_cv']	= $this->mysql->get_row('if_stylist_cv', 'if_user_id ="'.$user['if_id'].'"');
												}
												elseif($active=='brand-list')
												{
													if($user['if_role']=='Market-Brand')
														$user['brand']=$this->mysql->get_row('if_market_brand', 'if_user_id ="'.$user['if_id'].'"');
													else
														$user['brand']=$this->mysql->get_row('if_retail_brand', 'if_user_id ="'.$user['if_id'].'"');
												}
												// $currency=explode(".", json_decode($user['details']['if_currency'], true)['symbol']);
										?>
										<tr>
											<td><?= $user['if_username']?></td>
											<td><?= $user['if_email']?></td>
											<td class="text-center"><?= ($user['if_blocked']==1) ? '<button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float blockThisUser" data-type="unblock" data-userid="'.$user['if_id'].'" data-userstatus="1" data-toggle="tooltip" data-placement="bottom" title="Blocked"><i class="material-icons">lock_outline</i></button>' : '<button type="button" class="btn btn-default btn-circle waves-effect waves-circle waves-float blockThisUser" data-type="block" data-userid="'.$user['if_id'].'" data-userstatus="0" data-toggle="tooltip" data-placement="bottom" title="Unblocked"><i class="material-icons">lock_open</i></button>';?></td>
											<td class="text-center"><?= ($user['if_status']==1) ? '<button type="button" class="btn btn-default btn-circle waves-effect waves-circle waves-float approveUnapprove" data-type="unapprove" data-userid="'.$user['if_id'].'" data-userstatus="1" data-toggle="tooltip" data-placement="bottom" title="Approved"><i class="material-icons">spellcheck</i></button>' : '<button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float approveUnapprove" data-type="approve" data-userid="'.$user['if_id'].'" data-userstatus="1" data-toggle="tooltip" data-placement="bottom" title="Unapproved"><i class="material-icons">block</i></p>';?></td>
											<td><?= $user['if_role'];?></td>
											<td><?= date('d F Y', strtotime($user['timestamp']))?></td>
											<td class="text-center"><button type="button" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float approveToSellAsBusiness" data-type="approve" data-userid="<?= $user['if_id'];?>" data-role="Market-Brand" data-toggle="tooltip" data-placement="bottom" title="Approve as Market Brand"><i class="material-icons">check</i></button></td>
											<td>
												<button type="button" class="btn bg-green waves-effect m-r-20" data-toggle="modal" data-target="#largeModal<?= $user['if_id'];?>">View</button>
												<div class="modal fade" id="largeModal<?= $user['if_id'];?>" tabindex="-1" role="dialog">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title text-primary" id="largeModalLabel"><?= "@".$user['if_username']?></h4>
															</div>
															<div class="modal-body">
																<div class="row">
																	<div class="col-md-6">
																		<p class="text-dark"><?= $user['if_email']?></p>
																	</div>
																	<div class="col-md-6 text-right">
																		<?php
																		if($active!='stylist-list')
																		{
																		?>
																		<a href="<?= base_url()."admin/userlist/".$active."/posts/".$user['if_username']."/".$user['if_id'];?>" target="_blank" class="btn bg-green waves-effect" ><i class="material-icons">insert_photo</i> <?= $this->db->select('if_post.if_id')->from('if_post')->join('if_post_images', 'if_post_images.if_post_id = if_post.if_id')->where(array("if_post.if_user_id" => $user['if_id']))->group_by('if_post_images.if_post_id')->get()->num_rows();?> Posts</a>
																		<?php
																		}
																		?>
																		<a href="<?= base_url()."admin/userlist/profile/view/".urlencode($user['if_username'])."/".$user['if_id'];?>" target="_blank" class="btn bg-green waves-effect"><i class="material-icons">person</i>  Profile</a>
																	</div>
																	<div class="col-md-12">
																		<table class="table table-bordered">
																			<tbody>
																				<tr>
																					<th>Username</th>
																					<td><?= $user['if_username']?></td>
																				</tr>
																				<tr>
																					<th>Email</th>
																					<td><?= $user['if_email']?></td>
																				</tr>
																				<tr>
																					<th>Mobile</th>
																					<td><?= $user['details']['if_mob']?></td>
																				</tr>
																				<tr>
																					<th>Full Name</th>
																					<td><?= $user['details']['if_full_name']?></td>
																				</tr>
																				<tr>
																					<th>DOB</th>
																					<td><?= $user['details']['if_dob']?></td>
																				</tr>
																				<tr>
																					<th>Points</th>
																					<td><?= $user['details']['if_points']?></td>
																				</tr>
																				<tr>
																					<th>Bio</th>
																					<td><?= $user['details']['if_bio']?></td>
																				</tr>
																				<tr>
																					<th>Gender</th>
																					<td><?= $user['details']['if_gender']?></td>
																				</tr>
																				<tr>
																					<th>Currency</th>
																					<td><?= json_decode(sprintf('"%s"', str_replace("u", "\u", json_decode($user['details']['if_currency'], true)['symbol'])));?></td>
																				</tr>
																				<tr>
																					<th>Location</th>
																					<td><?= $this->mysql->get_row('if_all_cities', 'id ="'.$user['details']['if_city_id'].'"', 'id')['city'].", ".$this->mysql->get_row('if_all_states', 'id ="'.$user['details']['if_state_id'].'"', 'id')['state'].", ".$this->mysql->get_row('if_all_countries', 'id ="'.$user['details']['if_country_id'].'"', 'id')['country_name'];?></td>
																				</tr>
																				<tr>
																					<th>Device Type (ID)</th>
																					<td><?= $user['details']['if_device_type']." (".(($user['details']['if_device_id'])? $user['details']['if_device_id'] : "NA").")";?></td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																	<?php
																	if(!empty($user['brand']))
																	{
																	?>
																	<div class="col-md-12">
																		<h4><?= ($user['if_role']=='Market-Brand') ? 'Market': 'Retail';?> Brand Details</h4>
																		<table class="table table-bordered">
																			<tbody>
																				<?php
																					if($user['if_role']=='Market-Brand')
																					{
																				?>
																				<tr>
																					<th>Brand Name</th>
																					<td><?= $user['brand']['if_shop_name']?></td>
																				</tr>
																				<tr>
																					<th>Clothing Range</th>
																					<td><?= $user['brand']['if_clothing_range']?></td>
																				</tr>
																				<tr>
																					<th>Description</th>
																					<td><?= $user['brand']['if_description']?></td>
																				</tr>
																				<?php
																					}
																					else
																					{
																				?>
																				<tr>
																					<th>Brand Name</th>
																					<td><?= $user['brand']['if_brand_name']?></td>
																				</tr>
																				<tr>
																					<th>Trademark No.</th>
																					<td><?= $user['brand']['if_trade_mark_num']?></td>
																				</tr>
																				<tr>
																					<th>Logo</th>
																					<td><img width="120" src="<?= ($user['brand']['if_brand_logo']) ? '/fashion_app_api/'.$user['brand']['if_brand_logo'] : base_url().'assets/admin/images/default-image.jpg';?>"></td>
																				</tr>
																				<tr>
																					<th>Certificatie</th>
																					<td><?php if(!empty($user['brand']['if_registry_certi'])){?><a href="<?= ($user['brand']['if_registry_certi']) ? '/fashion_app_api/'.$user['brand']['if_registry_certi'] : base_url().'assets/admin/images/default-image.jpg';?>" class="btn bg-green waves-effect waves-green" target="_blank"><i class="material-icons">file_download</i> Download </a><?php }else echo "<i>NA<i>"?></td>
																				</tr>
																				<tr>
																					<th>Location</th>
																					<td><?= $this->mysql->get_row('if_all_cities', 'id ="'.$user['brand']['if_city'].'"', 'id')['city'].", ".$this->mysql->get_row('if_all_states', 'id ="'.$user['brand']['if_state'].'"', 'id')['state'].", ".$this->mysql->get_row('if_all_countries', 'id ="'.$user['brand']['if_country'].'"', 'id')['country_name'];?></td>
																				</tr>
																				<?php
																					}
																				?>
																			</tbody>
																		</table>
																	</div>
																	<?php
																	}
																	?>
																	<?php
																	if(!empty($user['if_role']=='Stylist'))
																	{
																	?>
																	<div class="col-md-12">
																		<h4>Stylist Details</h4>
																		<table class="table table-bordered">
																			<tbody>
																				<tr>
																					<th>Currency</th>
																					<td><?= (isset($user['stylist']['if_currency'])) ? $user['stylist']['if_currency'] : '<i>NA<i>';?></td>
																				</tr>
																				<tr>
																					<th>Specialised in</th>
																					<td><?= (isset($user['stylist']['if_specialty_id'])) ? $this->mysql->get_row('if_stylist_specialities',array("if_id"=> $user['stylist']['if_specialty_id']))['if_title'] : '<i>NA<i>';?></td>
																				</tr>
																				<tr>
																					<th>Curriculam Vitae</th>
																					<td><?php if(!empty($user['stylist_cv']['if_cv_url'])){?><a href="<?= ($user['stylist_cv']['if_cv_url']) ? '/fashion_app_api/'.$user['stylist_cv']['if_cv_url'] : base_url().'assets/admin/images/default-image.jpg';?>" class="btn bg-green waves-effect waves-green" target="_blank"><i class="material-icons">file_download</i> Download </a><?php }else echo "<i>NA<i>"?></td>
																				</tr>
																				<tr>
																					<th>Description</th>
																					<td><?= (isset($user['stylist']['if_currency'])) ? $user['stylist']['if_description'] : '<i>NA<i>';?></td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																	<?php
																	}
																	?>
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