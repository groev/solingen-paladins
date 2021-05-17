<?php get_header();?>
<div class="single-news">
 

<div class="wrapped">
<div class="hero" style="background-image:url(<?php echo get_the_post_thumbnail_url($post, 'large');?>
)"></div>
<div class="content">
    <span class="date"><?php echo get_the_date('d.m.Y');?></span>
    <h1><?php the_title();?></h1>
    <div class="text">
    <?php the_content();?>
</div>
</Div>
</div>
</div>

<?php get_footer();?>