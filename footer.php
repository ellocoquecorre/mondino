<?php

/**
 * Plantilla del footer.
 */
?>
<!-- FOOTER -->
<div class="container-fluid bg-footer bg-primary text-white mt-5">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-12 col-md-6">
                <div class="row gx-5">
                    <!-- 1 -->
                    <div class="col-lg-3 col-md-12 pt-5 mb-5">
                        <h4 class="text-white mb-4">Casa Central</h4>
                        <div class="d-flex mb-2">
                            <i class="bi bi-geo-alt text-white me-2"></i>
                            <p class="text-white mb-0">
                                Vélez Sárfield 466<br>
                                Del Campillo<br>
                                (6271) Córdoba
                            </p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-envelope-open text-white me-2"></i>
                            <a class="text-white mb-0" href="mailto:asm@alfredosmondino.com.ar">
                                <span class="lf">asm@alfredosmondino.com.ar</span>
                            </a>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-telephone text-white me-2"></i>
                            <p class="text-white mb-0">+54 3583 49-9144</p>
                        </div>
                    </div>

                    <!-- 2 -->
                    <div class="col-lg-3 col-md-12 pt-0 pt-lg-5 mb-5">
                        <h4 class="text-white mb-4">Links</h4>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="<?php echo esc_url(home_url('/')); ?>">
                                <i class="bi bi-arrow-right text-white me-2"></i><span class="lf">Inicio</span>
                            </a>
                            <a class="text-white mb-2" href="<?php echo esc_url(home_url('/conozcanos/')); ?>">
                                <i class="bi bi-arrow-right text-white me-2"></i><span class="lf">Conózcanos</span>
                            </a>
                            <a class="text-white mb-2" href="<?php echo esc_url(home_url('/noticias/')); ?>">
                                <i class="bi bi-arrow-right text-white me-2"></i><span class="lf">Noticias</span>
                            </a>
                            <a class="text-white mb-2" href="<?php echo esc_url(home_url('/sucursales/')); ?>">
                                <i class="bi bi-arrow-right text-white me-2"></i><span class="lf">Sucursales</span>
                            </a>
                            <a class="text-white mb-2" href="<?php echo esc_url(home_url('/contacto/')); ?>">
                                <i class="bi bi-arrow-right text-white me-2"></i><span class="lf">Contacto</span>
                            </a>
                        </div>
                    </div>

                    <!-- 3 -->
                    <div class="col-lg-3 col-md-12 pt-0 pt-lg-5 mb-5">
                        <h4 class="text-white mb-4">Servicios</h4>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="<?php echo esc_url(home_url('/remates/')); ?>">
                                <i class="bi bi-arrow-right text-white me-2"></i><span class="lf">Remates y Hacienda</span>
                            </a>
                            <a class="text-white mb-2" href="<?php echo esc_url(home_url('/cereales/')); ?>">
                                <i class="bi bi-arrow-right text-white me-2"></i><span class="lf">Cereales</span>
                            </a>
                            <a class="text-white mb-2" href="<?php echo esc_url(home_url('/inmobiliaria/')); ?>">
                                <i class="bi bi-arrow-right text-white me-2"></i><span class="lf">Inmobiliaria Rural</span>
                            </a>
                            <a class="text-white mb-2" href="<?php echo esc_url(home_url('/transporte/')); ?>">
                                <i class="bi bi-arrow-right text-white me-2"></i><span class="lf">Transporte y Logística</span>
                            </a>
                        </div>
                    </div>

                    <!-- 4 -->
                    <div class="col-lg-3 col-md-12 pt-0 pt-lg-5 mb-5">
                        <h4 class="text-white mb-4">Seguinos en</h4>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="btn btn-secondary btn-square rounded-circle"
                                href="<?php echo esc_url('https://www.instagram.com/alfredosmondino'); ?>"
                                target="_blank" rel="noopener"
                                aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div>
        </div>
    </div>
</div>

<div class="container-fluid bg-dark text-white py-4">
    <div class="container text-center">
        <p class="mb-0">
            &copy;
            <a class="text-secondary fw-bold" href="<?php echo esc_url(home_url('/')); ?>">
                <?php bloginfo('name'); ?>
            </a>.
            <?php esc_html_e('All Rights Reserved.', 'mondino'); ?>
            <?php esc_html_e('Designed by', 'mondino'); ?>
            <a class="text-secondary fw-bold" href="https://htmlcodex.com">HTML Codex</a>
        </p>
        <p class="mb-0">
            <?php esc_html_e('Distributed by:', 'mondino'); ?>
            <a class="text-secondary fw-bold" href="https://themewagon.com" target="_blank" rel="noopener">ThemeWagon</a>
        </p>
    </div>
</div>
<!-- FIN FOOTER -->

<?php wp_footer(); ?>
</body>

</html>