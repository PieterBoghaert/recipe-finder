// One-time scroll animations using Intersection Observer
// Respects user's motion preferences

export function initScrollAnimations() {
    // Check if user prefers reduced motion
    const prefersReducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    ).matches;

    if (prefersReducedMotion) {
        // Make all elements visible immediately
        document.querySelectorAll(".animate-on-scroll").forEach((el) => {
            el.style.opacity = "1";
        });
        return;
    }

    // Create intersection observer
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    // Add visible class to trigger animation
                    entry.target.classList.add("is-visible");

                    // Stop observing this element (one-time animation)
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            // Trigger when 20% of the element is visible
            threshold: 0.2,
            // Start observing slightly before element enters viewport
            rootMargin: "0px 0px -30px 0px",
        }
    );

    // Observe all elements with animation classes
    document.querySelectorAll(".animate-on-scroll").forEach((el) => {
        observer.observe(el);
    });
}

// Initialize on DOM ready and after Livewire navigation
document.addEventListener("DOMContentLoaded", initScrollAnimations);
document.addEventListener("livewire:navigated", initScrollAnimations);
