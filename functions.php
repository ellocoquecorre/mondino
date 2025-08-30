<?php
// Evita acceso directo
if (! defined('ABSPATH')) exit;

/**
 * Soportes del tema + registro de menús
 */
function mondino_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('align-wide'); // bloques Ancho amplio / Ancho completo

    // Registrar ubicación de menú
    register_nav_menus([
        'menu-principal' => __('Menú Principal', 'mondino'),
    ]);

    // Si más adelante necesitás traducciones:
    // load_theme_textdomain('mondino', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'mondino_setup');

/**
 * Versión por filemtime para assets locales (cache busting)
 */
function mondino_asset_ver($rel_path)
{
    $file = get_template_directory() . $rel_path;
    return file_exists($file) ? filemtime($file) : null; // null => deja que WP gestione
}

/**
 * Enqueue de estilos y scripts
 */
function mondino_enqueue_assets()
{
    /* =========  CSS  ========= */
    wp_enqueue_style(
        'mondino-google-fonts',
        'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'mondino-bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css',
        [],
        null
    );

    wp_enqueue_style(
        'mondino-owlcarousel',
        get_template_directory_uri() . '/lib/owlcarousel/assets/owl.carousel.min.css',
        [],
        mondino_asset_ver('/lib/owlcarousel/assets/owl.carousel.min.css')
    );

    // CSS local Bootstrap 5.0.0 (coincide con el bundle del CDN)
    wp_enqueue_style(
        'mondino-bootstrap',
        get_template_directory_uri() . '/css/bootstrap.min.css',
        [],
        mondino_asset_ver('/css/bootstrap.min.css')
    );

    wp_enqueue_style(
        'mondino-style',
        get_template_directory_uri() . '/css/style.css',
        ['mondino-bootstrap'],
        mondino_asset_ver('/css/style.css')
    );

    /* =========  JS  ========= */
    // jQuery para plugins que lo requieren (owl, waypoints, counterup, easing)
    wp_enqueue_script('jquery');

    wp_enqueue_script(
        'mondino-fontawesome',
        'https://kit.fontawesome.com/daae4e8876.js',
        [],
        null,
        true
    );

    // Bootstrap 5 bundle (NO depende de jQuery)
    wp_enqueue_script(
        'mondino-bootstrap-bundle',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js',
        [],
        null,
        true
    );

    wp_enqueue_script(
        'mondino-easing',
        get_template_directory_uri() . '/lib/easing/easing.min.js',
        ['jquery'],
        mondino_asset_ver('/lib/easing/easing.min.js'),
        true
    );

    wp_enqueue_script(
        'mondino-waypoints',
        get_template_directory_uri() . '/lib/waypoints/waypoints.min.js',
        ['jquery'],
        mondino_asset_ver('/lib/waypoints/waypoints.min.js'),
        true
    );

    wp_enqueue_script(
        'mondino-counterup',
        get_template_directory_uri() . '/lib/counterup/counterup.min.js',
        ['jquery', 'mondino-waypoints'],
        mondino_asset_ver('/lib/counterup/counterup.min.js'),
        true
    );

    wp_enqueue_script(
        'mondino-owlcarousel',
        get_template_directory_uri() . '/lib/owlcarousel/owl.carousel.min.js',
        ['jquery'],
        mondino_asset_ver('/lib/owlcarousel/owl.carousel.min.js'),
        true
    );

    // main.js depende del bundle de Bootstrap para tener la API disponible
    wp_enqueue_script(
        'mondino-main',
        get_template_directory_uri() . '/js/main.js',
        ['jquery', 'mondino-owlcarousel', 'mondino-easing', 'mondino-bootstrap-bundle'],
        mondino_asset_ver('/js/main.js'),
        true
    );

    // (Opcional, WP >= 6.3) estrategia de carga:
    // wp_script_add_data('mondino-bootstrap-bundle', 'strategy', 'defer');
    // wp_script_add_data('mondino-main', 'strategy', 'defer');
}
add_action('wp_enqueue_scripts', 'mondino_enqueue_assets');

/* =======================================================
 * SHORTCODES - Utilidades sanitizadas
 * ======================================================= */
function mondino_img($rel_path, $alt = '', $classes = 'w-100')
{
    $src = esc_url(get_template_directory_uri() . $rel_path);
    $alt = esc_attr($alt);
    $classes = esc_attr($classes);
    return '<img class="' . $classes . '" src="' . $src . '" alt="' . $alt . '">';
}
function mondino_btn($path, $classes, $label)
{
    $url = esc_url(home_url($path));
    $label = esc_html($label);
    $classes = esc_attr($classes);
    return '<a href="' . $url . '" class="' . $classes . '">' . $label . '</a>';
}

/* ======= IMÁGENES ======= */
add_shortcode('carousel_vacas', function () {
    return mondino_img('/img/carousel-vacas.jpg', 'Remates y Hacienda');
});
add_shortcode('carousel_cereales', function () {
    return mondino_img('/img/carousel-cereales.jpg', 'Cereales');
});
add_shortcode('carousel_inmobiliaria', function () {
    return mondino_img('/img/carousel-inmobiliaria.jpg', 'Inmobiliaria Rural');
});
add_shortcode('carousel_transporte', function () {
    return mondino_img('/img/carousel-transporte.jpg', 'Transporte y Logística');
});
add_shortcode('index_quienes', function () {
    return mondino_img('/img/index-quienes.jpg', 'Quiénes somos', 'img-fluid mt-auto mx-auto');
});
add_shortcode('index_hacienda', function () {
    return mondino_img('/img/index-hacienda.png', 'Hacienda', 'img-fluid mb-3');
});
add_shortcode('index_cereales', function () {
    return mondino_img('/img/index-cereales.png', 'Cereales', 'img-fluid mb-3');
});
add_shortcode('index_inmobiliaria', function () {
    return mondino_img('/img/index-inmobiliaria.png', 'Inmobiliaria', 'img-fluid mb-3');
});
add_shortcode('index_transporte', function () {
    return mondino_img('/img/index-transporte.png', 'Transporte', 'img-fluid mb-3');
});

/* ======= BOTONES ======= */
add_shortcode('boton_conozcanos',   function () {
    return mondino_btn('/conozcanos/',             'btn btn-primary py-md-2 px-md-3',           'Ver más');
});
add_shortcode('boton_hacienda',     function () {
    return mondino_btn('/remates-y-hacienda/',     'btn btn-primary custom-btn mt-auto mx-auto', 'Ver más');
});
add_shortcode('boton_cereales',     function () {
    return mondino_btn('/cereales/',               'btn btn-primary custom-btn mt-auto mx-auto', 'Ver más');
});
add_shortcode('boton_inmobiliaria', function () {
    return mondino_btn('/inmobiliaria-rural/',     'btn btn-primary custom-btn mt-auto mx-auto', 'Ver más');
});
add_shortcode('boton_transporte',   function () {
    return mondino_btn('/transporte-y-logistica/', 'btn btn-primary custom-btn mt-auto mx-auto', 'Ver más');
});
add_shortcode('boton_noticias',     function () {
    return mondino_btn('/noticias/',               'btn btn-primary custom-btn mt-auto mx-auto', 'Ver más');
});

/* ======= Walker Bootstrap 5 ======= */
add_action('after_setup_theme', function () {
    $walker_file = get_template_directory() . '/inc/bootstrap5-walker.php';
    if (file_exists($walker_file)) {
        require_once $walker_file;
    } else {
        // Aviso opcional en admin para no romper el sitio si falta el archivo
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p><strong>Mondino:</strong> falta <code>/inc/bootstrap5-walker.php</code>. Verificá el archivo del walker.</p></div>';
        });
    }
});

/* ====== Forzar clases Bootstrap al menú (por si falta el walker) ====== */
// <li> clases
add_filter('nav_menu_css_class', function ($classes, $item, $args, $depth) {
    if (isset($args->theme_location) && $args->theme_location === 'menu-principal') {
        $classes[] = 'nav-item';
        if (in_array('menu-item-has-children', $classes, true) && $depth === 0) {
            $classes[] = 'dropdown';
        }
    }
    return $classes;
}, 10, 4);

// <a> atributos base (dropdown y toggle en nivel 0 con hijos)
add_filter('nav_menu_link_attributes', function ($atts, $item, $args, $depth) {
    if (isset($args->theme_location) && $args->theme_location === 'menu-principal') {
        $atts['class'] = ($depth > 0) ? 'dropdown-item' : 'nav-link';
        // Si tiene hijos en el nivel 0, que actúe como toggle (BS5)
        if (in_array('menu-item-has-children', (array)$item->classes, true) && $depth === 0) {
            $atts['class'] .= ' dropdown-toggle';
            $atts['data-bs-toggle'] = 'dropdown';
            $atts['data-bs-auto-close'] = 'outside';
            $atts['aria-expanded'] = 'false';
            $atts['role'] = 'button';
            // Padre NO navega:
            $atts['href'] = '#';
        }
    }
    return $atts;
}, 10, 4);

// <a> marcar 'active' cuando corresponda (se aplica luego del filtro anterior)
add_filter('nav_menu_link_attributes', function ($atts, $item, $args, $depth) {
    if (isset($args->theme_location) && $args->theme_location === 'menu-principal') {
        $classes_attr = isset($atts['class']) ? $atts['class'] : '';
        if (
            in_array('current-menu-item', (array)$item->classes, true) ||
            in_array('current-menu-ancestor', (array)$item->classes, true) ||
            in_array('current_page_item', (array)$item->classes, true) ||
            in_array('current_page_ancestor', (array)$item->classes, true)
        ) {
            $classes_attr .= ' active';
        }
        $atts['class'] = trim($classes_attr);
    }
    return $atts;
}, 20, 4);

// <ul> del submenú
add_filter('nav_menu_submenu_css_class', function ($classes, $args, $depth) {
    if (isset($args->theme_location) && $args->theme_location === 'menu-principal') {
        $classes = array_diff($classes, ['sub-menu']);
        $classes[] = 'dropdown-menu';
    }
    return $classes;
}, 10, 3);
