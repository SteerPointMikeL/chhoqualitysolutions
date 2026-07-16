				<div id="comments">
<?php if ( post_password_required() ) { ?>
					<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', SP_TEXT_DOMAIN ); ?></p>
				</div>
<?php return; } ?>
					
<?php if ( have_comments() ) { ?>
					<h3 id="comments-title"><?php
					printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), SP_TEXT_DOMAIN ),
					number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
					?></h3>
					
					<ul class="commentlist">
						<?php wp_list_comments(); ?>
					</ul>
					
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) )	{ ?>
					<div class="comment-navigation">
						<?php paginate_comments_links( array('prev_text' => '&laquo;', 'next_text' => '&raquo;', 'type' => 'list') ); ?>
					</div>
<?php } ?>
					
<?php } else { ?>
					
<?php if ( !comments_open() ) { ?>
					<p class="nocomments"><?php _e( 'Comments are closed.', SP_TEXT_DOMAIN ); ?></p>
					
<?php } ?>
			
<?php } ?>
					
<?php comment_form(); ?>
					
				</div>
