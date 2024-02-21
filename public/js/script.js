const form = document.querySelector('.form'),
    tradeNumber = document.querySelector('input#tradeNumber'),
    lotNumber = document.querySelector('input#lotNumber'),
    alert = document.querySelector('#alert');

lotNumber.addEventListener('input', (e) => {
    const regexp = new RegExp("[0-9]{4}");
    if (e.target.value.length > 4) {
        e.target.value = e.target.value.slice(0, 4);
    }
})

tradeNumber.addEventListener('change', (e) => {
    const regexp = new RegExp("^[0-9]{4,}[-]{1}[А-Я]{4}$");
    let value = e.target.value.trim();
    if (!regexp.test(value)) {
        e.target.value = '';
        alert.style.display = 'block';
    } else {
        alert.style.display = 'none';
    }
});
