	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>
					DreamWerk Feedbacks List
					<small>Taken from <a href="#" target="_blank">DreamWerk APP</a></small>
				</h2>
			</div>
			<!-- User Table -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2><?= strtoupper('DreamWerk Feedbacks');?> LIST</h2>
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
											<th>Title</th>
											<th>Username</th>
											<th>Rating</th>
											<th>Date</th>
											<th></th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Title</th>
											<th>Username</th>
											<th>Rating</th>
											<th>Date</th>
											<th></th>
										</tr>
									</tfoot>
									<tbody>
										<?php
										if($feedbacks)
											foreach ($feedbacks as $key => $feedback)
											{
										?>
										<tr>
											<td><?= $feedback['title']?></td>
											<td class="col-cyan" data-toggle="modal" data-target="#largeModal<?= $feedback['id'];?>"><?= "@".$feedback['user']['username']." (".$feedback['user']['full_name'].")"?></td>
											<td style="color: #FFD700"><?php for($i=0; $i < $feedback['rating']; $i++) echo '<i class="material-icons">star</i>';?></td>
											<td><?= date('d F Y', strtotime($feedback['created_at']))?></td>
											<td>
												<button type="button" class="btn bg-red waves-effect m-r-20" data-toggle="modal" data-target="#largeModal<?= $feedback['id'];?>">View</button>
												<div class="modal fade" id="largeModal<?= $feedback['id'];?>" tabindex="-1" role="dialog">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title col-cyan" id="largeModalLabel"><a href="<?= base_url('user/profile/'.urlencode($feedback['user']['username'])."/".$feedback['user']['user_id']);?>" target="_blank"><?= "@".$feedback['user']['username']." (".$feedback['user']['full_name'].")"?></a></h4>
																<p class="mb-0 mt-1" id="largeModalLabel"><?= $feedback['user']['email']?> </p>
															</div>
															<div class="modal-body">
																<div class="row">
																	<div class="col-md-12 mb-1">
																		<hr class="my-1">
																	</div>
																	<div class="col-md-12 mb-1">
																		<h4><?= $feedback['title'];?> <span style="color: #FFD700"></span></h4>
																		<p class="mb-0 border-0"><?= $feedback['description'];?></p>
																		<span style="color: #FFD700"><?php for ($i=0; $i < $feedback['rating']; $i++) echo '<i class="font-16  material-icons">star</i>';?></span>
																	</div>
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
											echo '<tr><th colspan="4" class="text-center">There are no feedbacks yet...</th></tr>';
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