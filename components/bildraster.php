<div class="component-bildraster wrapped">
    <h2 class="divider"><?php echo $block['headline'];?></h2>
    <div class="grid" style="grid-template-columns: repeat(<?php echo $block['spaltenzahl'];?>,1fr)">
    <?php $bilder = $block['bilder'];
    if($bilder):foreach($bilder as $bild):?>
        <a href="<?php echo $bild['link']['url'];?>" target="_blank">
            <img src="<?php echo $bild['bild'];?>" alt="Bild" />
        </a>
    <?php endforeach;endif;?>
    </div>
</div>