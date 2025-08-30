<?php defined('ABSPATH') || exit; ?>

<?php if ($posts->have_posts()) : ?>
	<?php while ($posts->have_posts()) : ?>
		<?php $posts->the_post(); ?>

		<?php if (! su_current_user_can_read_post(get_the_ID())) : ?>
			<?php continue; ?>
		<?php endif; ?>
		<!-- Desde acá -->
		<div id="su-post-<?php the_ID(); ?>" class="col-lg-3">
			<div class="blog-item position-relative overflow-hidden">
				<img class="img-fluid" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID())); ?>" alt="" />
				<a class="blog-overlay" href="<?php the_permalink(); ?>">
					<h4 class="text-white"><?php the_title(); ?></h4>

					<?php
					$fecha_remate = get_field('fecha_remate', get_the_ID());

					if ($fecha_remate) {
						// Intentamos convertir a timestamp
						$timestamp = strtotime($fecha_remate);

						if ($timestamp) {
							// Formato localizado (en español)
							$dia_semana = date_i18n('l', $timestamp);
							$dia        = date_i18n('j', $timestamp);
							$mes = ucfirst(date_i18n('F', $timestamp));
							$hora       = date_i18n('H:i', $timestamp);

							// Mostramos con íconos + salto de línea
							echo '<span class="text-white fw-bold">';
							echo '<i class="fas fa-calendar-alt"></i> ' . ucfirst($dia_semana) . ' ' . $dia . ' de ' . $mes;
							echo '<br><i class="fas fa-clock"></i> ' . $hora . ' hs';
							echo '</span>';
						} else {
							echo '<span class="text-white fw-bold">Formato inválido en fecha_remate</span>';
						}
					} else {
						// fallback si no hay campo cargado
						echo '<span class="text-white fw-bold">';
						echo '<i class="fas fa-calendar-alt"></i> ' . esc_html(get_the_date());
						echo '</span>';
					}
					?>

				</a>
			</div>
		</div>
		<!-- hasta acá -->
	<?php endwhile; ?>
<?php else : ?>
	<p class="su-posts-not-found"><?php esc_html_e('Posts not found', 'shortcodes-ultimate'); ?></p>
<?php endif; ?>