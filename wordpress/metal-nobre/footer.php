<?php
$mn_img     = get_template_directory_uri() . '/assets/img/';
$mn_zap     = metal_nobre_whatsapp();
$mn_zap_txt = get_theme_mod( 'mn_whatsapp_texto', '(62) 8430-7480' );
$mn_insta   = get_theme_mod( 'mn_instagram', 'https://www.instagram.com/metalnobrejoalheria/' );
?>
<footer class="rodape" id="contato">
  <div class="wrap">
    <div class="rodape-grade">
      <div>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="marca" aria-label="Metal Nobre Joalheria, voltar ao início"><span class="logo logo-rodape" role="img" aria-label="Logo Metal Nobre Joalheria"></span></a>
        <p class="sobre">Joias finas em ouro 18k com autenticidade e garantia eterna. Há 20 anos no mercado.</p>
      </div>
      <div>
        <h4>Loja</h4>
        <ul>
          <?php foreach ( metal_nobre_categorias() as $mn_cat ) : ?>
            <li><a href="<?php echo esc_url( get_term_link( $mn_cat ) ); ?>"><?php echo esc_html( $mn_cat->name ); ?></a></li>
          <?php endforeach; ?>
          <li><a href="<?php echo esc_url( metal_nobre_link_loja() ); ?>">Ver todas as peças</a></li>
          <li><a href="<?php echo esc_url( metal_nobre_link_area() ); ?>" rel="nofollow">Área da loja (login)</a></li>
        </ul>
      </div>
      <div>
        <h4>Fale com a gente</h4>
        <ul><li><a href="<?php echo esc_url( $mn_insta ); ?>" target="_blank" rel="noopener">@metalnobrejoalheria</a></li><li>Seg. a sáb., 10h às 19h</li><li class="mono" style="font-size:12.5px"><a href="<?php echo esc_url( 'https://wa.me/' . $mn_zap ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $mn_zap_txt ); ?></a></li><li class="mono" style="font-size:12.5px">contato@metalnobre.com.br</li></ul>
      </div>
      <div>
        <h4>Cartas do ateliê</h4>
        <p class="sobre">Lançamentos e peças únicas, uma vez por mês.</p>
        <form class="news" id="news" novalidate>
          <label for="email" class="sr" style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0)">Seu e-mail</label>
          <input id="email" type="email" placeholder="seu@email.com" autocomplete="email">
          <button type="submit">Assinar</button>
        </form>
        <p class="news-msg" id="newsMsg" aria-live="polite"></p>
      </div>
    </div>
    <div class="rodape-base">
      <span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> Metal Nobre Joalheria</span>
      <span class="contraste"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.1"><path d="M4 4h16v16H4z"/><text x="12" y="15.5" text-anchor="middle" font-size="7.5" fill="currentColor" stroke="none" font-family="DM Mono, monospace">750</text></svg>Todo ouro com contraste 750</span>
    </div>
  </div>
</footer>

<div class="janela" id="janela" hidden role="dialog" aria-modal="true" aria-labelledby="janelaNome">
  <div class="janela-caixa">
    <button class="fechar" id="fechar" aria-label="Fechar">×</button>
    <figure class="janela-foto" id="janelaFoto"></figure>
    <div class="janela-corpo">
      <span class="eyebrow" id="janelaRef"></span>
      <h3 id="janelaNome"></h3>
      <p>Fale com a gente no WhatsApp. A foto desta peça já vai junto na mensagem.</p>
      <a class="btn btn-zap" id="janelaZap" href="#" target="_blank" rel="noopener"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2zm0 18.2a8.2 8.2 0 0 1-4.2-1.2l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8s-.4-.1-.6.1-.7.8-.8 1-.3.2-.5.1a6.7 6.7 0 0 1-3.3-2.9c-.3-.4.3-.4.7-1.3.1-.2 0-.3 0-.4l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2 5.2 5.2 0 0 0 1.1 2.8 11.9 11.9 0 0 0 4.6 4 5.2 5.2 0 0 0 3.2.7 2.7 2.7 0 0 0 1.8-1.3 2.2 2.2 0 0 0 .2-1.3c-.1-.1-.3-.2-.5-.3z"/></svg> Chamar no WhatsApp</a>
    </div>
  </div>
</div>
<a class="zap-flutuante" href="#" data-zap target="_blank" rel="noopener" aria-label="Fale conosco no WhatsApp"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2zm0 18.2a8.2 8.2 0 0 1-4.2-1.2l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8s-.4-.1-.6.1-.7.8-.8 1-.3.2-.5.1a6.7 6.7 0 0 1-3.3-2.9c-.3-.4.3-.4.7-1.3.1-.2 0-.3 0-.4l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2 5.2 5.2 0 0 0 1.1 2.8 11.9 11.9 0 0 0 4.6 4 5.2 5.2 0 0 0 3.2.7 2.7 2.7 0 0 0 1.8-1.3 2.2 2.2 0 0 0 .2-1.3c-.1-.1-.3-.2-.5-.3z"/></svg></a>

<div class="aviso" id="aviso" role="status" aria-live="polite"><span class="logo" style="width:30px;height:30px"></span><span id="avisoTxt"></span></div>

<?php wp_footer(); ?>
</body>
</html>
