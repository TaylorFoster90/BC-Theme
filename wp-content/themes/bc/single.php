<?php

/*
* Default Single Page Template
*/

?>

<?php get_header(); ?>
<?php echo do_shortcode('[page_banner title="' . 'Blog' . '"]'); ?>
<section class="section">
	<div class="container">
		<div class="row">

			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<h2><?php echo get_the_title(); ?></h2>
				<?php
				if ( have_posts() ) :
					while (have_posts()) : the_post();
				  the_content();
				  endwhile;
				endif;
				?>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<h3 class="h2">Contact Us</h3>
				<?php echo do_shortcode('[text-blocks id="sidebar-form-schema"]');?>
			</div>

		</div>
	</div>
</section>
<?php get_footer(); ?>
