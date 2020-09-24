	<section>
		<!-- Left Sidebar -->
		<aside id="leftsidebar" class="sidebar">
			<!-- User Info -->
			<div class="user-info">
				<div class="image">
					<img src="<?= base_url()?>assets/images/dw_favicon.png" width="48" height="48" alt="User" />
				</div>
				<div class="info-container">
					<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $this->session->dw_a_username; ?></div>
					<div class="email"><?= $this->session->dw_a_email; ?></div>
					<div class="btn-group user-helper-dropdown">
						<i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
						<ul class="dropdown-menu pull-right">
							<!-- <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
							<li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
							<li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
							<li role="separator" class="divider"></li> -->
							<li><a href="<?= base_url()?>logout"><i class="material-icons">input</i>Sign Out</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- #User Info -->
			<!-- Menu -->
			<div class="menu">
				<ul class="list">
					<li class="header">DreamWerk Settings</li>
					<li class="<?php if($active=='Home') echo('active')?>">
						<a href="<?= base_url()?>admin/">
							<i class="material-icons">dashboard</i>
							<span>Dashboard</span>
						</a>
					</li>
					<li class="<?php if($active=='profile' || $active=='user-list' || $active=='stylist-list' || $active=='brand-list' || $active=='deletion-request') echo('active')?>">
						<a href="<?= base_url('user')?>" class="waves-red">
							<i class="material-icons">people</i>
							<span>Users</span>
						</a>
					</li>
					<li class="<?php if($active=='Videos') echo('active')?>">
						<a href="<?= base_url('video');?>">
							<i class="material-icons">subscriptions</i>
							<span>Videos</span>
						</a>
					</li>
					<li class="<?php if($active=='pendingVideos') echo('active')?>">
						<a href="<?= base_url('video/pendingVideos');?>">
							<i class="material-icons">video_library</i>
							<span>Pending Videos</span>
						</a>
					</li>
					<li class="<?php if($active=='Feedbacks') echo('active')?>">
						<a href="<?= base_url('feedback');?>">
							<i class="material-icons">feedback</i>
							<span>Feedbacks</span>
						</a>
					</li>
					<!-- <li class="<?php if($active=='Html' || $active=='categories' || $active=='category' || $active=='addcategory' || $active=='styles' || $active=='style' || $active=='addstyle' || $active=='specialities' || $active=='speciality' || $active=='addspeciality' || $active=='meet-sellers' || $active=='bids' || $active=='twiml') echo('active')?>">
						<a href="javascript:void(0);" class="menu-toggle">
							<i class="material-icons">touch_app</i>
							<span>APP Settings</span>
						</a>
						<ul class="ml-menu">
							<li class="<?php if($active=='categories' || $active=='category' || $active=='addcategory' || $active=='styles' || $active=='style' || $active=='addstyle' || $active=='specialities' || $active=='speciality' || $active=='addspeciality') echo('active')?>">
								<a href="javascript:void(0);" class="menu-toggle">
									<i class="material-icons">style</i>
									<span>Fashion</span>
								</a>
								<ul class="ml-menu">
									<li class="<?php if($active=='categories' || $active=='category' || $active=='addcategory') echo('active')?>">
										<a href="<?= base_url('admin/fashion/categories')?>">
											<i class="material-icons">collections_bookmark</i>
											<span>Categories</span>
										</a>
									</li>
									<li class="<?php if($active=='styles' || $active=='style' || $active=='addstyle') echo('active')?>">
										<a href="<?= base_url('admin/fashion/styles')?>">
											<i class="material-icons">collections</i>
											<span>Styles</span>
										</a>
									</li>
									<li class="<?php if($active=='specialities' || $active=='speciality' || $active=='addspeciality') echo('active')?>">
										<a href="<?= base_url('admin/fashion/specialities')?>">
											<i class="material-icons">business_center</i>
											<span>Stylist Specialities</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="<?php if($active=='meet-sellers') echo('active')?>">
								<a href="<?= base_url('admin/meetsellers')?>">
									<i class="material-icons">supervisor_account</i>
									<span>Meet Sellers</span>
								</a>
							</li>
							<li class="<?php if($active=='Html') echo('active')?>">
								<a href="<?= base_url('admin/apphtml')?>">
									<i class="material-icons">text_fields</i>
									<span>Text / HTML</span>
								</a>
							</li>
							<li class="<?php if($active=='bids') echo('active')?>">
								<a href="<?= base_url('admin/bids')?>">
									<i class="material-icons">format_line_spacing</i>
									<span>This Month Biddings</span>
								</a>
							</li>
							<li class="<?php if($active=='twiml') echo('active')?>">
								<a href="<?= base_url('admin/twiml')?>">
									<i class="material-icons">settings_input_composite</i>
									<span>TwiML Settings</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="<?php if($active=='Payments' || $active=='Stylist Hire Packages' || $active=='Profile Projection Packages' || $active=='Post Projection Packages' || $active=='orders-list' || $active=='commissions-rewards' || $active=='points-management' || $active=='Vaqra Transactions History') echo('active')?>">
						<a href="javascript:void(0);" class="menu-toggle">
							<i class="material-icons">payment</i>
							<span>Payments</span>
						</a>
						<ul class="ml-menu">
							<li class="<?php if($active=='commissions-rewards') echo('active')?>">
								<a href="<?= base_url('admin/commissions')?>">
									<i class="material-icons">account_balance</i>
									<span>Commissions & Rewards</span>
								</a>
							</li>
							<li class="<?php if($active=='orders-list') echo('active')?>">
								<a href="<?= base_url('admin/orderslist')?>">
									<i class="material-icons">shopping_cart</i>
									<span>Orders</span>
								</a>
							</li>
							<li class="<?php if($active=='points-management') echo('active')?>">
								<a href="<?= base_url('admin/points')?>">
									<i class="material-icons">card_giftcard</i>
									<span>Points Management</span>
								</a>
							</li>
							<li class="<?php if($active=='Post Projection Packages') echo('active')?>">
								<a href="<?= base_url('admin/postprojectionpackages')?>">
									<i class="material-icons">tap_and_play</i>
									<span>Post Projection Packages</span>
								</a>
							</li>
							<li class="<?php if($active=='Profile Projection Packages') echo('active')?>">
								<a href="<?= base_url('admin/profileprojectionpackages')?>">
									<i class="material-icons">airplay</i>
									<span>Profile Projection Packages</span>
								</a>
							</li>
							<li class="<?php if($active=='Stylist Hire Packages') echo('active')?>">
								<a href="<?= base_url('admin/stylisthirepackages')?>">
									<i class="material-icons">business</i>
									<span>Stylist Hire Packages</span>
								</a>
							</li>
							<li class="<?php if($active=='Vaqra Transactions History') echo('active')?>">
								<a href="<?= base_url('admin/vaqrapaymenthistory')?>">
									<i class="material-icons">account_balance</i>
									<span>Transactions History</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="<?php if($active=='feedbacks' || $active=='reports' || $active=='solvedReports') echo('active')?>">
						<a href="javascript:void(0);" class="menu-toggle">
							<i class="material-icons">report_problem</i>
							<span>Feedback & Reports</span>
						</a>
						<ul class="ml-menu">
							<li class="<?php if($active=='feedbacks') echo('active')?>">
								<a href="<?= base_url('admin/feedbacks')?>">
									<i class="material-icons">feedback</i>
									<span>Feedbacks</span>
								</a>
							</li>
							<li class="<?php if($active=='reports') echo('active')?>">
								<a href="<?= base_url('admin/reports')?>">
									<i class="material-icons">report</i>
									<span>Reports</span>
								</a>
							</li>
							<li class="<?php if($active=='solvedReports') echo('active')?>">
								<a href="<?= base_url('admin/solvedreports')?>">
									<i class="material-icons">assignment_turned_in</i>
									<span>Solved Reports</span>
								</a>
							</li>
						</ul>
					</li> -->
					<!-- <li>
						<a href="<?= base_url()?>assets/admin/pages/helper-classes.html">
							<i class="material-icons">layers</i>
							<span>Helper Classes</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);" class="menu-toggle">
							<i class="material-icons">widgets</i>
							<span>Widgets</span>
						</a>
						<ul class="ml-menu">
							<li>
								<a href="javascript:void(0);" class="menu-toggle">
									<span>Cards</span>
								</a>
								<ul class="ml-menu">
									<li>
										<a href="<?= base_url()?>assets/admin/pages/widgets/cards/basic.html">Basic</a>
									</li>
									<li>
										<a href="<?= base_url()?>assets/admin/pages/widgets/cards/colored.html">Colored</a>
									</li>
									<li>
										<a href="<?= base_url()?>assets/admin/pages/widgets/cards/no-header.html">No Header</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="javascript:void(0);" class="menu-toggle">
									<span>Infobox</span>
								</a>
								<ul class="ml-menu">
									<li>
										<a href="<?= base_url()?>assets/admin/pages/widgets/infobox/infobox-1.html">Infobox-1</a>
									</li>
									<li>
										<a href="<?= base_url()?>assets/admin/pages/widgets/infobox/infobox-2.html">Infobox-2</a>
									</li>
									<li>
										<a href="<?= base_url()?>assets/admin/pages/widgets/infobox/infobox-3.html">Infobox-3</a>
									</li>
									<li>
										<a href="<?= base_url()?>assets/admin/pages/widgets/infobox/infobox-4.html">Infobox-4</a>
									</li>
									<li>
										<a href="<?= base_url()?>assets/admin/pages/widgets/infobox/infobox-5.html">Infobox-5</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0);" class="menu-toggle">
							<i class="material-icons">swap_calls</i>
							<span>User Interface (UI)</span>
						</a>
						<ul class="ml-menu">
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/alerts.html">Alerts</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/animations.html">Animations</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/badges.html">Badges</a>
							</li>

							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/breadcrumbs.html">Breadcrumbs</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/buttons.html">Buttons</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/collapse.html">Collapse</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/colors.html">Colors</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/dialogs.html">Dialogs</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/icons.html">Icons</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/labels.html">Labels</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/list-group.html">List Group</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/media-object.html">Media Object</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/modals.html">Modals</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/notifications.html">Notifications</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/pagination.html">Pagination</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/preloaders.html">Preloaders</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/progressbars.html">Progress Bars</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/range-sliders.html">Range Sliders</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/sortable-nestable.html">Sortable & Nestable</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/tabs.html">Tabs</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/thumbnails.html">Thumbnails</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/tooltips-popovers.html">Tooltips & Popovers</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/ui/waves.html">Waves</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0);" class="menu-toggle">
							<i class="material-icons">assignment</i>
							<span>Forms</span>
						</a>
						<ul class="ml-menu">
							<li>
								<a href="<?= base_url()?>assets/admin/pages/forms/basic-form-elements.html">Basic Form Elements</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/forms/advanced-form-elements.html">Advanced Form Elements</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/forms/form-examples.html">Form Examples</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/forms/form-validation.html">Form Validation</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/forms/form-wizard.html">Form Wizard</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/forms/editors.html">Editors</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0);" class="menu-toggle">
							<i class="material-icons">view_list</i>
							<span>Tables</span>
						</a>
						<ul class="ml-menu">
							<li>
								<a href="<?= base_url()?>assets/admin/pages/tables/normal-tables.html">Normal Tables</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/tables/jquery-datatable.html">Jquery Datatables</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/tables/editable-table.html">Editable Tables</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0);" class="menu-toggle">
							<i class="material-icons">perm_media</i>
							<span>Medias</span>
						</a>
						<ul class="ml-menu">
							<li>
								<a href="<?= base_url()?>assets/admin/pages/medias/image-gallery.html">Image Gallery</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/medias/carousel.html">Carousel</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0);" class="menu-toggle">
							<i class="material-icons">pie_chart</i>
							<span>Charts</span>
						</a>
						<ul class="ml-menu">
							<li>
								<a href="<?= base_url()?>assets/admin/pages/charts/morris.html">Morris</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/charts/flot.html">Flot</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/charts/chartjs.html">ChartJS</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/charts/sparkline.html">Sparkline</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/charts/jquery-knob.html">Jquery Knob</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0);" class="menu-toggle">
							<i class="material-icons">content_copy</i>
							<span>Example Pages</span>
						</a>
						<ul class="ml-menu">
							<li>
								<a href="<?= base_url()?>assets/admin/pages/examples/profile.html">Profile</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/examples/sign-in.html">Sign In</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/examples/sign-up.html">Sign Up</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/examples/forgot-password.html">Forgot Password</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/examples/blank.html">Blank Page</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/examples/404.html">404 - Not Found</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/examples/500.html">500 - Server Error</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0);" class="menu-toggle">
							<i class="material-icons">map</i>
							<span>Maps</span>
						</a>
						<ul class="ml-menu">
							<li>
								<a href="<?= base_url()?>assets/admin/pages/maps/google.html">Google Map</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/maps/yandex.html">YandexMap</a>
							</li>
							<li>
								<a href="<?= base_url()?>assets/admin/pages/maps/jvectormap.html">jVectorMap</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0);" class="menu-toggle">
							<i class="material-icons">trending_down</i>
							<span>Multi Level Menu</span>
						</a>
						<ul class="ml-menu">
							<li>
								<a href="javascript:void(0);">
									<span>Menu Item</span>
								</a>
							</li>
							<li>
								<a href="javascript:void(0);">
									<span>Menu Item - 2</span>
								</a>
							</li>
							<li>
								<a href="javascript:void(0);" class="menu-toggle">
									<span>Level - 2</span>
								</a>
								<ul class="ml-menu">
									<li>
										<a href="javascript:void(0);">
											<span>Menu Item</span>
										</a>
									</li>
									<li>
										<a href="javascript:void(0);" class="menu-toggle">
											<span>Level - 3</span>
										</a>
										<ul class="ml-menu">
											<li>
												<a href="javascript:void(0);">
													<span>Level - 4</span>
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?= base_url()?>assets/admin/pages/changelogs.html">
							<i class="material-icons">update</i>
							<span>Changelogs</span>
						</a>
					</li>
					<li class="header">LABELS</li>
					<li>
						<a href="javascript:void(0);">
							<i class="material-icons col-red">donut_large</i>
							<span>Important</span>
						</a>	
					</li>
					<li>
						<a href="javascript:void(0);">
							<i class="material-icons col-amber">donut_large</i>
							<span>Warning</span>
						</a>
					</li> -->
					<!-- <li class="header">Second Menu</li>
					<li>
						<a href="javascript:void(0);">
							<i class="material-icons col-light-blue">donut_large</i>
							<span>Information</span>
						</a>
					</li> -->
				</ul>
			</div>
			<!-- #Menu -->
			<!-- Footer -->
			<div class="legal">
				<div class="copyright">&copy; 2020 - 2021 <a href="https://www.linkedin.com/in/polus-fansare/" style="display: block;" target="_blank">DreamWerks - Polus Fansare</a></div>
				<div class="version"><b>Version: </b> 1.6.2</div>
			</div>
			<!-- #Footer -->
		</aside>
		<!-- #END# Left Sidebar -->
		<!-- Right Sidebar -->
		<aside id="rightsidebar" class="right-sidebar">
			<ul class="nav nav-tabs tab-nav-right" role="tablist">
				<li role="presentation" class="active"><a href="<?= base_url()?>assets/admin/#skins" data-toggle="tab">SKINS</a></li>
				<li role="presentation"><a href="<?= base_url()?>assets/admin/#settings" data-toggle="tab">SETTINGS</a></li>
			</ul>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade in active in active" id="skins">
					<ul class="demo-choose-skin">
						<li data-theme="red" class="active">
							<div class="red"></div>
							<span>Red</span>
						</li>
						<li data-theme="pink">
							<div class="pink"></div>
							<span>Pink</span>
						</li>
						<li data-theme="purple">
							<div class="purple"></div>
							<span>Purple</span>
						</li>
						<li data-theme="deep-purple">
							<div class="deep-purple"></div>
							<span>Deep Purple</span>
						</li>
						<li data-theme="indigo">
							<div class="indigo"></div>
							<span>Indigo</span>
						</li>
						<li data-theme="blue">
							<div class="blue"></div>
							<span>Blue</span>
						</li>
						<li data-theme="light-blue">
							<div class="light-blue"></div>
							<span>Light Blue</span>
						</li>
						<li data-theme="cyan">
							<div class="cyan"></div>
							<span>Cyan</span>
						</li>
						<li data-theme="teal">
							<div class="teal"></div>
							<span>Teal</span>
						</li>
						<li data-theme="green">
							<div class="green"></div>
							<span>Green</span>
						</li>
						<li data-theme="light-green">
							<div class="light-green"></div>
							<span>Light Green</span>
						</li>
						<li data-theme="lime">
							<div class="lime"></div>
							<span>Lime</span>
						</li>
						<li data-theme="yellow">
							<div class="yellow"></div>
							<span>Yellow</span>
						</li>
						<li data-theme="amber">
							<div class="amber"></div>
							<span>Amber</span>
						</li>
						<li data-theme="orange">
							<div class="orange"></div>
							<span>Orange</span>
						</li>
						<li data-theme="deep-orange">
							<div class="deep-orange"></div>
							<span>Deep Orange</span>
						</li>
						<li data-theme="brown">
							<div class="brown"></div>
							<span>Brown</span>
						</li>
						<li data-theme="grey">
							<div class="grey"></div>
							<span>Grey</span>
						</li>
						<li data-theme="blue-grey">
							<div class="blue-grey"></div>
							<span>Blue Grey</span>
						</li>
						<li data-theme="black">
							<div class="black"></div>
							<span>Black</span>
						</li>
					</ul>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="settings">
					<div class="demo-settings">
						<p>GENERAL SETTINGS</p>
						<ul class="setting-list">
							<li>
								<span>Report Panel Usage</span>
								<div class="switch">
									<label><input type="checkbox" checked><span class="lever"></span></label>
								</div>
							</li>
							<li>
								<span>Email Redirect</span>
								<div class="switch">
									<label><input type="checkbox"><span class="lever"></span></label>
								</div>
							</li>
						</ul>
						<p>SYSTEM SETTINGS</p>
						<ul class="setting-list">
							<li>
								<span>Notifications</span>
								<div class="switch">
									<label><input type="checkbox" checked><span class="lever"></span></label>
								</div>
							</li>
							<li>
								<span>Auto Updates</span>
								<div class="switch">
									<label><input type="checkbox" checked><span class="lever"></span></label>
								</div>
							</li>
						</ul>
						<p>ACCOUNT SETTINGS</p>
						<ul class="setting-list">
							<li>
								<span>Offline</span>
								<div class="switch">
									<label><input type="checkbox"><span class="lever"></span></label>
								</div>
							</li>
							<li>
								<span>Location Permission</span>
								<div class="switch">
									<label><input type="checkbox" checked><span class="lever"></span></label>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</aside>
		<!-- #END# Right Sidebar -->
	</section>