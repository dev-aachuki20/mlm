$(document).ready(function() {
    $(document).on('change','.toggleSwitch', function() {
        if ($(this).is(':checked')) {
            // Perform actions for "on" state
            $(this).val(1);
        } else {
            // Perform actions for "off" state
            $(this).val(0);
        }
    });
});

