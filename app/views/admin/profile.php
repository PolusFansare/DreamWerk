	<?php if(!isset($profile)) redirect("user");?>
	<section class="content">
		<div class="container-fluid">
			<div class="row clearfix">
				<div class="col-xs-12 col-sm-3">
					<div class="card profile-card">
						<div class="profile-header">&nbsp;</div>
						<div class="profile-body">
							<div class="image-area">
								<img src="<?= (!empty($profile['profile_picture'])) ? base_url($profile['profile_picture']) : base_url('assets/admin/images/default-image.jpg');?>" alt="<?= $profile['username'];?> - Profile Image" data-toggle="tooltip" data-placement="top" title="<?= "@".$profile['username'];?>"/>
							</div>
							<div class="content-area">
								<h3 style="word-break: break-all;"><?= "@".$profile['username'];?></h3>
								<p><?= $profile['full_name'];?></p>
								<p><?= $profile['role'];?></p>
							</div>
						</div>
						<div class="profile-footer">
							<?php $this->load->view('admin/sections/profile/profile-view-user');?>
							<!-- <button class="btn btn-primary btn-lg waves-effect btn-block">FOLLOW</button> -->
						</div>
					</div>

					<div class="card card-about-me">
						<div class="header">
							<h2>ABOUT ME</h2>
						</div>
						<div class="body">
							<?php $this->load->view('admin/sections/profile/profile-about-me');?>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-9">
					<div class="card">
						<div class="body">
							<div>
								<ul class="nav nav-tabs tab-col-green" role="tablist">
									<!-- <li role="presentation" <?php if(!isset($error) && !isset($updated) && !isset($error2) && !isset($updated2)) echo 'class="active"';?>>
										<a href="#wishlist" aria-controls="wishlist" role="tab" data-toggle="tab">
											Wishlist
										</a>
									</li> -->
									<li role="presentation" class="active" <?php if(isset($error) || isset($updated)) echo 'class="active"';?>>
										<a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a>
									</li>
									<li role="presentation" <?php if(isset($error2) || isset($updated2)) echo 'class="active"';?>>
										<a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Change Password</a>
									</li>
									<li role="presentation" <?php if(isset($error2) || isset($updated2)) echo 'class="active"';?>>
										<a href="#Videos" aria-controls="settings" role="tab" data-toggle="tab">Videos</a>
									</li>
									<!-- <li role="presentation" <?php if(isset($error2) || isset($updated2)) echo 'class="active"';?>>
										<a href="#followings" aria-controls="settings" role="tab" data-toggle="tab">Followings</a>
									</li> -->
								</ul>

								<div class="tab-content">
									<!-- <div role="tabpanel" class="tab-pane fade in <?php if(!isset($error) && !isset($updated) && !isset($error2) && !isset($updated2)) echo 'active';?> row" id="wishlist">
										<?php
										if($wishlist)
											foreach ($wishlist as $key => $wished)
												$this->load->view('admin/sections/profile/profile-wishlist', array('wished'=>$wished));
										else
										{
										?>
										<div class="col-md-10">
											<h5 class="">User didn't saved any posts yet...</h5>
										</div>
										<?php
										}
										?>
										<div class="panel panel-default panel-post col-md-6 m-2">
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
										</div>
									</div> -->
									<div role="tabpanel" class="tab-pane fade in active <?php if(isset($error) || isset($updated)) echo 'active';?>" id="profile_settings">
										<?php
										if(isset($error))
											echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Oh snap!</strong>'.$error.'</div>';
										if(!empty($updated))
										{
											if($updated)
												echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Well done!</strong> You successfully updated '."#".$profile['username'].'.</div>';
											else
												echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>';
										}
										$this->load->view("admin/sections/profile/profile-update-form");
										?>
									</div>
									<div role="tabpanel" class="tab-pane fade in <?php if(isset($error2) || isset($updated2)) echo 'active';?>" id="change_password_settings">
										<?php
										if(isset($error2))
											echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Oh snap!</strong>'.$error2.'</div>';
										if(!empty($updated2))
										{
											if($updated2)
												echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Well done!</strong> You successfully updated '."#".$profile['username'].'.</div>';
											else
												echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>';
										}
										$this->load->view("admin/sections/profile/profile-update-password-form");
										?>
									</div>
									<div role="tabpanel" class="tab-pane fade in <?php if(isset($error2) || isset($updated2)) echo 'active';?>" id="Videos">
										<?php
										$this->load->view("admin/sections/profile/profile-videos", array("videos"=>$videos));
										?>
									</div>
									<div role="tabpanel" class="tab-pane fade in <?php if(isset($error2) || isset($updated2)) echo 'active';?>" id="followings">
										<?php
										//$this->load->view("admin/sections/profile/profile-following-list.php", array("followings"=>$followings));
										?>
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
			height: 253px;
			width: 100%;
		}
		.item a
		{
			height: inherit;
			width: 100%;
		}
		.bootstrap-select .dropdown-menu.open {
			overflow: unset !important;
		}
	</style>