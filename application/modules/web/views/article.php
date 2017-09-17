
		<div id="second-content">
			<div id="block-4" class="wrap">
				<div class="news">
						<div class="col8b">
							<div id="latest-news">
								<?php
								$id=0;
								$title='';
								$date='';
								$content='';
								$com='';
								$category='';
								$author='';
								$read=0;
								$permalink_share='';
								foreach($article['rows']->result_array() as $row){
									$id=$row['id'];
									$title=$row['title'];
									$date=$row['created'];
									$content=str_replace('<hr id="readmore">','',$row['content']);
									$com=$row['comment'];
									$category=$row['id_category'];
									$author=$row['created_by'];
									$read=$row['read'];
									$permalink_share=$row['permalink'];
								}
								?>
								<h2 class="news-title"><?php echo $title?></h2><span class="date"><?php echo dateToIndo($date)?>
								</span>
								
								<div id="entry" class="post">
									<!--<img src="img/post/01-big.jpg" alt="" />-->
									<?php echo $content?>
								</div>
								
								<?php
								$total = $article_comm->num_rows();
								
								?>
								<?php if($com == 'yes'){?>
								<div id="comments">
									<h2><?php echo $total?> Comments</h2> 
									<ol class="commentlist">
									<?php
									foreach($article_comm['rows']->result_array() as $row){
										if($row['is_spam'] == 'no'){
									?>
										<li class="comment">
											<div id="comment-<?php echo $row['id']?>" class="comment-single clearfix">
												<div class="gravatar">
													<img alt="" src="<?php echo $this->config->item('base_url')?>images/gravatar.png" class="avatar avatar-69 photo" height="69" width="69">
												</div>
												<div class="comment-info">
													<p class="author">
														<?php echo $row['author_name']?> &nbsp;•&nbsp; <span class="date"><?php echo dateToIndo($row['created'])?></span>
													</p>
													<p><?php echo $row['content']?></p>
												</div>
											</div>					
										</li>
									<?php }}?>	
									</ol>
									
									<div id="respond-wrap">
										<div id="respond">
											<h2 id="reply-title">Berikan Komentar Anda<small><a style="display:none;" href="http://demo.marketthemes.com/demo/roaming/2010/11/08/tripadvisor-slated-by-hoteliers-at-its-own-lunch/#respond" id="cancel-comment-reply-link" rel="nofollow">Cancel reply</a></small></h2>
											<form id="commentform" method="post" action="">
												<div id="comment-user-details">
													<p class="comment-form-author"><label for="author">Name</label> <span class="required">*</span><input type="text" aria-required="true" size="30" value="" name="data[author_name]" id="author"></p>
													<p class="comment-form-email"><label for="email">Email</label> <span class="required">*</span><input type="text" aria-required="true" size="30" value="" name="data[author_email]" id="email"></p>
													<p class="comment-form-url"><label for="url">Website</label><input type="text" size="30" value="" name="data[author_website]" id="url"></p>
												</div>
												<div id="comment-message">
													<p class="comment-form-comment">
														<label for="comment">Comment</label>
														<textarea aria-required="true" rows="8" cols="45" name="data[content]" id="comment"></textarea>
													</p>
													<p class="form-submit">
														<input type="submit" value="Submit Comment" id="submit" name="comment_act">
														<input type="hidden" id="comment_post_ID" value="<?php echo $id?>" name="data[id_article]">
														<input type="hidden" value="0" id="comment_parent" name="parent">
													</p>
												</div>
												<div class="clear"></div>
											</form>
										</div><!-- #respond -->
									</div>									
								</div>
								<?php } ?>
							</div>
						</div> <!--! end of .col8b -->
					</div> <!--! end of #content -->
				</div> <!--! end of #block-4 -->
		</div> <!--! end of #second-content -->