<?php
define('TEMPLATE_URI', get_stylesheet_directory_uri());
define('INCLUDE_DIR', TEMPLATEPATH . '/include/');
define('LANG_DIR', TEMPLATEPATH . '/languages');
define('IMAGES_URI', TEMPLATE_URI . '/img/');
define('ICONS_URI', IMAGES_URI . 'icons/');
require_once TEMPLATEPATH . '/vendor/autoload.php'; // Autoload files using Composer autoload

require_once INCLUDE_DIR . 'defines.php';
require_once INCLUDE_DIR . 'globals.php';
require_once INCLUDE_DIR . 'helpers.php';

require TEMPLATEPATH . '/shortcode/shortcode-functions.php';

require_once INCLUDE_DIR . 'scripts.php';

require_once INCLUDE_DIR . 'acf.php';
require_once INCLUDE_DIR . 'post-types.php';

add_action('wp_ajax_ask_question', 'ask_question');
add_action('wp_ajax_nopriv_ask_question', 'ask_question');
/**
 * Обработка скрипта
 *
 */
function ask_question() {

  // Массив ошибок
  $art_subject = 'Заявка с сайта prifinance';
  $err_message = array();
  $FIELD = array();

  parse_str($_POST['data'], $_POST['data']);
  // Проверяем nonce. Если проверкане прошла, то блокируем отправку
  if (!wp_verify_nonce($_POST['nonce'], 'main-nonce')) {
    wp_die('Данные отправлены с левого адреса');
  }

  if (empty($_POST['data']['private-policy'])) {
    wp_die($_POST['data']['email']);
  }

  // Проверяем полей темы письма, если пустое, то пишем сообщение по умолчанию
  if (empty($_POST['data']['phone']) || !isset($_POST['data']['phone'])) {
    $err_message['phone'] = 'Пожалуйста, введите ваше сообщение.';
  } else {
    $FIELD['phone'] = sanitize_text_field($_POST['data']['phone']);
  }

  // Проверяем полей емайла, если пустое, то пишем сообщение в массив ошибок
  if (empty($_POST['data']['email']) || !isset($_POST['data']['email'])) {
    $err_message['email'] = 'Пожалуйста, введите адрес вашей электронной почты.';
  } elseif (!preg_match('/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i', $_POST['data']['email'])) {
    $err_message['email'] = 'Адрес электронной почты некорректный.';
  } else {
    $FIELD['email'] = sanitize_email($_POST['data']['email']);

  }

//	проверка на номер и емейл конец-----


//	дополнительные поля ----------------------------------------

  if (isset($_POST['data']['message']) || !empty($_POST['data']['message'])) {
    $FIELD['message'] = sanitize_textarea_field($_POST['data']['country']);
  }

  if (isset($_POST['data']['country']) || !empty($_POST['data']['country'])) {
    $FIELD['country'] = $_POST['data']['country'];
  }

  if (isset($_POST['data']['type-service']) || !empty($_POST['data']['type-service'])) {
    $FIELD['type-service'] = $_POST['data']['type-service'];
  }

  //	дополнительные поля end ----------------------------------------

  // Проверяем массив ошибок, если не пустой, то передаем сообщение. Иначе отправляем письмо
  if ($err_message) {

    wp_send_json_error($err_message);

  } else {

    // Указываем адресата
    $email_to = 'nessq95@gmail.com';

    // Если адресат не указан, то берем данные из настроек сайта
    if (!$email_to) {
      $email_to = get_option('admin_email');
    }
    $body = '';
    foreach ($FIELD as $key => $value) {
      $body .= $key . ': ' . $value . "\n";
    }

    $headers[] = 'Content-type: text/html; charset=utf-8';
    $headers[] = 'From: ' . $FIELD['email'] . ' <' . $email_to . '>' . "\r\n" . 'Reply-To: ' . $email_to;


    // Отправляем письмо
    wp_mail($email_to, $art_subject, $body, $headers);

    // Отправляем сообщение об успешной отправке
    $message_success = 'Собщение отправлено. В ближайшее время мы свяжемся с вами.';
    wp_send_json_success($message_success);
  }

  // На всякий случай убиваем еще раз процесс ajax
  wp_die();

}

add_action('wp_ajax_load_more', 'load_more');
add_action('wp_ajax_nopriv_load_more', 'load_more');

function load_more() {
  error_reporting(E_ALL);
  @ini_set('display_errors', 1);
  $posts = get_media_items_query($_POST['limit']);
  $items = get_press_media_items($posts);
  $listItems = '';
  foreach ($items as $item) {
    $listItems .= getMediaLi($item);
  }
  echo $listItems;
  wp_die();
}

class True_Walker_Nav_Menu extends Walker_Nav_Menu {
  /*
   * Позволяет перезаписать <ul class="sub-menu">
   */
  function start_lvl(&$output, $depth = 0, $args = NULL) {
    // для WordPress 5.3+
    // function start_lvl( &$output, $depth = 0, $args = NULL ) {
    /*
     * $depth – уровень вложенности, например 2,3 и т д
     */
    $output .= '<ul class="mm-collapse inner-list list-unstyled list-inline mb-0 sub-ul">';
  }

  /**
   * @param string $output
   * @param object $item Объект элемента меню, подробнее ниже.
   * @param int $depth Уровень вложенности элемента меню.
   * @param object $args Параметры функции wp_nav_menu
   * @see Walker::start_el()
   * @since 3.0.0
   *
   */
  function start_el(&$output, $item, $depth = 0, $args = NULL, $id = 0) {
    // для WordPress 5.3+
    // function start_el( &$output, $item, $depth = 0, $args = NULL, $id = 0 ) {
    global $wp_query;
    /*
     * Некоторые из параметров объекта $item
     * ID - ID самого элемента меню, а не объекта на который он ссылается
     * menu_item_parent - ID родительского элемента меню
     * classes - массив классов элемента меню
     * post_date - дата добавления
     * post_modified - дата последнего изменения
     * post_author - ID пользователя, добавившего этот элемент меню
     * title - заголовок элемента меню
     * url - ссылка
     * attr_title - HTML-атрибут title ссылки
     * xfn - атрибут rel
     * target - атрибут target
     * current - равен 1, если является текущим элементом
     * current_item_ancestor - равен 1, если текущим (открытым на сайте) является вложенный элемент данного
     * current_item_parent - равен 1, если текущим (открытым на сайте) является родительский элемент данного
     * menu_order - порядок в меню
     * object_id - ID объекта меню
     * type - тип объекта меню (таксономия, пост, произвольно)
     * object - какая это таксономия / какой тип поста (page /category / post_tag и т д)
     * type_label - название данного типа с локализацией (Рубрика, Страница)
     * post_parent - ID родительского поста / категории
     * post_title - заголовок, который был у поста, когда он был добавлен в меню
     * post_name - ярлык, который был у поста при его добавлении в меню
     */
    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    /*
     * Генерируем строку с CSS-классами элемента меню
     */
    $class_names = $value = '';
    $classes = empty($item->classes) ? array() : (array)$item->classes;
    $classes[] = 'menu-item-' . $item->ID;

    // функция join превращает массив в строку
    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    /*
     * Генерируем ID элемента
     */
    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';


    /*
     * Генерируем элемент меню
     */
    if ($depth == 0) {
      $output .= $indent . '<li' . $id . $value . $class_names . '>';
    } else {
      $output .= $indent . '<li' . $id . $value . ' class="sub-li">';
    }

    // атрибуты элемента, title="", rel="", target="" и href=""
    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    // ссылка и околоссылочный текст
    $item_output = $args->before;

    $item_output .= '<a class="' . (($item->url === '#') ? "has-arrow link-child-menu " : '') . 'text-decoration-none ' . (($item->current) ? "active" : '') . '"' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    if ($args->walker->has_children && $item->url !== '#') {
      $item_output .= '<p class="has-arrow link-child-menu"></p>';
    }
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}


add_filter('gettext', 'change_post_name');
add_filter('ngettext', 'change_post_name');
function change_post_name($translated) {
  $translated = str_ireplace('Записи', 'Компании', $translated);
  return $translated;
}

function change_post_menu_label() {
  global $menu, $submenu;
  $menu[5][0] = 'Компании';
  $submenu['edit.php'][5][0] = 'Компании';
  $submenu['edit.php'][10][0] = 'Добавить Компанию';
  $submenu['edit.php'][16][0] = 'Mетки компаний';
  $submenu['edit.php'][15][0] = 'Категории компаний';
  echo '';

}

add_action('admin_menu', 'change_post_menu_label');
function change_post_object_label() {
  global $wp_post_types;
  $labels = &$wp_post_types['post']->labels;
  $labels->name = 'Компании';
  $labels->singular_name = 'Компании';
  $labels->add_new = 'Добавить Компанию';
  $labels->add_new_item = 'Добавить Компанию';
  $labels->edit_item = 'Редактировать Компанию';
  $labels->new_item = 'Добавить Компанию';
  $labels->view_item = 'Посмотреть Компанию';
  $labels->search_items = 'Найти Компанию';
  $labels->not_found = 'Не найдено';
  $labels->not_found_in_trash = 'Корзина пуста';
}

add_action('init', 'change_post_object_label');


load_theme_textdomain('prifinance', LANG_DIR);

add_filter('upload_mimes', 'svg_upload_allow');

# Добавляет SVG в список разрешенных для загрузки файлов.
function svg_upload_allow($mimes) {
  $mimes['svg'] = 'image/svg+xml';

  return $mimes;
}

add_filter('wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5);

# Исправление MIME типа для SVG файлов.
function fix_svg_mime_type($data, $file, $filename, $mimes, $real_mime = '') {

  // WP 5.1 +
  if (version_compare($GLOBALS['wp_version'], '5.1.0', '>='))
    $dosvg = in_array($real_mime, ['image/svg', 'image/svg+xml']);
  else
    $dosvg = ('.svg' === strtolower(substr($filename, -4)));

  // mime тип был обнулен, поправим его
  // а также проверим право пользователя
  if ($dosvg) {

    // разрешим
    if (current_user_can('manage_options')) {

      $data['ext'] = 'svg';
      $data['type'] = 'image/svg+xml';
    } // запретим
    else {
      $data['ext'] = $type_and_ext['type'] = false;
    }

  }

  return $data;
}

add_filter('wp_prepare_attachment_for_js', 'show_svg_in_media_library');

# Формирует данные для отображения SVG как изображения в медиабиблиотеке.
function show_svg_in_media_library($response) {

  if ($response['mime'] === 'image/svg+xml') {

    // С выводом названия файла
    $response['image'] = [
      'src' => $response['url'],
    ];
  }

  return $response;
}


add_action('after_setup_theme', 'theme_register_nav_menu');
function theme_register_nav_menu() {
  register_nav_menu('primary', 'Primary Menu');
  register_nav_menu('primary-en', 'Primary Menu eng');
}


function add_menu_link_class($atts, $item, $args) {
  if (property_exists($args, 'link_class')) {
    $atts['class'] = $args->link_class;
  }
  return $atts;
}

add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);

function add_menu_list_item_class($classes, $item, $args) {
  if (property_exists($args, 'list_item_class')) {
    $classes[] = $args->list_item_class;
  }
  return $classes;
}

add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);


// my own function to do what get_category_parents does for other taxonomies
function get_taxonomy_parents($id, $taxonomy, $link = false, $separator = '/', $nicename = false, $visited = array()) {
  $chain = '';
  $parent = get_term($id, $taxonomy);

  if (is_wp_error($parent)) {
    return $parent;
  }

  if ($nicename)
    $name = $parent->slug;
  else
    $name = $parent->name;

  if ($parent->parent && ($parent->parent != $parent->term_id) && !in_array($parent->parent, $visited)) {
    $visited[] = $parent->parent;
    $chain .= get_taxonomy_parents($parent->parent, $taxonomy, $link, $separator, $nicename, $visited);

  }

  if ($link) {
    // nothing, can't get this working :(
  } else
    $chain .= $name . $separator;
  return $chain;
}


//add ID body
function body_id_dynamic() {

  if (
    (is_page_template('templates/page-banks.php')
      || is_404()
      || is_tax('banks')
      || is_singular('bank-account')
      || is_singular('post')
      || is_page_template('templates/page-company.php')
      || is_category()
      || is_post_type_archive('fondi-i-trusti')
      || is_post_type_archive('vnzhpost')
      || is_page_template('templates/page-consultation.php')
      || is_page_template('templates/page-license.php')
      || is_page_template('default'))
    && !is_front_page()
  ) {

    echo ' id="bankacc" ';

  };

  if (is_singular('fondi-i-trusti')) {
    echo 'id="foundinner" ';
  }

  if (
    is_page_template('templates/page-about-us.php')
    || is_page_template('templates/page-contact.php')

  ) {
    echo 'id="about" ';
  }

  if (is_page_template('templates/page-crypto-consalting.php')) {
    echo 'id="ico" ';
  }

  if (is_page_template('templates/page-fintech.php')) {
    echo 'id="ico" ';
  }
  if (is_page_template('templates/page-aml.php')) {
    echo 'id="ico" ';
  }

  if (is_page_template('templates/page-presscentr.php')) {
    echo 'id="press" ';
  }

}

//add CLASS body
add_filter('body_class', 'my_body_classes');
function my_body_classes($classes) {

  if (is_singular('bank-account')) {

    $classes[] = 'onebank';

  }




  if (is_page_template('templates/page-consultation.php')) {
    $classes[] = 'consultation';
  }


  if (is_page_template('templates/page-aml.php')) {
    $classes[] = 'ftone';
  }


  return $classes;

}

// CATEGORY AND TAX START-------------!------------!-------------!------------!----------!----------!--------!

function cptui_register_my_cpts_reg_company() {

  /**
   * Post Type: Регистрация компаний.
   */

  $labels = [
    "name" => __("Банк", "prifinance"),
    "singular_name" => __("Банк", "prifinance"),
  ];

  $args = [
    "label" => __("Банк", "prifinance"),
    "labels" => $labels,
    'menu_position' => 6,
    'public' => true,
    'hierarchical' => true,
    'has_archive' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array(
      'slug' => 'bank-account/%banks%',
      'with_front' => false,
    ),
    "menu_icon" => "dashicons-groups",
    "supports" => ["title", "editor", "thumbnail"],
    "taxonomies" => ["banks"],
  ];

  register_post_type("bank-account", $args);
}

add_action('init', 'cptui_register_my_cpts_reg_company');


function cptui_register_my_taxes_category_company() {

  /**
   * Taxonomy: Категория компаний.
   */

  $labels = [
    "name" => __("Категория банка", "prifinance"),
    "singular_name" => __("Категория банка", "prifinance"),
  ];

  $args = [
    "label" => __("Категория банка", "prifinance"),
    "labels" => $labels,
    'hierarchical' => true,
    'rewrite' => array(
      'slug' => 'bank-account',
      'with_front' => false,
    ),
  ];
  register_taxonomy("banks", ["bank-account"], $args);
}

add_action('init', 'cptui_register_my_taxes_category_company');

function filter_post_type_link($link, $post) {
  if ($post->post_type != 'bank-account')
    return $link;

  if ($cats = get_the_terms($post->ID, 'banks')) {
    $link = str_replace('%banks%/', get_taxonomy_parents(array_pop($cats)->term_id, 'banks', false, '/', true), $link); // see custom function defined below
  }
  return $link;
}

add_filter('post_type_link', 'filter_post_type_link', 10, 2);

// CATEGORY AND TAX ENDDDDDDD================================================================================


// CATEGORY AND TAX START-------------!------------!-------------!------------!----------!----------!--------!

function cptui_register_my_cpts_reg_fondi() {

  /**
   * Post Type: Регистрация компаний.
   */

  $labels = [
    "name" => __("Фонды и трасты", "prifinance"),
    "singular_name" => __("Фонды и трасты", "prifinance"),
  ];

  $args = [
    "label" => __("Фонды и трасты", "prifinance"),
    "labels" => $labels,
    'menu_position' => 7,
    'public' => true,
    'hierarchical' => true,
    'has_archive' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array(
      'slug' => 'fondi-i-trusti',
      'with_front' => false,
    ),
    "menu_icon" => "dashicons-groups",
    "supports" => ["title", "editor", "thumbnail"],
    "taxonomies" => ["fondi"],

  ];

  register_post_type("fondi-i-trusti", $args);
}

add_action('init', 'cptui_register_my_cpts_reg_fondi');


function cptui_register_my_taxes_category_fondi() {

  /**
   * Taxonomy: Категория компаний.
   */

  $labels = [
    "name" => __("Категории Фондов и трастов", "prifinance"),
    "singular_name" => __("Категория фонда и траста", "prifinance"),
  ];

  $args = [
    "label" => __("Категория фонда и траста", "prifinance"),
    "labels" => $labels,
    'hierarchical' => true,
    'rewrite' => array(
      'slug' => 'fondi-i-trusti',
      'with_front' => false,
    ),
    'default_term' => [ //(string|array) Default term to be used for the taxonomy.
      'name' => 'fondi-i-trusti', //(string) Name of default term.
      'slug' => 'fondi-i-trusti', //(string) Slug for default term.
      'description' => '', //(string) Description for default term.
    ],
  ];
  register_taxonomy("fondi", ["fondi-i-trusti"], $args);
}

add_action('init', 'cptui_register_my_taxes_category_fondi');

function filter_post_type_link_fondi($link, $post) {
  if ($post->post_type != 'fondi-i-trusti')
    return $link;

  if ($cats = get_the_terms($post->ID, 'fondi')) {
    $link = str_replace('%fondi%/', get_taxonomy_parents(array_pop($cats)->term_id, 'fondi', false, '/', true), $link); // see custom function defined below
  }
  return $link;
}

add_filter('post_type_link', 'filter_post_type_link_fondi', 10, 2);

// CATEGORY AND TAX ENDDDDDDD================================================================================


// CATEGORY AND TAX START-------------!------------!-------------!------------!----------!----------!--------!

function cptui_register_my_cpts_reg_vnzhpost() {

  /**
   * Post Type: Регистрация компаний.
   */

  $labels = [
    "name" => __("Residence permit in various countries", "prifinance"),
    "singular_name" => __("Residence permit in various countries", "prifinance"),
  ];

  $args = [
    "label" => __("Residence permit in various countries", "prifinance"),
    "labels" => $labels,
    'menu_position' => 7,
    'public' => true,
    'hierarchical' => true,
    'has_archive' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array(
      'slug' => 'vnzh',
      'with_front' => false,
    ),
    "menu_icon" => "dashicons-groups",
    "supports" => ["title", "editor", "thumbnail"],
    "taxonomies" => ["vnzh"],

  ];

  register_post_type("vnzhpost", $args);
}

add_action('init', 'cptui_register_my_cpts_reg_vnzhpost');


function cptui_register_my_taxes_category_vnzh() {

  /**
   * Taxonomy: Категория компаний.
   */

  $labels = [
    "name" => __("Категории ВНЖ и гражданство", "prifinance"),
    "singular_name" => __("Категория ВНЖ и гражданства", "prifinance"),
  ];

  $args = [
    "label" => __("Категория ВНЖ и гражданства", "prifinance"),
    "labels" => $labels,
    'hierarchical' => true,
    'rewrite' => array(
      'slug' => 'vnzh',
      'with_front' => false,
    ),
    'default_term' => [ //(string|array) Default term to be used for the taxonomy.
      'name' => 'vnzh', //(string) Name of default term.
      'slug' => 'vnzh', //(string) Slug for default term.
      'description' => '', //(string) Description for default term.
    ],
  ];
  register_taxonomy("vnzh", ["vnzhpost"], $args);
}

add_action('init', 'cptui_register_my_taxes_category_vnzh');

function filter_post_type_link_vnzh($link, $post) {
  if ($post->post_type != 'vnzhpost')
    return $link;

  if ($cats = get_the_terms($post->ID, 'vnzh')) {
    $link = str_replace('%vnzh%/', get_taxonomy_parents(array_pop($cats)->term_id, 'vnzh', false, '/', true), $link); // see custom function defined below
  }
  return $link;
}

add_filter('post_type_link', 'filter_post_type_link_vnzh', 10, 2);

// CATEGORY AND TAX ENDDDDDDD================================================================================


// CATEGORY AND TAX START-------------!------------!-------------!------------!----------!----------!--------!

function cptui_register_my_cpts_reg_licensepost() {

  /**
   * Post Type: Регистрация компаний.
   */

  $labels = [
    "name" => __("Получение лицензий", "prifinance"),
    "singular_name" => __("Получение лицензий", "prifinance"),
  ];

  $args = [
    "label" => __("Получение лицензий", "prifinance"),
    "labels" => $labels,
    'menu_position' => 8,
    'public' => true,
    'hierarchical' => true,
    'has_archive' => '%licensetax%',
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array(
      'slug' => 'licensepost',
      'with_front' => false,
    ),
    "menu_icon" => "dashicons-groups",
    "supports" => ["title", "editor", "thumbnail"],
    "taxonomies" => ["licensetax"],

  ];

  register_post_type("licensepost", $args);
}

add_action('init', 'cptui_register_my_cpts_reg_licensepost');


function cptui_register_my_taxes_category_licensetax() {

  /**
   * Taxonomy: Категория компаний.
   */

  $labels = [
    "name" => __("Категории лицензий", "prifinance"),
    "singular_name" => __("Категория лицензии", "prifinance"),
  ];

  $args = [
    "label" => __("Категория лицензии", "prifinance"),
    "labels" => $labels,
    'hierarchical' => true,
    'rewrite' => array(
      'slug' => 'licensetax',
      'with_front' => false,
    ),

  ];
  register_taxonomy("licensetax", ["licensepost"], $args);
}

add_action('init', 'cptui_register_my_taxes_category_licensetax');


// CATEGORY AND TAX ENDDDDDDD================================================================================


add_action('admin_head', 'hidden_term_description');

function hidden_term_description() {
  print '<style>
.term-description-wrap { display:none; }
</style>';
}


add_action('pre_get_posts', 'exclude_this_page');
function exclude_this_page($query) {
  if (!is_admin())
    return $query;
  global $pagenow;
  if ('edit.php' == $pagenow && (get_query_var('post_type') && 'page' == get_query_var('post_type')))
    $query->set('post__not_in', array(767, 764, 762, 765, 768, 766, 630, 3065, 3067, 3059, 3057, 3066, 3068, 3053));
  return $query;
}


 //if ( !function_exists( 'add_page_number' ))
//{
    function add_page_number( $p )
    {
        global $page;
        $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
        ! empty ( $page ) && 1 < $page && $paged = $page;

        // $paged > 1 && $p .= ' | ' . sprintf( __( ' | страница %s' ), $paged );
        // return $p;

        if($paged>1) {

        return $p.' | ' . sprintf( __( ' %s' ), $paged );
        } else {
        	return $p;
        }

    }


  //  add_filter( 'wpseo_title', 'add_page_number', 100, 1 );
	//add_filter( 'wpseo_metadesc', 'add_page_number', 100, 1 );

//}



    function fondiitrusti_vnzhpost_title($title)
    {
        if((get_query_var('post_type')=='fondi-i-trusti') and (get_queried_object_id()==0))
		{
			$title="Создание фондов и трастов в разных странах | Прифинанс";
		}
		 if((get_query_var('post_type')=='vnzhpost') and (get_queried_object_id()==0))
		{
			$title="Получение вида на жительство в разных странах | Прифинанс";
		}
		return add_page_number($title);
    }

	function fondiitrusti_vnzhpost_meta($meta)
    {
        if((get_query_var('post_type')=='fondi-i-trusti') and (get_queried_object_id()==0))
		{
			$meta="Услуги по созданию фондов и трастов в разных странах. Компания Прифинанс: помощь при регистрации фондов и трастов, короткие сроки. Звоните: ☎️ +372 699-15-65.";
		}

		if((get_query_var('post_type')=='vnzhpost') and (get_queried_object_id()==0))
		{
			$meta="Получение гражданства в разных странах за инвестиции. Компания Прифинанс: помощь в оформлении паспорта через инвестиции, короткие сроки. Звоните: ☎️ +372 699-15-65.";
		}

		return add_page_number($meta);
    }


    add_filter( 'wpseo_title', 'fondiitrusti_vnzhpost_title', 110, 1 );
	add_filter( 'wpseo_metadesc', 'fondiitrusti_vnzhpost_meta', 110, 1 );



add_filter( 'wpseo_next_rel_link', '__return_false' );
add_filter( 'wpseo_prev_rel_link', '__return_false' );



add_filter( 'walker_nav_menu_start_el', 'my_walker_nav_menu_start_el', 10, 4 );
function my_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {
    if ( empty( $item->url ) || '#' === $item->url ) {
        $item_output = $args->before;
        $item_output .= '<span class="has-arrow link-child-menu text-decoration-none ">';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</span>';
        $item_output .= $args->after;
    }
    return $item_output;
}



add_filter( 'wpml_hreflangs', 'wpml_hreflangs_function', 10, 1);


function wpml_hreflangs_function( $hreflang_items ) {
  
  $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  //var_dump($hreflang_items );

  if ( is_array( $hreflang_items ) ) {


    foreach ($hreflang_items as $key => $hreflang_url) {
        $pos1 = strpos($actual_link, "/en/");
        $pos2 = strpos($hreflang_url, "/en/");      
    

      if ($pos1 === $pos2) {
        $hreflang_items[$key]=$actual_link;
      }else
      {
        unset($hreflang_items[$key]);
      }
  }
	return $hreflang_items;
}
}
?>
