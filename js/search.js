document.addEventListener("DOMContentLoaded", function() {
    // Obtener todos los productos
    var productos = document.querySelectorAll(".product");

    // Obtener el campo de búsqueda
    var searchInput = document.getElementById("search-input");

    // Agregar evento de escucha al campo de búsqueda
    searchInput.addEventListener("input", function() {
        var searchTerm = searchInput.value.toLowerCase(); // Obtener el texto de búsqueda en minúsculas

        // Iterar sobre todos los productos para ocultar aquellos que no coinciden con el término de búsqueda
        productos.forEach(function(producto) {
            var productName = producto.querySelector(".product-name").innerText.toLowerCase(); // Obtener el nombre del producto en minúsculas

            // Si el nombre del producto contiene el término de búsqueda, mostrar el producto; de lo contrario, ocultarlo
            if (productName.includes(searchTerm)) {
                producto.style.display = "block";
            } else {
                producto.style.display = "none";
            }
        });
    });
});
