document.getElementById('ctaForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = this;
    const msg = document.querySelector('.cta-message');

    fetch(ghbCta.ajax_url, {
        method: 'POST',
        body: new FormData(form)
    })
    .then(res => res.json())
    .then(data => {
        msg.textContent = data.data;
        msg.style.color = data.success ? 'green' : 'red';
        if (data.success) form.reset();
    });
});