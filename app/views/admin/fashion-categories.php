<?php
if(!empty($edit))
{
	$category=$this->mysql->get_data("if_fashion_category", "if_id = '$edit'");
	if(!$category)
		redirect("admin/fashion/categories");
?>
	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>Edit Fashion Category</h2>
			</div>
			<div class="block-header">
				<a href="<?= base_url()?>admin/fashion/categories" class="btn bg-green btn-xs waves-effect"><i class="material-icons">reply</i> Back</a>
			</div>

			<!-- TinyMCE -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2><?= "#".$category[0]['if_fc_name']?> <?= ($category[0]['if_gender']) ? "({$category[0]['if_gender']})" : '' ;?><small>Changes may affect the running applications (IOS / Andr.).</small></h2>
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
									echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Well done!</strong> You successfully updated '."#".$category[0]['if_fc_name'].'.</div>';
								else
									echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>';
							}
							if(isset($error))
								echo '<div class="alert alert-danger">'.$error.'</div>';
							?>
							<form action="" method="POST" enctype="multipart/form-data">
								<div class="row clearfix">
									<div class="col-lg-8">
										<div class="row">
											<div class="col-sm-5">
												<div class="form-group form-float">
													<div class="form-line focused">
														<input type="text" name="cat_name" class="form-control" value="<?= $category[0]['if_fc_name']?>" required/>
														<input type="hidden" name="cat_id" class="form-control" value="<?= $category[0]['if_id']?>" required/>
														<label class="form-label">Fashion Category Name</label>
													</div>
												</div>
											</div>
											<div class="col-sm-5">
												<div class="form-group">
													<select class="form-control show-tick" name="cat_gender" >
														<option value="" <?= ($category[0]['if_gender']=='')? '' : '';?>>- Select Gender -</option>
														<option value="Male" <?= ($category[0]['if_gender']=='Male')? 'selected' : '';?>>Male</option>
														<option value="Female" <?= ($category[0]['if_gender']=='Female')? 'selected' : '';?>>Female</option>
													</select>
												</div>
											</div>
											<div class="col-sm-2">
												<div class="switch">
													<label><input name="cat_status" type="checkbox" <?= ($category[0]['if_status'])? 'checked' : '';?> value="1"><span class="lever switch-col-green"></span></label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-5">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="file" name="cat_image" class="form-control">
													</div>
												</div>
											</div>
											<div class="col-sm-5">
												<div class="form-group form-float">
													<select class="form-control show-tick" name="cat_size" >
														<option value="0" <?= ($category[0]['if_size']=='0')? 'selected' : '';?>>- Select Size type -</option>
														<option value="1" <?= ($category[0]['if_size']=='1')? 'selected' : '';?>>Top wear sizes (eg. L, XL etc.)</option>
														<option value="2" <?= ($category[0]['if_size']=='2')? 'selected' : '';?>>Bottom wear sizes (eg. M, XL etc.)</option>
														<option value="3" <?= ($category[0]['if_size']=='3')? 'selected' : '';?>>Footwear wear sizes (eg. US4, US7 etc.)</option>
													</select>
												</div>
											</div>
											<div class="col-sm-10">
												<div class="form-group form-float">
													<div class="form-line">
														<textarea rows="4" class="form-control no-resize" name="cat_desc"><?= $category[0]['if_fc_description']?></textarea>
														<label class="form-label">Fashion Category Descrtipion	</label>
													</div>
												</div>
											</div>
											<div class="col-sm-10">
												<div class="form-group form-float">
													<button class="btn bg-green" type="submit">Submit</button>
												</div>
											</div>
										</div>
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
elseif($active=='addcategory')
{
?>
	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>Add Fashion Category</h2>
			</div>
			<div class="block-header">
				<a href="<?= base_url()?>admin/fashion/categories" class="btn bg-green btn-xs waves-effect"><i class="material-icons">reply</i> Back</a>
			</div>

			<!-- TinyMCE -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>Add Category<small>Changes may affect the running applications (IOS / Andr.).</small></h2>
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
							if(isset($inserted))
							{
								if($inserted)
									echo '<div class="alert alert-success"><strong>Well done!</strong> You successfully Added a category. Redirecting you to edit it.</div>';
								else
									echo '<div class="alert alert-danger"><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>';
							}
							if(isset($error))
								echo '<div class="alert alert-danger">'.$error.'</div>';
							?>
							<form action="" method="POST" enctype="multipart/form-data">
								<div class="row clearfix">
									<div class="col-lg-8">
										<div class="row">
											<div class="col-sm-5">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" name="cat_name1" class="form-control" required/>
														<label class="form-label">Fashion Category Name</label>
													</div>
												</div>
											</div>
											<div class="col-sm-5">
												<div class="form-group">
													<select class="form-control show-tick" name="cat_gender1" >
														<option value="" >- Select Gender -</option>
														<option value="Male" >Male</option>
														<option value="Female" >Female</option>
													</select>
												</div>
											</div>
											<div class="col-sm-2">
												<div class="switch">
													<label><input name="cat_status1" type="checkbox" checked value="1"><span class="lever switch-col-green"></span></label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-5">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="file" name="cat_image1" class="form-control">
													</div>
												</div>
											</div>
											<div class="col-sm-5">
												<div class="form-group form-float">
													<div class="form-line">
														<select class="form-control show-tick" name="cat_size1" >
															<option value="0" selected>- Select Size type -</option>
															<option value="1" >Top wear sizes (eg. L, XL etc.)</option>
															<option value="2" >Bottom wear sizes (eg. M, XL etc.)</option>
															<option value="3" >Footwear wear sizes (eg. US4, US7 etc.)</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-sm-10">
												<div class="form-group form-float">
													<div class="form-line">
														<textarea rows="4" class="form-control no-resize" name="cat_desc1"></textarea>
														<label class="form-label">Fashion Category Descrtipion	</label>
													</div>
												</div>
											</div>
											<div class="col-sm-10">
												<div class="form-group form-float">
													<button class="btn bg-green" type="submit">Submit</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php
			if(isset($inserted))
				if($inserted)
					redirect("admin/fashion/category/edit/".$inserted);
			?>
			<!-- #END# TinyMCE -->
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
					Fashion Categories
					<small>Taken from <a href="#" target="_blank">Vaqra APP</a></small>
					<br>
					<a class="btn bg-green btn-xs waves-effect" href="<?= base_url()?>admin/fashion/category/addcategory"><i class="material-icons">add</i> Add Category</a>
				</h2>
			</div>
			<!-- User Table -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>CATEGORY LIST</h2>
							<p></p>
							<ul class="header-dropdown m-r--5">
								<li class="dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<i class="material-icons">more_vert</i>
									</a>
									<!-- <ul class="dropdown-menu pull-right">
										<li><a href="javascript:void(0);">Action</a></li>
										<li><a href="javascript:void(0);">Another action</a></li>
										<li><a href="javascript:void(0);">Something else here</a></li>
									</ul> -->
								</li>
							</ul>
						</div>
						<div class="body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover dataTable js-exportable">
									<thead>
										<tr>
											<th>Sr.</th>
											<th>Name</th>
											<th>Image</th>
											<th>Description</th>
											<th>Date</th>
											<th></th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Sr.</th>
											<th>Name</th>
											<th>Image</th>
											<th>Description</th>
											<th>Date</th>
											<th></th>
										</tr>
									</tfoot>
									<tbody>
										<?php
										$categories=$this->mysql->get_data('if_fashion_category', '');
										if($categories)
											foreach ($categories as $key => $category)
											{
										?>
										<tr>
											<td><?= $key+1?></td>
											<td><?= ($category['if_gender']) ? $category['if_fc_name']." (".$category['if_gender'].")" : $category['if_fc_name'];?></td>
											<td><img width="120" src="<?= ($category['if_fc_image']) ? '/fashion_app_api/'.$category['if_fc_image'] : base_url().'assets/admin/images/default-image.jpg';?>"></td>
											<td><?= $category['if_fc_description'];?></td>
											<td><?= date('d F Y', strtotime($category['timestamp']))?></td>
											<td>
												<a href="<?= base_url()?>admin/fashion/category/edit/<?= $category['if_id']?>" class="btn bg-green waves-effect waves-green m-5"><i class="material-icons">mode_edit</i> Edit</a>
												<button class="btn waves-effect bg-red waves-green js-sweetalert m-5" data-datatype="if_fashion_category" data-dataname="<?= ($category['if_gender']) ? $category['if_fc_name']." (".$category['if_gender'].")" : $category['if_fc_name'];?> fashion category" data-dataid="<?= $category['if_id']?>" data-type="cancel"><i class="material-icons">delete_forever</i> Delete</button>
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

	<!-- <div class="sweet-alert hideSweetAlert" data-custom-class="" data-has-cancel-button="false" data-has-confirm-button="true" data-allow-outside-click="false" data-has-done-function="false" data-animation="pop" data-timer="null" style="display: none; margin-top: -144px; opacity: -0.01;">
		<div class="sa-icon sa-error" style="display: none;">
			<span class="sa-x-mark">
				<span class="sa-line sa-left"></span>
				<span class="sa-line sa-right"></span>
			</span>
		</div>
		<div class="sa-icon sa-warning" style="display: none;">
			<span class="sa-body"></span>
			<span class="sa-dot"></span>
		</div>
		<div class="sa-icon sa-info" style="display: none;"></div>
		<div class="sa-icon sa-success" style="display: none;">
			<span class="sa-line sa-tip"></span>
			<span class="sa-line sa-long"></span>

			<div class="sa-placeholder"></div>
			<div class="sa-fix"></div>
		</div>
		<div class="sa-icon sa-custom" style="display: block; background-image: url(&quot;../../images/thumbs-up.png&quot;); width: 80px; height: 80px;width:80px; height:80px"></div>
		<h2>Sweet!</h2>
		<p style="display: block;">Here's a custom image.</p>
		<fieldset>
			<input type="text" tabindex="3" placeholder="">
			<div class="sa-input-error"></div>
		</fieldset>
		<div class="sa-error-container">
			<div class="icon">!</div>
			<p>Not valid!</p>
		</div>
		<div class="sa-button-container">
			<button class="cancel" tabindex="2" style="display: none; box-shadow: none;">Cancel</button>
			<div class="sa-confirm-button-container">
				<button class="confirm" tabindex="1" style="display: inline-block; background-color: rgb(140, 212, 245); box-shadow: rgba(140, 212, 245, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;">OK</button>
				<div class="la-ball-fall">
					<div></div>
					<div></div>
					<div></div>
				</div>
			</div>
		</div>
	</div> -->
<?php
}
?>