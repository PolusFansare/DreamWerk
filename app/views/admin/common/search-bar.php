	<!-- Overlay For Sidebars -->
	<div class="overlay"></div>
	<!-- #END# Overlay For Sidebars -->
	<!-- Search Bar -->
	<div class="search-bar">
		<div class="search-icon">
			<i class="material-icons">search</i>
		</div>
		<form method="POST" action="<?= base_url('user/userlist');?>">
			<input type="text" name="username" placeholder="START TYPING..." value="<?= $this->input->post('username')?>">
		</form>
		<div class="close-search">
			<i class="material-icons">close</i>
		</div>
	</div>
	<!-- #END# Search Bar -->