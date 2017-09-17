		<div class="listberita page">
            <h2 class="page-title"><?php echo str_replace("-"," ",strtoupper($category))?></h2>
            <div class="content">
                <div id="latest-news">
                    <?php foreach($article['data']->result_array() as $row){?>
                    <div class="post-summary">
                    	<h3>
                        	<a href="<?php echo $this->config->item('base_url').$this->config->item('article_link').$row['permalink']?>" title="<?php echo $row['title']?>"><?php echo $row['title']?></a>
						</h3>
                        <span><?php echo dateToIndo($row['created'])?></span>
                        <div class="summary">
                        	<p>
								<?php 
									//echo $row['introcontent'];
                                    if($row['introcontent'] == '' || $row['introcontent'] == '0'){
                                        echo $row['content'];
                                    }else{
                                        echo $row['introcontent'];
                                        echo "...<span class=\"klikmore\"><a href=\"{$this->config->item('base_url')}{$this->config->item('article_link')}{$row['permalink']}\" title=\"{$row['title']}\" >Selengkapnya</a></span></p>";
                                    }
								?>
						</div>
					</div><?php } ?>	
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
								if($page == 1)
									echo '<li>Previous</li>';
								else
									echo '<li><a href="'.($page == 1?'#':$this->config->item('base_url')."category/$category/".($page-1)).'">Previous</a></li>';
                                for($i=0;$i<7;$i++){
                                    if($loop > $totpage)
                                        break;
									
									if($page==$loop)
										echo '<li>'.$loop.'</li>';
                                    else
										echo '<li><a href="'.$this->config->item('base_url')."category/$category/".($loop).'">'.$loop.'</a></li>';
									$loop++;
                                }
								if($page == $totpage)
									echo '<li>Next</li>';
								else
									echo '<li><a href="'.($page == $totpage?'#':$this->config->item('base_url')."category/$category/".($page+1)).'">Next</a></li>';
							?>
                        </ul>
                    </div>						
				</div>
            </div>
        </div>
        
		<div id="second-content">
			<div id="block-4" class="wrap">
				<div class="news">
						<div class="col8b">
							<div id="latest-news">
								
															
							</div><!--! end of #latest-news -->
						</div> <!--! end of .col8b -->
					</div> <!--! end of #content -->
				</div> <!--! end of #block-4 -->
		</div> <!--! end of #second-content -->