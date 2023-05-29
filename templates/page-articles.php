<?php
/*
Template Name: Page - Articles
Template Post Type: page
*/
?>
<?php get_header();  ?>
<div class="hero">
  
  <?php get_template_part('include/top-nav'); ?>

  <div class="container-xxl">
    <div class="row justify-content-center">
      <div class="col-xxl-10 mx-auto">

        <header class="d-none d-xl-block-custom">
          <?php get_template_part('include/top-nav-second'); ?>
          <?php get_template_part('include/top-nav-menu'); ?>
        </header>

        <header class="d-xl-none-custom">
          <?php get_template_part('include/top-nav-menu_mobile'); ?>
        </header>
      </div>
    </div>
  </div>
</div>
<section class="search-component-section">
  <div class="container-xxl">
    <div class="header-circle">
      <div class="circle bg-light"></div>
    </div>
    <h3><?php _e('Search', 'prifinance') ?></h3>
    <div class="content search-component">
      <div class="form-input">
        <form action="<?= home_url( $GLOBALS['wp']->request ) ?>" method="get">
          <input type="search" class="form-control" name="query" id="search" value="<?= $_GET['query'] ?? '' ?>"
                 placeholder="<?= __('Enter your request', 'prifinance') ?>">
        </form>
      </div>
    </div>
  </div>
</section>
<section class="main">
  <div class="content-wrap">
    <div class="header-circle">
      <div class="circle bg-light"></div>
    </div>
    <h1 class="the_title" style="margin-bottom: 62px;"><?php _e('Articles', 'prifinance') ?></h1>
    <div class="content">
      <div class="articles-list">
        <?php
        $page = get_requested_page();
        $limit = 10;
        $slugToKeep = 'nalogooblozhenie';
        $ignoreSlugs = array_filter( array_map(function($term) use ($slugToKeep) {
          return ($term->slug == $slugToKeep) ? false : $term->slug;
        }, get_terms('licensetax')) );
        $query = new WP_Query([
          's' => $_GET['query'] ?? '',
          'post_type' => ['articles', 'licensepost'],
          'tax_query' => array(
              array(
                  'taxonomy' => 'licensetax',
                  'field' => 'slug',
                  'terms' => $ignoreSlugs,
                  'operator' => 'NOT IN'
              ),
          ),
          'order' => 'DESC',
          'orderby' => ['type' => 'ASC'],
          'posts_per_page' => $limit,
          'paged' => $page,
        ]);
        $count = $query->found_posts;
        $last_page = $query->max_num_pages;
        if ($query->have_posts()): while ($query->have_posts()) : $query->the_post(); ?>
          <li class="articles-list-item">
            <a href="<?= get_post_permalink() ?>"><?php the_title(); ?></a>
          </li>
        <?php endwhile;
          wp_reset_postdata(); elseif (isset($_GET['query'])): ?>
          <p><?= sprintf(__("No result found by query %s"), '<b>' . $_GET['query'] . '</b>') ?></p>
        <?php endif;
        ?>
        <?php get_template_part('include/feature-pagination', null, ['last_page' => $last_page]) ?>
      </div>
    </div>
    <div class="content-text">
      <?php the_content(); ?>
    </div>
  </div>
  <aside class="sidebar">
    <?php get_template_part('include/bankform') ?>
  </aside>
</section>
<?php get_template_part('include/block-payment'); ?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function () {
        $("#accordion").accordion({
            active: false,
            collapsible: true,
            heightStyle: "content"

        });
    });
</script>
<?php get_footer(); ?>
