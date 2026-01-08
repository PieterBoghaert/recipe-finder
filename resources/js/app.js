import "./bootstrap";

// Enable View Transitions for Livewire navigation
document.addEventListener("livewire:init", () => {
    Livewire.hook("navigate", ({ direction, url }) => {
        // Check if View Transition API is supported
        if (document.startViewTransition) {
            return new Promise((resolve) => {
                document.startViewTransition(() => {
                    resolve();
                });
            });
        }
    });
});
