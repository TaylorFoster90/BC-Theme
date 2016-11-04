<?php

//	Template Name: Blog

?>
<?php get_header(); ?>
<?php echo do_shortcode('[page_banner title="Blog" background=""]'); ?>
<?php
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args = array(
  'post_type' => 'post',
  'posts_per_page' => 2,
  'paged' => $paged
);
// the query
$the_query = new WP_Query( $args ); ?>
<?php if ( $the_query->have_posts() ) : ?>
	<section class="post-loop section">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

					  <!-- the loop -->
					  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<div class="post-block">
					    	<h3 class="mbs h2"><a href="<?php echo get_the_permalink($post->ID); ?>" class="link-blend"><?php echo get_the_title($post->ID); ?></a></h3>
								<p><?php echo get_the_excerpt($post->ID); ?></p>
								<a href="<?php echo get_the_permalink($post->ID); ?>" class="btn mtxs btn-sm btn-color-1">Continue Reading &nbsp;<i class="fa fa-angle-double-right"></i></a>
							</div>
					  <?php endwhile; ?>
						<?php if ($the_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
              <nav class="pagination-links bottom">
  							<div class="newer">
  					      <?php echo get_previous_posts_link( '<i class="fa fa-angle-double-left" aria-hidden="true"></i> Newer' ); // display newer posts link ?>
  					    </div>
  					    <div class="older">
  					      <?php echo get_next_posts_link( 'Older <i class="fa fa-angle-double-right" aria-hidden="true"></i>', $the_query->max_num_pages ); // display older posts link ?>
  					    </div>
  					  </nav>
					<?php } ?>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
          <h3 class="h2">Contact Form</h3>
					<?php echo do_shortcode('[text-blocks id="sidebar-form-schema"]'); ?>
				</div>
			</div>
		</div>
	</section>


<?php wp_reset_postdata(); ?>

	<?php endif; ?>
<?php get_footer(); ?>
