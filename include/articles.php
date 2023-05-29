<?php
/* @var array $args */
$block = $args['block'];
if (empty($block['news-items'])) return;
$newsItems = $block['news-items'];
$isVideo = $args['type'] === 'video' || 'text';
?>
<section class="<?= $args['cssClass'] ?>">
  <div class="container-xxl">
    <div class="row justify-content-center">
      <div class="col-md-10 col-xl-9">
        <div class="header-circle">
          <div class="circle bg-light c_circle"></div>
          <h2><?= $block['news-title2'] ?></h2>
        </div>
        <h3><?= $block['news-title'] ?></h3>
        <div class="press-js-pagination<?= $isVideo ? '' : ' load-more' ?>" data-limit="<?= $args['limit'] ?>"
             data-last-page="<?= $args['last_page'] ?>">
          <?php
          $listItems = [];
          $newsCount = count($newsItems);
          if ($isVideo) {
            $idx = 0;
            foreach ($newsItems as $item) {
              $idx++;
              $listItems[] = getMediaLi($item);
              if (count($listItems) === 5 || $idx == $newsCount && count($listItems) % 5 != 0) {
                echo getMediaUl($listItems);
                $listItems = [];
              }
            }
          } else {
            foreach ($newsItems as $item) {
              $listItems[] = getMediaLi($item);
            }
            echo getMediaUl($listItems); ?>
          <?php } ?>
          <?php if (!$isVideo): ?>
            <div class="load-more-button-box">
              <button class="load-more-button btn btn-orange btn-sm">
                <span><?= __('Load more', 'prifinance') ?></span>
                <svg version="1.1" id="L7" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                        <path fill="#fff" d="M31.6,3.5C5.9,13.6-6.6,42.7,3.5,68.4c10.1,25.7,39.2,38.3,64.9,28.1l-3.1-7.9c-21.3,8.4-45.4-2-53.8-23.3
                        c-8.4-21.3,2-45.4,23.3-53.8L31.6,3.5z">
                          <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="2s"
                                            from="0 50 50" to="360 50 50" repeatCount="indefinite"></animateTransform>
                        </path>
                  <path fill="#fff" d="M42.3,39.6c5.7-4.3,13.9-3.1,18.1,2.7c4.3,5.7,3.1,13.9-2.7,18.1l4.1,5.5c8.8-6.5,10.6-19,4.1-27.7
                        c-6.5-8.8-19-10.6-27.7-4.1L42.3,39.6z">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                      from="0 50 50" to="-360 50 50" repeatCount="indefinite"></animateTransform>
                  </path>
                  <path fill="#fff" d="M82,35.7C74.1,18,53.4,10.1,35.7,18S10.1,46.6,18,64.3l7.6-3.4c-6-13.5,0-29.3,13.5-35.3s29.3,0,35.3,13.5
                        L82,35.7z">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="2s"
                                      from="0 50 50" to="360 50 50" repeatCount="indefinite"></animateTransform>
                  </path>
                    </svg>
              </button>
            </div>
          <?php endif; ?>
        </div>
        <!--  end post list   -->
      </div>
    </div>
  </div>
</section>
