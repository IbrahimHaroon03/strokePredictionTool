window.onload = function() {
    // Get the current page's full path (e.g., "/Users/.../templates/sign_up.html")
    const currentPath = window.location.pathname;

    // Extract just the filename (e.g., "sign_up.html")
    const currentPage = currentPath.split('/').pop();

    // Get all the <li> elements in the navbar
    const navItems = document.querySelectorAll('.side-navbar ul li');

    // Loop through each <li> element
    navItems.forEach((li) => {
        // Get the <a> tag inside the <li>
        const link = li.querySelector('a');

        // Extract the filename from the link's href (e.g., "sign_up.html")
        const linkPage = link.getAttribute('href').split('/').pop();

        // Check if the link's filename matches the current page's filename
        if (linkPage === currentPage) {
            // Add the 'active' class to the <li>
            li.classList.add('active');
        }
    });
};
