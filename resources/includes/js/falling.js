/*
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('falling-images-container');

    // Create falling images
    for (let i = 0; i < 10; i++) {
        const fallingImage = document.createElement('div');
        fallingImage.className = 'falling-image';
        fallingImage.style.left = `${Math.random() * 100}vw`;
        container.appendChild(fallingImage);

        // Set different animation duration and delay for each image
        const duration = Math.random() * 2 + 1; // Random duration between 1 and 3 seconds
        const delay = Math.random() * 1; // Random delay between 0 and 1 second
        fallingImage.style.animationDuration = `${duration}s`;
        fallingImage.style.animationDelay = `-${delay}s`;
    }

    // Trigger animation on scroll
    window.addEventListener('scroll', function () {
        const scrollPosition = window.scrollY;

        // Adjust the scroll threshold as needed
        if (scrollPosition > 200) {
            container.style.opacity = 1;

            // Add a class to make the falling images stay fixed
            container.classList.add('stuck');

            // Set a random position for the images when they stick
        } else {
            container.style.opacity = 0;

            // Remove the class to allow falling images to move again
            container.classList.remove('stuck');
        }
    });
});
*/