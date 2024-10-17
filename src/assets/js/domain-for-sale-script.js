(function ($) {
  "use strict";

  // Wrap entire code inside foreach for each .dfs class element
  $(".dfs").each(function () {
    var $dfs = $(this);
    $dfs.find(".form").on("submit", function (e) {
      e.preventDefault();

      const $form = $(this);
      const formData = $(this).serialize();
      $.ajax({
        url: confirmation.ajax_url,
        type: "post",
        data: {
          action: "dfs_send_email",
          data: formData,
          nonce: confirmation.nonce,
        },
        
        success: function (response) {
          if (response.data.type === "success") {
            Swal.fire({
              icon: "success",
              title: response.data.title,
              text: response.data.description,
              timer: 2000,
              showConfirmButton: false,
            }).then(function () {
              $form.trigger("reset");
            });
          } else {
            Swal.fire({
              icon: "error",
              title: response.data.title,
              text: `${response.data.title}\n${response.data.description}`,
              confirmButtonText: `${response.data.okay}`,
            });
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: errorThrown,
            confirmButtonText: "OK",
          });
        },
      });
    });

    // // FAQ Item Toggle within each .dfs instance
    // const $faqItems = $dfs.find(".dfs__faq_item");
    // if ($faqItems.length) {
    //   $faqItems.first().addClass("faq_active");
    // }

    // $dfs.find(".dfs__faq__question").on("click", function () {
    //   const $item = $(this).closest(".dfs__faq_item");
    //   $item
    //     .toggleClass("faq_active")
    //     .siblings(".dfs__faq_item")
    //     .removeClass("faq_active");
    // });

    // // FAQ Form Button Toggle within each .dfs instance
    // $dfs.find(".dfs__form__btn").on("click", function (e) {
    //   e.preventDefault();
    //   $(this).toggleClass("btn_active");
    //   $dfs.find(".dfs__form_popup").toggleClass("form_active");
    // });
  });
})(jQuery);
