<?php
if(!empty($edit))
{
	$style=$this->mysql->get_data("if_fashion_style", "if_id = '$edit'");
	if(!$style)
		redirect("admin/fashion/styles");
?>
	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>Edit Fashion Style</h2>
			</div>
			<div class="block-header">
				<a href="<?= base_url()?>admin/fashion/styles" class="btn bg-green btn-xs waves-effect"><i class="material-icons">reply</i> Back</a>
			</div>

			<!-- TinyMCE -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2><?= "#".$style[0]['if_style_name']?><small>Changes may affect the running applications (IOS / Andr.).</small></h2>
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
									echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Well done!</strong> You successfully updated '."#".$style[0]['if_style_name'].'.</div>';
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
											<div class="col-sm-10">
												<div class="form-group form-float">
													<div class="form-line focused">
														<input type="text" name="style_name" class="form-control" value="<?= $style[0]['if_style_name']?>" required/>
														<input type="hidden" name="style_id" class="form-control" value="<?= $style[0]['if_id']?>" required/>
														<label class="form-label">Fashion Style Name</label>
													</div>
												</div>
											</div>
											<div class="col-sm-1">
												<div class="switch">
													<label><input name="style_status" type="checkbox" <?= ($style[0]['if_status'])? 'checked' : '';?> value="1"><span class="lever switch-col-green"></span></label>
												</div>
											</div>
											<div class="col-sm-10">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="file" name="style_image" class="form-control">
													</div>
												</div>
											</div>
											<div class="col-sm-10">
												<div class="form-group form-float">
													<div class="form-line">
														<textarea rows="4" class="form-control no-resize" name="style_desc"><?= $style[0]['if_description']?></textarea>
														<label class="form-label">Fashion Style Descrtipion	</label>
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
		</div>
	</section>
<?php
}
elseif($active=='addstyle')
{
?>
	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>Add Fashion Style</h2>
			</div>
			<div class="block-header">
				<a href="<?= base_url()?>admin/fashion/styles" class="btn bg-green btn-xs waves-effect"><i class="material-icons">reply</i> Back</a>
			</div>

			<!-- TinyMCE -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>Add Style<small>Changes may affect the running applications (IOS / Andr.).</small></h2>
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
									echo '<div class="alert alert-success"><strong>Well done!</strong> You successfully Added a style. Redirecting you to edit it.</div>';
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
											<div class="col-sm-10">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" name="style_name1" class="form-control" required/>
														<label class="form-label">Fashion Style Name</label>
													</div>
												</div>
											</div>
											<div class="col-sm-1">
												<div class="switch">
													<label><input name="style_status1" type="checkbox" checked value="1"><span class="lever switch-col-green"></span></label>
												</div>
											</div>
											<div class="col-sm-10">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="file" name="style_image1" class="form-control">
													</div>
												</div>
											</div>
											<div class="col-sm-10">
												<div class="form-group form-float">
													<div class="form-line">
														<textarea rows="4" class="form-control no-resize" name="style_desc1"></textarea>
														<label class="form-label">Fashion Style Descrtipion	</label>
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
					redirect("admin/fashion/style/edit/".$inserted);
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
					Fashion Styles
					<small>Taken from <a href="#" target="_blank">Vaqra APP</a></small>
					<br>
					<a class="btn bg-green btn-xs waves-effect" href="<?= base_url()?>admin/fashion/style/addstyle"><i class="material-icons">add</i> Add Style</a>
				</h2>
			</div>
			<!-- User Table -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>STYLES LIST</h2>
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
										$styles=$this->mysql->get_data('if_fashion_style', '');
										if($styles)
											foreach ($styles as $key => $style)
											{
										?>
										<tr>
											<td><?= $key+1?></td>
											<td><?= $style['if_style_name']?></td>
											<td><img width="120" src="<?= ($style['if_image']) ? '/fashion_app_api/'.$style['if_image'] : base_url().'assets/admin/images/default-image.jpg';?>"></td>
											<td><?= $style['if_description'];?></td>
											<td><?= date('d F Y', strtotime($style['timestamp']))?></td>
											<td>
												<a href="<?= base_url()?>admin/fashion/style/edit/<?= $style['if_id']?>" class="btn bg-green waves-effect waves-green m-5"><i class="material-icons">mode_edit</i> Edit</a>
												<button class="btn waves-effect bg-red waves-green js-sweetalert m-5" data-datatype="if_fashion_style" data-dataname="<?= $style['if_style_name'];?> fashion style" data-dataid="<?= $style['if_id']?>" data-type="cancel"><i class="material-icons">delete_forever</i> Delete</button>
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
<?php
}
?>