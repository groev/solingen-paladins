<?php
    get_header();
    // STARTS - wrapp your content with this conditional statement
if ( post_password_required() ) :

   echo '<div class="component-text wrapped">';
 

    echo get_the_password_form();
echo '</div>';
/* display the password protected content if the correct password is entered */ 
else :
    get_template_part('pagebuilder');
endif;

    get_footer();