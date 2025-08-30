<?php defined('ABSPATH') || exit; ?>

<?php if ($posts->have_posts()) : ?>
    <?php while ($posts->have_posts()) : $posts->the_post(); ?>

        <?php
        // Restringir por permisos (igual que en tu template original)
        if (! su_current_user_can_read_post(get_the_ID())) {
            continue;
        }

        // Excluir cualquier entrada que esté en la categoría "remates"
        // (usa el slug; si tu slug fuera distinto, cámbialo aquí)
        if (has_category('remates', get_the_ID())) {
            continue;
        }
        ?>

        <div id="su-post-<?php the_ID(); ?>" class="col-lg-3">
            <div class="blog-item position-relative overflow-hidden">
                <img class="img-fluid" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" alt="" />
                <a class="blog-overlay" href="<?php the_permalink(); ?>">
                    <h4 class="text-white"><?php the_title(); ?></h4>

                    <?php
                    // Solo fecha de creación (formato y localización según Ajustes > Generales > Formato de fecha)
                    echo '<span class="text-white fw-bold">';
                    echo '<i class="fas fa-calendar-alt"></i> ' . esc_html(get_the_date());
                    echo '</span>';
                    ?>
                </a>
            </div>
        </div>

    <?php endwhile; ?>
<?php else : ?>
    <p class="su-posts-not-found"><?php esc_html_e('Posts not found', 'shortcodes-ultimate'); ?></p>
<?php endif; ?>