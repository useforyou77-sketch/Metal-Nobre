<?php
/**
 * Modelo padrão (páginas e posts comuns).
 */
get_header();
?>
<main class="loja">
  <section class="pagina-comum">
    <div class="wrap">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article <?php post_class(); ?>>
          <h1 class="script"><?php the_title(); ?></h1>
          <div class="peca-texto"><?php the_content(); ?></div>
        </article>
      <?php endwhile; else : ?>
        <h1 class="script">Página não encontrada</h1>
        <p><a class="btn btn-ouro" href="<?php echo esc_url( home_url( '/' ) ); ?>">Voltar ao início</a></p>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php
get_footer();
