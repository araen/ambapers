<?php
$responseStatus = $result['responseStatus'];
$results = isset($result['responseData']['results'])?$result['responseData']['results']:array();
$pages = isset($result['responseData']['cursor']['pages'])?$result['responseData']['cursor']['pages']:array();
$currentPageIndex = isset($result['responseData']['cursor']['currentPageIndex'])?$result['responseData']['cursor']['currentPageIndex']:-1;
?>
		<div id="second-content">
			<div id="block-4" class="wrap">
				<div class="news">
						<div class="col8b">
							<div id="latest-news">
								<?php foreach($results as $row){?>
								<div class="post">
									<h2>
										<a href="<?php echo $row['url']?>"><?php echo $row['title']?></a>
									</h2>
									<div class="summary">
										<p><?php 
										echo $row['content']											
										?></p>
									</div>
								</div>
								<?php } ?>
								<div class="pagination">
									<ul>
										<?php 											
											foreach($pages as $key=>$value){
												if($key == $currentPageIndex)
													echo "<li>$value[label]</li>";
												else
													echo "<li><a href=\"".base_url()."search?start=$value[start]&q=".urlencode($q)." \">$value[label]</a></li>";
											}
										?>
									</ul>
								</div>								
							</div><!--! end of #latest-news -->
						</div> <!--! end of .col8b -->
					</div> <!--! end of #content -->
				</div> <!--! end of #block-4 -->
		</div> <!--! end of #second-content -->