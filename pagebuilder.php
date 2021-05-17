<?php 
    $content = get_field('content');
    if($content):foreach($content as $block):
        $file = PALAPATH.'/components/'.$block['acf_fc_layout'].'.php';
        if(file_exists($file)) {
            include $file;
        } else {
            if(current_user_can('manage_options')) {
                echo $file;
                echo 'ERROR: Component undefined.';
            }
    
        }

    endforeach;endif;
