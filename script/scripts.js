
    document.getElementById("producto_id").addEventListener("change", function () {
        var cantidadDisponible = this.options[this.selectedIndex].getAttribute('data-disponible');
        document.getElementById("cantidad_disponible").innerText = "Cantidad Disponible: " + cantidadDisponible;
    });


    document.getElementById("producto_id").addEventListener("change", function () {
        var productoId = this.value;

        // Realizar una solicitud AJAX para obtener información adicional del producto
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var productoInfo = JSON.parse(this.responseText);

                // Actualizar la información adicional en el formulario
                document.getElementById("categoria_info").innerText = "Categoría: " + productoInfo.categoria;
                document.getElementById("ubicacion_info").innerText = "Ubicación: " + productoInfo.ubicacion;
                document.getElementById("marca_info").innerText = "Marca: " + productoInfo.marca;
            }
        };
        xhr.open("GET", "obtener_info_producto.php?id=" + productoId, true);
        xhr.send();
    });


// Script para actualizar automáticamente el campo de cargo al seleccionar una persona
document.getElementById("persona_id").addEventListener("change", function () {
    var selectedOption = this.options[this.selectedIndex];
    var cargoField = document.getElementById("cargo");

    // Llenar el campo de cargo con el valor asociado al dato seleccionado
    cargoField.value = selectedOption.getAttribute("data-cargo");
});
