<section class="component-slider ">
    <div class="wrapped">
    <div class="news-slider">
    <?php $query = new WP_Query( 'posts_per_page=5' ); ?>
    <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

        <a class="slide" href="<?php the_permalink( );?>" aria-label="<?php the_title();?>">
            <div class="thumbnail">
                      <?php the_post_thumbnail('full');?>
                <div  class="content">
                    <h3 class=""><?php the_title();?></h3>
                    <div><?php the_excerpt(); ?></div>
                </div>
            </div>
        </a>
        <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
    <div class="sidebar">
        <div class="sidebar-inner">
            <div class="sidebar-header">
                <div class="item">
                    Weitere News
                </div>
            </div>
    <?php $query = new WP_Query( 'posts_per_page=5;offset=5' ); ?>
    <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
    <a class="post" href="<?php the_permalink( );?>" aria-label="<?php the_title();?>">
        <img src="<?php echo get_template_directory_uri( ).'/assets/images/news.svg';?>" alt="news" />
        <?php the_title();?>
    </a>
<?php endwhile; wp_reset_postdata(); endif; ?>
        <a class="more" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Mehr anzeigen</a>
    </div>
</div>
</div>
</section>
