document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    
    form.addEventListener('submit', function(e) {
        const nom = document.getElementById('nom').value.trim();
        const email = document.getElementById('email').value.trim();
        const codiPostal = document.getElementById('codi_postal').value.trim();
        
        let errors = [];
        
        if (!nom) errors.push("El nom és obligatori");
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            errors.push("El correu electronic no es valid");
        }
        if (!/^\d{5}$/.test(codiPostal)) {
            errors.push("El codi postal no es valid, ha de ser un numero de 5 digits");
        }
        
        if (errors.length > 0) {
            e.preventDefault();
            alert(errors.join("\n"));
        }
    });
});