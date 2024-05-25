document.addEventListener('DOMContentLoaded', function() {
    console.log('custom-admin.js loaded');
    console.log(tpColors);

    // Select the correct ACF field
    const colorField = document.querySelector('select[name="acf[field_664c778d3d4be]"]');
    if (colorField) {
        const colorPreview = document.createElement('div');
        colorPreview.id = 'color-preview';
        colorPreview.style.width = '20px';
        colorPreview.style.height = '20px';
        colorPreview.style.borderRadius = '50%';
        colorPreview.style.marginTop = '10px';
        colorPreview.style.marginLeft = '10px';
        colorPreview.style.display = 'inline-block';
        colorPreview.style.verticalAlign = 'middle';
        colorField.parentNode.appendChild(colorPreview);

        function updateColorPreview() {
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

        colorField.addEventListener('change', updateColorPreview);
        updateColorPreview(); // Initial call
    }
});
