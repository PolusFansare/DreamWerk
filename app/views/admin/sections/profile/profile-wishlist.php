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
																			<?php
																			if($image['if_post_filetype']=='Image')
																				echo '<img src="/fashion_app_api/'.$image['if_post_image'].'">';
																			elseif($image['if_post_filetype']=='Video')
																			{
																			?>
																			<video class="post-video">
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
															<div class="shadow-sm">
																<?php
																if(isset($wished['post_images'][0]))
																{
																	if($wished['post_images'][0]['if_post_filetype']=='Image')
																		echo '<img class="single-image-post" src="'.((!empty($wished['post_images'][0]['if_post_image'])) ? "/fashion_app_api/".$wished['post_images'][0]['if_post_image'] : base_url().'assets/admin/images/default-image.png').'">';
																	elseif($wished['post_images'][0]['if_post_filetype']=='Video')
																	{
																	?>
																	<video class="post-video">
																		<source src="<?= '/fashion_app_api/'.$wished['post_images'][0]['if_post_image'];?>" type="<?= mime_content_type(APPPATH.'../../fashion_app_api/'.$wished['post_images'][0]['if_post_image']);?>">
																		Your browser does not support HTML5 video.
																	</video>
																	<?php
																	}
																}
																else
																	echo 'No image available at the moment.';
																?>
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