document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("producto_id").addEventListener("change", function () {
        var cantidadDisponible = this.options[this.selectedIndex].getAttribute('data-disponible');
        document.getElementById("cantidad_disponible").textContent = "Cantidad Disponible: " + cantidadDisponible;
    });
});


