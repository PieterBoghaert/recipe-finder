import "./bootstrap";

// View Transitions API support check
// The @view-transition CSS rule handles transitions automatically for wire:navigate links in Livewire 3

// Log support status (for debugging)
if (document.startViewTransition) {
    console.log("✅ View Transitions API supported");
} else {
    console.log("⚠️ View Transitions API not supported in this browser");
}

