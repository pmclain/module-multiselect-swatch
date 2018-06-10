require([
    'jquery',
    'mage/translate'
], function ($) {
    'use strict';

    $(function () {

        $('select#frontend_input:disabled').each(function () {
            var select = $(this),
                currentValue = select.find('option:selected').val(),
                enabledTypes = ['multiselect', 'swatch_multiselect_visual', 'swatch_multiselect_text'],
                warning = $('<label>')
                    .hide()
                    .text($.mage.__('These changes affect all related products.'))
                    .addClass('mage-error')
                    .attr({
                        generated: true, for: select.attr('id')
                    }),

                /**
                 * Toggle hint about changes types
                 */
                toggleWarning = function () {
                    if (select.find('option:selected').val() === currentValue) {
                        warning.hide();
                    } else {
                        warning.show();
                    }
                },

                /**
                 * Remove unsupported options
                 */
                removeOption = function () {
                    if (!~enabledTypes.indexOf($(this).val())) {
                        $(this).remove();
                    }
                };

            if (!~enabledTypes.indexOf(currentValue)) {
                return;
            }

            select.removeAttr('disabled').find('option').each(removeOption);

            select.after(warning).on('change', toggleWarning);
        });
    });
});
