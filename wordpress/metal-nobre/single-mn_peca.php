<?php
/**
 * Página de uma peça.
 */
get_header();
while ( have_posts() ) :
	the_post();
	$mn_cat  = metal_nobre_categoria_da_peca( get_the_ID() );
	$mn_foto = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	$mn_msg  = 'Olá, Metal Nobre! Tenho interesse nesta peça: ' . get_the_title() . ".\n" . ( $mn_foto ? $mn_foto : get_permalink() );
	?>
<main class="loja">
  <section class="peca-pagina">
    <div class="wrap peca-pagina-grade">
      <figure class="peca-pagina-foto">
        <?php if ( $mn_foto ) : ?><img src="<?php echo esc_url( $mn_foto ); ?>" alt="<?php the_title_attribute(); ?>"><?php endif; ?>
      </figure>
      <div class="peca-pagina-info">
        <a class="voltar" href="<?php echo esc_url( metal_nobre_link_loja() ); ?>">← Voltar para a loja</a>
        <?php if ( $mn_cat ) : ?><span class="eyebrow"><?php echo esc_html( $mn_cat ); ?></span><?php endif; ?>
        <h1 class="script"><?php the_title(); ?></h1>
        <p class="mono">Ouro 18k · teor 750 · garantia eterna</p>
        <div class="peca-texto"><?php the_content(); ?></div>
        <a class="btn btn-zap" target="_blank" rel="noopener" href="<?php echo esc_attr( 'https://wa.me/' . metal_nobre_whatsapp() . '?text=' . rawurlencode( $mn_msg ) ); ?>"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2zm0 18.2a8.2 8.2 0 0 1-4.2-1.2l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8s-.4-.1-.6.1-.7.8-.8 1-.3.2-.5.1a6.7 6.7 0 0 1-3.3-2.9c-.3-.4.3-.4.7-1.3.1-.2 0-.3 0-.4l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2 5.2 5.2 0 0 0 1.1 2.8 11.9 11.9 0 0 0 4.6 4 5.2 5.2 0 0 0 3.2.7 2.7 2.7 0 0 0 1.8-1.3 2.2 2.2 0 0 0 .2-1.3c-.1-.1-.3-.2-.5-.3z"/></svg> Chamar no WhatsApp</a>
      </div>
    </div>
  </section>
</main>
	<?php
endwhile;
get_footer();
