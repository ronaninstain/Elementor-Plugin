(function ($) {
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/pe-latest-posts-sliders.default",
      function (scope, $) {
        const $HeroSlider = $(scope).find(".owl-bundle");
        if ($HeroSlider.length > 0) {
          $HeroSlider.owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            dots: false,
            nav: true,
            autoWidth: true,
            navText: [
              "<i class='fa fa-arrow-left'></i>",
              "<i class='fa fa-arrow-right'></i>",
            ],

            responsive: {
              0: {
                items: 1,
                nav: true,
                autoWidth: true,
              },
              580: {
                items: 2,
                nav: true,
              },
              1000: {
                items: 2,
                nav: true,
              },
            },
          });
        }
      }
    );
  });
})(jQuery);

// Bulk purchase

jQuery(document).on("click", ".qty-plus", function () {
  jQuery(this)
    .prev()
    .val(+jQuery(this).prev().val() + 1);

  //get qty value
  var qtyVal = jQuery(this).prev().val();
  //get url
  var getUrl = jQuery(this).next().attr("href");
  var url = new URL(getUrl);
  var search_params = url.searchParams;
  search_params.set("quantity", qtyVal);

  url.search = search_params.toString();

  var new_url = url.toString();
  getUrl = jQuery(this).next().attr("href", new_url);
  jQuery(this).next().attr("data-quantity", qtyVal);
});
jQuery(document).on("click", ".qty-minus", function () {
  if (jQuery(this).next().val() > 0)
    jQuery(this)
      .next()
      .val(+jQuery(this).next().val() - 1);
  //get qty value
  var qtyVal = jQuery(this).next().val();
  //get url
  var getUrl = jQuery(this).siblings(":last").attr("href");
  var url = new URL(getUrl);
  var search_params = url.searchParams;
  search_params.set("quantity", qtyVal);
  search_params.set("data-quantity", qtyVal);

  url.search = search_params.toString();

  var new_url = url.toString();
  getUrl = jQuery(this).siblings(":last").attr("href", new_url);
  jQuery(this).siblings(":last").attr("data-quantity", qtyVal);
});

// Ajax for new cats dropdown with re initialization for owl

(function ($) {
  function initializeOwlCarousel() {
    const $HeroSlider = $(".owl-bundle");
    if ($HeroSlider.length > 0) {
      $HeroSlider.owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        dots: false,
        nav: true,
        autoWidth: true,
        navText: [
          "<i class='fa fa-arrow-left'></i>",
          "<i class='fa fa-arrow-right'></i>",
        ],
        responsive: {
          0: {
            items: 1,
            nav: true,
            autoWidth: true,
          },
          580: {
            items: 2,
            nav: true,
          },
          1000: {
            items: 2,
            nav: true,
          },
        },
      });
    }
  }

  $(document).ready(function () {
    initializeOwlCarousel();

    $("#course-id-ele-plug-2").on("change", function () {
      var selectedOption = $(this).find("option:selected");
      var selectedValue = selectedOption.val();
      var courseIDs = selectedOption.attr("courseid");
      var loading = document.querySelector('.sh-premium-courses .elementor-container');
      var loader = document.querySelector('.sh-23-loader');
      
      loading.classList.add("sh-loading");
      loader.style.display = "initial";
    

      $.ajax({
        url: ajaxurl,
        method: "GET",
        data: {
          action: "process_selected_option",
          selected_value: selectedValue,
          courseIDs: courseIDs,
        },
        success: function (response) {
          loading.classList.remove("sh-loading");
          loader.style.display = "none";
          $("#owl-sh-23-bundle").html(response);
          $(".owl-bundle")
            .trigger("destroy.owl.carousel")
            .removeClass("owl-loaded owl-hidden owl-refresh");
          setTimeout(function () {
            initializeOwlCarousel();
          }, 100);
        },
        error: function (xhr, status, error) {
          console.error(error);
        },
      });
    });
  });
})(jQuery);
