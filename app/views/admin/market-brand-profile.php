	<?php if(!isset($profile)) redirect("admin/userlist");?>
	<section class="content">
		<div class="container-fluid">
			<div class="row clearfix">
				<div class="col-xs-12 col-sm-3">
					<div class="card profile-card">
						<div class="profile-header">&nbsp;</div>
						<div class="profile-body">
							<div class="image-area">
								<img src="<?= ($profile_image['if_image']) ? '/fashion_app_api/'.$profile_image['if_image'] : base_url().'assets/admin/images/default-image.jpg';?>" alt="<?= $profile['if_username'];?> - Profile Image" data-toggle="tooltip" data-placement="top" title="<?= "@".$profile['if_username'];?>"/>
							</div>
							<div class="content-area">
								<h3><?= "@".$profile['if_username'];?></h3>
								<p><?= ($profile['if_role']=='User' || $profile['if_role']=='Stylist') ? $profile['if_full_name'] : (($profile['if_role']=='Retail-Brand') ? $profile['if_brand_name'] : (($profile['if_role']=='Market-Brand') ? $profile['if_shop_name'] : ''));?></p>
								<p><?= $profile['if_role'];?></p>
							</div>
						</div>
						<div class="profile-footer">
							<ul> 
								<li>
									<span>Followers</span>
									<span><?= $followers;?></span>
								</li>
								<li style="background-color: #efefef">
									<span>Following</span>
									<span><?= $followings;?></span>
								</li>
								<li>
									<span>Friends</span>
									<span><?= $friends;?></span>
								</li>
								<li style="background-color: #efefef">
									<span><a class="col-black" data-toggle="tooltip" data-placement="left" title="View <?= "@".$profile['if_username'];?> posts" href="<?= base_url();?>admin/userlist/user-list/posts/<?= $profile['if_username'];?>/<?= $profile['if_id'];?>">Posts</a></span>
									<span><?= $posts_count;?></span>
								</li>
								<li>
									<span>Points</span>
									<span><?= $profile['if_points'];?></span>
								</li>
							</ul>
							<!-- <button class="btn btn-primary btn-lg waves-effect btn-block">FOLLOW</button> -->
						</div>
					</div>

					<div class="card card-about-me">
						<div class="header">
							<h2>ABOUT ME</h2>
						</div>
						<div class="body">
							<ul>
								<li>
									<div class="title">
										<i class="material-icons">account_circle</i>
										Gender
									</div>
									<div class="content">
										<?= ($profile['if_gender']) ? $profile['if_gender'] : '<i>NA</i>';?>
									</div>
								</li>
								<li>
									<div class="title">
										<i class="material-icons">date_range</i>
										Date of Birth
									</div>
									<div class="content">
										<?= ($profile['if_dob']) ? date("d M Y", strtotime($profile['if_dob'])) : '<i>NA</i>';?>
									</div>
								</li>
								<li>
									<div class="title">
										<i class="material-icons">location_on</i>
										Location
									</div>
									<div class="content">
										<?php if($profile['if_city'] || $profile['if_state'] || $profile['if_country']){ if($profile['if_city']) echo $this->mysql->get_row('if_all_cities', array("id"=>$profile['if_city']), 'id')['city'].", "; if($profile['if_state']) echo $this->mysql->get_row('if_all_states', array("id"=>$profile['if_state']), 'id')['state'].", "; if($profile['if_country']) echo $this->mysql->get_row('if_all_countries', array("id"=>$profile['if_country']), 'id')['country_name'].".";} else echo '<i>NA</i>';?>
									</div>
								</li>
								<li>
									<div class="title">
										<i class="material-icons">smartphone</i>
										Phone Number
									</div>
									<div class="content">
										<?= ($profile['if_mob']) ? $profile['if_country_code']." ".$profile['if_mob'].'<span class="label col-grey" style="float:right;" data-toggle="tooltip" data-placement="top" title="Verified"><i class="material-icons font-18">verified_user</i></span>' : '<i>NA</i>';?>
									</div>
								</li>
								<li>
									<div class="title">
										<i class="material-icons">devices_other</i>
										Device Type
									</div>
									<div class="content">
										<?= ($profile['if_device_type']=='Android') ? '<i class="material-icons" style="display: inline-block;vertical-align: middle;float:right;">phone_android</i><span style="margin: auto 0;display: inline-block;vertical-align: middle;">'.$profile['if_device_type'].'</span>' : (($profile['if_device_type']=='iOS') ? '<i class="material-icons float-right" style="display: inline-block;vertical-align: middle;float:right;">phone_iphone</i><span style="margin: auto 0;display: inline-block;vertical-align: middle;">'.$profile['if_device_type'].'</span>' : '<i>NA</i>');?>
									</div>
								</li>
								<!-- <li>
									<div class="title">
										<i class="material-icons">edit</i>
										Skills
									</div>
									<div class="content">
										<span class="label bg-red">UI Design</span>
										<span class="label bg-teal">JavaScript</span>
										<span class="label bg-blue">PHP</span>
										<span class="label bg-amber">Node.js</span>
									</div>
								</li> -->
								<li>
									<div class="title">
										<i class="material-icons">notes</i>
										Bio
									</div>
									<div class="content">
										<?= ($profile['if_description']) ? $profile['if_description'] : '<i>NA</i>';?>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-9">
					<div class="card">
						<div class="body">
							<div>
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" <?php if(!isset($error) && !isset($updated) && !isset($error2) && !isset($updated2)) echo 'class="active"';?>><a href="#wishlist" aria-controls="wishlist" role="tab" data-toggle="tab">Wishlist</a></li>
									<li role="presentation" <?php if(isset($error) || isset($updated)) echo 'class="active"';?>><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
									<li role="presentation" <?php if(isset($error2) || isset($updated2)) echo 'class="active"';?>><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Change Password</a></li>
								</ul>

								<div class="tab-content">
									<div role="tabpanel" class="tab-pane fade in <?php if(!isset($error) && !isset($updated) && !isset($error2) && !isset($updated2)) echo 'active';?> row" id="wishlist">
										<?php
										if($wishlist)
											foreach ($wishlist as $key => $wished)
											{
										?>
										<div class="col-md-6">
											<div class="panel panel-default panel-post mb-0">
												<div class="panel-heading">
													<div class="media">
														<div class="media-left">
															<a href="#">
																<img src="<?= ($wished['profile_image']['if_image']) ? '/fashion_app_api/'.$wished['profile_image']['if_image'] : base_url().'assets/admin/images/user_default.png';?>" />
															</a>
														</div>
														<div class="media-body">
															<h4 class="media-heading">
																<a href="#"><?= ($wished['profile']['if_full_name']) ? $wished['profile']['if_full_name'] : $wished['profile']['if_username'];?></a>
															</h4>
															Shared publicly - <?= date("d M Y", strtotime($wished['post']['timestamp']));?>
														</div>
													</div>
												</div>
												<div class="panel-body">
													<div class="post">
														<div class="post-heading">
															<p><?= ($wished['post']['if_description']) ? $wished['post']['if_description'] : '<i>NA</i>';?></p>
															<p class="col-cyan"><?php $hashes=explode(" ", $wished['post']['if_hash_tag']); foreach ($hashes as $key => $hash) echo (strpos($hash, '#') !== false) ? $hash." " : "#".$hash." "?></p>
														</div>
														<div class="post-content">
															<?php
															if (isset($wished['post_images'][1]))
															{
															?>
															<div id="postcarouse<?= $wished['post']['if_id']?>" class="carousel slide" data-ride="carousel" data-interval="false">
																<!-- Indicators -->
																<ol class="carousel-indicators">
																	<?php
																	foreach ($wished['post_images'] as $key => $image)
																		echo '<li data-target="#postcarousel'.$key.$wished['post']['if_id'].$image['if_id'].'" data-slide-to="'.$key.$wished['post']['if_id'].$image['if_id'].'" class="'.(($key==0)?'active':'').'"></li>';
																	?>
																</ol>

																<!-- Wrapper for slides -->
																<div class="carousel-inner shadow-sm" role="listbox">
																	<?php
																	foreach ($wished['post_images'] as $key => $image)
																	{
																	?>
																	<div class="item <?= ($key==0)? 'active' :'';?>">
																		<a class="show-light-gallery" href="/fashion_app_api/<?= $image['if_post_image']?>" data-sub-html="<?= $wished['post']['if_description']?>">
																			<img src="/fashion_app_api/<?= $image['if_post_image']?>">
																		</a>
																	</div>
																	<?php
																	}
																	?>
																</div>

																<!-- Controls -->
																<a class="left carousel-control" href="#postcarouse<?= $wished['post']['if_id']?>" role="button" data-slide="prev" data-toggle="tooltip" data-placement="top" title="" data-original-title="Previous">
																	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
																	<span class="sr-only">Previous</span>
																</a>
																<a class="right carousel-control" href="#postcarouse<?= $wished['post']['if_id']?>" role="button" data-slide="next" data-toggle="tooltip" data-placement="top" title="" data-original-title="Next">
																	<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
																	<span class="sr-only">Next</span>
																</a>
															</div>
															<?php
															}
															else
															{
															?>
															<!-- <img src="<?= ($wished['post_images'][0]['if_post_image']) ? "/fashion_app_api/".$wished['post_images'][0]['if_post_image'] : base_url().'assets/admin/images/default-image.png';?>" class="img-responsive" /> -->
															<div class="shadow-sm">
																<img class="single-image-post" src="/fashion_app_api/<?= $wished['post_images'][0]['if_post_image']?>">
																</a>
															</div>
															<?php
															}

															?>
														</div>
													</div>
												</div>
												<div class="panel-footer">
													<ul>
														<li>
															<a href="#">
																<i class="material-icons">thumb_up</i>
																<span><?= ($count=$this->mysql->get_count('if_likes', array("if_post_id"=> $wished['post']['if_id'], "if_status"=> 1))) ? $count : '0' ;?> Likes</span>
															</a>
														</li>
														<li>
															<a href="#">
																<i class="material-icons">comment</i>
																<span><?= ($count=$this->mysql->get_count('if_comments', array("if_post_id"=> $wished['post']['if_id']))) ? $count : '0' ;?> Comments</span>
															</a>
														</li>
														<li>
															<!-- <a href="#">
																<i class="material-icons">share</i>
																<span>Share</span>
															</a> -->
														</li>
													</ul>

													<!-- <div class="form-group">
														<div class="form-line">
															<input type="text" class="form-control" placeholder="Type a comment" />
														</div>
													</div> -->
												</div>
											</div>
										</div>
										<?php
											}
										else
										{
										?>
										<div class="col-md-10">
											<h5 class="">User didn't saved any posts yet...</h5>
										</div>
										<?php
										}
										?>

										<!-- <div class="panel panel-default panel-post col-md-6 m-2">
											<div class="panel-heading">
												<div class="media">
													<div class="media-left">
														<a href="#">
															<img src="<?= base_url()?>assets/admin/images/user-lg.jpg" />
														</a>
													</div>
													<div class="media-body">
														<h4 class="media-heading">
															<a href="#">Marc K. Hammond</a>
														</h4>
														Shared publicly - 01 Oct 2018
													</div>
												</div>
											</div>
											<div class="panel-body">
												<div class="post">
													<div class="post-heading">
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
													</div>
													<div class="post-content">
														<iframe width="100%" height="360" src="https://www.youtube.com/embed/10r9ozshGVE" frameborder="0" allowfullscreen=""></iframe>
													</div>
												</div>
											</div>
											<div class="panel-footer">
												<ul>
													<li>
														<a href="#">
															<i class="material-icons">thumb_up</i>
															<span>125 Likes</span>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="material-icons">comment</i>
															<span>8 Comments</span>
														</a>
													</li>
													<li>
														<a href="#">
															<i class="material-icons">share</i>
															<span>Share</span>
														</a>
													</li>
												</ul>

												<div class="form-group">
													<div class="form-line">
														<input type="text" class="form-control" placeholder="Type a comment" />
													</div>
												</div>
											</div>
										</div> -->
									</div>
									<div role="tabpanel" class="tab-pane fade in <?php if(isset($error) || isset($updated)) echo 'active';?>" id="profile_settings">
										<?php
										if(isset($error))
											echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Oh snap!</strong>'.$error.'</div>';
										if(!empty($updated))
										{
											if($updated)
												echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Well done!</strong> You successfully updated '."#".$profile['if_username'].'.</div>';
											else
												echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>';
										}
										?>
										<form class="form-horizontal" method="post" enctype="multipart/form-data" id="updateProfile">
											<div class="form-group">
												<label for="username" class="col-sm-2 control-label">Username</label>
												<div class="col-sm-10">
													<div class="form-line">
														<input type="text" class="form-control" id="username" name="username" placeholder="User name" value="<?= $profile['if_username'];?>" required>
														<input type="hidden" class="form-control" id="userid" name="userid" placeholder="userid" value="<?= $userid;?>" required>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="email" class="col-sm-2 control-label">Email</label>
												<div class="col-sm-10">
													<div class="form-line">
														<input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?= $profile['if_email'];?>" required>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="fullname" class="col-sm-2 control-label">Full Name</label>
												<div class="col-sm-10">
													<div class="form-line">
														<input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full name" value="<?= $profile['if_full_name'];?>" required>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="username" class="col-sm-2 control-label">Gender</label>
												<div class="col-sm-10">
													<input type="radio" name="gender" id="male" class="with-gap" value="Male" <?= ($profile['if_gender']=='Male') ? 'checked' : '' ;?>>
													<label for="male">Male</label>

													<input type="radio" name="gender" id="female" class="with-gap" value="Female" <?= ($profile['if_gender']=='Female') ? 'checked' : '' ;?>>
													<label for="female" class="m-l-20">Female</label>
												</div>
											</div>
											<div class="form-group">
												<label for="dob" class="col-sm-2 control-label">Date of Birth</label>
												<div class="col-sm-10">
													<div class="form-line" id="bs_datepicker_container">
														<input type="text" class="form-control" id="dob" name="dob" placeholder="Please choose a date..." value="<?= ($profile['if_dob']) ? date('Y-m-d', strtotime($profile['if_dob'])): '';?>" required>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="points" class="col-sm-2 control-label">Points</label>
												<div class="col-sm-10">
													<div class="form-line">
														<input type="number" class="form-control" id="points" name="points" placeholder="Points" value="<?= $profile['if_points'];?>" required step="1" min="0">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="country_code" class="col-sm-2 control-label">Phone Number</label>

												<div class="col-sm-2">
													<div class="form-line <?= ($profile['if_country_code']) ? 'focused' : '' ;?>">
														<select class="form-control show-tick" id="country_code" name="country_code" data-live-search="true" required="">
															<option value="">Dialing</option>
															<?php
															if($countries)
															{
																sort($countries);
																foreach ($countries as $key => $country)
																	echo '<option value="'.$country['callingCodes'].'" '.(($country['callingCodes']==$profile['if_country_code']) ? 'selected' : '').'>+'.$country['callingCodes'].'</option>';
															}
															?>
														</select>
													</div>
												</div>
												<div class="col-sm-8">
													<div class="form-line">
														<input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Phone Number" value="<?= $profile['if_mob'];?>">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="country" class="col-sm-2 control-label">Country</label>

												<div class="col-sm-10">
													<div class="form-line <?= ($profile['if_country']) ? 'focused' : '' ;?>">
														<select class="form-control show-tick" id="country" name="country" data-live-search="true" required="">
															<option value="">-- Select Country --</option>
															<?php
															if($countries)
																foreach ($countries as $key => $country)
																	echo '<option value="'.$country['id'].'" '.(($country['id']==$profile['if_country']) ? 'selected' : '').'>'.$country['country_name'].'</option>';
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="state" class="col-sm-2 control-label">State</label>

												<div class="col-sm-10">
													<div class="form-line <?= ($profile['if_state']) ? 'focused' : '' ;?>">
														<select class="form-control show-tick" id="state" name="state" data-live-search="true"  required>
															<?php
															if($states)
																foreach ($states as $key => $state)
																	echo ($key==0) ? '<option value="">-- Select State --</option>' : '<option value="'.$state['id'].'" '.(($state['id']==$profile['if_state']) ? 'selected' : '').'>'.$state['state'].'</option>';
															else
																echo '<option value="">-- Select Country First --</option>';
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="city" class="col-sm-2 control-label">City</label>

												<div class="col-sm-10">
													<div class="form-line <?= ($profile['if_city']) ? 'focused' : '' ;?>">
														<select class="form-control show-tick" id="city" name="city" data-live-search="true"  required>
															<?php
															if($cities)
																foreach ($cities as $key => $city)
																	echo ($key==0) ? '<option value="">-- Select City --</option>' : '<option value="'.$city['id'].'" '.(($city['id']==$profile['if_city']) ? 'selected' : '').'>'.$city['city'].'</option>';
															else
																echo '<option value="">-- Select State First --</option>';
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="userbio" class="col-sm-2 control-label">Bio</label>

												<div class="col-sm-10">
													<div class="form-line">
														<textarea class="form-control" id="userbio" name="userbio" rows="3" placeholder="Bio"><?= $profile['if_description'];?></textarea>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="userbio" class="col-sm-2 control-label">Profile Image</label>

												<div class="col-sm-10">
													<div class="form-line">
														<input type="file" id="profilepic" name="profilepic" accept="image/*">
													</div>
												</div>
											</div>
											<!-- <div class="form-group">
												<div class="col-sm-offset-2 col-sm-10">
													<input type="checkbox" id="terms_condition_check" class="chk-col-green filled-in" />
													<label for="terms_condition_check">I agree to the <a href="#">terms and conditions</a></label>
												</div>
											</div> -->
											<div class="form-group">
												<div class="col-sm-offset-2 col-sm-10">
													<input type="submit" name="updateProfile" class="btn bg-green" value="Update">
												</div>
											</div>
										</form>
									</div>
									<div role="tabpanel" class="tab-pane fade in <?php if(isset($error2) || isset($updated2)) echo 'active';?>" id="change_password_settings">
										<?php
										if(isset($error2))
											echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Oh snap!</strong>'.$error2.'</div>';
										if(!empty($updated2))
										{
											if($updated2)
												echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Well done!</strong> You successfully updated '."#".$profile['if_username'].'.</div>';
											else
												echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>';
										}
										?>
										<form class="form-horizontal" method="post">
											<!-- <div class="form-group">
												<label for="OldPassword" class="col-sm-3 control-label">Old Password</label>
												<div class="col-sm-9">
													<div class="form-line">
														<input type="password" class="form-control" id="OldPassword" name="OldPassword" placeholder="Old Password" required>
													</div>
												</div>
											</div> -->
											<div class="form-group">
												<label for="NewPassword" class="col-sm-3 control-label">New Password</label>
												<div class="col-sm-9">
													<div class="form-line">
														<input type="password" class="form-control" id="NewPassword" name="NewPassword" placeholder="New Password" required>
														<input type="hidden" class="form-control" name="userid" placeholder="userid" value="<?= $userid;?>" required>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="NewPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm)</label>
												<div class="col-sm-9">
													<div class="form-line">
														<input type="password" class="form-control" id="NewPasswordConfirm" name="NewPasswordConfirm" placeholder="New Password (Confirm)" required>
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-9">
													<input type="submit" class="btn bg-green" name="updatePassword" value="Update">
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<style type="text/css">
		.carousel-inner .item {
			height: 260px;
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