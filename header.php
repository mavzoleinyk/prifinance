<?php
//if ( $_SERVER['REQUEST_URI'] != strtolower( $_SERVER['REQUEST_URI']) ) {
//    header('Location: //'.$_SERVER['HTTP_HOST'] . strtolower($_SERVER['REQUEST_URI']), true, 301);
//    exit();
//}

$lastUrlS=substr($_SERVER['REQUEST_URI'], -1);
if(($lastUrlS!="/") and (strpos($_SERVER['REQUEST_URI'], 'page=') == false) and (strpos($_SERVER['REQUEST_URI'], 'gclid=') == false))
{
 header('Location: //'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '/', true, 301);
    exit();
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php wp_title(); ?></title>

  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/app.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/tingle.min.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/theme-style.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= ICONS_URI ?>apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= ICONS_URI ?>favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= ICONS_URI ?>favicon-16x16.png">
  <link rel="manifest" href="<?= ICONS_URI ?>site.webmanifest">
  <link rel="mask-icon" href="<?= ICONS_URI ?>safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="<?= ICONS_URI ?>favicon.ico">
  <meta name="msapplication-TileColor" content="#603cba">
  <meta name="msapplication-config" content="<?= ICONS_URI ?>browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
  <?php
  $active_languages = apply_filters('wpml_active_languages', null);
  $switch_lang = $_GET['switch_lang'] ?? '';
  ?>
  <script>
      function validURL(str) {
          var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
              '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
              '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
              '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
              '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
              '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
          return !!pattern.test(str);
      }

      let redirectUrl = "<?= getRedirectUrl() ?>";
      let currentUrl = window.location.origin + window.location.pathname;
      let switch_lang = "<?= $switch_lang ?>";
      let active_languages = <?= json_encode($active_languages) ?>;

      let storageLanguage = localStorage.getItem('selected_language');

      if (switch_lang) {
        let selectedLanguage = active_languages[switch_lang];

        if (!!selectedLanguage){
          localStorage.setItem('selected_language', switch_lang);

          if (selectedLanguage?.active != "1") {
            redirectUrl = active_languages[switch_lang]['url'];
          } else {
            redirectUrl = '';
          }
        } else {
          redirectUrl = active_languages['en']['url'];
        }
      }


      if (validURL(redirectUrl) && currentUrl != redirectUrl && (!storageLanguage)) {
        window.location = redirectUrl;
      }

  </script>

  <?php wp_head(); ?>

  <script>
      var getLangCode = '<?php echo ICL_LANGUAGE_CODE; ?>';
  </script>

  <!-- INTEGRATION -->
  <?php
  if ($_SERVER['REMOTE_ADDR'] !== '127.0.0.1') {
    if (get_locale() == 'ru_RU') {
      ?>
      <script src="//code-eu1.jivosite.com/widget/fi33cJC0SO" async></script><?php
    } else {
      ?>
      <script src="//code-eu1.jivosite.com/widget/o2pSGuh9Wy" async></script><?php
    }
  }
  ?>


  <!-- BEGIN JIVOSITE INTEGRATION WITH ROISTAT -->
  <script type='text/javascript'>
      var getCookie = window.getCookie = function (name) {
          var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
          return matches ? decodeURIComponent(matches[1]) : undefined;
      };

      function jivo_onLoadCallback() {
          jivo_api.setUserToken(getCookie('roistat_visit'));
      }
  </script>
  <!-- END JIVOSITE INTEGRATION WITH ROISTAT -->

  <!-- Google Tag Manager -->
  <script>(function (w, d, s, l, i) {
          w[l] = w[l] || [];
          w[l].push({
              'gtm.start':
                  new Date().getTime(), event: 'gtm.js'
          });
          var f = d.getElementsByTagName(s)[0],
              j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
          j.async = true;
          j.src =
              'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
          f.parentNode.insertBefore(j, f);
      })(window, document, 'script', 'dataLayer', 'GTM-KRHQQPJ');</script>
  <!-- End Google Tag Manager -->


  <style>
	  #error404 .hero{
  background-image: url(../img/about-hero-bg.png)!important;
}
	  </style>
</head>
<?php

?>
<body <?php body_id_dynamic();
body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript>
  <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KRHQQPJ"
          height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<?php wp_body_open(); ?>
