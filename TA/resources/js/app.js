import Alpine from "alpinejs";
import "./bootstrap";

window.Alpine = Alpine;
Alpine.start();

// Utility function to show confirmation dialog
window.confirmAction = (message, callback) => {
    if (confirm(message)) {
        callback();
    }
};

// Handle flash messages auto-hide
document.addEventListener("DOMContentLoaded", () => {
    const flashMessages = document.querySelectorAll("[data-auto-hide]");
    flashMessages.forEach((message) => {
        setTimeout(() => {
            message.style.display = "none";
        }, 3000);
    });
});

// Form validation helper
window.validateForm = (form) => {
    const requiredFields = form.querySelectorAll("[required]");
    let isValid = true;

    requiredFields.forEach((field) => {
        if (!field.value.trim()) {
            field.classList.add("border-red-500");
            isValid = false;
        } else {
            field.classList.remove("border-red-500");
        }
    });

    return isValid;
};
