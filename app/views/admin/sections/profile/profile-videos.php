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