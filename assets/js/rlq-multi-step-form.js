jQuery(document).ready(function ($) {
    var totalSteps = 17;
    var form = $('#rlq-multi-step-form');
    var storageKey = 'rlq_quote_form_data';

    // Load saved data or start fresh
    var savedData = localStorage.getItem(storageKey);
    var savedState = savedData ? JSON.parse(savedData) : { step: 1, formData: {} };
    var currentStep = savedState.step || 1;

    function saveProgress() {
        var dataToSave = {
            step: currentStep,
            formData: {}
        };
        
        // Loop through all inputs except the final step/buttons to save state
        form.find('input, select').each(function() {
            var name = $(this).attr('name');
            if (!name) return;
            
            if ($(this).is(':checkbox') || $(this).is(':radio')) {
                if ($(this).is(':checked')) {
                    if (!dataToSave.formData[name]) dataToSave.formData[name] = [];
                    dataToSave.formData[name].push($(this).val());
                }
            } else {
                dataToSave.formData[name] = $(this).val();
            }
        });

        localStorage.setItem(storageKey, JSON.stringify(dataToSave));
    }

    function restoreProgress() {
        if (!savedData) return;

        var data = savedState.formData;
        for (var name in data) {
            var val = data[name];
            var el = form.find('[name="' + name + '"]');
            
            if (el.is(':checkbox') || el.is(':radio')) {
                el.each(function() {
                    // Check if the current value is in our saved array
                    if (Array.isArray(val) && val.includes($(this).val())) {
                        $(this).prop('checked', true);
                    } else if (val === $(this).val()) { // Fallback for single value
                        $(this).prop('checked', true);
                    }
                });
            } else {
                el.val(val);
            }
        }
        
        // Trigger changes for dependent fields
        if ($('#has_insurance_yes').is(':checked')) {
            $('#current_coverage_container').slideDown();
            $('#current_coverage_amount').prop('required', true);
        }
        
        // Format phone again if needed
        var phoneField = $('#user_phone');
        if (phoneField.val()) phoneField.trigger('input');
        
        // Format Zip to State if needed
        var zipField = $('#zip_code_initial');
        if (zipField.val() && zipField.val().length === 5 && !$('#state_initial').val()) {
            zipField.trigger('keyup');
        }
    }

    function showStep(step) {
        $('.rlq-form-step').hide();
        var currentSection = $('.rlq-form-step[data-step="' + step + '"]');
        currentSection.fadeIn();

        // Update Stepper UI
        $('.rlq-step-indicator').removeClass('active completed');
        $('.rlq-step-indicator').each(function () {
            var stepNum = $(this).data('step');
            if (stepNum < step) {
                $(this).addClass('completed');
            } else if (stepNum == step) {
                $(this).addClass('active');
            }
        });

        // Update progress line
        var progressWidth = ((step - 1) / (totalSteps - 1)) * 100;
        $('.rlq-stepper-progress-bar').css('width', progressWidth + '%');

        // Initial validation check for the step
        validateStep(currentSection);
    }

    // Validation Logic
    function validateStep(section) {
        var stepNum = section.data('step');
        var isValid = true;
        
        section.find('input[required], select[required]').each(function () {
            // Radio/Checkbox groups
            if ($(this).is(':radio') || $(this).is(':checkbox')) {
                var name = $(this).attr('name');
                if ($('input[name="' + name + '"]:checked').length === 0) {
                    isValid = false;
                }
            } else {
                // Text, Number, Select
                var val = $(this).val();
                if (!val || val.trim() === '') {
                    isValid = false;
                } else if ($(this).attr('pattern')) {
                    var regex = new RegExp('^' + $(this).attr('pattern') + '$');
                    if (!regex.test(val)) isValid = false;
                } else if ($(this).attr('min') && $(this).attr('max')) {
                    var min = parseFloat($(this).attr('min'));
                    var max = parseFloat($(this).attr('max'));
                    var num = parseFloat(val);
                    if (isNaN(num) || num < min || num > max) isValid = false;
                }
            }
        });
        
        // Special requirement Step 11: Although not explicitly required, must choose at least one condition.
        if (stepNum === 11) {
            if ($('input[name="conditions[]"]:checked').length === 0) {
                isValid = false;
            }
        }
        
        // State validation for zip
        if (stepNum === 5) {
            if (!$('#state_initial').val() || $('#state_initial').val() === 'Invalid Zip') {
                isValid = false;
            }
        }

        var nextBtn = section.find('.rlq-next-step, .rlq-submit-btn');
        if (isValid) {
            nextBtn.prop('disabled', false);
        } else {
            nextBtn.prop('disabled', true);
        }
    }

    // Attach real-time validation check
    form.on('change input', 'input, select', function() {
        var section = $(this).closest('.rlq-form-step');
        
        // Handle error messages UI on change for text/number/select
        if ($(this).prop('required') && !$(this).is(':radio') && !$(this).is(':checkbox')) {
             var val = $(this).val();
             var hasError = false;
             
             if (!val || val.trim() === '') { 
                 hasError = true; 
             } else if ($(this).attr('pattern')) {
                 var regex = new RegExp('^' + $(this).attr('pattern') + '$');
                 if (!regex.test(val)) hasError = true;
             } else if ($(this).attr('min') && $(this).attr('max')) {
                 var min = parseFloat($(this).attr('min'));
                 var max = parseFloat($(this).attr('max'));
                 var num = parseFloat(val);
                 if (isNaN(num) || num < min || num > max) {
                     hasError = true;
                 }
             }
             
        var errorDiv = $(this).closest('.rlq-form-group').find('.rlq-error-message');
        if (hasError) {
             $(this).addClass('error');
             if(errorDiv.length) {
                 errorDiv.text($(this).data('error-msg') || 'Invalid input').show();
             }
        } else {
             $(this).removeClass('error');
             if(errorDiv.length) errorDiv.hide();
        }
    }
    
    validateStep(section);
    saveProgress();
});

    // Next/Prev Navigation
    form.on('click', '.rlq-next-step', function () {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
            saveProgress();
        }
    });

    form.on('click', '.rlq-prev-step', function () {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
            saveProgress();
        }
    });

    // Step 5: Zip to State
    $('#zip_code_initial').on('keyup', function() {
        var zip = $(this).val();
        if (zip.length === 5) {
            $.getJSON('https://api.zippopotam.us/us/' + zip, function(data) {
                if (data && data.places && data.places.length > 0) {
                    $('#state_initial').val(data.places[0]['state abbreviation']).removeClass('error');
                    validateStep($('#zip_code_initial').closest('.rlq-form-step'));
                }
            }).fail(function() {
                $('#state_initial').val('Invalid Zip');
                validateStep($('#zip_code_initial').closest('.rlq-form-step'));
            });
        } else {
            $('#state_initial').val('');
            validateStep($('#zip_code_initial').closest('.rlq-form-step'));
        }
    });

    // Step 6: Conditional Coverage Amount
    $('input[name="has_insurance"]').on('change', function() {
        if ($('#has_insurance_yes').is(':checked')) {
            $('#current_coverage_container').slideDown();
            $('#current_coverage_amount').prop('required', true);
        } else {
            $('#current_coverage_container').slideUp();
            $('#current_coverage_amount').prop('required', false).val('');
            $('#current_coverage_amount').removeClass('error');
            $('#current_coverage_amount').siblings('.rlq-error-message').hide();
        }
        validateStep($(this).closest('.rlq-form-step'));
    });

    // Step 11: None of these toggle
    $('input[name="conditions[]"]').on('change', function() {
        if ($(this).val() === 'None of these') {
            if ($(this).is(':checked')) {
                $('input[name="conditions[]"]').not(this).prop('checked', false);
            }
        } else {
            if ($(this).is(':checked')) {
                $('input[value="None of these"]').prop('checked', false);
            }
        }
        validateStep($(this).closest('.rlq-form-step'));
        saveProgress();
    });

    // Phone Mask Simple
    $('#user_phone').on('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
        validateStep($(this).closest('.rlq-form-step'));
    });

    // Setup initial step
    restoreProgress();
    showStep(currentStep);
    
    // Final Submit Action
    form.on('click', '.rlq-submit-btn', function (e) {
        e.preventDefault();
        
        var btn = $(this);
        var originalText = btn.text();
        btn.prop('disabled', true).text('Sending...');
        
        // Include the page title in the data
        var pageTitle = document.title;
        var formData = form.serialize() + '&action=submit_rlq_quote&page_title=' + encodeURIComponent(pageTitle);
        
        $.post(rlqAjax.ajax_url, formData, function(response) {
            if (response.success) {
                var email = $('#user_email').val() || 'email@gmail.com';
                $('#display_email').text(email);
                
                // Transition to final success step
                currentStep = 17;
                showStep(currentStep);
                
                // Hide Stepper completely as we are on success page
                $('.rlq-stepper-container').slideUp();
                $('.rlq-ms-left-panel').hide();
                $('.rlq-ms-right-panel').css({'width': '100%', 'padding': '40px'});
                
                // Clear localStorage
                localStorage.removeItem(storageKey);
            } else {
                alert('There was an error submitting your quote. Please try again.');
                btn.prop('disabled', false).text(originalText);
            }
        }).fail(function() {
            alert('A network error occurred. Please try again later.');
            btn.prop('disabled', false).text(originalText);
        });
    });
});
