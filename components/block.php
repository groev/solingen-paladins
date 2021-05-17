<div class="component-block theme-<?php echo $block['farbe'];?> <?php echo $block['ausrichtung'];?>">
<div class="image-holder" style="background-image:url(<?php echo $block['bild'];?>)")>
</div>
    <div class="content">
            <h3 class="headline"><?php echo $block['headline'];?></h3>
            <div><?php echo $block['text'];?></div>

            <?php if($block['cta']) {?>
            <a target="<?php echo $block['cta']['target'];?>" href="<?php echo $block['cta']['url'];?>" class="cta"><?php echo $block['cta']['title'];?></a>
            <?php } ?>

        </div>
</div>