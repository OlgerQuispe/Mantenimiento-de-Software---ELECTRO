document.addEventListener("DOMContentLoaded", function() {
    var productos = document.querySelectorAll(".tab-pane"); // Obtener todos los productos

    // Agregar evento de clic a cada enlace de categoría
    document.querySelectorAll(".main-nav a").forEach(function(enlace) {
        enlace.addEventListener("click", function(evento) {
            evento.preventDefault(); // Evitar la acción predeterminada del enlace

            var categoria = this.getAttribute("data-category"); // Obtener la categoría de la que se hizo clic
            console.log(categoria);
            // Iterar sobre todos los productos para mostrar solo los que coinciden con la categoría seleccionada
            productos.forEach(function(producto) {
                var categoriaProducto = producto.querySelector(".product-category").textContent;
                
                console.log(categoriaProducto);

                if (categoria === "all" || categoria === categoriaProducto) {
                    producto.style.display = "block";
                } else {
                    producto.style.display = "none";
                }
            });
        });
    });
});
