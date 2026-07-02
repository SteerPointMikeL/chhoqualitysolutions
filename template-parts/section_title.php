<?php

global $h1_already_used;

extract($args);

$heading_tag = !$h1_already_used ? 'h1' : 'p';

if ( !empty($pre_title) ) { ?>
		<p class="pre_title"><?php echo $pre_title; ?></p>
<?php } ?>
		
<?php
if ( !empty($title) ) {
	$h1_already_used = true;
?>
		<<?php echo $heading_tag; ?> class="section_title"><?php echo $title; ?></<?php echo $heading_tag; ?>>
<?php } ?>
