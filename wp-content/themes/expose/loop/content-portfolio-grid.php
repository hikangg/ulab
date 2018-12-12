<div id="portfolio-<?php the_ID(); ?>" <?php post_class( 'works-item works-item-one-third zoom ' . ebor_the_terms('portfolio_category', ' ', 'slug') ); ?>>

    <?php the_post_thumbnail('grid', array( 'class' => 'img-responsive' )); ?>
    
    <!--<a class="venobox" data-gall="portfolio-gallery" href="images/works/01.jpg">-->
    <a href="<?php the_permalink(); ?>">
        <div class="works-item-inner valign">
        	<?php the_title('<h3 class="dark">', '</h3><p class="dark"><span class="dark">'. ebor_the_terms('portfolio_category', ', ', 'name') .'</span></p>'); ?>
        </div>
    </a>
    
</div>