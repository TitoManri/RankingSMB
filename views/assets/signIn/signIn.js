document.addEventListener('DOMContentLoaded', function() {
    ScrollReveal().reveal('#contenido-frases', {
        origin: 'top',
        distance: '50px',
        duration: 1000, 
        delay: 300, 
        reset: true 
    });
});


function displaySelectedImage(event, elementId) {
    const selectedImage = document.getElementById(elementId);
    const fileInput = event.target;

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            selectedImage.src = e.target.result;
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
}

