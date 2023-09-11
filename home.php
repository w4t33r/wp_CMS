<?php get_header(); ?>
<div class="page-banner-area-4 page-contact" id="page-banner">
    <div class="overlay dark-overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
                <div class="banner-content content-padding">
                    <h1 class="text-white">GYM Post</h1>
                    <p>- Latest GYM Topics -</p>
                </div>
            </div>
        </div>
    </div>
</div>


<section class="section blog-wrap ">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <?php if (have_posts()) : while (have_posts()) :
                        the_post(); ?>
                        <div class="col-lg-6">
                            <div class="blog-post">
                                <?php
                                if( has_post_thumbnail() ) {
                                    the_post_thumbnail('medium', array('class' => "img-fluid"));
                                }
                                else {
                                    echo '<img class="img-fluid" src="'.get_template_directory_uri().'/wp-content/themes/barb_group7/images/blog/blog-3.jpg" />';
                                }
                                ?>
                                <img src="images/blog/blog-1.jpg" alt="" class="img-fluid">
                                <div class="mt-4 mb-3 d-flex">
                                    <div class="post-author mr-3">
                                        <i class="fa fa-user"></i>
                                        <span class="h6 text-uppercase"><?php the_author(); ?></span>
                                    </div>

                                    <div class="post-info">
                                        <i class="fa fa-calendar-check"></i>
                                        <span><?php the_date(); ?></span>
                                    </div>
                                </div>
                                <a href="blog-single.html" class="h4 "><?php the_title(); ?></a>
                                <p class="mt-3"><?php the_excerpt(); ?></p>
                                <a href="<?php echo get_the_permalink(); ?>" class="read-more">Read Article <i
                                            class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    <?php endwhile; else: ?>
                        No Articles.
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>
