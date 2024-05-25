document.addEventListener('DOMContentLoaded', function() {
    console.log('custom-admin.js loaded'); // Debug statement

    // Ensure the script only runs on landing pages post type
    var postType = document.getElementById('post_type').value;
    if (postType !== 'landing-page') {
        return;
    }

    // Function to update the color preview
    function updateColorPreview() {
        var colorSelectors = document.querySelectorAll('.acf-field-select[data-name="cta_section_bg_color"] select');
        console.log('Found color selectors:', colorSelectors.length); // Debug statement

        colorSelectors.forEach(function(selector) {
            var selectedOption = selector.options[selector.selectedIndex].value;
            var colorField = document.querySelector('.acf-field[data-name="' + selectedOption + '"] input[type="text"]');
            if (colorField) {
                var color = colorField.value;
                console.log('Selected color:', color); // Debug statement

                var preview = selector.parentElement.querySelector('.color-preview');
                if (preview) {
                    preview.style.backgroundColor = color;
                } else {
                    console.log('Preview element not found'); // Debug statement
                }
            }
        });
    }

    // Initial update on page load
    updateColorPreview();

    // Update preview on select change
    document.querySelectorAll('.acf-field-select[data-name="cta_section_bg_color"] select').forEach(function(select) {
        select.addEventListener('change', function() {
            var selectedOption = select.options[select.selectedIndex].value;
            var colorField = document.querySelector('.acf-field[data-name="' + selectedOption + '"] input[type="text"]');
            if (colorField) {
                var color = colorField.value;
                console.log('Changed selected color:', color); // Debug statement

                var preview = select.parentElement.querySelector('.color-preview');
                if (preview) {
                    preview.style.backgroundColor = color;
                } else {
                    console.log('Preview element not found'); // Debug statement
                }
            }
        });
    });
});
