$(function() {

    $('.page-profile').each(function() {

        let $page = $(this);
        let $changePasswordCheckbox = $page.find('.change-password-checkbox');
        let $passwordFields = $page.find('.password-fields');

        $changePasswordCheckbox.on('change', function() {

            if ($changePasswordCheckbox.is(':checked')) {
                $passwordFields.removeClass('d-none');
                $passwordFields.find('input').attr('required', true);

            } else {
                $passwordFields.addClass('d-none');
                $passwordFields.find('input').attr('required', false);
            }

        }).trigger('change');

    });

});
