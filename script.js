document.addEventListener('scroll', () => {
    const btn = document.getElementById('backToTop');
    btn.classList.toggle('hidden', window.scrollY < 200);
});

function resetForm() {
    document.getElementById('applicationForm').reset();
}

function closeModal() {
    document.getElementById('successModal').classList.add('hidden');
}
