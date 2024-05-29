document.addEventListener("DOMContentLoaded", function() {
    const accordionHeaders = document.querySelectorAll(".accordion-header");

    accordionHeaders.forEach(header => {
        header.addEventListener("click", function() {
            // Toggle active class on the current accordion item
            const currentItem = this.parentElement;
            currentItem.classList.toggle("active");

            // Hide the other accordion contents
            accordionHeaders.forEach(otherHeader => {
                if (otherHeader !== this) {
                    otherHeader.parentElement.classList.remove("active");
                }
            });
        });
    });
});
