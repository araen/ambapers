
		<div id="second-content">
			<div id="block-4" class="wrap">
				<div class="news">
						<div class="col8b">
							<div id="latest-news">
								<span class="ribbon"><a href="#" class="blog">&nbsp;</a></span>
								<h6 class="news-title"><?php echo str_replace("-"," ",strtoupper($category))?></h6>
								<?php foreach($article['data']->result_array() as $row){?>
								<div class="post">
									<h2>
										<a href="<?php echo $this->config->item('base_url').'article/'.$row['permalink']?>" title="<?php echo $row['title']?>"><?php echo $row['title']?></a>
									</h2>
									<span class="date"><?php echo dateToIndo($row['created'])?></span>
									<div class="summary">
										<p><?php 
										echo $row['description']											
										?>...&nbsp;<b><i> <a href="<?php echo $this->config->item('base_url').'article/'.$row['permalink']?>" title="<?php echo $row['title']?>">Selengkapnya...</a></i></b></p>
									</div>
								</div>
								<?php } ?>
								<div class="pagination">
									<ul>
										<?php
										$total = $article['count']->num_rows();
										$totpage=0;
										if(($total%$limit) == 0)
											$totpage=$total/$limit;
										else
											$totpage=(int)($total/$limit) + 1;
										
										$loop = 1;
										if($page - 3 > 0)
											$loop = $page-3;
										?>
										<?php 
											echo '<li class="prev '.($page == 1?'disabled':'').'"><a href="'.($page == 1?'#':$this->config->item('base_url')."category/$category/".($page-1)).'"><< Previous</a></li>';
											for($i=0;$i<7;$i++){
												if($loop >= $totpage)
													break;
												echo '<li '.($page==$loop?'class="active"':'').'><a href="'.$this->config->item('base_url')."category/$category/".($loop).'">'.$loop.'</a></li>';
												$loop++;
											}
											echo '<li class="next '.($page == $totpage?'disabled':'').'"><a href="'.($page == $totpage?'#':$this->config->item('base_url')."category/$category/".($page+1)).'">Next >></a></li>';
										?>
									</ul>
								</div>								
							</div><!--! end of #latest-news -->
						</div> <!--! end of .col8b -->
					</div> <!--! end of #content -->
				</div> <!--! end of #block-4 -->
		</div> <!--! end of #second-content -->