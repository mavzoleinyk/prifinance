<?php get_header(); ?>

<div class="hero">
  <?php get_template_part('include/top-nav'); ?>
  <div class="container-xxl">
    <div class="row justify-content-center">
      <div class="col-xxl-10 mx-auto">
        <header class="d-none d-xl-block">
          <?php get_template_part('include/top-nav-second'); ?>
          <?php get_template_part('include/top-nav-menu'); ?>
        </header>
        <header class="d-xl-none">
          <?php get_template_part('include/top-nav-menu_mobile'); ?>
        </header>
      </div>
    </div>
  </div>
</div>

<?php the_post(); ?>
<section class="main">
  <div class="content-wrap">
    <div class="category-heading">
      <div class="header-circle">
          <div class="circle bg-light"></div>
      </div>
      <h1 class="the_title"><?php the_title() ?></h1>
    </div>
    <div class="content">
      <?php
      if (have_rows('table') < 1) {
        ?>
        <?php
      } else {
        ?>
        <div class="single-country-table">
          <table class="table table-company">
            <thead>
            <tr>
              <th><?php _e('Name of service', 'prifinance') ?></th>

              <?php
              $tarifs = get_field('tarif');
              if ($tarifs): ?>
                <?php foreach ($tarifs as $tarif): ?>
                  <th class="tablethoffsh"><?php echo __($tarif, 'prifinance'); ?></th>
                <?php endforeach; ?>
              <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php if (have_rows('table')): while (have_rows('table')) : the_row(); ?>
              <?php $service = get_sub_field('service'); ?>
              <?php $service_desc = get_sub_field('service_desc'); ?>
              <tr>
                <td class="service-desc--trigger">
                  <div>
                    <img src="<?= IMAGES_URI ?>i.png" alt="">
                    <?php echo $service; ?>
                    <span class="service-desc"><?php echo $service_desc; ?></span>
                  </div>
                </td>

                <?php if ($tarifs): foreach ($tarifs as $tarif): $tar = get_sub_field(str_replace(' ', '_', mb_strtolower($tarif))); ?>
                  <td><img
                      src="<?= IMAGES_URI . ($tar ? 'check' : 'close'); ?>.svg">
                  </td>
                <?php endforeach; endif; ?>

              </tr>
            <?php endwhile;
            else : endif;
            $serviceLabels = [
              'total_cost' => __('Total cost', 'prifinance'),
              'apostilled' => __('Apostilled package', 'prifinance'),
              'nominee' => __('Nominee service', 'prifinance'),
              'accounting' => __('Accounting services', 'prifinance'),
              'annual' => __('Annual renewal (paid from the second year)', 'prifinance'),
            ];
            if (have_rows('table_price')): while (have_rows('table_price')) : the_row();
              $service_type = get_sub_field('service_type');
              if ($service_type['value'] == 'apostilled' || $service_type['value'] == 'nominee') continue;
              $label = $serviceLabels[$service_type['value']];
              $service_desc = get_sub_field('service_desc');
              ?>
              <tr class="table_price-row">
                <td>
                  <div class="table_price-title">
                    <?= $label ?>
                  </div>
                </td>

                <?php if ($tarifs): foreach ($tarifs as $tarif): $tar = get_sub_field(str_replace(' ', '_', mb_strtolower($tarif))); ?>
                  <td class="table_price-item"><?php echo $tar; ?></td>
                <?php endforeach; endif; ?>

              </tr>
            <?php endwhile; else : endif; ?>
            <tr class="js-galg table-company-checks">
              <td class="no-check"></td>
              <?php $i = 2; ?>
              <?php if ($tarifs): foreach ($tarifs as $tarif): ?>
                <td data-index="<?php echo $i++; ?>"><span class="check"></span></td>
              <?php endforeach; endif; ?>
            </tr>
            </tbody>
          </table>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
  <aside class="sidebar">
    <?php get_template_part('include/bankform') ?>
  </aside>
</section>
<?php
// Hidden until styles update
if (false) get_template_part('parts/team');

  get_template_part('parts/buy-centre');
  get_template_part('parts/steps');
?>
<section class="main-single" style="padding-top:1em">
  <div class="content-wrap-single">
    <div class="content-text">
      <?php echo str_replace(" style=\"text-align: justify;\"","",get_the_content()); ?>
    </div>
  </div>
  <aside class="sidebar"></aside>
</section>
<?php
get_template_part('parts/best-offers');
get_template_part('include/block-clients');
get_footer();
?>
