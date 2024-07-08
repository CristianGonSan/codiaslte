$(document).ready(function () {
    let forms = $('.needs-validation');

    forms.each(function () {
        $(this).on('submit', function (event) {
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            $(this).addClass('was-validated');
        })
    })
});
