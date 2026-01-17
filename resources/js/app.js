import "./bootstrap";
import { initScrollAnimations } from "./animations";

initScrollAnimations();

// Refresh CSRF token after Livewire navigation to prevent 419 errors
document.addEventListener('livewire:navigated', () => {
    // Refresh the CSRF token in axios headers
    let token = document.head.querySelector('meta[name="csrf-token"]');
    if (token) {
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    }
});

window.addEventListener("pageshow", (e) => {
    if (e.persisted) {
        window.location.reload();
    }
});
