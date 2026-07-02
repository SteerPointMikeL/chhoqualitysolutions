<?php /* Template Name: Has Page Sections */ ?>

<?php get_header(); ?>

<?php get_template_part('template-parts/hero'); ?>

<?php spm_load_acf_page_sections( get_field('page_sections') ); ?>

<?php get_footer(); ?>