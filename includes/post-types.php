<?php
/**
 * Register Custom Post Type for Quotes.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function rlq_register_quotes_cpt() {
	$labels = array(
		'name'                  => _x( 'Quotes', 'Post Type General Name', 'rlq-quotes-cpt' ),
		'singular_name'         => _x( 'Quote', 'Post Type Singular Name', 'rlq-quotes-cpt' ),
		'menu_name'             => __( 'Quotes', 'rlq-quotes-cpt' ),
		'name_admin_bar'        => __( 'Quote', 'rlq-quotes-cpt' ),
		'archives'              => __( 'Arquivos de Quote', 'rlq-quotes-cpt' ),
		'attributes'            => __( 'Atributos de Quote', 'rlq-quotes-cpt' ),
		'parent_item_colon'     => __( 'Quote Pai:', 'rlq-quotes-cpt' ),
		'all_items'             => __( 'Todos os Quotes', 'rlq-quotes-cpt' ),
		'add_new_item'          => __( 'Adicionar Novo Quote', 'rlq-quotes-cpt' ),
		'add_new'               => __( 'Adicionar Novo', 'rlq-quotes-cpt' ),
		'new_item'              => __( 'Novo Quote', 'rlq-quotes-cpt' ),
		'edit_item'             => __( 'Editar Quote', 'rlq-quotes-cpt' ),
		'update_item'           => __( 'Atualizar Quote', 'rlq-quotes-cpt' ),
		'view_item'             => __( 'Ver Quote', 'rlq-quotes-cpt' ),
		'view_items'            => __( 'Ver Quotes', 'rlq-quotes-cpt' ),
		'search_items'          => __( 'Procurar Quote', 'rlq-quotes-cpt' ),
		'not_found'             => __( 'Não encontrado', 'rlq-quotes-cpt' ),
		'not_found_in_trash'    => __( 'Não encontrado na lixeira', 'rlq-quotes-cpt' ),
		'featured_image'        => __( 'Imagem Destacada', 'rlq-quotes-cpt' ),
		'set_featured_image'    => __( 'Definir imagem destacada', 'rlq-quotes-cpt' ),
		'remove_featured_image' => __( 'Remover imagem destacada', 'rlq-quotes-cpt' ),
		'use_featured_image'    => __( 'Usar como imagem destacada', 'rlq-quotes-cpt' ),
		'insert_into_item'      => __( 'Inserir no Quote', 'rlq-quotes-cpt' ),
		'uploaded_to_this_item' => __( 'Carregado para este Quote', 'rlq-quotes-cpt' ),
		'items_list'            => __( 'Lista de Quotes', 'rlq-quotes-cpt' ),
		'items_list_navigation' => __( 'Navegação da lista de Quotes', 'rlq-quotes-cpt' ),
		'filter_items_list'     => __( 'Filtrar lista de Quotes', 'rlq-quotes-cpt' ),
	);
	$args = array(
		'label'                 => __( 'Quote', 'rlq-quotes-cpt' ),
		'description'           => __( 'Custom Post Type para Quotes', 'rlq-quotes-cpt' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ), // 'editor' is for full description
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-quote',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'rlq_quote', $args );
}
add_action( 'init', 'rlq_register_quotes_cpt', 0 );
