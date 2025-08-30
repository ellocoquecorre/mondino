<?php get_header(); ?>

<main id="main" class="site-main py-4">
    <div class="container">
        <?php if (have_posts()) : ?>

            <?php if (is_singular()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('mb-5'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <figure class="mb-3">
                                <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded']); ?>
                            </figure>
                        <?php endif; ?>

                        <h1 class="mb-3"><?php the_title(); ?></h1>

                        <div class="entry-content">
                            <?php
                            the_content();
                            // Paginación interna de páginas (<!--nextpage-->)
                            wp_link_pages([
                                'before' => '<nav class="page-links my-3">',
                                'after'  => '</nav>',
                            ]);
                            ?>
                        </div>
                    </article>

                    <?php
                    // Comentarios (si están habilitados)
                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }
                    ?>
                <?php endwhile; ?>

            <?php else : // Listado (home/blog, archivos, búsqueda, etc.) 
            ?>
                <div class="row g-4">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-md-6 col-lg-4">
                            <article <?php post_class('card h-100 shadow-sm'); ?>>

                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium_large', ['class' => 'card-img-top']); ?>
                                    </a>
                                <?php endif; ?>

                                <div class="card-body d-flex flex-column">
                                    <h2 class="h5 card-title">
                                        <a href="<?php the_permalink(); ?>" class="stretched-link text-decoration-none">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>

                                    <p class="card-text text-muted mb-3">
                                        <?php echo wp_kses_post(wp_trim_words(get_the_excerpt(), 22)); ?>
                                    </p>

                                    <div class="mt-auto small text-secondary">
                                        <?php echo esc_html(get_the_date()); ?>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; ?>
                </div>

                <nav class="mt-4">
                    <?php
                    the_posts_pagination([
                        'mid_size'  => 2,
                        'prev_text' => '&laquo;',
                        'next_text' => '&raquo;',
                    ]);
                    ?>
                </nav>
            <?php endif; ?>

        <?php else : ?>
            <div class="alert alert-info" role="alert">
                <?php esc_html_e('No hay contenido por ahora.', 'mondino'); ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>