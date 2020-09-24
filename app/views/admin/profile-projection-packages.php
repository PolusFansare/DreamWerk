<?php
if(!empty($edit))
{
	if(!$package)
		redirect("admin/profileprojectionpackages");
?>
	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>Edit <?= $active?></h2>
			</div>
			<div class="block-header">
				<a href="<?= base_url('admin/profileprojectionpackages')?>" class="btn bg-green btn-xs waves-effect"><i class="material-icons">reply</i> Back</a>
			</div>

			<!-- TinyMCE -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2><?= "#".$package['if_package_name']?><small>Changes may affect the running applications (IOS / Andr.).</small></h2>
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
									echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Well done!</strong> You successfully updated '."#".$package['if_package_name'].'.</div>';
								else
									echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>Oh snap!</strong> Change a few things up and try submitting again.</div>';
							}
							if(isset($error))
								echo '<div class="alert alert-danger">'.$error.'</div>';
							?>
							<form action="" method="POST" enctype="multipart/form-data">
								<div class="row clearfix">
									<div class="col-lg-9">
										<div class="row">
											<div class="col-sm-10">
												<div class="form-group form-float">
													<div class="form-line focused">
														<input type="hidden" name="package_id" class="form-control" value="<?= $package['if_id']?>" required/>
														<input type="text" name="package_name" class="form-control" value="<?= $package['if_package_name']?>" required/>
														<label class="form-label">Package Name</label>
													</div>
												</div>
											</div>
											<div class="col-sm-5">
												<div class="form-group form-float">
													<div class="form-line">
														<input type="number" class="form-control no-resize" name="if_price" value="<?= $package['if_price']?>" required>
														<label class="form-label">Package Price (in PKR)</label>
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
else
{
?>
	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2><?= $active?></h2>
			</div>
			<!-- Hover Rows -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>
								<span class="text-uppercase"><?= $active?></span>
								<small>Below is the list of packages that every user choose while promoting a profile.</small>
							</h2>
							<!-- <ul class="header-dropdown m-r--5">
								<li class="dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<i class="material-icons">more_vert</i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a href="javascript:void(0);" class=" waves-effect waves-green">Action</a></li>
										<li><a href="javascript:void(0);" class=" waves-effect waves-green">Another action</a></li>
										<li><a href="javascript:void(0);" class=" waves-effect waves-green">Something else here</a></li>
									</ul>
								</li>
							</ul> -->
						</div>
						<div class="body table-responsive">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Sr.</th>
										<th>Package name</th>
										<th>Price</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($packages)
										foreach ($packages as $key => $package)
										{
									?>
									<tr>
										<th scope="row"><?=$key+1?></th>
										<td><?=$package['if_package_name']?></td>
										<td>PKR <?=$package['if_price']?></td>
										<td>
											<a href="<?= base_url('admin/profileprojectionpackages/edit/'.$package['if_id'].'/'.$package['if_package_name'])?>" class="btn bg-green waves-effect waves-green"><i class="material-icons">mode_edit</i> Edit</a>
										</td>
									</tr>
									<?php
										}
									else
										echo '<tr><th colspan="4" class="text-center">There are currently no packages available at the moment. Please contact support to add a a package or want more information about that.</tr>';
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- #END# Hover Rows -->
		</div>
	</section>
	<style type="text/css">
	.table-hover > tbody > tr:hover {
		background-color: #4caf4f24;
	}
	</style>
<?php
}
?>