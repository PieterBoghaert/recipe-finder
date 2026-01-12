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

    // Check if browser supports modern CSS scroll-driven animations with sibling-index() stagger
    const supportsModernStagger =
        CSS.supports("animation-timeline", "view()") &&
        CSS.supports("animation-delay", "calc(sibling-index() * 1s)");

    // Skip JS animations for elements that use modern CSS stagger
    const modernStaggerSelectors = [
        ".about-whyweexist__item",
        ".about-philosophy__item",
    ];
    const skipElements = new Set();

    if (supportsModernStagger) {
        modernStaggerSelectors.forEach((selector) => {
            document.querySelectorAll(selector).forEach((el) => {
                skipElements.add(el);
            });
        });
        // Modern browsers handle animation purely with CSS @starting-style
        // No observer needed!
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

    // Observe all elements with animation classes (except those using modern CSS)
    document.querySelectorAll(".animate-on-scroll").forEach((el) => {
        // Skip elements that use modern CSS sibling-index() stagger
        if (!skipElements.has(el)) {
            observer.observe(el);
        }
    });
}

// Initialize on DOM ready and after Livewire navigation
document.addEventListener("DOMContentLoaded", initScrollAnimations);
document.addEventListener("livewire:navigated", initScrollAnimations);
