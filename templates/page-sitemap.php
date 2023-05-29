<?php
/*
Template Name: Page - Sitemap
Template Post Type: page
*/
get_header();
get_template_part('parts/hero');
?>
<section class="main">
  <div class="content">
      <h1><?= get_the_title() ?></h1>
      <ul class="sitemap-list">
          <?php
          foreach (get_post_type_names() as $post_type => $name) {
              wp_list_pages([
                  'title_li' => $name,
                  'post_type' => $post_type
              ]);
          }
          ?>
      </ul>
  </div>
</section>
<?php get_footer();
