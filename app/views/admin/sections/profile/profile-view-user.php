							<ul> 
								<li>
									<span>Subscribers</span>
									<span class="followers_count"><?= number_format(count($followings));?></span>
								</li>
								<li style="background-color: #efefef">
									<span>Videos Collection</span>
									<span class="followings_count"><?= number_format(count($videos));?></span>
								</li>
								<li>
									<span>Total Videos Likes</span>
									<span class="friends_count"><?= number_format(count($vid_likes));?></span>
								</li>
								<li style="background-color: #efefef">
									<span>Total Videos Dis-Likes</span>
									<span class="friends_count"><?= number_format(count($vid_dislikes));?></span>
								</li>
								<li>
									<span>Wishlist Collection</span>
									<span class="friends_count"><?= number_format(count($vid_saved));?></span>
								</li>
								<li style="background-color: #efefef">
									<span>Total Viewers</span>
									<span><?= number_format(count($vid_views));?></span>
								</li>
							</ul>