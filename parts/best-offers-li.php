<?php
$title = get_field('mini_title') ? get_field('mini_title') : get_the_title();
$img = get_field('flug');
$desc = get_field('best-offer_desc');
if (empty($desc)) {
  $desc = '• ' . __('Сompany registration', 'prifinance') . ' <br>';
  $desc .= '• ' . __('Legal address for 1 year', 'prifinance');
}
?>
<li class="splide__slide">
  <div class="offer">
    <?php if ($img): ?>
      <div class="offer-country"><img src="<?php echo $img; ?>" alt=""></div>
    <?php endif; ?>

    <div class="offer-heading"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></div>
    <?php
    $prices = get_table_prices();
    ?>
    <div
      class="offer-price d-flex align-items-center justify-content-center"><?= $prices['total_cost'] ?></div>
    <p class="offer-text"><?php echo $desc; ?></p>
    <div class="offer-action">
      <button
        class="btn btn-sm btn-orange btn-callback"><?php _e('Send Request', 'prifinance') ?></button>
    </div>
  </div>
</li>
