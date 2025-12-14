document.addEventListener('DOMContentLoaded', function() {
    const queryParams = new URLSearchParams(window.location.search);
    const action = queryParams.get('accio');
    const header = document.getElementById('main-header');
    const nav = document.getElementById('main-nav');

    const hideNavPages = ['register', 'login'];

    if(hideNavPages.includes(action)) {
        if (header) header.style.display = 'none';
        if (nav) nav.style.display = 'none';
    }
});