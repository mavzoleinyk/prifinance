<?php //echo get_locale();
$all_languages = apply_filters('wpml_active_languages', NULL, 'skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');
?>


<nav class="top-nav">
  <div class="container-xxl">
    <div class="row justify-content-center">
      <div class="col-xxl-10">
        <div class="row align-items-center g-0">
          <div class="col-auto">
            <div class="lang-menu">
              <ul class="metismenu list-unstyled" id="menuLanguage">
                <li>
                  <?php foreach ($all_languages as $l) {
                    if ($l['active']) {
                      echo '<a class="has-arrow text-decoration-none" href="/" aria-expanded="false">' . $l['code'] . '</a>';
                      //echo '<span class="has-arrow text-decoration-none" aria-expanded="false">' . $l['code'] . '</span>';
                      $curntL=$l['code'];
                    }
                  } ?>

                  <ul class="mm-collapse list-unstyled">
                    <?php foreach ($all_languages as $l) {
                      if($curntL!=$l['code'])
                      {
                      echo '<li><a href="' . $l['url'] . '" class="text-decoration-none lang" data-lang="' . $l['code'] . '">' . $l['code'] . '</a></li>';
                    }
                    } ?>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-auto d-none d-xl-block">
            <div class="call-us text-uppercase">
              <?php the_field('top-nav_tel', icl_object_id(427, 'page', true)) ?>
            </div>
          </div>
          <div class="col-auto ms-auto">
            <ul class="social list-unstyled list-inline mb-0">

              <?php if (have_rows('top-nav_socials', icl_object_id(427, 'page', true))): while (have_rows('top-nav_socials', icl_object_id(427, 'page', true))) : the_row(); ?>
                <li class="list-inline-item"><a
                    href="<?php the_sub_field('link', icl_object_id(427, 'page', true)); ?>"><img
                      src="<?php the_sub_field('icon', icl_object_id(427, 'page', true)); ?>" alt=""></a></li>
              <?php endwhile; else : endif; ?>

            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>
