<!DOCTYPE html>
<html <?php language_attributes();?>>
    <head>
        <meta charset="<?php bloginfo('charset');?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">

        <?php wp_head();?>
    </head>
    <body>
    <header role="banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo">
                    <?php if (has_custom_logo()): ?>
                        <?php
                            // Get Custom Logo URL
                            $custom_logo_id = get_theme_mod('custom_logo');
                            $custom_logo_data = wp_get_attachment_image_src($custom_logo_id, 'full');
                            $custom_logo_url = $custom_logo_data[0];
                        ?>
                        
                            <a href="<?php echo esc_url(home_url('/')); ?>"
                            title="<?php echo esc_attr(get_bloginfo('name')); ?>"
                            rel="home">
                                <img src="<?php echo esc_url($custom_logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="custom-logo"/>
                            </a>

                        <?php else: ?>
                            <div class="site-name"><?php bloginfo('name');?></div>
                        <?php endif;?>
                    </div>
                </div>
                <div class="col-sm-8">
                    <nav class="primary-navigation">
                    <?php
                        wp_nav_menu( array(
                            'theme_location'  => 'header',
                        ) );
                    ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>