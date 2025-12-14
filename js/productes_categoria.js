document.addEventListener("DOMContentLoaded", function() {
    
    const categoryID = document.querySelector("body").dataset.categoryId;
    
    if(!categoryID) {
        console.error("No s'ha trobat el ID de la categoria");
        return;
    }
    
    fetch(`index.php?accio=llistar-productes&category_id=${categoryID}`)
    .then(response => {
        if(!response.ok) {
            throw new Error('Error en la resposta');
        }
        return response.json(); //response.text()
    })
    .then(data => {
        const productList = document.querySelector('.product-list');
        if (!productList) {
            console.error("no s'ha trobat res en product-list");
            return;
        }
        if(data.length > 0 ) {
            productList.innerHTML ='';
            data.forEach(producte => {
                productList.innerHTML +=`
                    <div class="product-item">
                    <img src="../img/${producte.img}" alt="${producte.nom}">
                    <h3><a href="../index.php?accio=detall-producte&product_id=${producte.id}">${producte.nom}</a></h3>
                    ${producte.descripcio ? `<p>${producte.descripcio}</p>` : ''}
                    <p class="price">Preu: ${Number(producte.preu).toFixed(2)} €</p>
                </div>
                `;
            });
        } else {
            productList.innerHTML = '<p>No hi ha productes disponibles per a aquesta categoria.</p>';
        }
    })
    .catch(error => console.error('Error: ', error));
});

// ---------------------------------------------------------------------------------------------------------------------------

// Función para mostrar productos por categoría
function showProducts(categoryId) {
    // Realizar una solicitud para obtener productos por categoría
    fetch(`/controller/productes.php?categoria_id=${categoryId}`)
        .then(response => response.text())
        .then(data => {
            // Insertar los productos en el contenedor correspondiente
            document.getElementById("id-container-producte").innerHTML = data;
        });
}

// Función para mostrar los detalles de un producto
function showProductDetail(productId) {
    console.log('Product ID:', productId);  // Verifica que el ID sea el esperado

    // Realizar una solicitud para obtener los detalles del producto
    fetch(`/controller/detall_producte.php?id=${productId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text(); // Cambiar a .text() porque la respuesta es HTML
        })
        .then(data => {
            console.log('Product detail response:', data);  // Verifica el contenido de la respuesta

            // Verificar que el contenedor con ID "id-product-detail" existe
            const productDetail = document.getElementById('id-product-detail');

            if (productDetail) {
                // Insertamos el contenido HTML recibido en el contenedor
                productDetail.innerHTML = data;

                // Hacemos visible el contenedor de detalles
                productDetail.style.display = 'block';

                // Desplazar la página hacia el detalle del producto de forma suave
                productDetail.scrollIntoView({ behavior: 'smooth' });
            } else {
                console.error('El elemento HTML con ID "id-product-detail" no se encontró.');
            }
        })
        .catch(error => {
            console.error('Error fetching product detail:', error);
            alert('Hubo un error al cargar los detalles del producto.');
        });
}

// Función para buscar productos
function searchProducts() {
    const query = document.getElementById('search-input').value.trim();
    if (query === '') {
        alert('Por favor, ingresa un término de búsqueda.');
        return;
    }

    // Realizar una solicitud para buscar productos
    fetch(`/controller/cercador.php?query=${encodeURIComponent(query)}`)
        .then(response => response.text())
        .then(data => {
            // Insertar los resultados de la búsqueda en el contenedor correspondiente
            document.getElementById("id-container-producte").innerHTML = data;
        })
        .catch(error => {
            console.error('Error al buscar productos:', error);
            alert('Ocurrió un error al buscar los productos.');
        });
}

// Función para mostrar todos los productos
function showAllProducts() {
    // Realizar una solicitud para obtener todos los productos
    fetch('/controller/productes.php') 
        .then(response => response.text())
        .then(data => {
            // Insertar todos los productos en el contenedor correspondiente
            document.getElementById("id-container-producte").innerHTML = data;
        })
        .catch(error => {
            console.error('Error al mostrar todos los productos:', error);
            alert('Ocurrió un error al cargar todos los productos.');
        });
}