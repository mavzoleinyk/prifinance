<footer>
  <div class="container-xxl footer-inner">
    <div class="row justify-content-center">
      <div class="col-lg-11 col-xl-10 col-xxl-9">
        <div class="row">
          <div class="col-xl-6">
            <div class="row">
              <div class="col-12">
              <?php if(!is_front_page()){ ?>
                <a href="/">
                <?php } ?>
                  <img src="<?php the_field('top-nav-second_logo', icl_object_id(427, 'page', true)) ?>"
                                 class="footer-logo" alt="Private Finance Logo">
                <?php if(!is_front_page()){ ?>
                </a>
                <?php } ?>


              </div>

              <div class="col-sm pe-xxl-4 footer-col-left">
                <p><?php the_field('footer-desc', icl_object_id(427, 'page', true)); ?></p>
              </div>
              <div class="col-sm col-xxl-5 offset-xxl-1 pt-3 pt-sm-0 ps-xxl-0 footer-col-left">
                <p><?php the_field('footer-licence', icl_object_id(427, 'page', true)); ?></p>
                <?php if (get_field('footer-licence-img', icl_object_id(427, 'page', true))) : ?>
                  <img src="<?php the_field('footer-licence-img', icl_object_id(427, 'page', true)); ?>"
                       class="aaa-logo img-fluid" alt="">
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="col-xl-6 ps-xxl-4 mt-5 mt-xl-0">
            <div class="row">
              <div class="col-sm footer-col-right">
                <div class="heading"><?php _e('Navigation', 'prifinance') ?></div>
                <div class="row">


                  <?php $FOOTER_MENU_GRID_FULL = count(get_field('footer-nav', icl_object_id(427, 'page', true))); ?>
                  <?php $FOOTER_MENU_GRID_HALF = ceil(count(get_field('footer-nav', icl_object_id(427, 'page', true))) / 2); ?>
                  <?php $COUNT_ITERATION = 1; ?>

                  <?php if (have_rows('footer-nav', icl_object_id(427, 'page', true))): while (have_rows('footer-nav', icl_object_id(427, 'page', true))) : the_row(); ?>

                    <?php if ($FOOTER_MENU_GRID_HALF + 1 == $COUNT_ITERATION || $COUNT_ITERATION == 1): ?>
                      <div class="col col-sm-12">
                      <ul class="list-unstyled arrow-list mb-0">
                    <?php endif; ?>

                    <li><a href="<?php the_sub_field('link') ?>"
                           class="link-white text-decoration-none"><?php the_sub_field('text') ?></a></li>


                    <?php if ($FOOTER_MENU_GRID_HALF == $COUNT_ITERATION || $COUNT_ITERATION == $FOOTER_MENU_GRID_FULL): ?>
                      </ul>
                      </div>
                    <?php endif; ?>
                    <?php $COUNT_ITERATION++; ?>
                  <?php endwhile; else : endif; ?>


                </div>
              </div>
              <div class="col-sm footer-col-right ps-xxl-5 mt-5 mt-sm-0">
                <div class="heading"><?php _e('Contact Us', 'prifinance') ?></div>
                <div class="row">
                  <?php the_field('footer-contact', icl_object_id(427, 'page', true)); ?>
                </div>
                <div class="social">
                  <ul class="list-inline">
                    <?php if (have_rows('footer-social', icl_object_id(427, 'page', true))): while (have_rows('footer-social', icl_object_id(427, 'page', true))) : the_row(); ?>

                      <li class="list-inline-item"><a href="<?php the_sub_field('link'); ?>"><img
                            src="<?php the_sub_field('icon'); ?>" alt=""></a></li>

                    <?php endwhile; else : endif; ?>


                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<div class="copyright d-flex justify-content-between align-items-center">
  <div class="container-xxl text-center text-sm-start">
    <div class="row justify-content-center">
      <div
        class="col-lg-11 col-xl-10 col-xxl-9 d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div><?php the_field('footer-copy', icl_object_id(427, 'page', true)) ?></div>
        <ul class="list-inline mb-0">
          <?php the_field('footer-bottom-link', icl_object_id(427, 'page', true)) ?>
        </ul>
      </div>
    </div>
  </div>
</div>


<div class="modal-callback" style="display: none;">
  <div class="modal-callback__wrap">
    <div class="modal-callback__close">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" enable-background="new 0 0 50 50">
        <path d="M37.304 11.282l1.414 1.414-26.022 26.02-1.414-1.413z"/>
        <path d="M12.696 11.282l26.022 26.02-1.414 1.415-26.022-26.02z"/>
      </svg>
    </div>

    <div class="modal-callback__content">
      <?php get_template_part('include/bankform') ?>
    </div>
  </div>
</div>


<!--<script src="--><?php //echo get_template_directory_uri();?><!--/js/metismenujs.min.js"></script>-->
<!--<script src="--><?php //echo get_template_directory_uri();?><!--/js/splide.min.js"></script>-->
<!--<script src="--><?php //echo get_template_directory_uri();?><!--/js/main.js"></script>-->
<?php wp_footer(); ?>
<?php if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1') { ?>
  <!-- ROISTAT BEGIN -->
  <script>
      window.roistatVisitCallback = function (visitId) {
          window.redhlpSettings = {
              keys: [{name: "roistat", value: window.roistat.visit}]
          }
      };
  </script>
  <script>
      (function (w, d, s, h, id) {
          w.roistatProjectId = id;
          w.roistatHost = h;
          var p = d.location.protocol == "https:" ? "https://" : "http://";
          var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/" + id + "/init?referrer=" + encodeURIComponent(d.location.href);
          var js = d.createElement(s);
          js.charset = "UTF-8";
          js.async = 1;
          js.src = p + h + u;
          var js2 = d.getElementsByTagName(s)[0];
          js2.parentNode.insertBefore(js, js2);
      })(window, document, 'script', 'cloud.roistat.com', 'fbd9cd4372d3ff33a468d5462efaf78b');
  </script>
  <!-- ROISTAT END -->
  <!-- BEGIN JIVOSITE INTEGRATION WITH ROISTAT -->
  <script type='text/javascript'>
      var getCookie = window.getCookie = function (name) {
          var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
          return matches ? decodeURIComponent(matches[1]) : 'nocookie';
      };

      function jivo_onLoadCallback() {
          var visit = getCookie('roistat_visit');
          if (visit === 'nocookie') {
              window.onRoistatAllModulesLoaded = function () {
                  window.roistat.registerOnVisitProcessedCallback(function () {
                      jivo_api.setUserToken(window.roistat.getVisit());
                  });
              };
          } else {
              jivo_api.setUserToken(visit);
          }
      }
  </script>
  <!-- END JIVOSITE INTEGRATION WITH ROISTAT -->
<?php } ?>
<?php
if (get_locale() == 'en_US') {
  ?>
  <script> redconnect = {
          copy: {
              content: "Powered by <span id=\"rc-popup-copyright-red\">Red</span>Connect",
              free: "Powered by <span class=\"rc-name\">RedConnect</span>"
          },
          popup: {
              text: "Popup. We'll call you in 28 seconds!",
              offlineText: "Let's appoint a call. Select the time, enter your phone and we'll call you.",
          },
          textMain: "We'll call you in 28 seconds!",
          textOffline: "We'll call you in 28 seconds!",
          textOfflineShort: "Request a call",
          textButton: "Request a call",
          textPlaceholder: "+$code ... (your number)",
          textClose: "Close",
          textSend: "Send",
          textEdit: "Edit",
          textCancel: "Cancel",
          wrongNumber: "Check your number!",
      };
      redconnect.textMessages = {
          warningHeader: "Attention!",
          wrongNumber: "You have dialed the wrong number. Please check the number and try again.",
          wait: "Wait...",
          callingOperator: "Connecting to our agent...",
          talkInProgress: "You're talking now with our agent...",
          callingVisitor: "Calling on your phone...",
          timeout: "Please hold, our agent will call you soon...",
          operatorUnavailable: "All of our operators are currently busy. Please hold and we will call you as soon as possible.",
          visitorUnavailable: "Failed to call to the specified number, please check the number and make sure that your phone is available.",
          operatorHangup: "The call got dropped.",
          callCancelled: "The call got canceled.",
          timePickerHeader: "Time picker",
          timePickerText: "Our operators will call you at your convenience:",
          appointmentText: "We'll call you"
      };
      redconnect.feedback = {
          leaveComment: "Leave a comment",
          yes: "Yes",
          no: "No",
          reachQuestion: "Did you receive a call?",
          likeQuestion: "Please, rate the call:",
          commentQuestion: "Describe briefly what you disliked:",
          commentQuestionLiked: "Please, leave a comment on our agent's work:",
          completeMessage: "Thank You!",
          excuse: "Seems like operator can't take a call right now. We've sent him an e-mail with your contacts, so he's about to call you soon",
          exitWarning: "You haven't left a feedback about the call you've requested, do you want to leave the page anyway?"
      };
      redconnect.time = {
          months: ["Jan.", "Feb.", "Mar.", "Apr.", "May", "June", "July", "Aug.", "Sep.", "Oct.", "Nov.", "Dec."],
          today: "today",
          tomorrow: "tomorrow",
          timePrep: "at"
      };
  </script>
  <?php
}

$active_language = apply_filters( 'wpml_current_language', null );

if ($active_language != 'en') { ?>
  <!-- RedHelper -->
  <script id="rhlpscrtg" type="text/javascript" charset="utf-8" async="async"
          src="https://web.redhelper.ru/service/main.js?c=prifinance">
  </script>
  <!--/Redhelper -->
<?php } ?>
</body>
</html>
