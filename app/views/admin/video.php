<?php
if(!empty($edit))
{
	if(!$video)
		redirect("video");
?>
	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>Video Details Editor</h2>
			</div>
			<div class="block-header">
				<a href="admin/apphtml" class="btn bg-red btn-xs waves-effect"><i class="material-icons">reply</i> Back</a>
			</div>

			<!-- TinyMCE -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2><?= "#".$video['title']?><small>Changes may affect the running applications (Andr.).</small></h2>
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
									echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Well done!</strong> You successfully updated '."#".$video['title'].'.</div>';
								else
									echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>';
							}
							?>
							<form action="" method="POST">
								<div class="row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-float">
													<div class="form-line focused">
														<input type="hidden" name="vid_id" value="<?= $video['video_id']?>" required="">
														<input type="text" name="vid_title" value="<?= $video['title']?>" class="form-control" required="">
														<label class="form-label">Video title</label>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group form-float">
													<select class="form-control show-tick" name="vid_cat" required="">
														<option value="">--- Select a Category ---</option>
														<?php
														foreach ($categories as $key => $category)
															echo '<option value="'.$category['category_id'].'" '.(($category['category_id']==$video['category']) ? 'selected' : '' ).'>'.$category['title'].'</option>';
														?>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-float">
													<div class="form-line focused">
														<label class="form-label">Video Tags</label>
														<input type="text" name="vid_tags" value="<?= $video['tags']?>" class="form-control">
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group form-float">
													<select class="form-control show-tick" name="vid_pos" required="">
														<option value="16">--- Select a Position ---</option>
														<?php
														for ($i=1; $i < 16; $i++)
															echo '<option value="'.$i.'" '.(($i==$video['position']) ? 'selected' : '' ).'>'.$i.' Postion</option>';
														?>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-float">
													<div class="form-line focused">
														<label class="form-label">Video UPI No.</label>
														<input type="text" name="vid_upi_no" value="<?= $video['mobile_no_upi']?>" class="form-control">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group form-float">
													<span class="text-muted">Video Description</span>
													<textarea id="tinymce" class="form-control border" name="vid_desc" rows="6" required=""><?= $video['description']?></textarea>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group form-float align-right">
													<button class="btn bg-red waves-effect" type="submit">SUBMIT</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 text-center">
										<h5>Video Thumbnail</h5>
										<span class="text-muted">(Sorry! but you cannot change the video or it's thumbnail.)</span>
										<img class="img-responsive m-auto" src="<?= base_url($video['video_thumbnail']);?>" alt="Sorry! but image is not available at the moment." style="width: 60%;">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- #END# TinyMCE -->
			<!-- CKEditor -->
			<div class="row clearfix hidden">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>
								CKEDITOR
								<small>CKEditor is a ready-for-use HTML text editor designed to simplify web content creation. Taken from <a href="http://ckeditor.com/" target="_blank">ckeditor.com</a></small>
							</h2>
							<ul class="header-dropdown m-r--5">
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
							</ul>
						</div>
						<div class="body">
							<textarea id="ckeditor">
								<h2>WYSIWYG Editor</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ullamcorper sapien non nisl facilisis bibendum in quis tellus. Duis in urna bibendum turpis pretium fringilla. Aenean neque velit, porta eget mattis ac, imperdiet quis nisi. Donec non dui et tortor vulputate luctus. Praesent consequat rhoncus velit, ut molestie arcu venenatis sodales.</p>
								<h3>Lacinia</h3>
								<ul>
									<li>Suspendisse tincidunt urna ut velit ullamcorper fermentum.</li>
									<li>Nullam mattis sodales lacus, in gravida sem auctor at.</li>
									<li>Praesent non lacinia mi.</li>
									<li>Mauris a ante neque.</li>
									<li>Aenean ut magna lobortis nunc feugiat sagittis.</li>
								</ul>
								<h3>Pellentesque adipiscing</h3>
								<p>Maecenas quis ante ante. Nunc adipiscing rhoncus rutrum. Pellentesque adipiscing urna mi, ut tempus lacus ultrices ac. Pellentesque sodales, libero et mollis interdum, dui odio vestibulum dolor, eu pellentesque nisl nibh quis nunc. Sed porttitor leo adipiscing venenatis vehicula. Aenean quis viverra enim. Praesent porttitor ut ipsum id ornare.</p>
							</textarea>
						</div>
					</div>
				</div>
			</div>
			<!-- #END# CKEditor -->
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
					App <?= $active;?> List
					<small>Taken from <a href="#" target="_blank">DreamWerk APP</a></small>
				</h2>
			</div>
			<!-- User Table -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>APP <?= strtoupper($active);?> LIST</h2>
							<p></p>
							<ul class="header-dropdown m-r--5">
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
							</ul>
						</div>
						<div class="body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover dataTable js-exportable">
									<thead>
										<tr>
											<th>Sr.</th>
											<th>Title</th>
											<th>By</th>
											<th>Category</th>
											<!-- <th>Tags</th> -->
											<th>Date</th>
											<th></th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Sr.</th>
											<th>Title</th>
											<th>By</th>
											<th>Category</th>
											<!-- <th>Tags</th> -->
											<th>Date</th>
											<th></th>
										</tr>
									</tfoot>
									<tbody>
										<?php
										if($videos)
											foreach ($videos as $key => $video)
											{
												$user		= $this->mysql->get_row('dw_user_details', array('user_id'=>$video['user_id']), 'user_id');
												$likes		= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1))) ? $count : 0;
												$dislikes	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2))) ? $count2 : 0;
												/*$i_liked	= ($count=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>1, 'user_id'=> $user['user_id']))) ? $count : 0;
												$i_disliked	= ($count2=$this->mysql->get_count('dw_likes', array('video_id' => $video['video_id'], 'like_status'=>2, 'user_id'=> $user['user_id']))) ? $count2 : 0;
												$i_saved	= ($count2=$this->mysql->get_count('dw_wishlist', array('video_id' => $video['video_id'], 'wish_status'=>1, 'user_id'=> $user['user_id']))) ? $count2 : 0;
												$i_subscribed= ($count2=$this->mysql->get_count('dw_subcriptions', array('to_user_id' => $video['user_id'], 'from_user_id'=> $user['user_id']))) ? $count2 : 0;*/
										?>
										<tr>
											<td><?= $key+1?></td>
											<td><?= $video['title'] ?></td>
											<td><?= $user['full_name'] ?></td>
											<td><?= ($cat=$this->mysql->get_row('dw_categories', array('category_id'=>$video['category']))) ? $cat['title'] : '<i>NA</i>';?></td>
											<!-- <td><?= ($video['tags']) ? $video['tags'] : "<i>NA</i>";?></td> -->
											<td><?= date('d F Y', strtotime($video['created_at']))?></td>
											<td>
												<button type="button" class="btn bg-default waves-effect m-r-20" data-toggle="modal" data-target="#largeModal<?= $video['video_id'];?>"><i class="material-icons">pageview</i> View</button>
												<a href="<?= base_url('video/edit/'.$video['video_id'])?>" class="btn waves-effect bg-grey m-r-20"><i class="material-icons">mode_edit</i> Edit</a>
												<button class="btn waves-effect bg-red waves-green js-sweetalert " data-datatype="dw_videos" data-dataname="<?= $video['title'];?> video" data-dataid="<?= $video['video_id']?>" data-type="cancel" data-colname="video_id" data-url="<?= base_url();?>"><i class="material-icons">delete_forever</i> Delete</button>
												<div class="modal fade" id="largeModal<?= $video['video_id'];?>" tabindex="-1" role="dialog">
													<div class="modal-dialog modal-xl" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title text-primary" id="largeModalLabel"><?= "#".$video['title']?></h4>
															</div>
															<div class="modal-body">
																<div class="row">
																	<div class="col-md-6">
																		<p class="text-dark"><?= $user['email']?></p>
																	</div>
																	<div class="col-md-6 text-right">
																		<a href="<?= base_url('user/profile/'.urlencode($user['username'])."/".$user['user_id']);?>" target="_blank" class="btn bg-red waves-effect"><i class="material-icons">person</i>  Profile</a>
																	</div>
																	<div class="col-md-12">
																		<div class="details">
																			<table class="table table-bordered">
																				<tr>
																					<td class="text-center font-22" colspan="2">Video Details</td>
																				</tr>
																				<tr>
																					<th>Title</th>
																					<td><?= $video['title'];?></td>
																				</tr>
																				<tr>
																					<th>Duration</th>
																					<td><?= gmdate("H:i:s", ($video['duration']/1000));?></td>
																				</tr>
																				<tr>
																					<th>Category</th>
																					<td><?= ($cat) ? $cat['title'] : '<i>NA</i>';?></td>
																				</tr>
																				<tr>
																					<th>Tags</th>
																					<td><?= $video['tags'];?></td>
																				</tr>
																				<tr>
																					<th>Date</th>
																					<td><?= date('d F Y', strtotime($video['created_at']));?></td>
																				</tr>
																				<tr>
																					<th>UPI Number</th>
																					<td><?= $video['mobile_no_upi'];?></td>
																				</tr>
																				<tr>
																					<th>Total Likes</th>
																					<td><?= $likes;?></td>
																				</tr>
																				<tr>
																					<th>Total Dislikes</th>
																					<td><p><?= $dislikes;?></p></td>
																				</tr>
																				<tr>
																					<th>Description</th>
																					<td><?= $video['description'];?></td>
																				</tr>
																				<tr>
																					<td class="text-center font-22" colspan="2">Uploaded by</td>
																				</tr>
																				<tr>
																					<th>Full Name</th>
																					<td><?= $user['full_name']?></td>
																				</tr>
																				<tr>
																					<th>Username</th>
																					<td><?= $user['username']?></td>
																				</tr>
																				<tr>
																					<th>Email</th>
																					<td><?= $user['email']?></td>
																				</tr>
																				<tr>
																					<th>Mobile</th>
																					<td><?= $user['phone']?></td>
																				</tr>
																				<tr>
																					<th>DOB</th>
																					<td><?= $user['dob']?></td>
																				</tr>
																				<tr>
																					<th>Gender</th>
																					<td><?= $user['gender']?></td>
																				</tr>
																				<tr>
																					<th>Device Type (ID)</th>
																					<td><?= "Android";?></td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																	<div class="col-md-12">
																		<div class="shadow-sm">
																			<video id="video<?=$video['video_id']?>" class="lg-video-object lg-html5 video-js vjs-default-skin" style="width: 100%; height: 600px;" controls preload="none">
																				<source src="<?= base_url($video['video_url'])?>" type="video/mp4">
																				 Your browser does not support HTML5 video.
																			</video>
																		</div>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="document.getElementById('video<?=$video['video_id']?>').pause();">CLOSE</button>
															</div>
														</div>
													</div>
												</div>
											</td>
										</tr>
										<?php
											}
										else
										{
										?>
										<tr>
											<td colspan="6" class="text-center">User Haven't uploaded any videos yet.</td>
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
<?php
}
?>