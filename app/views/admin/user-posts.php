	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>
					<b>@<?= $username?></b> Posts
					<small>Taken from <a href="#" target="_blank">Vaqra APP</a></small>
				</h2>
			</div>
			<div class="block-header">
				<a href="<?= base_url()."admin/userlist/".$active?>" class="btn bg-green btn-xs waves-effect"><i class="material-icons">reply</i> Back</a>
			</div>
			<!-- Custom Content -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>Filter Posts of @<?= $username?></h2>
							<!-- <small></small> -->
						</div>
						<div class="body">
							<form method="GET" id="filter-users" class="filter-users">
								<div class="row">
									<div class="col-sm-4">
										<b>Search</b>
										<div class="form-group">
											<div class="form-line">
												<input class="form-control" type="text" name="q" value="<?= ($this->input->get('q')) ? $this->input->get('q'): "";?>">
											</div>
										</div>
									</div>
									<?php
									if($post_types)
									{
									?>
									<div class="col-sm-4">
										<b>Post type</b>
										<select class="form-control show-tick" name="post_type">
											<option value="">-- Select --</option>
											<?php
											foreach ($post_types as $key => $type)
												echo '<option value="'.$type['if_id'].'" '.(($this->input->get('post_type')) ? (($this->input->get('post_type')==$type['if_id']) ? 'selected' : '') : "").'>'.$type['if_name'].'</option>';
											?>
										</select>
									</div>
									<?php
									}
									?>
									<div class="col-sm-4">
										<p><b>Sponsered / Deleted</b></p>
										<input type="checkbox" id="md_checkbox_10" class="chk-col-green" name="sponsered" <?= ($this->input->get('sponsered')) ? "checked": "";?> value="yes">
										<label for="md_checkbox_10" class=" mr-2">Sponsered</label>
										<input type="checkbox" id="md_checkbox_11" class="chk-col-green" name="deleted" <?= ($this->input->get('deleted')) ? "checked": "";?> value="yes">
										<label for="md_checkbox_11" class=" mr-2">Deleted</label>
									</div>
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
								<small>All the posts that <b>@<?= $username?></b> posted on the <b>Vaqra APP</b> are listed below.</small>
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
						<div class="body">
							<div class="row" id="aniimated-thumbnials">
								<?php
								if($posts)
									foreach ($posts as $key => $post)
									{
										$images=$this->mysql->get_data('if_post_images', array("if_post_id" => $post['if_id'], "if_user_id" => $userid));
										$post_type=$this->mysql->get_row('if_post_type', array("if_id" => $post['if_post_type_id']));
										$project_hist=$this->mysql->get_row('if_post_projection_history', array("if_post_id" => $post['if_id']));
										if(!empty($images[0]))
										{
								?>
									<div class="col-sm-6 col-md-3">
										<div class="thumbnail shadow">
											<?php
											if($post['if_deleted'] || !empty($project_hist))
											{
											?>
											<div class="row" style="position: absolute;right: 15px;">
												<?php
												if(!empty($project_hist))
												{
													$project_packag=$this->mysql->get_row('if_post_projection_package', array("if_id" => $project_hist['if_pkg_id']));
												?>
												<div  class="col-sm-12 mb-1">
													<span class="badge bg-orange" style="float:right;" data-toggle="tooltip" data-placement="top" title="<?= $project_packag['if_pkg_name']." (".$project_packag['if_price']." ".$project_packag['if_currency']." / ".$project_packag['if_people_views']." Views)";?>">Sponsored</span>
												</div>
												<?php
												}
												if($post['if_deleted'])
												{
												?>
												<div class="col-sm-12 mb-1">
													<span class="badge bg-red" style="float:right;" data-toggle="tooltip" data-placement="top" title="This post is deleted">Deleted</span>
												</div>
												<?php
												}
												?>
											</div>
									<?php
											}
											if(!empty($images[1]))
											{
									?>
											<div id="postcarousel<?= $key?>" class="carousel slide" data-ride="carousel" data-interval="false">
												<!-- Indicators -->
												<ol class="carousel-indicators">
													<?php
													for ($i=0; $i < count($images); $i++)
														echo '<li data-target="#postcarousel'.$key.'" data-slide-to="'.$i.'" class="'.(($i==0)?'active':'').'"></li>';
													?>
												</ol>

												<!-- Wrapper for slides -->
												<div class="carousel-inner shadow-sm" role="listbox">
												<?php
													foreach ($images as $key1 => $image)
													{
														if(file_exists(APPPATH.'../../fashion_app_api/'.$image['if_post_image']))
														{
															if($image['if_post_filetype']=='Video')
															{
												?>
													<div class="item <?= ($key1==0)? 'active' :'';?>">
														<div style="display:none;" id="video<?=$key1.$key?>">
															<video class="lg-video-object lg-html5 video-js vjs-default-skin" controls preload="none">
																<source src="/fashion_app_api/<?= $image['if_post_image']?>" type="video/mp4">
																 Your browser does not support HTML5 video.
															</video>
														</div>
														<a class="show-light-gallery" data-poster="<?=base_url()?>assets/admin/images/default-video.png" data-sub-html="video caption1" data-html="#video<?=$key1.$key?>" >
															<img class="single-image-post" data-toggle="tooltip" data-placement="bottom" title="Click to play video" src="<?=base_url()?>assets/admin/images/default-video.png" />
														</a>
														<!-- <a class="show-light-gallery" href="/fashion_app_api/<?= $image['if_post_image']?>" data-sub-html="<?= $post['if_description']?>">
															<img src="/fashion_app_api/<?= $image['if_post_image']?>">
														</a> -->
													</div>
												<?php
															}
															else
															{
												?>
													<div class="item <?= ($key1==0)? 'active' :'';?>">
														<a class="show-light-gallery" href="/fashion_app_api/<?= $image['if_post_image']?>" data-sub-html="<?= $post['if_description']?>">
															<img data-toggle="tooltip" data-placement="bottom" title="Click to view image" src="/fashion_app_api/<?= $image['if_post_image']?>">
														</a>
													</div>
												<?php
															}
														}
													}
												?>
												</div>

												<!-- Controls -->
												<a class="left carousel-control" href="#postcarousel<?= $key?>" role="button" data-slide="prev" data-toggle="tooltip" data-placement="left" title="Previous">
													<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
													<span class="sr-only">Previous</span>
												</a>
												<a class="right carousel-control" href="#postcarousel<?= $key?>" role="button" data-slide="next" data-toggle="tooltip" data-placement="right" title="Next">
													<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
													<span class="sr-only">Next</span>
												</a>
											</div>
										<?php
											}
											else
											{
												if(!empty($images[0]))
												{
													if(file_exists(APPPATH.'../../fashion_app_api/'.$images[0]['if_post_image']))
													{
														if($images[0]['if_post_filetype']=='Video')
														{
										?>
															<!-- <video class="post-video" style="width: 100%" controls>
																<source src="/fashion_app_api/<?= $images[0]['if_post_image']?>" type="video/mp4">
																Your browser does not support HTML5 video.
															</video> -->
															<div style="display:none;" id="video<?=$images[0]['if_id'].$key?>">
																<video class="lg-video-object lg-html5 video-js vjs-default-skin" controls preload="none">
																	<source src="/fashion_app_api/<?= $images[0]['if_post_image']?>" type="video/mp4">
																	 Your browser does not support HTML5 video.
																</video>
															</div>
															<div class="shadow-sm">
																<a class="show-light-gallery" data-poster="<?=base_url()?>assets/admin/images/default-video.png" data-sub-html="video caption1" data-html="#video<?=$images[0]['if_id'].$key?>" >
																	<img class="single-image-post" data-toggle="tooltip" data-placement="bottom" title="Click to play video" src="<?=base_url()?>assets/admin/images/default-video.png" />
																</a>
															</div>
										<?php
														}
														else
															echo '<div class="shadow-sm"><a class="show-light-gallery" href="/fashion_app_api/'.$images[0]['if_post_image'].'" data-sub-html="'.$post['if_description'].'"><img data-toggle="tooltip" data-placement="bottom" title="Click to view image" class="single-image-post" src="/fashion_app_api/'.$images[0]['if_post_image'].'"></a></div>';
													}
													else
														echo '<div class="shadow-sm"><a class="show-light-gallery" href="'.base_url().'assets/admin/images/default-image.jpg" data-sub-html="'.$post['if_description'].'"><img data-toggle="tooltip" data-placement="bottom" title="Click to view image" class="single-image-post" src="'.base_url().'assets/admin/images/default-image.jpg"></a></div>';
												}
											}
										?>
											<div class="caption">
												<!-- <h3><?= $post_type['if_name']?>:</h3> -->
												<?php if(!empty($post['if_post_name'])){ ?><h3><?= $post['if_post_name']?></h3><?php }?>
												<p><?= $post_type['if_name']." :"?></p>
												<p class="col-black"><?= $post['if_description']?></p>
												<p class="col-cyan"><?php $hashes=explode(" ", $post['if_hash_tag']); foreach ($hashes as $key => $hash) echo (strpos($hash, '#') !== false) ? $hash." " : "#".$hash." "?></p>
												<p><b>Price&ensp;: </b><?php if($post['if_price'] && $post['if_currency']) echo (($post['if_sell_price']!=0.00) ? $post['if_currency']." <strike>".$post['if_price']."</strike> ".$post['if_sell_price'] : $post['if_currency']." ".$post['if_price']); else echo '<i>NA</i>'?></p>
												<p><b>Size&emsp;: </b><?php if($post['if_size']) echo $post['if_size']; else echo '<i>NA</i>'?></p>
												<div class="panel panel-default panel-post mb-0 border-0 shadow-none">
													<div class="panel-footer p-0">
														<ul>
															<li>
																<a href="#">
																	<i class="material-icons">thumb_up</i>
																	<span><?= ($count=$this->mysql->get_count('if_likes', array("if_post_id"=> $post['if_id'], "if_status"=> 1))) ? $count : '0' ;?> Likes</span>
																</a>
															</li>
															<li>
																<a href="#">
																	<i class="material-icons">comment</i>
																	<span><?= ($count=$this->mysql->get_count('if_comments', array("if_post_id"=> $post['if_id']))) ? $count : '0' ;?> Comments</span>
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
												<p class="text-right"><small><?php echo time_ago(strtotime($post['timestamp']));?></small></p>

												<div class="row">
													<div class="col-md-6 mb-0">
														<!-- <a href="javascript:void(0);" class="btn bg-green btn-circle waves-effect waves-circle waves-float" role="button" data-toggle="tooltip" data-placement="top" title="Edit post"><i class="material-icons">mode_edit</i></a> -->
													</div>
													<div class="col-md-6 text-right mb-0">
														<a href="javascript:void(0);" class="btn bg-red btn-circle waves-effect waves-circle waves-float deletePost" role="button" data-toggle="tooltip" data-placement="top" title="Delete this post" data-postid="<?= $post['if_id']?>"><i class="material-icons">delete</i></a>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php
									}
								}
								else
									echo '<p class="text-center">Sorry, user <b>@'.$username.'</b> haven\'t uploaded any posts yet.</p>';
								?>
								<!-- <div class="col-sm-6 col-md-3">
									<div class="thumbnail">
										<img src="http://placehold.it/500x300">
										<div class="caption">
											<h3>Thumbnail label</h3>
											<p>
												Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
												text ever since the 1500s
											</p>
											<p>
												<a href="javascript:void(0);" class="btn btn-primary waves-effect" role="button">BUTTON</a>
											</p>
										</div>
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- #END# Custom Content -->
		</div>
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
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin/css/video-js.css">
		<script type="text/javascript" src="<?=base_url()?>assets/admin/js/video.js"></script>
	</section>