										<form class="form-horizontal" method="post" enctype="multipart/form-data" id="updateProfile">
											<div class="form-group">
												<label for="fullname" class="col-sm-2 control-label">Full Name</label>
												<div class="col-sm-10">
													<div class="form-line">
														<input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full name" value="<?= $profile['full_name'];?>" required>
													</div>
												</div>
											</div>
											<div class="form-group hide">
												<label for="username" class="col-sm-2 control-label">Username</label>
												<div class="col-sm-10">
													<div class="form-line">
														<input type="text" class="form-control" id="username" name="username" placeholder="User name" value="<?= $profile['username'];?>" required>
														<input type="hidden" class="form-control" id="userid" name="userid" placeholder="userid" value="<?= $userid;?>" required>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="email" class="col-sm-2 control-label">Email</label>
												<div class="col-sm-10">
													<div class="form-line">
														<input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?= $profile['email'];?>" required>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Gender</label>
												<div class="col-sm-10">
													<input type="radio" name="gender" id="male" class="with-gap" value="Male" <?= ($profile['gender']=='Male') ? 'checked' : '' ;?>>
													<label for="male">Male</label>

													<input type="radio" name="gender" id="female" class="with-gap" value="Female" <?= ($profile['gender']=='Female') ? 'checked' : '' ;?>>
													<label for="female" class="m-l-20">Female</label>
												</div>
											</div>
											<div class="form-group">
												<label for="dob" class="col-sm-2 control-label">Date of Birth</label>
												<div class="col-sm-10">
													<div class="form-line" id="bs_datepicker_container">
														<input type="text" class="form-control" id="dob" name="dob" placeholder="Please choose a date..." value="<?= ($profile['dob']) ? date('Y-m-d', strtotime($profile['dob'])): '';?>" required>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="phonenumber" class="col-sm-2 control-label">Phone Number</label>
												<div class="col-sm-10">
													<div class="form-line">
														<input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Phone Number" value="<?= $profile['phone'];?>">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="profilepic" class="col-sm-2 control-label">Profile Image</label>

												<div class="col-sm-10">
													<div class="form-line">
														<input type="file" id="profilepic" name="profilepic" accept="image/*">
													</div>
												</div>
											</div>
											<!-- <div class="form-group">
												<div class="col-sm-offset-2 col-sm-10">
													<input type="checkbox" id="terms_condition_check" class="chk-col-red filled-in" />
													<label for="terms_condition_check">I agree to the <a href="#">terms and conditions</a></label>
												</div>
											</div> -->
											<div class="form-group">
												<div class="col-sm-offset-2 col-sm-10">
													<input type="submit" name="updateProfile" class="btn bg-red" value="Update">
												</div>
											</div>
										</form>