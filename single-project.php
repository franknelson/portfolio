<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
 get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h1 class="entry-title"><?php the_title(); ?></h1>
            
            <?php $heroImg = get_field('hero_image');
                if  ( $heroImg ) {
                    echo "<div class='hero'>";
                    echo '<img src="';
                    echo the_field('hero_image');
                    echo ' " alt="hero image"  /> ';
                    echo "</div>"; 
                }else{
                    echo "<div class='open'></div>";  
                }
            ?>
            
                        
            <?php $projectLink = get_field('project_link');
                if  ( $projectLink ) {
                    echo "<div class='project_link'>";
                    echo '<a href ="';
                    echo the_field('project_link');
                    echo ' ">Project Link ';
                    echo "</a></div>";
                }
            ?>
            
                
                
			<div class="entry-content">
                
                <?php the_content(); ?>

			</div>
            
            <div class="article-info">
                <ul>
                    <li><?php the_tags( __('Tags: ','html5reset'), ', ', ''); ?></li>
                    <li><?php posted_on(); ?></li>
                </ul>
            </div>
						
		</article>

	<?php endwhile; endif; ?>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>