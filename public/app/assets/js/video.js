function previewImage(input) {
    const file = input.files[0];
    const imageError = document.getElementById('imageError');
    const coverPreview = document.getElementById('coverPreview');
    const coverShadow = document.getElementById('coverShadow');

    // Reset error message
    imageError.style.display = 'none';
    imageError.textContent = '';

    if (file) {
        // Validate file type
        if (!file.type.match('image.*')) {
            imageError.textContent = 'Please select an image file';
            imageError.style.display = 'block';
            return;
        }

        // Validate file size (max 5MB)
        if (file.size > 5 * 1024 * 1024) {
            imageError.textContent = 'Image size should not exceed 5MB';
            imageError.style.display = 'block';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const img = new Image();
            img.onload = function() {
                // Validate dimensions
                // if (this.width <= 1200 || this.height <= 1200) {
                //     imageError.textContent = 'Image dimensions must be 1200x1200 pixels';
                //     imageError.style.display = 'block';
                //     return;
                // }

                // Update preview and shadow
                coverPreview.src = e.target.result;
                coverShadow.style.backgroundImage = `url(${e.target.result})`;
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

// Toggle price fields based on free checkbox
document.addEventListener('DOMContentLoaded', function() {
    const freeCheckbox = document.getElementById('fcustomCheck1');
    const priceRow = document.getElementById('row_price');

    function togglePriceFields() {
        priceRow.style.display = freeCheckbox.checked ? 'none' : '';
    }

    // Set initial state
    togglePriceFields();

    // Add event listener for checkbox changes
    freeCheckbox.addEventListener('change', togglePriceFields);
});

function resetCover() {
    const defaultImage = '//public/app/assets/img/bg-auth.jpg';
    const coverPreview = document.getElementById('coverPreview');
    const coverShadow = document.getElementById('coverShadow');
    const imageError = document.getElementById('imageError');
    const fileInput = document.getElementById('coverUpload');

    // Reset preview and shadow
    coverPreview.src = defaultImage;
    coverShadow.style.backgroundImage = `url(${defaultImage})`;

    // Clear file input and error message
    fileInput.value = '';
    imageError.style.display = 'none';
    imageError.textContent = '';
}
