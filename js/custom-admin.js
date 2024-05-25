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

    // Color preview for CTA Section Background Color
    const backgroundColorField = document.querySelector('select[name="acf[field_664c778d3d4be]"]');
    if (backgroundColorField) {
        const backgroundColorPreview = createColorPreview(backgroundColorField);
        backgroundColorField.addEventListener('change', function() {
            updateColorPreview(backgroundColorField, backgroundColorPreview);
        });
        updateColorPreview(backgroundColorField, backgroundColorPreview); // Initial call
    }

    // Color preview for CTA Section Copy Color
    const copyColorField = document.querySelector('select[name="acf[field_6651ecc3e0757]"]');
    if (copyColorField) {
        const copyColorPreview = createColorPreview(copyColorField);
        copyColorField.addEventListener('change', function() {
            updateColorPreview(copyColorField, copyColorPreview);
        });
        updateColorPreview(copyColorField, copyColorPreview); // Initial call
    }
});
