<?php
require_once ('woocommerce/hooks.php');
// ================= ACTIONS ====================



// ================= ACTIONS FUNCSTIONS ====================
add_action( 'pre_get_posts', 'consultation_per_page' );
function consultation_per_page( $consultation ){
    if( !is_admin() && $consultation->is_main_query() && $consultation->is_post_type_archive('consultation')){
        $consultation->set( 'posts_per_page', 10 );
        $consultation->set( 'posts_per_archive_page', 10 );
    }
}

add_action( 'pre_get_posts', 'reviews_per_page' );
function reviews_per_page( $reviews ){
    if( !is_admin() && $reviews->is_main_query() && $reviews->is_post_type_archive('reviews')){
        $reviews->set( 'posts_per_page', 8 );
        $reviews->set( 'posts_per_archive_page', 8 );
    }
}

add_action( 'pre_get_posts', 'works_per_page' );
function works_per_page( $works ){
    if( !is_admin() && $works->is_main_query() && $works->is_post_type_archive('works')){
        $works->set( 'posts_per_page',12 );
        $works->set( 'posts_per_archive_page',12 );
    }
}


// ================= ФИЛЬТРЫ ====================


add_filter('excerpt_more', function($more) {
    return '...';
});
add_filter( 'excerpt_length', function(){
    return 25;
} );


// ================ FUNCSTIONS ===============

/*
  PAGINATION
*/
function pagination()
{
    global $wp_query;

    $prev = __('<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M17 12H7M7 12L11 16M7 12L11 8" stroke="#015C91" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
</svg>');
    $next = __('<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M7 12H17M17 12L13 8M17 12L13 16" stroke="#015C91" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
</svg>');

    $args = array(
        'total' => $wp_query->max_num_pages,
        'current' => max(1, get_query_var('paged')),
        'prev_text' => $prev,
        'next_text' => $next,
        'type' => 'array',
        'end_size' => 1,
        'mid_size' => 1,
    );

    $pag = paginate_links($args);

    if (isset($pag)) {
        if (get_query_var('paged') == 0) {
            array_unshift($pag, '<span class="prev page-numbers disabled">' . $prev . '</span>');
        }
        if ($wp_query->max_num_pages == get_query_var('paged')) {
            array_push($pag, '<span class="next page-numbers disabled">' . $next . '</span>');
        }
        $pag = preg_replace('~/page/1/?([\'"])~', '/"', $pag);

        echo '<div class="nav-links">' . implode("", $pag) . '</div>';
    }
}

/*------- ПОЛУЧЕНИЕ ФОРМЫ ----------*/

function get_form($formname = '', $params = []) {
	$echo = true;
	
	if(array_key_exists('echo', $params)) {
		$echo = $params['echo'];
	}
	
	if(!$formname) {
		if($echo === true) {
			echo 'Форма не найдена!';
			return;
		}else{
			return false;
		}
	}
	
	if($echo) {
		get_template_part('inc/parts/forms/form', $formname, $params);
	}else{
		ob_start();
		get_template_part('inc/parts/forms/form', $formname, $params);
		$out = ob_get_clean();
		return $out;
	}
}


/*-------- ПЕРЕВОД ПОЛЕЙ ---------*/

if( function_exists('GSE') ) {
    GSE()::add_translation('subject','Тема письма');
    GSE()::add_translation('your-name','Имя');
    GSE()::add_translation('your-tel','Телефон');
    GSE()::add_translation('quiz-data','Результаты квиза');
}




// ============== ADD THEME PAGE ===============

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'        => 'Параметры темы',
        'menu_title'        => 'Параметры темы',
        'menu_slug'         => 'gs-theme-params',
        'capability'        => 'manage_options',
        'parent_slug'       => 'themes.php',
        'icon_url'          => 'dashicons-location-alt',
        'redirect'          => false,
        'autoload'          => true,
        'update_button'     => 'Обновить',
        'updated_message'   => 'Параметры темы обновлены',
    ));
}


function theme($type)
{
    $setting = get_field($type,'options');
    if($setting)
    {
        return $setting;
    }
    else
    {
        return '';
    }
}




// =========== РЕГИСТРАЦИЯ БЛОКОВ ===============


add_filter('block_categories_all', 'add_blocks_category', 10 );

function add_blocks_category($categories)
{

    $categories[] = array(
        'slug'  => 'theme-blocks',
        'title' => 'Блоки темы',
        'icon'  => null,
    );

    return $categories;
}

function add_blocks()
{
    $ignore = array('.','..');
    $bpath = __DIR__.'/blocks/';
    $blocks = scandir($bpath);

    foreach ($blocks as $folder)
    {
        if(!in_array($folder, $ignore))
        {
            if(file_exists($bpath.$folder.'/index.php'))
            {
                    // $this->blocks[$folder] = require_once $bpath.$folder.'/index.php';
                require_once $bpath.$folder.'/index.php';

            }
        }
    }
}
add_blocks();

function wide_Setup() {
    add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'wide_Setup' );
