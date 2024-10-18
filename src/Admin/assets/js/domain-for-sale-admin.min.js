(function ($) {
  "use strict";

  $(function () {
    /* Copy to clipboard */
    $(".domain-for-sale-shortcode-selectable").on("click", function (e) {
      e.preventDefault();
      domain_for_sale_copyToClipboard($(this));
      domain_for_sale_SelectText($(this));
      $(this).trigger("focus").select();
      $(".domain-for-sale-after-copy-text").animate(
        {
          opacity: 1,
          bottom: 25,
        },
        300
      );
      setTimeout(function () {
        jQuery(".domain-for-sale-after-copy-text").animate(
          {
            opacity: 0,
          },
          200
        );
        jQuery(".domain-for-sale-after-copy-text").animate(
          {
            bottom: 0,
          },
          0
        );
      }, 2000);
    });
    $(".ta_domain_for_sale_input").on("click", function (e) {
      e.preventDefault();
      /* Get the text field */
      var copyText = $(this);
      /* Select the text field */
      copyText.select();
      document.execCommand("copy");
      $(".domain-for-sale-after-copy-text").animate(
        {
          opacity: 1,
          bottom: 25,
        },
        300
      );
      setTimeout(function () {
        jQuery(".domain-for-sale-after-copy-text").animate(
          {
            opacity: 0,
          },
          200
        );
        jQuery(".domain-for-sale-after-copy-text").animate(
          {
            bottom: 0,
          },
          0
        );
      }, 2000);
    });
    function domain_for_sale_copyToClipboard(element) {
      var $temp = $("<input>");
      $("body").append($temp);
      $temp.val($(element).text()).select();
      document.execCommand("copy");
      $temp.remove();
    }
    function domain_for_sale_SelectText(element) {
      var r = document.createRange();
      var w = element.get(0);
      r.selectNodeContents(w);
      var sel = window.getSelection();
      sel.removeAllRanges();
      sel.addRange(r);
    }

    $('.layout.column-layout').each(function() {
      $(this).text($(this).text().replace('_', ' '));
    });
  });
})(jQuery);
