<?php
    get_header();
    // STARTS - wrapp your content with this conditional statement
if ( post_password_required() ) :

    // if your post is password protected with our Pro version, show our password form instead
    echo get_the_password_form();

/* display the password protected content if the correct password is entered */ 
else :
    get_template_part('pagebuilder');
endif;

    get_footer();