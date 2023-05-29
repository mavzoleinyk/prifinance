<?php
$buyCentre = getOption('buy_action');
if (empty($buyCentre)) return;
$title = getArrayField($buyCentre, 'title');
$description = getArrayField($buyCentre, 'description');

if (str_contains($description, '%s')) {
    try {
        $description = sprintf($description, date('t'), $genMonthName);
    } finally {
        $description = sprintf($description, date('t'));
    }
}

$link = getArrayField($buyCentre, 'link');
$buttonText = getArrayField($buyCentre, 'button_text');
?>
<section class="buy-centre">
  <div class="press-centre-inner fonbuycompany buycompany">
    <div class="container-xxl">
      <div class="row justify-content-center">
        <div class="col-md-10 col-xl-9">
          <div class="buycomptext">
            <h3 class="text-white buyh3"><?= $title ?></h3>
            <p><?= $description ?></p>
            <a href="<?= $link ?>" class="btn-get-offer"><?= $buttonText ?><img src="<?= ICONS_URI ?>right-arrow.svg" alt=""></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
