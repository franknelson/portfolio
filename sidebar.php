<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
?>
 <aside id="sidebar">
    <?php
        $args = array( 'post_type' => 'project', );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
          echo '<div class="thumbnail">';
            the_post_thumbnail();
          echo '</div>';
        endwhile;
    ?>

    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')) : else : ?>

     
        <!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->
    
    		
	<?php endif; ?>

</aside>