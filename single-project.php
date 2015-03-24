<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
 get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
            <div class="hero">
                <img src="<?php the_field('hero_image'); ?>" alt="" />
            </div>
            
			<h1 class="entry-title"><?php the_title(); ?></h1>

			<div class="entry-content">
                
                <?php the_content(); ?>

				<?php wp_link_pages(array('before' => __('Pages: ','html5reset'), 'next_or_number' => 'number')); ?>
				
				<?php the_tags( __('Tags: ','html5reset'), ', ', ''); ?>

			</div>
						
		</article>

	<?php endwhile; endif; ?>

<?php post_navigation(); ?>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>