<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark premium-nav">
    <div class="container nav-flex-wrapper">
        <a class="navbar-brand font-weight-bold" href="index.php">
            <i class="fa fa-heart text-danger mr-2"></i>BloodBank<span class="brand-divider">| Donor Hub</span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-collapse-trigger>
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="nav-menu-wrapper" id="navbarExample">
            <ul class="custom-nav-links">
                <li><a class="nav-link-item" href="page.php?type=aboutus">Our Mission</a></li>
                <li><a class="nav-link-item" href="page.php?type=donor">Why Donate?</a></li>
                <li><a class="nav-link-item" href="become-donar.php">Register as Donor</a></li>
                <li>
                    <a class="nav-link-item highlight-link" href="search-donor.php">
                        <i class="fa fa-search mr-1"></i> Find Blood
                    </a>
                </li>
                <li><a class="nav-link-item" href="contact.php">Contact Us</a></li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Fixed Container Constraints */
    .premium-nav {
        background-color: #16181b !important; /* Deep matte black background */
        padding: 0 !important;
        height: 70px;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    /* Core Layout Flex Arrangement */
    .nav-flex-wrapper {
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between !important;
        align-items: center !important;
        width: 100%;
        height: 100%;
    }

    /* Logo Text Modifications */
    .premium-nav .navbar-brand {
        font-size: 1.25rem;
        color: #ffffff !important;
        display: flex;
        align-items: center;
        margin: 0;
        padding: 0;
    }

    .brand-divider {
        color: #718096 !important;
        font-weight: 300;
        margin-left: 6px;
    }

    /* Inline Item Strip Layout */
    .custom-nav-links {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        list-style: none !important;
        margin: 0 !important;
        padding: 0 !important;
        gap: 8px; /* Balanced structural spacing between links */
    }

    /* New Animated Menu Item Links */
    .nav-link-item {
        color: rgba(255, 255, 255, 0.75) !important;
        font-size: 0.95rem;
        font-weight: 500;
        text-decoration: none !important;
        padding: 8px 16px;
        display: block;
        position: relative;
        transition: color 0.25s ease;
    }

    /* Premium Slide-under Line Accent Effect */
    .nav-link-item::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 16px;
        right: 16px;
        height: 2px;
        background-color: #dc3545;
        transform: scaleX(0);
        transition: transform 0.25s ease;
        transform-origin: right;
    }

    .nav-link-item:hover {
        color: #ffffff !important;
    }

    .nav-link-item:hover::after {
        transform: scaleX(1);
        transform-origin: left;
    }

    /* Find Blood Emergency Standout Button Style */
    .custom-nav-links .highlight-link {
        color: #dc3545 !important;
        font-weight: 700;
    }

    .custom-nav-links .highlight-link::after {
        background-color: #ff4d5e;
    }

    .custom-nav-links .highlight-link:hover {
        color: #ff4d5e !important;
    }

    /* Responsive Mobile Handling Overrides */
    @media (max-width: 991.98px) {
        .premium-nav {
            height: auto;
            padding: 15px 0 !important;
        }
        .nav-flex-wrapper {
            flex-wrap: wrap;
        }
        .navbar-toggler {
            display: block !important;
        }
        .nav-menu-wrapper {
            display: none;
            width: 100%;
            margin-top: 15px;
        }
        .nav-menu-wrapper.show-mobile {
            display: block !important;
        }
        .custom-nav-links {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 4px;
            width: 100%;
        }
        .nav-link-item {
            padding: 10px 0;
            width: 100%;
        }
        .nav-link-item::after {
            left: 0;
            right: 0;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var toggleBtn = document.querySelector('[data-collapse-trigger]');
        var menuWrapper = document.getElementById('navbarExample');
        
        if(toggleBtn && menuWrapper) {
            toggleBtn.addEventListener('click', function() {
                menuWrapper.classList.toggle('show-mobile');
            });
        }
    });
</script>