<div class="component-sponsorenslider wrapped">
    <h2 class="divider">Sponsoren und Partner</h2>
    <div class="slider-inner" >
    <?php 
        $content = $block['bildquelle'];
        if($content) {
            foreach($content as $row) {
                $bilder = $row['bilder'];
                if($bilder):foreach($bilder as $bild):?>
                    <a href="<?php echo $bild['link'];?>" target="_blank">
                        <img src="<?php echo $bild['bild'];?>" alt="Bild" />
                    </a>
                <?php endforeach;endif;?>
           <?php  }
        } ?>
        </div>
</div>
