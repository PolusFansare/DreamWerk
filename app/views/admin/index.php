	<section class="content">
		<div class="container-fluid">
			<div class="block-header shadow-sm">
				<h2>DASHBOARD</h2>
			</div>
			<!-- Widgets -->
			<div class="row clearfix">
				<div class="col-md-12 hide">
					<div class="block-header">
						<h2>USERS</h2>
					</div>
				</div>
				<div class="col-md-2 col-sm-6">
					<div class="info-box bg-red hover-expand-effect" onclick="window.location.href='<?= base_url('video');?>'">
						<div class="icon">
							<i class="material-icons">video_library</i>
						</div>
						<div class="content">
							<div class="text">Videos</div>
							<div class="number count-to" data-from="0" data-to="<?= $posts_count;?>" data-speed="2000" data-fresh-interval="20"></div>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-6">
					<div class="info-box bg-orange hover-expand-effect" onclick="window.location.href='<?= base_url('user');?>'" data-toggle="tooltip" data-placement="bottom" title="View Users List">
						<div class="icon">
							<i class="material-icons">people</i>
						</div>
						<div class="content">
							<div class="text">Users</div>
							<div class="number count-to" data-from="0" data-to="<?= $users_count;?>" data-speed="2000" data-fresh-interval="20"></div>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-6">
					<div class="info-box bg-blue hover-expand-effect" data-toggle="tooltip" data-placement="bottom" title="View Brands List">
						<div class="icon">
							<i class="material-icons">thumb_up</i>
						</div>
						<div class="content">
							<div class="text">Videos Likes</div>
							<div class="number count-to" data-from="0" data-to="<?= $likes_count;?>" data-speed="2000" data-fresh-interval="20"></div>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-6">
					<div class="info-box bg-grey hover-expand-effect" data-toggle="tooltip" data-placement="bottom" title="View Stylists List">
						<div class="icon">
							<i class="material-icons">thumb_down</i>
						</div>
						<div class="content">
							<div class="text">Videos Dislikes</div>
							<div class="number count-to" data-from="0" data-to="<?= $dislikes_count;?>" data-speed="2000" data-fresh-interval="20"></div>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-6 col-xs-12">
					<div class="info-box bg-teal hover-expand-effect">
						<div class="icon">
							<i class="material-icons">subscriptions</i>
						</div>
						<div class="content">
							<div class="text">Subscriptions</div>
							<div class="number count-to" data-from="0" data-to="<?= $subscriptions_count;?>" data-speed="2000" data-fresh-interval="20"></div>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-6 col-xs-12">
					<div class="info-box bg-light-green hover-expand-effect" onclick="window.location.href='<?= base_url('video');?>'" data-toggle="tooltip" data-placement="bottom" title="View Transactions History">
						<div class="icon">
							<i class="material-icons">library_add</i>
						</div>
						<div class="content">
							<div class="text">Wishlist Videos</div>
							<div class="number count-to" data-from="0" data-to="<?= $wishlist_count;?>" data-speed="2000" data-fresh-interval="20"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- #END# Widgets -->
			<div class="row clearfix">
				<!-- Visitors -->
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<div class="card">
						<div class="body bg-pink">
							<div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
								 data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
								 data-offset="90" data-width="100%" data-height="85px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
								 data-fill-Color="rgba(0, 188, 212, 0)">
								<?php
								for ($i=30; $i >= 0; $i--)
									($i==0) ? eval('echo $weak_users_reg'.$i.';') : eval('echo $weak_users_reg'.$i.'.",";');
								?>
							</div>
							<ul class="dashboard-stat-list">
								<li class="font-17">
									NEW REGISTRATIONS...
								</li>
								<li>
									Today
									<span class="pull-right"><b><?= $today_registrations?></b> <small>Users</small></span>
								</li>
								<li>
									Yesterday
									<span class="pull-right"><b><?= $yesterday_registrations?></b> <small>Users</small></span>
								</li>
								<li>
									Last Week
									<span class="pull-right"><b><?= $weak_registrations?></b> <small>Users</small></span>
								</li>
								<li>
									Last Month
									<span class="pull-right"><b><?= $month_registrations?></b> <small>Users</small></span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- #END# Visitors -->
				<!-- Latest Social Trends -->
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<div class="card">
						<div class="body bg-cyan">
							<div class="m-b--35 font-bold">LATEST SOCIAL TRENDS</div>
							<ul class="dashboard-stat-list">
								<?php
								if(!empty($top_hashes) && isset($top_hashes[1]))
									foreach ($top_hashes as $key => $top_hashe)
									{
								?>
								<li>
									<?= '#'.str_replace("#", "", $top_hashe['tags']);?>
									<?php
									if($top_hashe['hash_count'] > 15)
									{
									?>
									<span class="pull-right">
										<i class="material-icons">trending_up</i>
									</span>
									<?php
									}
									?>
								</li>
								<?php
									}
								else
									echo '<li>There are no Video tags in the DreamWerk APP yet which is trending right now. Please Try after sometime.</li>'
								?>
							</ul>
						</div>
					</div>
				</div>
				<!-- #END# Latest Social Trends -->
				<!-- Visitors -->
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<div class="card">
						<div class="body bg-teal">
							<div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
								 data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
								 data-offset="90" data-width="100%" data-height="85px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
								 data-fill-Color="rgba(0, 188, 212, 0)">
								<?php
								for ($i=30; $i >= 0; $i--)
									($i==0) ? eval('echo $weak_users_posts'.$i.';') : eval('echo $weak_users_posts'.$i.'.",";');
								?>
							</div>
							<ul class="dashboard-stat-list">
								<li class="font-17">
									VIDEO UPLOADS...
								</li>
								<li>
									Today
									<span class="pull-right"><b><?= $today_posts?></b> <small>Posts</small></span>
								</li>
								<li>
									Yesterday
									<span class="pull-right"><b><?= $yesterday_posts?></b> <small>Posts</small></span>
								</li>
								<li>
									Last Week
									<span class="pull-right"><b><?= $weak_posts?></b> <small>Posts</small></span>
								</li>
								<li>
									Last Month
									<span class="pull-right"><b><?= $month_posts?></b> <small>Posts</small></span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- #END# Visitors -->
				<!-- Answered Tickets -->
				<!-- <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<div class="card">
						<div class="body bg-teal">
							<div class="font-bold m-b--35">ANSWERED TICKETS</div>
							<ul class="dashboard-stat-list">
								<li>
									TODAY
									<span class="pull-right"><b>12</b> <small>TICKETS</small></span>
								</li>
								<li>
									YESTERDAY
									<span class="pull-right"><b>15</b> <small>TICKETS</small></span>
								</li>
								<li>
									LAST WEEK
									<span class="pull-right"><b>90</b> <small>TICKETS</small></span>
								</li>
								<li>
									LAST MONTH
									<span class="pull-right"><b>342</b> <small>TICKETS</small></span>
								</li>
								<li>
									LAST YEAR
									<span class="pull-right"><b>4 225</b> <small>TICKETS</small></span>
								</li>
								<li>
									ALL
									<span class="pull-right"><b>8 752</b> <small>TICKETS</small></span>
								</li>
							</ul>
						</div>
					</div>
				</div> -->
				<!-- #END# Answered Tickets -->
			</div>
			<!-- Table -->
			<div class="row clearfix">
				<!-- Task Info -->
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="card">
						<div class="header shadow-sm bg-red" style="/*background-image: linear-gradient(to bottom, #9c0d0c , #e71f1e);*/">
							<h2>Most Subscribed Users</h2>
							<!-- <ul class="header-dropdown m-r--5">
								<li class="dropdown">
									<a href="<?= base_url()?>assets/admin/javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<i class="material-icons">more_vert</i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a href="<?= base_url('admin/orderslist')?>">View Orders</a></li>
									</ul>
								</li>
							</ul> -->
						</div>
						<div class="body">
							<div class="table-responsive">
								<table class="table dashboard-task-infos table-bordered table-hover dataTable js-exportable">
									<thead>
										<tr>
											<th>Username</th>
											<th>Name</th>
											<th>Email</th>
											<th>Blocked</th>
											<th>Role</th>
											<th>Date</th>
											<th></th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Username</th>
											<th>Name</th>
											<th>Email</th>
											<th>Blocked</th>
											<th>Role</th>
											<th>Date</th>
											<th></th>
										</tr>
									</tfoot>
									<tbody>
										<?php
										if($users)
											foreach ($users as $key => $user)
											{
												// $currency=explode(".", json_decode($user['details']['if_currency'], true)['symbol']);
										?>
										<tr>
											<td><?= $user['username']?></td>
											<td><?= $user['full_name']?></td>
											<td><?= $user['email']?></td>
											<td class="text-center"><?= ($user['is_blocked']==1) ? '<button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float blockThisUser" data-type="unblock" data-userid="'.$user['user_id'].'" data-userstatus="1" data-toggle="tooltip" data-placement="bottom" title="Unblock this User."><i class="material-icons">lock_outline</i></button>' : '<button type="button" class="btn btn-default btn-circle waves-effect waves-circle waves-float blockThisUser" data-type="block" data-userid="'.$user['user_id'].'" data-userstatus="0" data-toggle="tooltip" data-placement="bottom" title="Block this User."><i class="material-icons">lock_open</i></button>';?></td>
											<td><?= $user['role'];?></td>
											<td><?= date('d F Y', strtotime($user['created_at']))?></td>
											<td>
												<button type="button" class="btn bg-red waves-effect m-r-20" data-toggle="modal" data-target="#largeModal<?= $user['user_id'];?>">View</button>
												<div class="modal fade" id="largeModal<?= $user['user_id'];?>" tabindex="-1" role="dialog">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title text-primary" id="largeModalLabel"><?= "@".$user['username']?></h4>
															</div>
															<div class="modal-body">
																<div class="row">
																	<div class="col-md-6">
																		<p class="text-dark"><?= $user['email']?></p>
																	</div>
																	<div class="col-md-6 text-right">
																		<a href="<?= base_url('user/profile/').urlencode($user['username'])."/".$user['user_id'];?>" target="_blank" class="btn bg-red waves-effect"><i class="material-icons">person</i>  Profile</a>
																	</div>
																	<div class="col-md-12">
																		<table class="table table-bordered">
																			<tbody>
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
																					<th>Subscribers</th>
																					<td><?= $this->mysql->get_count('dw_subcriptions', array('to_user_id' => $user['user_id']))?></td>
																				</tr>
																				<tr>
																					<th>Device Type</th>
																					<td><?= "Android";?></td>
																				</tr>
																			</tbody>
																		</table>
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
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- #END# Task Info -->
				<!-- Browser Usage -->
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hide">
					<div class="card">
						<div class="header">
							<h2>Usage</h2>
							<!-- <ul class="header-dropdown m-r--5">
								<li class="dropdown">
									<a href="<?= base_url()?>assets/admin/javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<i class="material-icons">more_vert</i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a href="<?= base_url()?>assets/admin/javascript:void(0);">Action</a></li>
										<li><a href="<?= base_url()?>assets/admin/javascript:void(0);">Another action</a></li>
										<li><a href="<?= base_url()?>assets/admin/javascript:void(0);">Something else here</a></li>
									</ul>
								</li>
							</ul> -->
						</div>
						<div class="body">
							<div id="donut_chart" class="dashboard-donut-chart"></div>
						</div>
					</div>
				</div>
				<!-- #END# Browser Usage -->
			</div>
			<!-- CPU Usage -->
			<!-- <div class="row clearfix">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="card">
						<div class="header">
							<div class="row clearfix">
								<div class="col-xs-12 col-sm-6">
									<h2>CPU USAGE (%)</h2>
								</div>
								<div class="col-xs-12 col-sm-6 align-right">
									<div class="switch panel-switch-btn">
										<span class="m-r-10 font-12">REAL TIME</span>
										<label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
									</div>
								</div>
							</div>
							<ul class="header-dropdown m-r--5">
								<li class="dropdown">
									<a href="<?= base_url()?>assets/admin/javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<i class="material-icons">more_vert</i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a href="<?= base_url()?>assets/admin/javascript:void(0);">Action</a></li>
										<li><a href="<?= base_url()?>assets/admin/javascript:void(0);">Another action</a></li>
										<li><a href="<?= base_url()?>assets/admin/javascript:void(0);">Something else here</a></li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="body">
							<div id="real_time_chart" class="dashboard-flot-chart"></div>
						</div>
					</div>
				</div>
			</div> -->
			<!-- #END# CPU Usage -->
		</div>
	</section>