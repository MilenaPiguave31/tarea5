function validarCantidad() {
    const input = document.getElementById('quantity');
    if (input && parseInt(input.value) < 0) {
        alert('La cantidad no puede ser negativa');
        return false;
    }
    return true;
}
