 function showModal(modalId) {
        document.getElementById(modalId).style.display = 'flex';
    }

    function hideModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    function login() {
        // Hide all elements with the class 'home1331'
        var elements = document.querySelectorAll('.home1331');
        elements.forEach(function (element) {
            element.style.display = 'none';
        });

        // Show all elements with the class 'home1332'
        var showElements = document.querySelectorAll('.home1332');
        showElements.forEach(function (element) {
            element.style.display = 'block';
        });

        hideModal('loginModalContent'); // Assuming you want to close the modal on login
    }

    function logout() {
        // Show all elements with the class 'home1331'
        var elements = document.querySelectorAll('.home1331');
        elements.forEach(function (element) {
            element.style.display = 'block';
        });

        // Hide all elements with the class 'home1332'
        var hideElements = document.querySelectorAll('.home1332');
        hideElements.forEach(function (element) {
            element.style.display = 'none';
        });
    }

    function toggleDropdown() {
        var dropdown = document.getElementById('dropdownMenu');
        if (dropdown.style.display === 'none') {
            dropdown.style.display = 'block';
        } else {
            dropdown.style.display = 'none';
        }
    }

    // Optionally, add this to close the dropdown if clicked outside
    window.onclick = function (event) {
        if (!event.target.matches('.home1332 img')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === "block") {
                    openDropdown.style.display = "none";
                }
            }
        }
    }

    let dropdownVisible = false;
    const authImage = document.querySelector('.auth-image');
    const authDropdown = document.getElementById('authDropdown');

    authImage.addEventListener('mouseenter', () => {
        dropdownVisible = !dropdownVisible;
        authDropdown.style.display = dropdownVisible ? 'block' : 'none';
    });

    // Video navigation function
    function changeVideo(direction) {
        const video = document.getElementById('mainVideo');
        const sources = video.getElementsByTagName('source');
        const dots = document.getElementsByClassName('nav-dot');
        const currentSrc = video.currentSrc;
        let nextIndex = 0;

        // Find current video index
        for(let i = 0; i < sources.length; i++) {
            if(sources[i].src === currentSrc) {
                nextIndex = (i + direction + sources.length) % sources.length;
                break;
            }
        }

        // Update dots
        for (let i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        dots[nextIndex].className += " active";

        // Change video
        video.src = sources[nextIndex].src;
        video.play();
    }

    function goToVideo(index) {
        const video = document.getElementById('mainVideo');
        const sources = video.getElementsByTagName('source');
        const dots = document.getElementsByClassName('nav-dot');
        
        // Update dots
        for (let i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        dots[index].className += " active";
        
        // Change video
        video.src = sources[index].src;
        video.play();
    }

    // Set first dot as active initially
    document.getElementsByClassName('nav-dot')[0].className += " active";