(function ($) {
  $('#menuLanguage')
    .find('.lang')
    .on('click', function () {
      let langCode = $(this).data('lang');
      localStorage.setItem('selected_language', langCode);
    });

  $('.table_price-row')
    .first()
    .children('.table_price-item')
    .css('color', '#FF5B2E');

  window.ModalCallback = function (modal, selectors) {
    this.modal = modal;
    this.$modal = $(modal);
    this.$selectors = $(selectors);

    this.close = function () {
      if (this.$modal.css('display') === 'none') return;
      this.$modal.fadeOut();
      $(window).off('keyup', this.onClose);
    };

    this.onClose = function (e) {
      if (this.$modal.css('display') === 'none') return;

      if (e.keyCode === 27) {
        this.$modal.fadeOut();
        $(window).off('keyup', this.onClose);
        return;
      }
      var $this = $(e.target);
      if (
        $this.is(this.modal) ||
        $this.is(this.modal + '__close') ||
        $this.parents(this.modal + '__close').length
      ) {
        this.$modal.fadeOut();
        $(window).off('keyup', this.onClose);
      }
    };

    this.onOpen = function (e) {
      e.preventDefault();
      this.$modal.fadeIn();
      $(window).on('keyup', this.onClose);
    };

    //bind
    this.close = this.close.bind(this);
    this.onClose = this.onClose.bind(this);
    this.onOpen = this.onOpen.bind(this);
    // ON
    this.$modal.on('mousedown', this.onClose);

    this.$selectors.click(this.onOpen);
  };
})(jQuery);

(function ($) {
  $('#headerMenuHover .menu-item-has-children').hover(function (e) {
    if (e.type === 'mouseenter') {
      $(this).find('.has-arrow').attr('aria-expanded', 'true');
      $(this).find('ul').stop(true, false).slideDown('150');
    }

    if (e.type === 'mouseleave') {
      $(this).find('.has-arrow').attr('aria-expanded', 'false');
      $(this).find('ul').stop(true, false).slideUp('150');
    }
  });

  $('[data-fancybox]').fancybox({
    youtube: {
      controls: 1,
      showinfo: 0,
    },
    image: {},
  });
  $('.single-post .info-block').each(function () {
    return $(this).html(
      `<div class="info-block-full-width-wrap">${$(this).html()}</div>`
    );
  });
})(jQuery);

document.addEventListener('DOMContentLoaded', function (event) {
  function closeOnClick(event, elem) {
    window.addEventListener('click', function mmClick1(e) {
      if (!event.target.contains(e.target)) {
        elem.hide(event.detail.shownElement);
        window.removeEventListener('click', mmClick1);
      }
    });
  }

  const mmLang = new MetisMenu('#menuLanguage').on(
    'shown.metisMenu',
    function (event) {
      closeOnClick(event, mmLang);
    }
  );

  const mmHeader = new MetisMenu('#headerMenu').on(
    'shown.metisMenu',
    function (event) {
      closeOnClick(event, mmHeader);
    }
  );

  // new MetisMenu("#headerMenuHover", {
  //     triggerElement: '.link-child-menu'
  // })

  new MetisMenu('#headerMenuMob', {
    triggerElement: '.link-child-menu',
  });

  if (!!document.getElementById('testimonialsSplide')) {
    new Splide('#testimonialsSplide', {
      perPage: 4,
      arrows: true,
      autoplay: false,
      rewind: true,
      pagination: false,
      breakpoints: {
        599: {
          perPage: 1,
        },
        900: {
          perPage: 2,
        },
        1440: {
          perPage: 3,
        },
      },
    }).mount();
  }

  if (!!document.getElementById('strany')) {
    new Splide('#strany', {
      perPage: 4,
      arrows: true,
      autoplay: false,
      rewind: true,
      pagination: false,
      autoWidth: false,
      breakpoints: {
        599: {
          perPage: 1,
        },
        900: {
          perPage: 1,
        },
        1300: {
          perPage: 2,
          gap: 20,
        },
        1440: {
          perPage: 3,
        },
      },
    }).mount();
  }
  if (!!document.getElementById('bestOffersSplides')) {
    new Splide('#bestOffersSplides', {
      perPage: 3,
      perMove: 1,
      gap: '70px',
      arrows: true,
      autoplay: false,
      rewind: true,
      pagination: false,
      breakpoints: {
        991: {
          perPage: 1,
        },
        1600: {
          perPage: 2,
        },
      },
    }).mount();
  }

  if (!!document.getElementById('bestOffersSplide')) {
    new Splide('#bestOffersSplide', {
      perPage: 4,
      perMove: 1,
      gap: '20px',
      arrows: true,
      autoplay: false,
      drag: false,
      rewind: true,
      pagination: false,
      breakpoints: {
        767: {
          perPage: 1,
        },
        991: {
          perPage: 2,
        },
        1279: {
          perPage: 3,
        },
      },
    }).mount();
  }

  if (!!document.getElementById('pressCentreSplide')) {
    let pressCentreSplide = new Splide('#pressCentreSplide', {
      perPage: 3,
      arrows: true,
      autoplay: false,
      rewind: true,
      pagination: false,
      gap: '30px',
      breakpoints: {
        500: {
          perPage: 1,
        },
        1200: {
          perPage: 2,
          gap: '30px',
        },
        1680: {
          perPage: 3,
          gap: '20px',
        },
      },
    }).mount();

    pressCentreSplide.on('mounted', function (argument) {
      if (document.querySelector('[data-modal-count]')) {
        let modals = document.querySelectorAll('[data-modal-count]');
        modals.forEach((el) => {
          let videoUrl =
            el.querySelector('.js-tingle-modal-6').dataset.modalVideo;
          el.addEventListener('click', function () {
            let modalVideo = new tingle.modal({
              onClose: function () {
                modalVideo.destroy();
              },
            });
            modalVideo.setContent(`
                            <div class="video-container">
                                <iframe width="100%" height="600" src="${videoUrl}?autoplay=1" frameborder="0" allowfullscreen allow="accelerometer; autoplay; encrypted-media; gyroscope;"></iframe>
                            </div>
                            `);
            modalVideo.open();
          });
        });
      }
    });

    pressCentreSplide.mount();
  }

  var burger = {
    body: document.querySelector('body'),
    menu: document.querySelector('#burgerMenu'),
    btnOpen: document.querySelector('.burger-menu-toggle'),
    btnClose: document.querySelector('.burger-menu-close'),
  };

  function initialize() {
    burger.btnOpen.addEventListener('click', function () {
      toggle();
    });

    burger.btnClose.addEventListener('click', function () {
      toggle();
    });
  }

  function toggle() {
    burger.menu.classList.toggle('expanded');
    burger.body.classList.toggle('overflow');
  }

  initialize();

  //table company hover table check
  var tableCompany = document.querySelector('.table-company');
  var target = document.querySelector('.js-galg');

  if (tableCompany) {
    target.addEventListener('mouseover', mOver, false);
    target.addEventListener('mouseout', mOut, false);
  }

  function mOver(e) {
    var index;
    if (e.target.nodeName !== 'TD' && e.target.nodeName === 'SPAN') {
      e.target.parentNode.classList.add('checked');
      index = e.target.parentNode.dataset.index;
      index && tableCompany.classList.add('checked-' + index);
      return;
    }
    index = e.target.dataset.index;
    index && tableCompany.classList.add('checked-' + index);
    e.target.classList.add('checked');
  }

  function mOut(e) {
    var index;
    if (e.target.nodeName !== 'TD' && e.target.nodeName === 'SPAN') {
      e.target.parentNode.classList.remove('checked');
      index = e.target.parentNode.dataset.index;
      index && tableCompany.classList.remove('checked-' + index);
      return;
    }
    index = e.target.dataset.index;
    index && tableCompany.classList.remove('checked-' + index);
    e.target.classList.remove('checked');
  }

  //table company hover table check end

  //NEXT LVL JS/jQ
  (function ($) {
    const modal = new ModalCallback(
      '.modal-callback',
      '.btn-call, .btn-get-offer, .js-galg td[data-index], .btn-callback, .btn-push'
    );

    var MESSAGE_AJAX = {
      ru: {
        success: 'Спасибо! Ваша заявка принята.',
        error: 'Ошибка отправки заявки. Попробуйте позже.',
      },
      en: {
        success: 'Thank you for request!',
        error: 'Failed to send the message. Please try again later.',
      },
    };
    // VALIDATOR FORMS
    var MESSAGE_VALIDATORS = {
      ru: {
        phone: {
          required: 'Заполните поле «Телефон»',
          minlength: 'Неверный формат номера телефона',
        },
        email: {
          required: 'Заполните поле «E-mail»',
          email: 'Неправильно введен E-mail',
        },
        massage: {
          required: 'Обязательное поле',
        },
        'private-policy': 'Обязательное поле',
        country: 'Обязательное поле',
        'type-service': 'Обязательное поле',
      },

      en: {
        phone: {
          required: 'Fill in the "Phone" field',
          minlength: 'Invalid phone number format',
        },
        email: {
          required: 'Fill in the field "E-mail"',
          email: 'Incorrectly entered E-mail',
        },
        massage: {
          required: 'Required field',
        },
        'private-policy': 'Required field',
        country: 'Required field',
        'type-service': 'Required field',
      },
    };

    var createValidate = function (selector) {
      $(selector).validate({
        rules: {
          phone: {
            required: true,
            minlength: 10,
          },
        },
        messages: MESSAGE_VALIDATORS[getLangCode],
        submitHandler: function (form, e) {
          submitForm(form, e);
        },
      });
    };
    createValidate('aside .form');
    createValidate('.modal-callback .form');
    createValidate('.personal-form');
    createValidate('.formico');

    //submit AJAX FORMS FUNCTION
    function submitForm(form, e) {
      e.preventDefault();
      $form = $(form);
      $result = $form.find('.result-ajax');
      $result.removeClass('error success').html('');

      $form.find("button[type=submit]").attr("disabled", "true").css({ opacity: 0.5 });
      if ($(form).find('.form-result').length) {
          $(form).find('.form-result').slideDown(400, function () {
              setTimeout(()=>{
                  $(this).slideUp(400)
              }, 3000)
          })
      }

      //ROISTAT BEGIN
      var name = form.querySelector("input[name='name']")
          ? form.querySelector("input[name='name']").value
          : '',
        email = form.querySelector("input[name='email']")
          ? form.querySelector("input[name='email']").value
          : '',
        phone = form.querySelector("input[name='phone']")
          ? form.querySelector("input[name='phone']").value
          : '',
        massage = form.querySelector("textarea[name='massage']")
          ? form.querySelector("textarea[name='massage']").value + '\n'
          : '';

      // massage += form.querySelector('#country')
      //   ? 'Country: ' + form.querySelector('#country').value + '\n'
      //   : '';
      massage += roistat.geo.country
        ? 'Country: ' + roistat.geo.country + '\n'
        : '';
      massage += form.querySelector('#serviceType')
        ? 'Service type: ' + form.querySelector('#serviceType').value + '\n'
        : '';

      roistatGoal.reach({
        leadName: 'Заявка с сайта prifinance.com',
        name: name,
        phone: phone,
        email: email,
        text: massage,
        fields: {
          page: document.location.href,
        },
      });

      $result.addClass("success");
      $form.trigger("reset");
      $result.html("<p>" + MESSAGE_AJAX[getLangCode].success + "</p>");

      setTimeout(function () {
          modal.close();
      }, 3000);

      $form.find("button[type=submit]").removeAttr("disabled").css({ opacity: 1 });
      setTimeout(function () {
          $result.removeClass("error success").html("");
      }, 3000);

      //ROISTAT END
      dataLayer.push({
        'event' : 'formSubmitted',
        'eventAction' : 'Generate Lead'
      });
    }
    
    var canBeLoaded = true; // this param allows to initiate the AJAX call only if necessary

    var $loadMore = $('.load-more');
    let buttonText = $loadMore.find('.load-more-button span');
    let buttonIcon = $loadMore.find('.load-more-button svg');

    var limit = +$loadMore.data('limit');
    var _page = 1;
    var last_page = +$loadMore.data('last-page');
    console.log(limit, last_page);
    $loadMore.find('.load-more-button').on('click', function () {
      if (canBeLoaded == true) {
        _page++;
        if (_page <= last_page) {
          $.ajax({
            type: 'POST',
            url: main_object.url,
            data: {
              action: 'load_more',
              nonce: main_object.nonce,
              _page: _page,
              limit: limit,
            },
            beforeSend: function () {
              canBeLoaded = false;
              buttonText.hide();
              buttonIcon.show();
            },
            success: function (data) {
              $loadMore
                .closest('.press-js-pagination')
                .find('.press-slider')
                .append(data);
              canBeLoaded = true;
              console.log(_page, last_page);
              buttonText.show();
              buttonIcon.hide();
              if (_page === last_page)
                $loadMore.find('.load-more-button').hide();
            },
          });
        }
      }
    });

    function sendWpAjax() {
      $.ajax({
        type: 'POST',
        url: main_object.url,
        data: {
          action: 'ask_question',
          nonce: main_object.nonce,
          data: $form.serialize(),
        },
        beforeSend: function () {
          $form
            .find('button[type=submit]')
            .attr('disabled', 'true')
            .css({ opacity: 0.5 });
        },
        success: function (data) {
          if (data.success) {
            $result.addClass('success');
            $form.trigger('reset');
            $result.html('<p>' + data.data + '</p>');

            setTimeout(function () {
              modal.close();
            }, 3000);
          } else {
            let str = '';
            for (let prop in data.data) {
              str += '<p>' + data.data[prop] + '</p>';
            }
            $result.addClass('error');
            $result.html(str);
          }
          $form
            .find('button[type=submit]')
            .removeAttr('disabled')
            .css({ opacity: 1 });
          setTimeout(function () {
            $result.removeClass('error success').html('');
          }, 3000);
        },
      }); //end wp-ajax
    }

    if ($(window).width() > 768) {
      $('.testimonials .press-js-pagination').slick({
        slidesToShow: 1,
        infinite: false,
        dots: true,
        arrows: false,
      });
    }
  })(jQuery);
});
