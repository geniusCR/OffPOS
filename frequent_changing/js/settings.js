$(document).ready(function() {
    "use strict";
    CKEDITOR.replace('term_conditions', {
        toolbar: [
            ['Bold', 'Italic', 'Underline', 'Strike', 'TextColor','BGColor', '-', 'NumberedList', 'BulletedList', '-', 'FontSize']
        ],
    });
    CKEDITOR.replace('invoice_footer', {
        toolbar: [
            ['Bold', 'Italic', 'Underline', 'Strike', 'TextColor','BGColor', '-', 'NumberedList', 'BulletedList', '-', 'FontSize']
        ],
    });
    CKEDITOR.replace('refund_and_return', {
        toolbar: [
            ['Bold', 'Italic', 'Underline', 'Strike', 'TextColor','BGColor', '-', 'NumberedList', 'BulletedList', '-', 'FontSize']
        ],
    });


    function generateUUID() {
        let d = new Date().getTime();
        let uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            let r = (d + Math.random() * 16) % 16 | 0;
            d = Math.floor(d / 16);
            return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
        });
        return uuid;
    }
    $(document).on("click", "#generateKey", function() {
        let uniqueKey = generateUUID();
        $('#api_key').val(uniqueKey);
    });
});