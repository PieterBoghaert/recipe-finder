import "./bootstrap";

// View Transitions API for smooth page transitions
// Add view-transition meta tag for better cross-document transitions
if (
    "startViewTransition" in document &&
    !document.documentElement.hasAttribute("data-view-transition-ready")
) {
    // Mark as ready to prevent multiple initializations
    document.documentElement.setAttribute("data-view-transition-ready", "true");

    // Intercept navigation clicks for SPA-like transitions
    document.addEventListener("click", function (e) {
        const link = e.target.closest("a");

        // Only intercept same-origin navigation links
        if (
            link &&
            link.href &&
            link.origin === location.origin &&
            !link.hasAttribute("target") &&
            !e.ctrlKey &&
            !e.metaKey &&
            !e.shiftKey &&
            link.getAttribute("href") !== "#"
        ) {
            e.preventDefault();

            // Use View Transition API
            if (!document.startViewTransition) {
                window.location.href = link.href;
                return;
            }

            document.startViewTransition(() => {
                window.location.href = link.href;
            });
        }
    });
}
