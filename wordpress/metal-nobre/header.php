<?php
/**
 * Cabeçalho do tema.
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php
$mn_img     = get_template_directory_uri() . '/assets/img/';
$mn_zap     = metal_nobre_whatsapp();
$mn_zap_txt = get_theme_mod( 'mn_whatsapp_texto', '(62) 8430-7480' );
$mn_insta   = get_theme_mod( 'mn_instagram', 'https://www.instagram.com/metalnobrejoalheria/' );
?>


<!-- ícones reutilizados -->
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <symbol id="i-seta" viewBox="0 0 16 16"><path d="M1 8h13M9 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.3"/></symbol>
  <symbol id="i-mais" viewBox="0 0 14 14"><path d="M7 1v12M1 7h12" fill="none" stroke="currentColor" stroke-width="1.3"/></symbol>
  <symbol id="i-louro" viewBox="0 0 70 124"><path d="M50.5 109.6 L38.4 103.7 L28.2 94.7 L20.8 83.4 L16.7 70.5 L16.3 57.0 L19.4 43.8 L26.0 32.0 L35.5 22.4 L47.3 15.6" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/><g fill="currentColor"><ellipse cx="43.2" cy="112.8" rx="8.5" ry="3.1" transform="rotate(156 43.2 112.8)"/><ellipse cx="46.5" cy="102.6" rx="8.5" ry="3.1" transform="rotate(240 46.5 102.6)"/><ellipse cx="30.8" cy="104.8" rx="8.1" ry="2.9" transform="rotate(172 30.8 104.8)"/><ellipse cx="36.4" cy="96.2" rx="8.1" ry="2.9" transform="rotate(256 36.4 96.2)"/><ellipse cx="21.0" cy="93.8" rx="7.7" ry="2.8" transform="rotate(187 21.0 93.8)"/><ellipse cx="28.3" cy="87.5" rx="7.7" ry="2.8" transform="rotate(271 28.3 87.5)"/><ellipse cx="14.5" cy="80.7" rx="7.2" ry="2.6" transform="rotate(203 14.5 80.7)"/><ellipse cx="22.8" cy="76.8" rx="7.2" ry="2.6" transform="rotate(287 22.8 76.8)"/><ellipse cx="11.7" cy="66.5" rx="6.8" ry="2.5" transform="rotate(218 11.7 66.5)"/><ellipse cx="20.2" cy="65.0" rx="6.8" ry="2.5" transform="rotate(302 20.2 65.0)"/><ellipse cx="12.7" cy="52.1" rx="6.4" ry="2.3" transform="rotate(234 12.7 52.1)"/><ellipse cx="20.7" cy="52.9" rx="6.4" ry="2.3" transform="rotate(318 20.7 52.9)"/><ellipse cx="17.4" cy="38.5" rx="5.9" ry="2.2" transform="rotate(249 17.4 38.5)"/><ellipse cx="24.5" cy="41.3" rx="5.9" ry="2.2" transform="rotate(333 24.5 41.3)"/><ellipse cx="25.5" cy="26.8" rx="5.5" ry="2.0" transform="rotate(265 25.5 26.8)"/><ellipse cx="31.2" cy="31.0" rx="5.5" ry="2.0" transform="rotate(349 31.2 31.0)"/><ellipse cx="36.4" cy="17.6" rx="5.1" ry="1.9" transform="rotate(280 36.4 17.6)"/><ellipse cx="40.4" cy="22.7" rx="5.1" ry="1.9" transform="rotate(364 40.4 22.7)"/><ellipse cx="49.2" cy="11.6" rx="4.7" ry="1.7" transform="rotate(296 49.2 11.6)"/><ellipse cx="51.4" cy="17.2" rx="4.7" ry="1.7" transform="rotate(380 51.4 17.2)"/><ellipse cx="53.8" cy="13.0" rx="7" ry="2.6" transform="rotate(338 53.8 13.0)"/></g></symbol>
  <symbol id="i-gema" viewBox="0 0 32 28"><path d="M8 2h16l6 7-14 17L2 9z M2 9h28 M12 2l-3 7 7 17 7-17-3-7" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></symbol>
</svg>

<div class="grao" aria-hidden="true"></div>

<header class="topo" id="topo">
  <div class="wrap">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="marca" aria-label="Metal Nobre Joalheria, início">
      <span class="logo logo-topo" role="img" aria-label="Logo Metal Nobre Joalheria"></span>
    </a>
    <nav aria-label="Principal">
      <ul class="menu" id="menu">
        <li><a href="<?php echo esc_url( home_url( '/#inicio' ) ); ?>"<?php echo is_front_page() ? ' class="ativo"' : ''; ?>>Início</a></li>
        <li><a href="<?php echo esc_url( metal_nobre_link_loja() ); ?>"<?php echo metal_nobre_na_loja() ? ' class="ativo"' : ''; ?>>Loja</a></li>
        <li><a href="<?php echo esc_url( home_url( '/#historia' ) ); ?>">Sobre nós</a></li>
        <li><a href="<?php echo esc_url( home_url( '/#atelie' ) ); ?>">Nossa joalheria</a></li>
        <li><a href="<?php echo esc_url( home_url( '/#servicos' ) ); ?>">Atendimento</a></li>
        <li><a href="#contato">Contato</a></li>
      </ul>
    </nav>
    <div class="acoes">
      <a class="zap-topo" href="#" data-zap aria-label="Fale conosco no WhatsApp"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2zm0 18.2a8.2 8.2 0 0 1-4.2-1.2l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8s-.4-.1-.6.1-.7.8-.8 1-.3.2-.5.1a6.7 6.7 0 0 1-3.3-2.9c-.3-.4.3-.4.7-1.3.1-.2 0-.3 0-.4l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2 5.2 5.2 0 0 0 1.1 2.8 11.9 11.9 0 0 0 4.6 4 5.2 5.2 0 0 0 3.2.7 2.7 2.7 0 0 0 1.8-1.3 2.2 2.2 0 0 0 .2-1.3c-.1-.1-.3-.2-.5-.3z"/></svg><span>WhatsApp</span></a>
      <button class="abrir-menu" id="abrirMenu" aria-label="Abrir menu" aria-expanded="false" aria-controls="menu"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M2 6h16M2 10h16M8 14h10"/></svg></button>
    </div>
  </div>
</header>
