<?php get_header(); ?>
<!--<div class="page-banner-area page-contact" id="page-banner">
    <div class="overlay dark-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="banner-content content-padding">
                    <h1 class="text-white"><?php the_title(); ?></h1>
                    <p>nb</p>
                </div>
            </div>
        </div>
    </div>
</div> -->
<section class="section blog-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        while (have_posts()) :
                            the_post();

                            get_template_part('template-parts/content', get_post_type());

                            the_post_navigation(
                                array(
                                    'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'gym') . '</span> <span class="nav-title">%title</span>',
                                    'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'gym') . '</span> <span class="nav-title">%title</span>',
                                )
                            );

                            // If comments are open or we have at least one comment, load up the comment template.
                            if (comments_open() || get_comments_number()) :
                                comments_template();
                            endif;

                        endwhile; // End of the loop.
                        ?>

                    </div>
                </div>
            </div>
            <!-- Asside <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sidebar-widget search">
                            <div class="form-group">
                                <input type="text" placeholder="поиск" class="form-control">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="sidebar-widget about-bar">
                            <h5 class="mb-3">О нас</h5>
                            <p>Мы — маркетинговое агентство полного цикла, которое оказывает диджитал услуги стартапам и
                                крупным компаниям</p>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="sidebar-widget category">
                            <h5 class="mb-3">Рубрики</h5>
                            <ul class="list-styled">
                                <li>Маркетинг</li>
                                <li>Диджитал</li>
                                <li>SEO</li>
                                <li>Веб-дизайн</li>
                                <li>Разработка</li>
                                <li>Видео</li>
                                <li>Подкаст</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="sidebar-widget tag">
                            <a href="#">web</a>
                            <a href="#">development</a>
                            <a href="#">seo</a>
                            <a href="#">marketing</a>
                            <a href="#">branding</a>
                            <a href="#">web deisgn</a>
                            <a href="#">Tutorial</a>
                            <a href="#">Tips</a>
                            <a href="#">Design trend</a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="sidebar-widget download">
                            <h5 class="mb-4">Полезные файлы</h5>
                            <a href="#"> <i class="fa fa-file-pdf"></i>Презентация Promodise</a>
                            <a href="#"> <i class="fa fa-file-pdf"></i>10 источников бесплатного SEO</a>
                        </div>
                    </div>

                </div>
            </div> -->
        </div>
    </div>
    </div>
</section>
<?php get_footer(); ?>
