	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>
					Users List
					<small>Taken from <a href="#" target="_blank">DreamWerk APP</a></small>
				</h2>
			</div>
			<!-- User Table -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>Filter Users</h2>
							<!-- <small></small> -->
						</div>
						<div class="body">
							<form method="POST" id="filter-users" class="filter-users">
								<div class="row">
									<div class="col-sm-4">
										<b>Username / Full Name / Email</b>
										<div class="form-group">
											<div class="form-line">
												<input class="form-control" type="text" name="username" value="<?= ($this->input->post('username')) ? $this->input->post('username'): "";?>">
											</div>
										</div>
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
										<button class="btn bg-red">Filter Now</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="card">
						<div class="header">
							<h2>USERS LIST</h2>
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
			</div>
			<!-- #END# Exportable Table -->
		</div>
	</section>