<div class="component-ansprechpartner wrapped">
    <h2 class="divider"><?php echo $block['headline'];?></h2>
    <div class="person-grid" style="grid-template-columns: repeat(<?php echo $block['spaltenzahl'];?>,1fr)">
    <?php $bilder = $block['personen'];
    if($bilder):foreach($bilder as $bild):?>
    <div class="person">
            <?php if($bild['bild']) {?>
                <div class="image" style="background-image:url(<?php echo $bild['bild'];?>)"></div>

<?php } else {?>
                <div class="image" style="background-image:url(<?php echo PALAURL.'/assets/images/person.png';?>)"></div>

                <?php }?>
    <div class="inner">
        <h3><?php echo $bild['name'];?></h3>
        <div class="position"><?php  echo $bild['position'];?></div>
        <div class="contact"><a href="mailto:<?php  echo $bild['email'];?>"><?php  echo $bild['email'];?></a></div>

</div>

    </div>

<?php endforeach;endif;?>
    </div>
</div>