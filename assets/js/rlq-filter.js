jQuery(document).ready(function ($) {
    $('#rlq-age-filter').on('change', function () {
        var ageGroup = $(this).val();
        var listContainer = $('#rlq-quotes-list');

        // Optional: specific loading state
        listContainer.css('opacity', '0.5');

        $.ajax({
            url: rlq_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'rlq_filter_quotes',
                age_group: ageGroup
            },
            success: function (response) {
                listContainer.html(response);
                listContainer.css('opacity', '1');
            },
            error: function () {
                alert('Error filtering quotes. Please try again.');
                listContainer.css('opacity', '1');
            }
        });
    });
});
