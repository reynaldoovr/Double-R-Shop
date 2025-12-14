console.log("Cistella.js loaded");

$(document).ready(function() {
    console.log("Document ready");
    
    $('#finalitzar-btn').on('click', function() {
        console.log("Button clicked");
        finalitzarCompra();
    });
});

function actualitzarCistella() {
    location.reload();
}

function afegirACistella(productId, nom, preu, img) {
    fetch('/controller/afegir_cistella.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            product_id: productId,
            nom: nom,
            preu: preu,
            quantitat: 1,
            img: img
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('Producte afegit a la cistella');
            actualitzarCistella();
        }
    });
}

function eliminarDeCistella(productId) {
    fetch('/controller/eliminar_cistella.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            product_id: productId
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            location.reload();
        }
    });
}

function buidarCistella() {
    if (confirm("Estàs segur que vols buidar tota la cistella?")) {
        $.ajax({
            url: 'index.php?accio=buidar-cistella',
            method: 'POST',
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert('Hi ha hagut un error al buidar la cistella');
                }
            },
            error: function() {
                alert('Hi ha hagut un error al buidar la cistella');
            }
        });
    }
}

function finalitzarCompra() {
    console.log("finalitzarCompra function called");
    if (confirm('Vols finalitzar la compra?')) {
        console.log("Purchase confirmed");
        $.ajax({
            url: 'index.php?accio=processar-compra',
            method: 'POST',
        });
    }
}