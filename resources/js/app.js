import "./bootstrap";
import { initScrollAnimations } from "./animations";

// Initialize one-time scroll animations
initScrollAnimations();

// View Transitions API integration with Livewire navigation
document.addEventListener("livewire:navigating", () => {
    if (!document.startViewTransition) return;

    document.startViewTransition(() => {
        // Livewire will handle the DOM update
    });
});
