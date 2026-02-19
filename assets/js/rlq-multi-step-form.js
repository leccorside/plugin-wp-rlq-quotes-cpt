jQuery(document).ready(function ($) {
    var currentStep = 1;
    var totalSteps = 4;

    function showStep(step) {
        $('.rlq-form-step').hide();
        $('.rlq-form-step[data-step="' + step + '"]').fadeIn();

        // Update Stepper UI
        $('.rlq-step-indicator').removeClass('active completed');
        $('.rlq-step-indicator').each(function (index) {
            var stepNum = $(this).data('step');
            if (stepNum < step) {
                $(this).addClass('completed');
            } else if (stepNum == step) {
                $(this).addClass('active');
            }
        });

        // Update Progress Bar Line (between steps)
        var progressWidth = ((step - 1) / (totalSteps - 1)) * 100;
        $('.rlq-stepper-progress-bar').css('width', progressWidth + '%');
    }

    // Initialize
    showStep(currentStep);

    // Next Button Click
    $('.rlq-next-step').on('click', function () {
        var currentSection = $('.rlq-form-step[data-step="' + currentStep + '"]');
        var isValid = true;

        // Simple validation
        currentSection.find('input, select').each(function () {
            if ($(this).prop('required') && !$(this).val()) {
                isValid = false;
                $(this).addClass('error');
            } else {
                $(this).removeClass('error');
            }
        });

        if (isValid) {
            if (currentStep < totalSteps) {
                currentStep++;
                showStep(currentStep);
            }
        } else {
            // Optional: Show error message
            // alert('Please fill in all required fields.');
        }
    });

    // Previous Button Click
    $('.rlq-prev-step').on('click', function () {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });

    // Remove error class on focus
    $('input, select').on('focus', function () {
        $(this).removeClass('error');
    });

});
