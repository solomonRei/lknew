function showErrorAlert(messages) {
    const translations = document.getElementById('alertTranslations');
    Swal.fire({
        title: translations.dataset.alertError,
        html: messages,
        icon: 'error',
        confirmButtonText: translations.dataset.alertOk
    });
}

function showSuccessAlert(message) {
    const translations = document.getElementById('alertTranslations');
    Swal.fire({
        title: translations.dataset.alertSuccess,
        text: message,
        icon: 'success',
        confirmButtonText: translations.dataset.alertOk
    });
}
