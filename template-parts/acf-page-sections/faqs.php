<?php

if ( empty($appearance_modifiers) ) $appearance_modifiers = array();
if ( empty($additional_css_classes) ) $additional_css_classes = '';

wp_enqueue_script( 'jquery-ui-accordion' );

$faqs_id = wp_unique_id('faqs_id-');

?>
<section class="layout_block faqs <?php echo esc_attr( implode( ' ', $appearance_modifiers ) ); ?> <?php echo esc_attr( $additional_css_classes ); ?>">
	<div class="wrap">
		<?php get_template_part( 'template-parts/section_title', null, array( 'pre_title' => $pre_title, 'title' => $title) ); ?>
		
<?php if ( !empty($intro_text) ) { ?>
		<div class="intro_text">
			<?php echo $intro_text; ?>	
		</div>
<?php } ?>
		
		<div id="<?php echo $faqs_id; ?>" class="accordion_container">
<?php foreach ( $faqs as $faq ) { ?>	
			<p class="ui-accordion-header question"><i class="icon-plus-circle"></i><i class="icon-minus-circle"></i> <?php echo $faq['question']; ?></p>
			
			<div class="ui-accordion-content">	
				<?php echo $faq['answer']; ?>
			</div>
<?php } ?>
		</div>
		
		<script>
		jQuery(document).ready(function($) {
			$('#<?php echo $faqs_id; ?>').accordion({
				//active: false,
				collapsible: true,
				heightStyle: 'content',
				// allow panels to be opened independently
				beforeActivate: function(event, ui) {
					event.preventDefault();
					
					// The accordion believes a panel is being opened
					if (ui.newHeader[0]) {
						var currHeader  = ui.newHeader;
						var currContent = currHeader.next('.ui-accordion-content');
					// The accordion believes a panel is being closed
					} else {
						var currHeader  = ui.oldHeader;
						var currContent = currHeader.next('.ui-accordion-content');
					}
					// Since we've changed the default behavior, this detects the actual status
					var isPanelSelected = currHeader.attr('aria-selected') == 'true';
					
					// Toggle the panel's header
					currHeader
						.toggleClass('ui-corner-all', isPanelSelected)
						.toggleClass('accordion-header-active ui-state-active ui-corner-top', !isPanelSelected)
						.attr('aria-selected', ((!isPanelSelected).toString()));
					
					// Toggle the panel's icon
					currHeader.children('.ui-icon')
						.toggleClass('ui-icon-triangle-1-e', isPanelSelected)
						.toggleClass('ui-icon-triangle-1-s', !isPanelSelected);
					
					// Toggle the panel's content
					currContent.toggleClass('accordion-content-active',!isPanelSelected)    
					if (isPanelSelected) { currContent.slideUp(); }  else { currContent.slideDown(); }
				}
			});
		});
		</script>
	</div>
</section>
