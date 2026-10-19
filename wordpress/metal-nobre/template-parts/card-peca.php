<?php
/**
 * Cartão de uma peça: só a foto; ao clicar abre a janela do WhatsApp.
 */
$mn_cat   = metal_nobre_categoria_da_peca( get_the_ID() );
$mn_foto  = get_the_post_thumbnail_url( get_the_ID(), 'large' );
$mn_nome  = get_the_title();
?>
<article class="peca revelar" tabindex="0" role="button" data-nome="<?php echo esc_attr( $mn_nome ); ?>" data-ref="<?php echo esc_attr( $mn_cat ); ?>" data-link="<?php echo esc_url( get_permalink() ); ?>" aria-label="<?php echo esc_attr( $mn_nome . ': chamar no WhatsApp' ); ?>">
  <figure class="foto">
    <?php if ( $mn_foto ) : ?>
      <img loading="lazy" src="<?php echo esc_url( $mn_foto ); ?>" alt="<?php echo esc_attr( $mn_nome ); ?>">
    <?php else : ?>
      <svg class="arte" style="display:block" viewBox="0 0 32 28" aria-hidden="true"><use href="#i-gema"/></svg>
    <?php endif; ?>
    <?php if ( $mn_cat ) : ?><span class="selo"><?php echo esc_html( $mn_cat ); ?></span><?php endif; ?>
    <span class="peca-chamada"><?php echo metal_nobre_icone_zap(); // phpcs:ignore -- SVG fixo do tema ?><b><?php echo esc_html( $mn_nome ); ?></b><small>Quero esta peça</small></span>
  </figure>
</article>
