<?php
    get_header();?>

    <div class="post-archive-grid wrapped">
    <h1>News</h1>

<?php  get_template_part('loop');?>
     
</div>


<div class="pagination">
<?php    echo paginate_links(); ?>

</div>
<?php 

    get_footer();

