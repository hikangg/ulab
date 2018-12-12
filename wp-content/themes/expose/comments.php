<section class="offwhite-bg">
	<div class="container">
		<div class="row add-top add-bottom">
			<article class="col-md-12">
				<section class="inner-section pricing-info">
					<section class="container">
						<div class="row">
							<article id="comments" class="col-md-10 col-md-offset-1">
			
								<ol id="singlecomments" class="commentlist">
									<?php wp_list_comments('type=comment&callback=ebor_custom_comment'); ?>
								</ol>
								
								<?php 
									paginate_comments_links();
									comment_form(array('comment_notes_after' => '')); 
								?>
			
							</article>
						</div>
					</section>
				</section>	
			</article>
		</div>
	</div>
</section>