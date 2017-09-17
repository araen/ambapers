		<div class="respond page">
            <h2 class="page-title">Kontak</h2>
            <div class="content">
                <div class="pingbox">
            	<div style="background-color:#CDCDCD; width:auto; height:65px; border:1px dotted #FFF;">
                    <img src="templates/default/img/chat-info.png" />
                    <a href="<?php echo base_url()?>chat/operasional" style="float:right;" class="chat"><img src="templates/default/img/chat-operasional.png" /></a>
                    <!--<a href="<?php echo base_url()?>chat/keuangan" style="float:right;" class="chat"><img src="templates/default/img/chat-keuangan.png" /></a>-->
                </div><!---end of kontainer chat--->
                </div>
                <div class="send-mail">
                    <p>
                    Atau Anda bisa mengirimkan pertanyaan Anda melalui form di bawah ini :
                    </p>
                    <form id="contactform" method="post" action="">
                        <div id="comment-user-details">
                            <p class="contact-form-author">
                                <label for="author">Name</label> <span class="required">*</span> 
                                <br />
                                <input type="text" aria-required="true" size="30" value="" name="author_name" id="author" class="validate[required]">
                            </p>
                            <p class="contact-form-email">
                                <label for="email">Email</label> <span class="required">*</span>
                                <br />
                                <input type="text" aria-required="true" size="30" value="" name="author_email" id="email" class="validate[required,custom[email]]">
                            </p>
                            <p class="contact-form-subject">
                                <label for="subject">Subject</label> <span class="required">*</span>
                                <br />
                                <input type="text" size="30" value="" name="author_subject" id="sucject" class="validate[required]">
                            </p>
                        </div>
                        <div id="contact-message">
                            <p class="contact-form-contact">
                                <label for="message">Message</label> <span class="required">*</span>
                                <br />
                                <textarea aria-required="true" rows="9" cols="40" name="message" id="message" class="validate[required]"></textarea>
                            </p>
                            <p class="form-submit">
                                <input type="submit" value="Send Message" id="submit" name="send_act">
                            </p>
                        </div>
                        <div class="clear"></div>
                    </form>
                </div>
            </div>
        </div><!-- #respond -->
        
	<script>
	$(document).ready(function(){
		$("#contactform").validationEngine();
		$(".chat").popupWindow({
			centerBrowser:1,
			width:575,
			height:450,
			resizable:0,
			scrollbars:0,
			windowName:"<?php echo $this->config->item('site_title')?>"
		});
	});
	</script>