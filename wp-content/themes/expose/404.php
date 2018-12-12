<?php 
       get_header(); 
       
       ebor_page_header( __('404 Error','expose'), get_option('blog_header_background','Our Journal'), 'fullheight' );
?>

<div class="container-fluid  offwhite-bg">
       <div class="container">
               <div class="row add-top add-bottom">
                       <article class="col-md-10 col-md-offset-1 text-center">
                               <h1 class="super-heading grey font2"><span><?php _e('The page is not found.','expose'); ?></span></h1>
                       </article>
               </div>
       </div>
</div>

<?php get_footer();

