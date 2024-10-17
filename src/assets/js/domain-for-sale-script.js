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
  });
})(jQuery);
