<?php
// Bootstrap 5 wp_nav_menu walker (padres de dropdown no navegan)
if (! class_exists('Bootstrap_5_WP_Nav_Menu_Walker')) :

    class Bootstrap_5_WP_Nav_Menu_Walker extends Walker_Nav_Menu
    {

        private $current_item;
        private $dropdown_menu_alignment_values = [
            'dropdown-menu-start',
            'dropdown-menu-end',
            'dropdown-menu-sm-start',
            'dropdown-menu-sm-end',
            'dropdown-menu-md-start',
            'dropdown-menu-md-end',
            'dropdown-menu-lg-start',
            'dropdown-menu-lg-end',
            'dropdown-menu-xl-start',
            'dropdown-menu-xl-end',
            'dropdown-menu-xxl-start',
            'dropdown-menu-xxl-end'
        ];

        /**
         * <ul> del submenú
         */
        public function start_lvl(&$output, $depth = 0, $args = null)
        {
            $dropdown_menu_class = [];
            if (isset($this->current_item->classes) && is_array($this->current_item->classes)) {
                foreach ($this->current_item->classes as $class) {
                    if (in_array($class, $this->dropdown_menu_alignment_values, true)) {
                        $dropdown_menu_class[] = $class;
                    }
                }
            }

            $indent  = str_repeat("\t", $depth);
            $submenu = ($depth > 0) ? ' sub-menu' : '';
            $classes = trim('dropdown-menu' . $submenu . ' depth_' . $depth . ' ' . implode(' ', $dropdown_menu_class));
            $output .= "\n$indent<ul class=\"" . esc_attr($classes) . "\">\n";
        }

        /**
         * <li> + <a>
         */
        public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
        {
            $this->current_item = $item;

            $indent  = ($depth) ? str_repeat("\t", $depth) : '';
            $classes = empty($item->classes) ? [] : (array) $item->classes;

            // ✅ WordPress expone has_children en $args->walker->has_children
            $has_children = (! empty($args) && isset($args->walker) && ! empty($args->walker->has_children));

            if ($has_children) {
                $classes[] = 'dropdown';
            }
            $classes[] = 'nav-item';
            $classes[] = 'nav-item-' . $item->ID;

            // NUNCA agregar 'dropdown-menu' al <li>; eso va en <ul> (start_lvl)

            // Permitir filtro estándar de WP
            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

            $item_id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
            $item_id = $item_id ? ' id="' . esc_attr($item_id) . '"' : '';

            $output .= $indent . '<li' . $item_id . $class_names . '>';

            // <a> attributes
            $atts           = [];
            $atts['title']  = ! empty($item->attr_title) ? $item->attr_title : '';
            $atts['target'] = ! empty($item->target) ? $item->target : '';
            if ('_blank' === $item->target && empty($item->xfn)) {
                $atts['rel'] = 'noopener noreferrer';
            } else {
                $atts['rel'] = ! empty($item->xfn) ? $item->xfn : '';
            }
            $atts['href'] = ! empty($item->url) ? $item->url : '';

            $active_class   = ($item->current || $item->current_item_ancestor || in_array('current_page_parent', $item->classes, true) || in_array('current-post-ancestor', $item->classes, true)) ? 'active' : '';
            $nav_link_class = ($depth > 0) ? 'dropdown-item ' : 'nav-link ';

            if ($has_children && 0 === $depth) {
                // Toggle correcto Bootstrap 5 + que NO navegue
                $atts['class']           = $nav_link_class . $active_class . ' dropdown-toggle';
                $atts['data-bs-toggle']  = 'dropdown';
                $atts['data-bs-auto-close'] = 'outside';
                $atts['aria-expanded']   = 'false';
                $atts['role']            = 'button';
                $atts['id']              = 'menu-item-dropdown-' . $item->ID;
                $atts['href']            = '#'; // <- padre no navega
            } else {
                $atts['class'] = $nav_link_class . $active_class;
            }

            // ✅ MUY IMPORTANTE: aplicar filtro para que functions.php pueda modificar atributos
            $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

            // Construir string de atributos
            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (! empty($value)) {
                    $value       = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output  = isset($args->before) ? $args->before : '';
            $item_output .= '<a' . $attributes . '>';
            $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
            $item_output .= '</a>';
            $item_output .= isset($args->after) ? $args->after : '';

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }
    }

endif;
