<?php
/*
Template Name: Fullwidth Section
*/
?>
<?php get_header(); ?>
<div class="pagemid_section">	
	<?php if (have_posts()): ?>
		
		<?php while (have_posts()): the_post(); ?>
		<?php the_content(); ?> 
		<?php endwhile; ?>
		
	<?php endif; ?>
</div>
<!-- .pagemid -->
<?php get_footer(); ?>