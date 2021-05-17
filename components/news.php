<?php 

    $news = get_posts(array(
        'post_type' => 'post',
        'posts_per_page' => $block['anzahl']
    ));
?>

<div class="component-news wrapped">
    <h2 class="divider">Aktuelle Neuigkeiten</h2>
    <div class="news-grid">
<?php if($news):foreach($news as $post):?>
    <a href="<?php echo get_permalink($post->ID);?>" class="post">
        <div class="thumbnail-wrap">
            <?php echo get_the_post_thumbnail($post->id, 'medium' );?>
        </div>
        <div class="inner">
        <span class="date"><?php echo get_the_date('d.m.Y', $post->ID);?></span>
        <h3><?php echo $post->post_title;?></h3>
</div>
    </a>
<?php endforeach;endif;?>
</div>

</Div>