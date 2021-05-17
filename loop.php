<div class="loop-grid ">
<?php while ( have_posts() ) : the_post(); ?>
                 
<a href="<?php echo get_permalink($post->ID);?>" class="post">
        <div class="thumb-holder">
        <?php echo get_the_post_thumbnail($post->id, 'large' );?>
</div>
        <div class="inner">
        <span class="date"><?php echo get_the_date('d.m.Y', $post->ID);?></span>
        <h3><?php echo $post->post_title;?></h3>
</div>
    </a>
<?php endwhile; // end of the loop. ?>
</div>