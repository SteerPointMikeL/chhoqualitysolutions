<?php if ($wp_query->max_num_pages > 1) { ?>
			<div class="navigation">
<?php if ( function_exists('spm_pagination') ) { spm_pagination(); } else { ?>
				<div class="alignleft"><?php next_posts_link( __('Next <i class="icon-arrow_right"></i>', SP_TEXT_DOMAIN) ) ?></div>

				<div class="alignright"><?php previous_posts_link( __('Back <i class="icon-arrow_left"></i>', SP_TEXT_DOMAIN) ) ?></div>
<?php } ?>
			</div>
<?php } ?>
