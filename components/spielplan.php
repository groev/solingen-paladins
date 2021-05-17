<?php 

    $news = get_posts(array(
        'post_type' => 'game',
        'posts_per_page' => -1,
        'meta_key' => 'datum',
        'orderby' => 'meta_value_num',
        'order' => "ASC"
    ));
?>

<div class="component-spielplan wrapped">
    <h2 class="divider">Nächste Spiele</h2>
    <div class="game-grid">
<?php if($news):foreach($news as $post):?>
    <div class="game">
        <img src="<?php echo get_field('logo', $post->ID );?>" alt="logo" />
        <div class="inner">
            <span class="date"><?php echo get_field('datum', $post->ID);?> - <?php echo get_field('uhrzeit', $post->ID);?></span>
            <h3><?php if(get_field('auswarts', $post->ID)) {echo '@ ';}  else {echo 'vs. ';}?><?php echo get_field('gegner', $post->ID);?></h3>
            <span class="stadium"><?php echo get_field('ort', $post->ID);?></span>
        </div>
</div>
<?php endforeach;endif;?>
</div>

</Div>
