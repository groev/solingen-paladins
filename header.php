<html>
    <head>
        <?php wp_head();?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Solingen Paladins - <?php the_title();?></title>
        <link rel="icon" href="<?php echo PALAURL.'/assets/images/favicon.png   ';?>" type="image/png">

      
    </head>
    <body>
        <div class="preheader">
            <img src="<?php the_field('header', 'option');?>" />
        </div>
        <header id="header" class="header">

            <div class="start">
                <a href="<?php echo site_url();?>"><img src="<?php the_field('theme_logo', 'option');?>" alt="Logo" class="logo" /></a>
               
                <?php wp_nav_menu( array('theme_location' => 'primary_menu'));?>
            </div>
            <?php $social = get_field('social_media','option');?>
            <div class="social">
            <?php if($social):foreach($social as $site):?>
                <a target="_blank" href="<?php echo $site['url'];?>"><img src="<?php echo $site['logo'];?>" alt="Logo" /></a>
            <?php endforeach;endif; ?>
            <button type="button" class="menu-toggle">
                    <img src="<?php echo PALAURL.'/assets/images/menu.svg';?>" alt="Menu" />
             </botton>
            </div>  
        </header>
        <main>