	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>
					Vaqra Reports List
					<small>Taken from <a href="#" target="_blank">Vaqra APP</a></small>
				</h2>
			</div>
			<!-- User Table -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2><?= strtoupper('Vaqra Reports');?> LIST</h2>
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
											<th>Date</th>
											<th></th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Username</th>
											<th>Email</th>
											<th>Date</th>
											<th></th>
										</tr>
									</tfoot>
									<tbody>
										<?php
										if($reports)
											foreach ($reports as $key => $report)
											{
										?>
										<tr>
											<td class="col-cyan" data-toggle="modal" data-target="#largeModal<?= $report['if_id'];?>"><?= "@".$report['fromuser']['if_username']." (".$report['fromuser']['if_role'].")"?></td>
											<td><?= $report['fromuser']['if_email']?></td>
											<td><?= date('d F Y', strtotime($report['timestamp']))?></td>
											<td>
												<button type="button" class="btn bg-green waves-effect m-r-20" data-toggle="modal" data-target="#largeModal<?= $report['if_id'];?>">View</button>
												<div class="modal fade" id="largeModal<?= $report['if_id'];?>" tabindex="-1" role="dialog">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<div class="row">
																	<div class="col-md-9 mb-0">
																		<h4 class="modal-title col-cyan" id="largeModalLabel" onclick="window.open('<?= base_url("admin/userlist/profile/view/".$report['fromuser']['if_username']."/".$report['if_from_user_id'])?>', '_blank');"><?= "@".$report['fromuser']['if_username']." (".$report['fromuser']['if_role'].")"?></h4>
																		<p class="mb-0 mt-1" id="largeModalLabel"><?= !empty($report['fromuser_details']['if_full_name']) ? $report['fromuser_details']['if_full_name']." (".$report['fromuser']['if_email'].")" : $report['fromuser']['if_email']?></p>
																	</div>
																	<div class="col-md-3 mb-0 text-right">
																		<?php if($active=='reports'){?><button type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float waves-green mx-1 reportSolved" data-reportid="<?= $report['if_id'];?>" data-tomail="<?= $report['fromuser']['if_email'];?>" data-fullname="<?= $report['fromuser_details']['if_full_name'];?>" data-message="<?= $report['if_message'];?>"><i class="material-icons">done</i></button><?php }?>
																		<button type="button" class="btn btn-default btn-circle waves-effect waves-circle waves-float waves-green" data-dismiss="modal"><i class="material-icons">close</i></button>
																	</div>
																</div>
															</div>
															<div class="modal-body">
																<div class="row">
																	<div class="col-md-12 mb-1">
																		<hr class="my-1">
																	</div>
																	<div class="col-md-12 mb-1">
																		<p class="my-1 border-0"><?= $report['if_message'];?></p>
																	</div>
																	<?php
																	if($report['if_post_id'])
																	{
																		$post=$report['post'];
																		if($post)
																		{
																			$userid=$post['if_user_id'];
																			$item=$post;
																			$images=$this->mysql->get_data('if_post_images', array("if_post_id" => $post['if_id'], "if_user_id" => $userid));
																			if(!empty($images[0]))
																			{
																	?>
																		<div class="col-sm-6 col-md-4">
																			<div class="panel panel-default panel-post mb-0">
																				<div class="panel-heading">
																					<div class="media">
																						<div class="media-left">
																							<a target="_blank" href="<?= base_url()."admin/userlist/profile/view/".urlencode($report['touser']['if_username'])."/".$report['touser']['if_id'];?>">
																								<img src="<?= ($report['toprofile_image']['if_image']) ? '/fashion_app_api/'.$report['toprofile_image']['if_image'] : base_url().'assets/admin/images/user_default.png';?>" />
																							</a>
																						</div>
																						<div class="media-body">
																							<h4 class="media-heading">
																								<a target="_blank" href="<?= base_url()."admin/userlist/profile/view/".urlencode($report['touser']['if_username'])."/".$report['touser']['if_id'];?>"><?= ($report['touser_details']['if_full_name']) ? $report['touser_details']['if_full_name'] : $report['touser_details']['if_username'];?></a>
																							</h4>
																							Shared publicly - <?= date("d M Y", strtotime($post['timestamp']));?>
																						</div>
																					</div>
																				</div>
																				<div class="panel-body">
																					<div class="post">
																						<div class="post-heading">
																							<p><?= ($post['if_description']) ? $post['if_description'] : '<i>NA</i>';?></p>
																							<p class="col-cyan"><?php $hashes=explode(" ", $post['if_hash_tag']); foreach ($hashes as $key => $hash) echo (strpos($hash, '#') !== false) ? $hash." " : "#".$hash." "?></p>
																						</div>
																						<div class="post-content">
																							<?php
																							if (isset($images[1]))
																							{
																							?>
																							<div id="postcarousel<?= $item['if_id']?>" class="carousel slide" data-ride="carousel" data-interval="false">
																								<!-- Indicators -->
																								<ol class="carousel-indicators">
																									<?php
																									foreach ($images as $key => $image)
																										echo '<li data-target="#postcarousel'.$item['if_id'].'" data-slide-to="'.$key.'" class="'.(($key==0)?'active':'').'"></li>';
																									?>
																								</ol>

																								<!-- Wrapper for slides -->
																								<div class="carousel-inner shadow-sm" role="listbox">
																									<?php
																									foreach ($images as $key => $image)
																									{
																									?>
																									<div class="item <?= ($key==0)? 'active' :'';?>">
																										<a class="show-light-gallery" href="/fashion_app_api/<?= $image['if_post_image']?>" data-sub-html="<?= $post['if_description']?>" target="_blank">
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
																								<img class="single-image-post" src="<?= (!empty($images[0]['if_post_image'])) ? "/fashion_app_api/".$images[0]['if_post_image'] : base_url().'assets/admin/images/default-image.png';?>">
																							</div>
																							<?php
																							}

																							?>
																						</div>
																					</div>
																				</div>
																				<div class="panel-footer">
																					<ul class="">
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
																					</ul>
																				</div>
																			</div>
																		</div>
																		<?php
																			}
																		}
																		else
																			echo '<i>This post is no longer available...</i>';
																	}
																	elseif(!empty($report['if_to_user_id']) && !empty($report['touser']))
																	{
																	?>
																	<div class="col-md-12 mb-1">
																		<p><span class="font-bold">Reported For : </span><a class="col-cyan" href="<?= base_url("admin/userlist/profile/view/".$report['touser']['if_username']."/".$report['if_to_user_id'])?>" target="_blank"><?= "@".$report['touser']['if_username']."</a> (".$report['touser_details']['if_full_name']." as a ".(($report['touser']['if_role']=='User') ? "normal ".strtolower($report['touser']['if_role']) : strtolower($report['touser']['if_role'])).")"?></p>
																	</div>
																	<?php
																	}
																	?>
																	<div class="col-md-12 mb-1">
																		<hr class="mt-1 mb-0">
																	</div>
																</div>
															</div>
															<div class="modal-footer">
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
											echo '<tr><th colspan="4" class="text-center">There are no reports yet...</th></tr>';
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
		</style>
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin/css/video-js.css">
		<script type="text/javascript" src="<?=base_url()?>assets/admin/js/video.js"></script>
	</section>