<?php
/**
 * Funções do tema Metal Nobre Joalheria.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function metal_nobre_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'script', 'style', 'navigation-widgets' ) );
}
add_action( 'after_setup_theme', 'metal_nobre_setup' );

/* ---------- Loja: peças e categorias ---------- */

function metal_nobre_registrar_loja() {
	register_post_type( 'mn_peca', array(
		'labels'        => array(
			'name'                  => 'Peças',
			'singular_name'         => 'Peça',
			'menu_name'             => 'Peças da loja',
			'add_new'               => 'Adicionar peça',
			'add_new_item'          => 'Adicionar nova peça',
			'edit_item'             => 'Editar peça',
			'new_item'              => 'Nova peça',
			'view_item'             => 'Ver peça',
			'all_items'             => 'Todas as peças',
			'search_items'          => 'Buscar peças',
			'not_found'             => 'Nenhuma peça encontrada',
			'featured_image'        => 'Foto da peça',
			'set_featured_image'    => 'Escolher foto da peça',
			'remove_featured_image' => 'Remover foto',
			'use_featured_image'    => 'Usar como foto da peça',
		),
		'public'        => true,
		'has_archive'   => 'loja',
		'rewrite'       => array( 'slug' => 'peca', 'with_front' => false ),
		'menu_icon'     => 'dashicons-store',
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'show_in_rest'  => true,
	) );

	register_taxonomy( 'mn_categoria', 'mn_peca', array(
		'labels'            => array(
			'name'          => 'Categorias',
			'singular_name' => 'Categoria',
			'add_new_item'  => 'Adicionar categoria',
			'edit_item'     => 'Editar categoria',
			'all_items'     => 'Todas as categorias',
		),
		'hierarchical'      => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'loja/categoria', 'with_front' => false ),
	) );
}
add_action( 'init', 'metal_nobre_registrar_loja' );

/** A loja mostra 24 peças por página, na ordem escolhida no painel. */
function metal_nobre_ordem_loja( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( $query->is_post_type_archive( 'mn_peca' ) || $query->is_tax( 'mn_categoria' ) ) {
		$query->set( 'posts_per_page', 24 );
		$query->set( 'orderby', array( 'menu_order' => 'ASC', 'date' => 'DESC' ) );
	}
}
add_action( 'pre_get_posts', 'metal_nobre_ordem_loja' );

function metal_nobre_link_loja() {
	$link = get_post_type_archive_link( 'mn_peca' );
	return $link ? $link : home_url( '/loja/' );
}

function metal_nobre_na_loja() {
	return is_post_type_archive( 'mn_peca' ) || is_tax( 'mn_categoria' ) || is_singular( 'mn_peca' );
}

function metal_nobre_categorias() {
	$termos = get_terms( array( 'taxonomy' => 'mn_categoria', 'hide_empty' => true ) );
	return is_wp_error( $termos ) ? array() : $termos;
}

function metal_nobre_categoria_da_peca( $post_id ) {
	$termos = get_the_terms( $post_id, 'mn_categoria' );
	return ( $termos && ! is_wp_error( $termos ) ) ? $termos[0]->name : '';
}

function metal_nobre_icone_zap() {
	return '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2zm0 18.2a8.2 8.2 0 0 1-4.2-1.2l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8s-.4-.1-.6.1-.7.8-.8 1-.3.2-.5.1a6.7 6.7 0 0 1-3.3-2.9c-.3-.4.3-.4.7-1.3.1-.2 0-.3 0-.4l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2 5.2 5.2 0 0 0 1.1 2.8 11.9 11.9 0 0 0 4.6 4 5.2 5.2 0 0 0 3.2.7 2.7 2.7 0 0 0 1.8-1.3 2.2 2.2 0 0 0 .2-1.3c-.1-.1-.3-.2-.5-.3z"/></svg>';
}

/** Coluna com a foto na lista de peças do painel. */
function metal_nobre_colunas( $colunas ) {
	return array_merge( array( 'cb' => $colunas['cb'], 'mn_foto' => 'Foto' ), $colunas );
}
add_filter( 'manage_mn_peca_posts_columns', 'metal_nobre_colunas' );

function metal_nobre_coluna_foto( $coluna, $post_id ) {
	if ( 'mn_foto' === $coluna ) {
		echo get_the_post_thumbnail( $post_id, array( 60, 60 ), array( 'style' => 'width:60px;height:60px;object-fit:cover;border-radius:4px' ) );
	}
}
add_action( 'manage_mn_peca_posts_custom_column', 'metal_nobre_coluna_foto', 10, 2 );

/**
 * Ao ativar o tema pela primeira vez, cadastra as peças que vieram com ele,
 * para a loja já abrir com a coleção atual. Depois disso, tudo é feito pelo painel.
 */
function metal_nobre_pecas_iniciais() {
	return array(
		array( 'Corrente com Placa Diagonal', 'Colares', 'peca-01.jpg' ),
		array( 'Pulseira Elos Retangulares', 'Pulseiras', 'peca-02.jpg' ),
		array( 'Pulseira Coração Cravejado', 'Pulseiras', 'peca-03.jpg' ),
		array( 'Pulseira Dupla com Coração', 'Pulseiras', 'peca-04.jpg' ),
		array( 'Pulseira Grumet', 'Pulseiras', 'peca-05.jpg' ),
		array( 'Brinco Trio de Corações', 'Brincos', 'peca-06.jpg' ),
		array( 'Par de Alianças', 'Alianças', 'peca-07.jpg' ),
		array( 'Solitário e Aliança', 'Anéis', 'peca-08.jpg' ),
		array( 'Corrente com Crucifixo', 'Colares', 'peca-09.jpg' ),
		array( 'Pulseira Coração Vazado', 'Pulseiras', 'peca-10.jpg' ),
		array( 'Anel Cravejado', 'Anéis', 'peca-11.jpg' ),
		array( 'Anel Três Aros Bicolor', 'Anéis', 'peca-12.jpg' ),
		array( 'Corrente Grumet com Cavalo', 'Colares', 'peca-13.jpg' ),
		array( 'Brincos Rendados Coração e Gota', 'Brincos', 'peca-14.jpg' ),
		array( 'Brincos Ponto de Luz e Argola', 'Brincos', 'peca-15.jpg' ),
	);
}

function metal_nobre_importar_pecas() {
	if ( get_option( 'mn_pecas_importadas' ) ) {
		return;
	}
	update_option( 'mn_pecas_importadas', 1 );
	$existentes = wp_count_posts( 'mn_peca' );
	if ( $existentes && ( $existentes->publish + $existentes->draft ) > 0 ) {
		return;
	}
	require_once ABSPATH . 'wp-admin/includes/image.php';
	if ( function_exists( 'set_time_limit' ) ) {
		@set_time_limit( 300 ); // phpcs:ignore
	}

	foreach ( metal_nobre_pecas_iniciais() as $ordem => $peca ) {
		list( $nome, $categoria, $arquivo ) = $peca;
		$post_id = wp_insert_post( array(
			'post_type'   => 'mn_peca',
			'post_title'  => $nome,
			'post_status' => 'publish',
			'menu_order'  => $ordem + 1,
		) );
		if ( ! $post_id || is_wp_error( $post_id ) ) {
			continue;
		}
		wp_set_object_terms( $post_id, $categoria, 'mn_categoria' );

		$origem = get_template_directory() . '/assets/img/pecas/' . $arquivo;
		if ( ! file_exists( $origem ) ) {
			continue;
		}
		$upload = wp_upload_bits( sanitize_file_name( sanitize_title( $nome ) . '.jpg' ), null, file_get_contents( $origem ) ); // phpcs:ignore
		if ( ! empty( $upload['error'] ) ) {
			continue;
		}
		$anexo = wp_insert_attachment( array(
			'post_mime_type' => 'image/jpeg',
			'post_title'     => $nome,
			'post_status'    => 'inherit',
		), $upload['file'], $post_id );
		if ( $anexo && ! is_wp_error( $anexo ) ) {
			wp_update_attachment_metadata( $anexo, wp_generate_attachment_metadata( $anexo, $upload['file'] ) );
			set_post_thumbnail( $post_id, $anexo );
		}
	}
}

function metal_nobre_ativar() {
	metal_nobre_registrar_loja();
	metal_nobre_importar_pecas();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'metal_nobre_ativar' );

/* ---------- Contato ---------- */

/** Número do WhatsApp só com dígitos (DDI + DDD + número). */
function metal_nobre_whatsapp() {
	return preg_replace( '/\D/', '', get_theme_mod( 'mn_whatsapp', '556284307480' ) );
}

function metal_nobre_assets() {
	$versao = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'metal-nobre-fontes', 'https://fonts.googleapis.com/css2?family=Great+Vibes&family=Jost:wght@200;300;400;500&family=DM+Mono:wght@400&display=swap', array(), null );
	wp_enqueue_style( 'metal-nobre', get_stylesheet_uri(), array( 'metal-nobre-fontes' ), $versao );
	wp_enqueue_script( 'metal-nobre', get_template_directory_uri() . '/assets/js/site.js', array(), $versao, true );
	wp_localize_script( 'metal-nobre', 'metalNobre', array( 'whatsapp' => metal_nobre_whatsapp() ) );
}
add_action( 'wp_enqueue_scripts', 'metal_nobre_assets' );

function metal_nobre_icone() {
	if ( ! has_site_icon() ) {
		echo '<link rel="icon" type="image/png" href="' . esc_url( get_template_directory_uri() . '/assets/img/logo.png' ) . '">' . "\n";
	}
	echo '<meta name="description" content="Metal Nobre Joalheria: joias finas em ouro 18k teor 750, com autenticidade e garantia eterna. Há 20 anos no mercado.">' . "\n";
}
add_action( 'wp_head', 'metal_nobre_icone', 1 );

/** Aparência > Personalizar > Metal Nobre */
function metal_nobre_customizer( $wp_customize ) {
	$wp_customize->add_section( 'metal_nobre', array(
		'title'    => 'Metal Nobre',
		'priority' => 30,
	) );
	$campos = array(
		'mn_whatsapp'       => array( 'WhatsApp (só números, com 55 e DDD)', '556284307480', 'sanitize_text_field' ),
		'mn_whatsapp_texto' => array( 'WhatsApp como aparece no rodapé', '(62) 8430-7480', 'sanitize_text_field' ),
		'mn_instagram'      => array( 'Link do Instagram', 'https://www.instagram.com/metalnobrejoalheria/', 'esc_url_raw' ),
		'mn_qtd_inicio'     => array( 'Quantas peças mostrar na página inicial', 15, 'absint' ),
	);
	foreach ( $campos as $id => $c ) {
		$wp_customize->add_setting( $id, array( 'default' => $c[1], 'sanitize_callback' => $c[2] ) );
		$wp_customize->add_control( $id, array( 'label' => $c[0], 'section' => 'metal_nobre', 'type' => 'text' ) );
	}
}
add_action( 'customize_register', 'metal_nobre_customizer' );

/* ---------- área da loja: entrada protegida por login ---------- */
function metal_nobre_link_area() {
	$painel = admin_url( 'edit.php?post_type=mn_peca' );
	return is_user_logged_in() ? $painel : wp_login_url( $painel );
}

function metal_nobre_login_visual() {
	$logo = get_template_directory_uri() . '/assets/img/logo.png';
	?>
	<style>
		html, body.login { background: #141414; }
		body.login { background: #141414 radial-gradient(circle at 50% 0%, #2a2414 0, #141414 60%) no-repeat; min-height: 100vh; }
		body.login h1 a { background: url(<?php echo esc_url( $logo ); ?>) center / contain no-repeat; width: 130px; height: 130px; }
		body.login #loginform, body.login #lostpasswordform { background: #1c1c1c; border: 1px solid #3a3221; box-shadow: none; border-radius: 0; }
		body.login #loginform label, body.login #lostpasswordform label { color: #e8e1d3; }
		body.login #loginform .input, body.login #lostpasswordform .input { background: #111; border: 1px solid #3a3221; color: #f6f1e8; border-radius: 0; }
		body.login #loginform .input:focus, body.login #lostpasswordform .input:focus { border-color: #e4bf2f; box-shadow: 0 0 0 1px #e4bf2f; }
		body.login #loginform input[type=checkbox] { background: #111; border-color: #3a3221; }
		body.login.wp-core-ui .button-primary { background: #e4bf2f; border-color: #e4bf2f; color: #141414; border-radius: 0; text-transform: uppercase; letter-spacing: .12em; font-size: 12px; text-shadow: none; box-shadow: none; }
		body.login.wp-core-ui .button-primary:hover, body.login.wp-core-ui .button-primary:focus { background: #f0d25a; border-color: #f0d25a; color: #141414; }
		body.login #nav a, body.login #backtoblog a, body.login .privacy-policy-link { color: #b9b09c; }
		body.login #nav a:hover, body.login #backtoblog a:hover { color: #e4bf2f; }
		body.login .message, body.login .notice, body.login #login_error { background: #1c1c1c; color: #e8e1d3; border-left-color: #e4bf2f; }
		body.login .button.wp-hide-pw .dashicons { color: #e4bf2f; }
		body.login .language-switcher { display: none; }
	</style>
	<?php
}
add_action( 'login_enqueue_scripts', 'metal_nobre_login_visual' );
add_filter( 'login_headerurl', function () { return home_url( '/' ); } );
add_filter( 'login_headertext', function () { return 'Metal Nobre Joalheria'; } );
