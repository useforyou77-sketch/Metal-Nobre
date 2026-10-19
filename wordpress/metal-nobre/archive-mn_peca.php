<?php
/**
 * Loja: todas as peças, com filtro por categoria.
 */
get_header();
$mn_atual = is_tax( 'mn_categoria' ) ? get_queried_object() : null;
?>
<main class="loja">
  <section class="loja-topo">
    <div class="wrap titulo-sec">
      <span class="eyebrow"><?php echo $mn_atual ? 'Categoria' : 'Ouro 18k · teor 750'; ?></span>
      <h1><span class="caps-h">Nossa</span> <span class="script"><?php echo $mn_atual ? esc_html( $mn_atual->name ) : 'Loja'; ?></span></h1>
      <div class="louros"><svg viewBox="0 0 70 124"><use href="#i-louro"/></svg><svg viewBox="0 0 70 124"><use href="#i-louro"/></svg></div>
      <p class="loja-intro">Toque na peça que você gostou e fale com a gente no WhatsApp. A foto vai junto na mensagem.</p>
      <nav class="filtros" aria-label="Categorias">
        <a href="<?php echo esc_url( metal_nobre_link_loja() ); ?>" class="<?php echo $mn_atual ? '' : 'on'; ?>">Todas</a>
        <?php foreach ( metal_nobre_categorias() as $mn_cat ) : ?>
          <a href="<?php echo esc_url( get_term_link( $mn_cat ) ); ?>" class="<?php echo ( $mn_atual && $mn_atual->term_id === $mn_cat->term_id ) ? 'on' : ''; ?>"><?php echo esc_html( $mn_cat->name ); ?> <small><?php echo (int) $mn_cat->count; ?></small></a>
        <?php endforeach; ?>
      </nav>
    </div>
  </section>

  <section class="loja-lista">
    <div class="wrap">
      <?php if ( have_posts() ) : ?>
        <div class="grade grade-loja">
          <?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/card-peca' ); endwhile; ?>
        </div>
        <div class="paginacao">
          <?php
          the_posts_pagination( array(
            'mid_size'  => 1,
            'prev_text' => 'Anterior',
            'next_text' => 'Próxima',
          ) );
          ?>
        </div>
      <?php else : ?>
        <p class="vazio">Ainda não há peças nesta categoria. Chame a gente no WhatsApp que mostramos as novidades.</p>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php
get_footer();
