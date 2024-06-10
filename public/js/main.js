(function($) {
"use strict";

if (confirmation.type === 'success') {
Swal.fire({
    icon: 'success',
    title: confirmation.title,
    text: confirmation.description,
    showConfirmButton: false,
    timer: 2000,
});
} else if (confirmation.type === 'error') {
Swal.fire({
    icon: 'error',
    title: confirmation.title,
    text: confirmation.description,
    confirmButtonText: confirmation.okay,
    });
}
})(jQuery);