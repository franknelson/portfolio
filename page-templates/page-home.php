<?php
/*
 * Template Name: Home Page
 */
 get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<article class="home-page" id="post-<?php the_ID(); ?>">

			<div class="home-entry">

				<?php the_content(); ?>

            
			</div>
            <?php
                    $args = array( 'post_type' => 'project', );
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post();
                      echo '<div class="thumbnail">';
                        the_post_thumbnail();
                      echo '</div>';
                    endwhile;
                ?>
<!--
            <div class ="projects">
                <?php
                    $args = array( 'post_type' => 'project', );
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post();
                      echo '<div class="thumbnail">';
                        the_post_thumbnail();
                      echo '</div>';
                    endwhile;
                ?>
            </div>
-->

		</article>

		<?php endwhile; endif; ?>


<?php get_footer(); ?>
