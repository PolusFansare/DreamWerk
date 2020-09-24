<?php
if($followers)
	foreach ($followers as $key => $follower)
	{
		$follower_image		= $this->mysql->get_row('if_profile_image', array("if_user_id"=> $follower['if_from_user_id']));
		$follower_profile	= $this->mysql->get_row('if_user_details', array("if_user_id"=> $follower['if_from_user_id']));
?>
<div class="media profile-card p-3 border">
	<div class="media-left profile-body">
		<a href="javascript:void(0);" class="image-area">
			<img class="media-object p-0 m-0" src="/fashion_app_api/<?= $follower_image['if_image'];?>" style="width: 60px;height: 60px;border: 1px solid #ccc;border-radius: unset;">
		</a>
	</div>
	<div class="media-body">
		<h4 class="media-heading"><?= $follower_profile['if_full_name'];?> <small>(<?= $follower_profile['if_gender'];?>)</small></h4>
		<?= ($follower_profile['if_bio']) ? $follower_profile['if_bio'] : 'There is no bio abailable for this user';?>
	</div>
	<div class="media-right">
		<button type="button" class="btn btn-default waves-effect waves-red waves-float btn-xs shadow-sm remove-follow" data-userid="<?= $userid;?>" data-fromuserid="<?= $follower['if_from_user_id'];?>" data-datatype="Follower">
			<i class="material-icons">close</i>
		</button>
	</div>
</div>
<?php
	}
else
	echo '<h5 class="text-center">User doesn\'t have any followers yet...</h5>';
?>