<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 */
 
 global $data; //get theme options
?>

<?php
//get custom post type === > Slides
$args = array(
	'post_type' =>'slides',
	'numberposts' => -1,
	'order' => 'ASC'
);
$slides = get_posts($args);
?>
<?php if($slides) { ?>
<div id="slider-wrap">
	<div class="full-slides flexslider clearfix">
		<ul class="slides">
            <?php
            foreach($slides as $post) : setup_postdata($post);
			
			//image
            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider');
			$featured_video = get_post_meta($post->ID, 'adapt_slides_video', TRUE);
			//meta
            $slidelink = get_post_meta($post->ID, 'adapt_slides_url', TRUE);
			$slide_description = get_post_meta($post->ID, 'adapt_slides_description', TRUE);
            ?>
            	<?php if (has_post_thumbnail() || !empty($featured_video)) { ?>
            	<li class="slide">
                <?php if(!empty($slidelink)&&!empty($featured_image)) { ?>
                    <a href="<?php echo $slidelink ?>" title="<?php the_title(); ?>"><img src="<?php echo $featured_image[0]; ?>" /></a>
                <?php } else if(!empty($featured_video)){?>
                    <?php echo $featured_video;
                    }else { ?> 
                	<img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" />
                <?php } ?>
                <?php if(!empty($slide_description)) { ?>
				<div class="caption">
                    <?php if(!empty($slide_description)) { echo '<p> '. $slide_description .'</p>'; } ?>
				</div>
                <!-- /caption -->
                <?php } ?>
			</li><!--/slide -->
            <?php } ?>
            <?php endforeach; wp_reset_postdata(); ?>
		</ul><!-- /slides -->
    </div><!--/full-slides -->
</div>
<!-- /slider-wrap -->
<?php } ?>
