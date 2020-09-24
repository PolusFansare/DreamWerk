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
												<label for="newPassword" class="col-sm-3 control-label">New Password</label>
												<div class="col-sm-9">
													<div class="form-line">
														<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" required>
														<input type="hidden" class="form-control" name="userid" placeholder="userid" value="<?= $userid;?>" required>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="newPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm)</label>
												<div class="col-sm-9">
													<div class="form-line">
														<input type="password" class="form-control" id="newPasswordConfirm" name="newPasswordConfirm" placeholder="New Password (Confirm)" required>
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-9">
													<input type="submit" class="btn bg-red" name="updatePassword" value="Update">
												</div>
											</div>
										</form>