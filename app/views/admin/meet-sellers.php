<?php
if(!empty($edit))
{
	$seller=$this->mysql->get_row("if_meet_sellers", "if_id = '$edit'");
	if(!$seller)
		redirect("admin/meetsellers");
?>
	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>Edit Meet Seller</h2>
			</div>
			<div class="block-header">
				<a href="<?= base_url('admin/meetsellers')?>" class="btn bg-green btn-xs waves-effect"><i class="material-icons">reply</i> Back</a>
			</div>

			<!-- TinyMCE -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2><?= "#".$seller['if_name']?><small>Changes may affect the running applications (IOS / Andr.).</small></h2>
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
							<?php
							if(isset($updated))
							{
								if($updated)
									echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Well done!</strong> You successfully updated '."#".$seller['if_name'].'.</div>';
								else
									echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>';
							}
							if(isset($error))
								echo '<div class="alert alert-danger">'.$error.'</div>';
							?>
							<form action="" method="POST" enctype="multipart/form-data">
								<div class="row clearfix">
									<div class="col-lg-8">
										<div class="row">
											<div class="col-sm-7">
												<div class="form-group form-float">
													<div class="form-line focused">
														<input type="text" name="seller_name" class="form-control" value="<?= $seller['if_name']?>" required/>
														<input type="hidden" name="seller_id" class="form-control" value="<?= $seller['if_id']?>" required/>
														<label class="form-label">Name</label>
													</div>
												</div>
											</div>
											<!-- <div class="col-sm-2">
												<div class="switch">
													<label><input name="cat_status" type="checkbox" <?= ($seller['if_name'])? 'checked' : '';?> value="1"><span class="lever switch-col-green"></span></label>
												</div>
											</div> -->
										</div>
										<div class="row">
											<div class="col-sm-7">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="file" name="cat_image" class="form-control" required="">
													</div>
												</div>
											</div>
											<div class="col-sm-10">
												<div class="form-group form-float">
													<button class="btn bg-green" type="submit">Submit</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- #END# TinyMCE -->
		</div>
	</section>
<?php
}
elseif(!empty($view))
{
?>
	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>
					<?= $seller['if_name']?> List
					<small>Taken from <a href="#" target="_blank">Vaqra APP</a></small>
				</h2>
			</div>
			<div class="block-header">
				<a href="<?= base_url('admin/meetsellers')?>" class="btn bg-green btn-xs waves-effect"><i class="material-icons">reply</i> Back</a>
			</div>
			<!-- User Table -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>Filter <?= $seller['if_name']?> List</h2>
							<!-- <small></small> -->
						</div>
						<div class="body">
							<form method="POST" id="filter-users" class="filter-users">
								<div class="row">
									<div class="col-sm-4">
										<b>Username</b>
										<div class="form-group">
											<div class="form-line">
												<input class="form-control" type="text" name="username" value="<?= ($this->input->post('username')) ? $this->input->post('username'): "";?>">
											</div>
										</div>
									</div>
									<?php
									if($profile_type && $active=='user-list')
									{
									?>
									<div class="col-sm-4">
										<b>Profile type</b>
										<select class="form-control show-tick" name="profile_type">
											<option value="">-- Select --</option>
											<?php
											foreach ($profile_type as $key => $type)
												echo '<option value="'.$type['if_points'].'" '.(($this->input->post('profile_type')) ? (($this->input->post('profile_type')==$type['if_points']) ? 'selected' : '') : "").'>'.$type['if_name'].'</option>';
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
							<h2><?= strtoupper($seller['if_name'])?> LIST</h2>
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
								<table class="table table-bordered table-striped table-hover dataTable js-exportable" data-language='{"search": "Quick Search:","searchPlaceholder": "Email, Phone, Name"}'>
									<thead>
										<tr>
											<th>Username</th>
											<th>Email</th>
											<th>Blocked</th>
											<th>Status</th>
											<th>Role</th>
											<th>Date</th>
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
											<th></th>
										</tr>
									</tfoot>
									<tbody>
										<?php
										if(!empty($view))
										{
											if($view==1)
											{
												$details=$this->db->query('SELECT `if_post_id`, COUNT(*) FROM `if_cart`, `if_post` WHERE `if_cart`.`if_post_id`=`if_post`.`if_id` GROUP BY `if_post`.`if_user_id` ORDER BY COUNT(*) DESC')->result_array();
												$check='';
											}
											elseif($view==2)
											{
												$details=$this->db->query('SELECT `if_post_id`, COUNT(*) FROM `if_cart`, `if_post` WHERE `if_cart`.`if_post_id`=`if_post`.`if_id` GROUP BY `if_post`.`if_user_id` ORDER BY COUNT(*) DESC')->result_array();
												$check='Male';
											}
											elseif($view==3)
											{
												$details=$this->db->query('SELECT `if_post_views`.`if_post_id`, `if_post`.`if_id`,`if_post`.`if_user_id`, COUNT(*) FROM `if_post_views` JOIN `if_post` ON `if_post_views`.`if_post_id`=`if_post`.`if_id` GROUP BY `if_post`.`if_user_id` ORDER BY COUNT(*) DESC')->result_array();
												$check='Male';
											}
											elseif($view==4)
											{
												$details=$this->db->query('SELECT `if_post_views`.`if_post_id`, `if_post`.`if_id`,`if_post`.`if_user_id`, COUNT(*) FROM `if_post_views` JOIN `if_post` ON `if_post_views`.`if_post_id`=`if_post`.`if_id` GROUP BY `if_post`.`if_user_id` ORDER BY COUNT(*) DESC')->result_array();
												$check='Female';
											}
											elseif($view==5)
											{
												$details=$this->db->query('SELECT `if_post_views`.`if_post_id`, `if_post`.`if_id`,`if_post`.`if_user_id`, COUNT(*) FROM `if_post_views` JOIN `if_post` ON `if_post_views`.`if_post_id`=`if_post`.`if_id` GROUP BY `if_post`.`if_user_id` ORDER BY COUNT(*) DESC')->result_array();
												$check='';
											}
											if(!empty($details))
											{
												$i=0;
												foreach ($details as $key => $top_post3) 
												{
													unset($details[$key]);
													$post3 	= $this->db->query("SELECT * FROM `if_post` WHERE `if_id`='".$top_post3['if_post_id']."' AND `if_blocked`='0' AND `if_status`='1' ORDER BY `timestamp` DESC")->row_array();
													if($view==1 || $view==3 || $view==4 || $view==5)
														$user=$this->mysql->get_row('if_user_details, if_user_login', 'if_role !="Admin" AND `if_role`="User" AND if_user_details.if_user_id=if_user_login.if_id AND if_user_login.if_id="'.$post3['if_user_id'].'" '.(($this->input->post("profile_type")) ? " AND `if_user_details`.`if_points`>'".$this->input->post("profile_type")."'" : "").(($this->input->post("username")) ? " AND `if_user_login`.`if_username` LIKE '%".$this->input->post("username")."%'" : ""), 'if_role');
													else
														$user=$this->mysql->get_row('if_user_details, if_user_login', 'if_role !="Admin" AND if_user_details.if_user_id=if_user_login.if_id AND `if_role` LIKE "%Brand"AND if_user_login.if_id="'.$post3['if_user_id'].'" '.(($this->input->post("profile_type")) ? " AND `if_user_details`.`if_points`>'".$this->input->post("profile_type")."'" : "").(($this->input->post("username")) ? " AND `if_user_login`.`if_username` LIKE '%".$this->input->post("username")."%'" : ""), 'if_role');
													if(!empty($user))
													{
														$user['details']=$this->mysql->get_row('if_user_details', 'if_user_id ="'.$user['if_id'].'"');
														if(($user['details']['if_gender'] == $check) || $view==1 || $view==2 || ($view==5 && $post3['if_facebook'] == '1' && $post3['if_insta'] == '1' && $post3['if_twitter'] == '1'))
														{
															if($user['if_role']=='stylist-list')
															{
																$user['stylist']	= $this->mysql->get_row('if_stylist_details', 'if_user_id ="'.$user['if_id'].'"');
																$user['stylist_cv']	= $this->mysql->get_row('if_stylist_cv', 'if_user_id ="'.$user['if_id'].'"');
															}
															elseif($user['if_role']=='brand-list')
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
																<td class="text-center"><?= ($user['if_blocked']==1) ? '<button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float blockThisUser" data-type="unblock" data-userid="'.$user['if_id'].'" data-userstatus="1" data-toggle="tooltip" data-placement="bottom" title="User is Blocked."><i class="material-icons">lock_outline</i></button>' : '<button type="button" class="btn btn-default btn-circle waves-effect waves-circle waves-float blockThisUser" data-type="block" data-userid="'.$user['if_id'].'" data-userstatus="0" data-toggle="tooltip" data-placement="bottom" title="User is Unblocked."><i class="material-icons">lock_open</i></button>';?></td>
																<td class="text-center"><?= ($user['if_status']==1) ? '<button type="button" class="btn btn-default btn-circle waves-effect waves-circle waves-float approveUnapprove" data-type="unapprove" data-userid="'.$user['if_id'].'" data-userstatus="1" data-toggle="tooltip" data-placement="bottom" title="User is Aapproved"><i class="material-icons">spellcheck</i></button>' : '<button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float approveUnapprove" data-type="approve" data-userid="'.$user['if_id'].'" data-userstatus="1" data-toggle="tooltip" data-placement="bottom" title="User is Unapproved"><i class="material-icons">block</i></p>';?></td>
																<td><?= $user['if_role'];?></td>
																<td><?= date('d F Y', strtotime($user['timestamp']))?></td>
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
															if($active=='stylist-list')
																$users=$this->mysql->get_data('if_user_details, if_user_login', 'if_role !="Admin" AND if_role ="Stylist" AND if_user_details.if_user_id=if_user_login.if_id'.(($this->input->post("profile_type")) ? " AND `if_user_details`.`if_points`>'".$this->input->post("profile_type")."'" : "").(($this->input->post("username")) ? " AND `if_user_login`.`if_username` LIKE '%".$this->input->post("username")."%'" : ""), 'if_role');
															elseif($active=='brand-list')
																$users=$this->mysql->get_data('if_user_login', 'if_role !="Admin" AND (if_role ="Retail-Brand" OR if_role ="Market-Brand")'.(($this->input->post("username")) ? " AND `if_user_login`.`if_username` LIKE '%".$this->input->post("username")."%'" : ""), 'if_role');
															else
																$users=$this->mysql->get_data('if_user_details, if_user_login', 'if_role !="Admin" AND if_role ="User" AND if_user_details.if_user_id=if_user_login.if_id'.(($this->input->post("profile_type")) ? " AND `if_user_details`.`if_points`>'".$this->input->post("profile_type")."'" : "").(($this->input->post("username")) ? " AND `if_user_login`.`if_username` LIKE '%".$this->input->post("username")."%'" : ""), 'if_role');
														}
													}
												}
											}
										}
										// echo $this->db->last_query();die();
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
<?php
}
else
{
?>
	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>
					Meet Sellers
					<small>Taken from <a href="#" target="_blank">Vaqra APP</a></small>
				</h2>
			</div>
			<!-- Custom Content -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>
								MEET SELLERS
								<small>Below is the list of Discover Sellers section.</small>
							</h2>
						</div>
						<div class="body">
							<div class="row" id="aniimated-thumbnials">
								<?php
								$sellers=$this->mysql->get_data('if_meet_sellers', '', 'if_name', 'DESC');
								if($sellers)
									foreach ($sellers as $key => $seller)
									{
								?>
									<div class="col-sm-6 col-md-3">
										<div class="thumbnail shadow-sm">
											<div class="meetsellers-image border">
												<img class="single-image-post" src="<?= ($seller['if_image']) ? '/fashion_app_api/'.$seller['if_image'] : base_url().'assets/admin/images/default-image.jpg';?>" data-toggle="tooltip" data-placement="bottom" title="<?= $seller['if_name'];?>">
											</div>
											<div class="caption">
												<h3><?= $seller['if_name'];?></h3>
												<p class="text-right">
													<a href="<?= base_url('admin/meetsellers/view/'.$seller['if_id']);?>" class="btn bg-grey btn-circle waves-effect waves-circle waves-float" role="button" data-toggle="tooltip" data-placement="top" title="View"><i class="material-icons">visibility</i></a>
													<a href="<?= base_url('admin/meetsellers/edit/'.$seller['if_id']);?>" class="btn btn-success btn-circle waves-effect waves-circle waves-float" role="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons">mode_edit</i></a>
												</p>
											</div>
										</div>
									</div>
								<?php
									}
								else
									echo '<p class="text-center">Sorry, there aren\'t any sellers yet. Please contact your support to know more or if you want to add some.</p>';
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- #END# Custom Content -->
		</div>
		<style type="text/css">
			.meetsellers-image {
				height: 260px;
				margin: auto;
			}
			/*.thumbnail {
				height: 450px;
			}*/
			.meetsellers-image img, .meetsellers-image a img {
				height: inherit;
				width: 100%;
				object-fit: contain;
			}
			a.carousel-control.right, a.carousel-control.left {
				background-image: unset;
			}
			.thumbnail img.single-image-post {
				height: 260px;
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
		</style>
	</section>
<?php
}
?>