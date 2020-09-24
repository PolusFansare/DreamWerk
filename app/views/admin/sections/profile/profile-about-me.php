							<ul>
								<li>
									<div class="title">
										<i class="material-icons">account_circle</i>
										Gender
									</div>
									<div class="content">
										<?= ($profile['gender']) ? $profile['gender'] : '<i>NA</i>';?>
									</div>
								</li>
								<li>
									<div class="title">
										<i class="material-icons">date_range</i>
										Date of Birth
									</div>
									<div class="content">
										<?= ($profile['dob']) ? date("d M Y", strtotime($profile['dob'])) : '<i>NA</i>';?>
									</div>
								</li>
								<li>
									<div class="title">
										<i class="material-icons">smartphone</i>
										Phone Number
									</div>
									<div class="content">
										<?= ($profile['phone']) ? $profile['phone'].'<span class="label col-grey" style="float:right;" data-toggle="tooltip" data-placement="top" title="Verified"><i class="material-icons font-18">verified_user</i></span>' : '<i>NA</i>';?>
									</div>
								</li>
								<li>
									<div class="title">
										<i class="material-icons">devices_other</i>
										Device Type
									</div>
									<div class="content">
										Android
									</div>
								</li>
								<!-- <li>
									<div class="title">
										<i class="material-icons">edit</i>
										Skills
									</div>
									<div class="content">
										<span class="label bg-red">UI Design</span>
										<span class="label bg-teal">JavaScript</span>
										<span class="label bg-blue">PHP</span>
										<span class="label bg-amber">Node.js</span>
									</div>
								</li> -->
							</ul>