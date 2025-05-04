document.getElementById('toggleIndicators').addEventListener('change', function () {
    const show = this.checked;
    const cells = document.querySelectorAll('.indicator');

    cells.forEach(cell => {
        if (show) {
            cell.style.backgroundColor = cell.getAttribute('data-color');
        } else {
            cell.style.backgroundColor = '';
        }
    });
});
