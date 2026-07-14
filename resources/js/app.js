import "./bootstrap";

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[type="file"][data-preview]')
        .forEach(input => {
            input.addEventListener('change', function () {
                const preview = document.getElementById(this.dataset.preview);
                if (!preview || !this.files.length) {
                    return;
                }
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(this.files[0]);
            });
        });
});