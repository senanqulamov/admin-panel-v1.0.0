$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.language-change-request', function () {

        let changeLange = $(this).attr('data-language-code');
        console.log(languageChange);

        $.ajax({
            url: languageChange,
            method: 'POST',
            data: {
                fullUrl: window.location.href,
                currentLang: $('html').attr('lang'), // Update this to reflect your actual current lang
                changeLange: $(this).attr('data-language-code')
            },
            success: function (response) {
                if (response.success) {
                    window.location.href = response.data;
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });

    })

});
