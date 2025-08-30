<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Alfredo S. Mondino">
    <meta name="description" content="Alfredo S. Mondino">

    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo esc_url(get_template_directory_uri() . '/favicon/apple-icon-57x57.png'); ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo esc_url(get_template_directory_uri() . '/favicon/apple-icon-60x60.png'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url(get_template_directory_uri() . '/favicon/apple-icon-72x72.png'); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo esc_url(get_template_directory_uri() . '/favicon/apple-icon-76x76.png'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url(get_template_directory_uri() . '/favicon/apple-icon-114x114.png'); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo esc_url(get_template_directory_uri() . '/favicon/apple-icon-120x120.png'); ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url(get_template_directory_uri() . '/favicon/apple-icon-144x144.png'); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo esc_url(get_template_directory_uri() . '/favicon/apple-icon-152x152.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_template_directory_uri() . '/favicon/apple-icon-180x180.png'); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo esc_url(get_template_directory_uri() . '/favicon/android-icon-192x192.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url(get_template_directory_uri() . '/favicon/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo esc_url(get_template_directory_uri() . '/favicon/favicon-96x96.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url(get_template_directory_uri() . '/favicon/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?php echo esc_url(get_template_directory_uri() . '/favicon/manifest.json'); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo esc_url(get_template_directory_uri() . '/favicon/ms-icon-144x144.png'); ?>">
    <meta name="theme-color" content="#ffffff">
    <!-- FIN FAVICON -->

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <!-- BARRA SUPERIOR -->
    <div class="container-fluid px-5 d-none d-lg-block">
        <div class="row gx-5 py-3 align-items-center">
            <!-- Izquierda -->
            <div class="col-lg-3">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="bi bi-telephone fs-3 text-primary me-2"></i>
                    <h6 class="mb-0">
                        <a href="tel:+543583499144" class="text-reset text-decoration-none">+54 3583 49-9144</a>
                    </h6>
                </div>
            </div>
            <!-- Centro -->
            <div class="col-lg-6">
                <div class="d-flex align-items-center justify-content-center">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand ms-lg-5">
                        <div class="d-flex align-items-center">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/logo.png'); ?>" alt="<?php bloginfo('name'); ?>" style="height:60px" class="me-3">
                            <div class="text-center lh-sm">
                                <div class="fw-bold fs-4 text-dark"><?php bloginfo('name'); ?></div>
                                <div class="fw-bold text-dark">Hacienda - Cereales</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Derecha -->
            <div class="col-lg-3">
                <div class="d-flex align-items-center justify-content-end">
                    <i class="bi bi-envelope-at fs-3 text-primary me-2"></i>
                    <h6 class="mb-0">
                        <a href="mailto:asm@alfredosmondino.com.ar" class="text-reset text-decoration-none">
                            <span class="sup">asm@alfredosmondino.com.ar</span>
                        </a>
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN BARRA SUPERIOR -->

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5">
        <!-- Logo versión móvil -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand d-flex d-lg-none">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/img/logo-m.png'); ?>" alt="<?php bloginfo('name'); ?>">
        </a>

        <!-- Botón hamburguesa -->
        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'mondino'); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menú principal -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <?php
            wp_nav_menu([
                'theme_location' => 'menu-principal',
                'depth'          => 2, // dropdowns de un nivel
                'container'      => false,
                'menu_class'     => 'navbar-nav mx-auto py-0',
                'fallback_cb'    => '__return_false',
                'walker'         => new Bootstrap_5_WP_Nav_Menu_Walker(),
            ]);
            ?>
        </div>
    </nav>
    <!-- FIN NAVBAR -->