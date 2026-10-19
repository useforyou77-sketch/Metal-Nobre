<?php
$mn_img     = get_template_directory_uri() . '/assets/img/';
$mn_zap     = metal_nobre_whatsapp();
$mn_zap_txt = get_theme_mod( 'mn_whatsapp_texto', '(62) 8430-7480' );
$mn_insta   = get_theme_mod( 'mn_instagram', 'https://www.instagram.com/metalnobrejoalheria/' );
?>
<main>
  <section class="hero" id="inicio">
    <div class="hero-foto">
      <img src="<?php echo esc_url( $mn_img ); ?>banner.jpg" alt="Mulher usando brinco, anéis, pulseira e colar de coração em ouro 18k" fetchpriority="high">
      <svg class="arte" viewBox="0 0 100 100" fill="none" stroke="currentColor" aria-hidden="true"><circle cx="50" cy="62" r="30"/><circle cx="50" cy="62" r="25"/><path d="M37 20h26l8 9-21 21-21-21z M29 29h42 M44 20l-4 9 10 21 10-21-4-9"/><path d="M40 31l-5 7M60 31l5 7"/></svg>
    </div>
    <div class="wrap">
      <div class="hero-txt">
        <span class="eyebrow">Lapidado para encantar</span>
        <h1 aria-label="Elegância atemporal">
          <span class="l script escrita">Elegância</span>
          <span class="l ouro caps" data-letras>Atemporal</span>
        </h1>
        <p class="lead">Joias finas em ouro 18k teor 750, com autenticidade e garantia eterna. Há 20 anos oferecendo preços imbatíveis e qualidade comprovada.</p>
        <div class="hero-botoes">
          <a href="#colecao" class="btn btn-ouro ima">Ver coleção <svg><use href="#i-seta"/></svg></a>
          <a href="#historia" class="btn btn-linha ima">Nossa história</a>
        </div>
      </div>
    </div>
    <div class="selo-hero" aria-hidden="true">
      <svg class="anel" viewBox="0 0 200 200"><defs><path id="circulo" d="M100 100m-86 0a86 86 0 1 1 172 0a86 86 0 1 1-172 0"/></defs><text><textPath href="#circulo">OURO 18K · TEOR 750 · GARANTIA ETERNA · HÁ 20 ANOS ·</textPath></text></svg>
      <span class="logo"></span>
    </div>
    <div class="hero-ficha mono" aria-hidden="true">
      <span>Coleção Corações</span>
      <span>Ouro 18k · teor 750</span>
    </div>
    <div class="rolar" aria-hidden="true"></div>
  </section>

  <section class="faixa-clara" aria-label="Por que a Metal Nobre">
    <div class="wrap beneficios">
      <div class="beneficio revelar">
        <svg viewBox="0 0 32 28"><use href="#i-gema"/></svg>
        <div><h3>Ouro 18k teor 750</h3><p>Todas as peças em ouro 18k legítimo, com teor 750.</p></div>
      </div>
      <div class="beneficio revelar">
        <svg viewBox="0 0 34 34" fill="none" stroke="currentColor"><circle cx="17" cy="21" r="10"/><path d="M12.5 7.5 17 3l4.5 4.5L17 12z"/><path d="M14 10.5 12.5 11.6M20 10.5l1.5 1.1"/></svg>
        <div><h3>Qualidade comprovada</h3><p>São 20 anos no mercado de joias finas.</p></div>
      </div>
      <div class="beneficio revelar">
        <svg viewBox="0 0 34 34" fill="none" stroke="currentColor"><path d="M17 3 5 7.5v8.7c0 7.3 5 12.6 12 14.8 7-2.2 12-7.5 12-14.8V7.5z"/><path d="m11.8 17 3.6 3.6 7-7.2"/></svg>
        <div><h3>Garantia eterna</h3><p>Autenticidade garantida em cada joia, para sempre.</p></div>
      </div>
      <div class="beneficio revelar">
        <svg viewBox="0 0 34 34" fill="none" stroke="currentColor"><rect x="5" y="13" width="24" height="17"/><path d="M3 9h28v4H3zM17 9v21"/><path d="M17 9c-2-4-7.5-6-8.5-3S13 9 17 9c4 0 9.5-.1 8.5-3S19 5 17 9z"/></svg>
        <div><h3>Preços imbatíveis</h3><p>Ouro 18k de verdade com o melhor preço.</p></div>
      </div>
    </div>
  </section>

  <section class="colecao" id="colecao">
    <div class="wrap">
      <div class="titulo-sec revelar">
        <span class="eyebrow">Nossa coleção</span>
        <h2><span class="caps-h">Peças</span> <span class="script">Assinatura</span></h2>
        <div class="louros"><svg viewBox="0 0 70 124"><use href="#i-louro"/></svg><svg viewBox="0 0 70 124"><use href="#i-louro"/></svg></div>
      </div>
    </div>
    <div class="fita" aria-hidden="true">
      <div class="fita-trilho"><span>Colares</span><span>Pulseiras</span><span>Brincos</span><span>Anéis</span><span>Alianças</span><span>Pingentes</span><span>Solitários</span><span>Colares</span><span>Pulseiras</span><span>Brincos</span><span>Anéis</span><span>Alianças</span><span>Pingentes</span><span>Solitários</span></div>
    </div>
    <div class="wrap">
      <?php
      $mn_destaques = new WP_Query( array(
        'post_type'      => 'mn_peca',
        'posts_per_page' => (int) get_theme_mod( 'mn_qtd_inicio', 15 ),
        'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
      ) );
      ?>
      <?php if ( $mn_destaques->have_posts() ) : ?>
      <div class="grade">
        <?php while ( $mn_destaques->have_posts() ) : $mn_destaques->the_post(); get_template_part( 'template-parts/card-peca' ); endwhile; wp_reset_postdata(); ?>
      </div>
      <?php else : ?>
      <p class="vazio">Nenhuma peça cadastrada ainda. Adicione peças em <b>Peças &gt; Adicionar peça</b> no painel.</p>
      <?php endif; ?>
      <div class="ver-tudo"><a href="<?php echo esc_url( metal_nobre_link_loja() ); ?>" class="btn btn-linha ima">Ver todas as peças na loja <svg><use href="#i-seta"/></svg></a></div>
    </div>
  </section>

  <section class="historia" id="historia">
    <figure class="historia-foto revelar-img" id="atelie">
      <img loading="lazy" src="<?php echo esc_url( $mn_img ); ?>vitrine.jpg" alt="Vitrine da Metal Nobre com colar, brincos e anéis em ouro 18k" style="object-position:50% 40%">
      <svg class="arte" viewBox="0 0 100 100" fill="none" stroke="currentColor"><circle cx="50" cy="60" r="24"/><circle cx="50" cy="60" r="19"/><path d="M40 30h20l6 7-16 15-16-15z M34 37h32 M45 30l-3 7 8 15 8-15-3-7"/><path d="M78 12 62 30M80 16l-4-4M18 88l12-12"/></svg>
      <span class="logo carimbo" role="img" aria-label="Selo Metal Nobre Joalheria"></span>
      <figcaption>Nossa vitrine · ouro 18k</figcaption>
    </figure>
    <div class="historia-txt">
      <span class="eyebrow revelar">Nossa história</span>
      <h2 class="revelar"><span class="caps-h">20 anos de</span><span class="script">ouro verdadeiro</span></h2>
      <p class="revelar">Há 20 anos a Metal Nobre trabalha com joias finas em ouro 18k teor 750. Cada peça sai com autenticidade e garantia eterna, porque quem compra ouro precisa ter certeza do que está levando. Unimos qualidade comprovada a preços imbatíveis para que a joia certa caiba em mais momentos da sua vida.</p>
      <div class="assinatura revelar">
        <span class="nome" id="assinatura">Metal Nobre</span>
        <span class="cargo mono">Joalheria há 20 anos</span>
      </div>
      <a href="<?php echo esc_url( $mn_insta ); ?>" target="_blank" rel="noopener" class="btn btn-ouro ima">Siga no Instagram <svg><use href="#i-seta"/></svg></a>
    </div>
  </section>

  <section class="numeros" aria-label="A Metal Nobre em números">
    <div class="wrap">
      <div class="numero"><b data-conta="20" data-suf="+">20+</b><h3>Anos no mercado</h3><p>Duas décadas de joias finas.</p></div>
      <div class="numero"><b data-conta="5453" data-suf="">5.453</b><h3>Seguidores</h3><p>Acompanhando a gente no Instagram.</p></div>
      <div class="numero"><b data-conta="750" data-suf="">750</b><h3>Teor do ouro</h3><p>Ouro 18k legítimo em todas as peças.</p></div>
      <div class="numero"><b data-conta="282" data-suf="">282</b><h3>Publicações</h3><p>Peças e novidades no nosso perfil.</p></div>
    </div>
  </section>

  <section class="faixa-clara" id="servicos" aria-label="Atendimento">
    <div class="wrap servicos">
      <div class="servico revelar">
        <svg viewBox="0 0 34 34" fill="none" stroke="currentColor"><path d="M2 8h19v15H2zM21 13h6l5 5v5H21z"/><circle cx="8" cy="25" r="3"/><circle cx="26" cy="25" r="3"/></svg>
        <div><h3>Frete grátis e segurado</h3><p>Entrega com seguro para todo o Brasil.</p></div>
      </div>
      <div class="servico revelar">
        <svg viewBox="0 0 34 34" fill="none" stroke="currentColor"><circle cx="17" cy="13" r="9"/><path d="m11 20-3 11 9-4 9 4-3-11"/><path d="m13.5 13 2.5 2.5 4.5-4.5"/></svg>
        <div><h3>Garantia eterna</h3><p>Autenticidade do ouro 18k garantida para sempre.</p></div>
      </div>
      <div class="servico revelar">
        <svg viewBox="0 0 34 34" fill="none" stroke="currentColor"><path d="M6 19v-3a11 11 0 0 1 22 0v3"/><rect x="4" y="18" width="5" height="9" rx="1"/><rect x="25" y="18" width="5" height="9" rx="1"/><path d="M27.5 27c0 3-3 4-8 4"/></svg>
        <div><h3>Consultoria com ourives</h3><p>Ajuda para escolher pedra, aro e medida.</p></div>
      </div>
      <div class="servico revelar">
        <svg viewBox="0 0 34 34" fill="none" stroke="currentColor"><path d="M28 13A12 12 0 0 0 6.5 10M6 21a12 12 0 0 0 21.5 3"/><path d="M6 4v6h6M28 30v-6h-6"/></svg>
        <div><h3>Troca em 30 dias</h3><p>Sem perguntas, com coleta na sua casa.</p></div>
      </div>
    </div>
  </section>
</main>
