<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
$options = get_option( 'adapt_theme_settings' );
?>
<?php get_header(); ?>

<div class="home-wrap clearfix">
    
    <!-- Homepage tagline -->
    <?php if(get_bloginfo('description')) { ?>
    <aside id="home-tagline">
    	<?php echo bloginfo('description'); ?>
    </aside>
    <!-- /home-tagline -->
    <?php } ?>
    
    <!-- /Homepage Slider -->
    <?php get_template_part( 'includes/slides' ); ?> 
    
    <!-- Homepage Highlights -->
    <?php
    //get post type ==> hp highlights
        global $post;
        $args = array(
            'post_type' =>'hp_highlights',
            'numberposts' => '-1'
        );
        $highlight_posts = get_posts($args);
    ?>
    <?php if($highlight_posts) { ?>        
    
    
    <section id="home-highlights" class="clearfix">
        <?php
        $count=0;
        foreach($highlight_posts as $post) : setup_postdata($post);
        $count++;
        //get img
        $feat_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full-size');
		//meta
		$highlights_url = get_post_meta($post->ID, 'adapt_highlights_url', TRUE);
        ?>
        
        <article class="hp-highlight <?php if($count == '4') { echo 'remove-margin'; } if($count == '3') { echo ' responsive-clear'; } ?>">
            <h2>
			<?php if($feat_img) { ?><span><img src="<?php echo $feat_img[0]; ?>" alt="<?php the_title(); ?>" /></span><?php } ?>
            <?php if($highlights_url) { ?>
            	<a href="<?php echo $highlights_url; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			<?php } else { the_title(); } ?>
            </h2>
            
            <?php the_excerpt(); ?>
        </article>
        <!-- /hp-highlight -->
        
        <?php
        if($count == '4') { echo '<div class="clear"></div>'; $count=0; }
        endforeach; ?>
    </section>
    <!-- /home-projects -->      	
    <?php } ?>
    
    
    <!-- Recent Portfolio Items -->
    <?php
    //get post type ==> portfolio
        global $post;
        $args = array(
            'post_type' =>'portfolio',
            'numberposts' => '4'
        );
        $portfolio_posts = get_posts($args);
    ?>
    <?php if($portfolio_posts) { ?>        
        <section id="home-projects" class="clearfix">
            <h2 class="heading"><span><?php if(!empty($options['recent_work_text'])) { echo $options['recent_work_text']; } else { _e('Recent Work','adapt'); }?></span></h2>
        
            <?php
            $count=0;
            foreach($portfolio_posts as $post) : setup_postdata($post);
            $count++;
            //get portfolio thumbnail
            $feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
            ?>
            
            <?php if ($feat_img) {  ?>
            <div class="portfolio-item <?php if($count == '4') { echo 'remove-margin'; } if($count == '3') { echo ' responsive-clear'; } ?>">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" />
                <div class="portfolio-overlay"><h3><?php echo the_title(); ?></h3></div><!-- portfolio-overlay -->
                </a>
            </div>
            <!-- /portfolio-item -->
            <?php } ?>
            
            <?php
            if($count == '4') { echo '<div class="clear"></div>'; $count=0; }
            endforeach; ?>
        </section>
        <!-- /home-projects -->      	
    <?php } ?>
    
    
    <!-- Recent Blog Posts -->
    <?php
    //get post type ==> regular posts
        global $post;
        $args = array(
            'post_type' =>'post',
            'numberposts' => '4'
        );
        $blog_posts = get_posts($args);
    ?>
    <?php if($blog_posts) { ?>        
        <section id="home-posts" class="clearfix">
            <h2 class="heading"><span><?php if(!empty($options['recent_work_text'])) { echo $options['recent_news_text']; } else { _e('Recent News','adapt'); }?></span></h2>
            <?php
            $count=0;
            foreach($blog_posts as $post) : setup_postdata($post);
            $count++;
            //get portfolio thumbnail
            $feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'grid-thumb');
            ?>
            
            
            <article class="home-entry <?php if($count == '4') { echo 'remove-margin'; } if($count == '3') { echo ' responsive-clear'; } ?>">
            	<?php if ($feat_img) {  ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $feat_img[0]; ?>" height="<?php echo $feat_img[2]; ?>" width="<?php echo $feat_img[1]; ?>" alt="<?php echo the_title(); ?>" /></a>
                <?php } ?>
                <div class="home-entry-description">
                    <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo the_title(); ?></a></h3>
                    <?php echo excerpt('15'); ?>
                </div> 
                <!-- /home-entry-description -->
            </article>
            <!-- /home-entry-->
            <?php
            if($count == '4') { echo '<div class="clear"></div>'; $count=0; }
            endforeach; ?>
        </section>
        <!-- /home-posts -->      	
    <?php } ?>

</div>
<!-- END home-wrap -->   
<?php get_footer(); ?>