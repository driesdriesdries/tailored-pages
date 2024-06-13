document.addEventListener('DOMContentLoaded', function() {
    console.log('custom-admin.js loaded');
    console.log(tpColors);

    // Function to create color preview element
    function createColorPreview(colorField) {
        const colorPreview = document.createElement('div');
        colorPreview.style.width = '20px';
        colorPreview.style.height = '20px';
        colorPreview.style.borderRadius = '50%';
        colorPreview.style.marginTop = '10px';
        colorPreview.style.marginLeft = '10px';
        colorPreview.style.display = 'inline-block';
        colorPreview.style.verticalAlign = 'middle';
        colorPreview.style.border = '2px solid black'; // Added dashed black border
        colorField.parentNode.appendChild(colorPreview);
        return colorPreview;
    }

    // Function to update color preview
    function updateColorPreview(colorField, colorPreview) {
        const selectedColor = colorField.value;
        let color;
        switch (selectedColor) {
            case 'primary_color':
                color = tpColors.primary_color;
                break;
            case 'secondary_color':
                color = tpColors.secondary_color;
                break;
            case 'tertiary_color':
                color = tpColors.tertiary_color;
                break;
            case 'quaternary_color':
                color = tpColors.quaternary_color;
                break;
            case 'quinary_color':
                color = tpColors.quinary_color;
                break;
            default:
                color = '#FFFFFF'; // Default color
        }
        colorPreview.style.backgroundColor = color;
    }

    // Fields to add color previews
    const fields = [
        'faq_section_background_color',
        'faq_section_copy_color',
        'faq_section_accordion_heading_background_color',
        'faq_section_accordion_heading_copy_color',
        'faq_section_accordion_body_background_color',
        'faq_section_accordion_body_copy_color',
        'faq_section_accordion_accent_color'
    ];

    fields.forEach(function(field) {
        const fieldSelector = `select[name="acf[field_${field}]"]`;
        const colorField = document.querySelector(fieldSelector);
        if (colorField) {
            const colorPreview = createColorPreview(colorField);
            colorField.addEventListener('change', function() {
                updateColorPreview(colorField, colorPreview);
            });
            updateColorPreview(colorField, colorPreview); // Initial call
        }
    });

    // Existing color previews for CTA Section fields
    const ctaFields = [
        'field_664c778d3d4be', // CTA Section Background Color
        'field_6651ecc3e0757', // CTA Section Copy Color
        'field_6655d86d6aa9b', // CTA Section Button Background Color
        'field_6655d88c6aa9c'  // CTA Section Button Copy Color
    ];

    ctaFields.forEach(function(fieldId) {
        const fieldSelector = `select[name="acf[${fieldId}]"]`;
        const colorField = document.querySelector(fieldSelector);
        if (colorField) {
            const colorPreview = createColorPreview(colorField);
            colorField.addEventListener('change', function() {
                updateColorPreview(colorField, colorPreview);
            });
            updateColorPreview(colorField, colorPreview); // Initial call
        }
    });

    // Testimonial Section fields
    const testimonialFields = [
        '66697a62be49a', // Testimonial Section Background Color
        '66697acbc4a81', // Testimonial Section Text Color
        '66697cca2bf93', // Testimonial Instance Background Color
        '66697cde2bf94', // Testimonial Instance Text Color
        '66697cf32bf95'  // Testimonial Instance Accent Color
    ];

    testimonialFields.forEach(function(fieldId) {
        const fieldSelector = `select[name="acf[field_${fieldId}]"]`;
        const colorField = document.querySelector(fieldSelector);
        if (colorField) {
            const colorPreview = createColorPreview(colorField);
            colorField.addEventListener('change', function() {
                updateColorPreview(colorField, colorPreview);
            });
            updateColorPreview(colorField, colorPreview); // Initial call
        }
    });

    // Add custom styles for ACF accordion headings
    const style = document.createElement('style');
    style.innerHTML = `
        .acf-field.acf-field-accordion .acf-label.acf-accordion-title {
            background-color: #f2f2f2 !important;
            color: crimson !important;
        }
    `;
    document.head.appendChild(style);
});
