// !function(l){
//     "use strict";
//     l("#sidebarToggle, #sidebarToggleTop").on("click",
    
//     function(e){
//         l("body").toggleClass("sidebar-toggled"),
//         l(".sidebar").toggleClass("toggled"),
//         l(".sidebar").hasClass("toggled")&&l(".sidebar .collapse").collapse("hide")
//     }),
    
//     l(window).resize(
//         function(){
//             l(window).width()<768&&l(".sidebar .collapse").collapse("hide"),
//             l(window).width()<480&&!l(".sidebar").hasClass("toggled")&&(l("body").addClass("sidebar-toggled"),
//             l(".sidebar").addClass("toggled"),
//             l(".sidebar .collapse").collapse("hide"))
//         }),
//         l("body.fixed-nav .sidebar").on("mousewheel DOMMouseScroll wheel",
            
//     function(e){
//         var o;
        
//         768<l(window).width()&&(o=(o=e.originalEvent).wheelDelta||-o.detail,
//         this.scrollTop+=30*(o<0?1:-1),
//         e.preventDefault())
//     }),
//     l(document).on("scroll",
            
//     function(){
//         100<l(this).scrollTop()?l(".scroll-to-top").fadeIn():
//         l(".scroll-to-top").fadeOut()
//     }),
//     l(document).on("click","a.scroll-to-top",
            
//     function(e){
//         var o=l(this);
//         l("html, body").stop().animate({
//             scrollTop:l(o.attr("href")).offset().top},1e3,"easeInOutExpo"),e.preventDefault()
//     })
// }
// (jQuery);

!function(l) {
    "use strict";
    l("#sidebarToggle, #sidebarToggleTop").on("click", function(e) {
        l("body").toggleClass("sidebar-toggled");
        l(".sidebar").toggleClass("toggled");
        l(".sidebar").hasClass("toggled") && l(".sidebar .collapse").collapse("hide");

        // Adjust sidebar width and icon sizes when toggled
        if (l(".sidebar").hasClass("toggled")) {
            l(".navbar-nav.sidebar").css("width", "90px"); // Narrow width when toggled
            l(".nav-link i").each(function() {
                l(this).css({
                    "font-size": "2rem",
                    "width": "100%",
                    "display": "flex",
                    "justify-content": "center",
                    "align-items": "center"
                });
            });
            l(".nav-link span").hide(); // Hide text
        } else {
            l(".navbar-nav.sidebar").css("width", "230px"); // Default width
            l(".nav-link i").each(function() {
                l(this).css({
                    "font-size": "1.5rem",
                    "width": "auto",
                    "display": "inline-block",
                    "justify-content": "flex-start",
                    "align-items": "center"
                });
            });
            l(".nav-link span").show(); // Show text
        }
    });
}(jQuery);


                /* SIDEBAR CONTAINER MOBILE VERSION */
    /* .sidebar {
        width: 4.5rem;
        min-height: 100vh;
    }
    
    .sidebar .nav-item {
        position: relative;
    }
    
    .sidebar .nav-item:last-child {
        margin-bottom: 1rem;
    }
    
    .sidebar .nav-item .nav-link {
        text-align: center;
        padding: 0.75rem 1rem;
        width: 4.5rem;
    }
    
    .sidebar .nav-item .nav-link span {
        font-size: 0.46rem;
        display: block;
    }
    
    .sidebar .nav-item.active .nav-link {
        font-weight: 700;
    }
    
    .sidebar .nav-item .collapse {
        position: absolute;
        left: calc(6.5rem + 1.5rem / 2);
        z-index: 1;
        top: 2px;
    }
    
    .sidebar .nav-item .collapse .collapse-inner {
        border-radius: 0.35rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }
    
    .sidebar .nav-item .collapsing {
        display: none;
        transition: none;
    }
    
    .sidebar .nav-item .collapse .collapse-inner,
    .sidebar .nav-item .collapsing .collapse-inner {
        padding: 0.5rem 0;
        min-width: 10rem;
        font-size: 0.85rem;
        margin: 0 0 1rem 0;
    }
    
    .sidebar #sidebarToggle {
        width: 2.5rem;
        height: 2.5rem;
        text-align: center;
        margin-bottom: 1rem;
        cursor: pointer;
    }
    
    .sidebar #sidebarToggle::after {
        font-weight: 900;
        content: "\f104";
        font-family: "Font Awesome 5 Free";
        margin-right: 0.1rem;
    }
    
    .sidebar #sidebarToggle:hover {
        text-decoration: none;
    }
    
    .sidebar #sidebarToggle:focus {
        outline: 0;
    }
    
    .sidebar.toggled {
        width: 0 !important;
        overflow: hidden;
    }
    
    .sidebar.toggled #sidebarToggle::after {
        content: "\f105";
        font-family: "Font Awesome 5 Free";
        margin-left: 0.25rem;
    }
    
    .sidebar.toggled .sidebar-card {
        display: none;
    }
    
    .sidebar .sidebar-brand {
        height: 4.375rem;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 800;
        padding: 1.5rem 1rem;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 0.05rem;
        z-index: 1;
    }
    
    .sidebar .sidebar-brand .sidebar-brand-icon i {
        font-size: 3rem;
    }
    
    .sidebar .sidebar-brand .sidebar-brand-text {
        display: none;
    }
    
    .sidebar hr.sidebar-divider {
        margin: 0 1rem 1rem;
    }
    
    .sidebar .sidebar-heading {
        text-align: center;
        padding: 0 1rem;
        font-weight: 800;
        font-size: 0.65rem;
    } */
    /* SIDEBAR CONTAINER MOBILE VERSION */


    


















//     @media (min-width: 768px) { /* Adjust breakpoint as needed */
//     #accordionSidebar {
//         width: 230px; /* Set the sidebar width */
//     }
    
//     .navbar-nav.sidebar .nav-item {
//         display: flex; /* Make it a flex container */
//         justify-content: flex-start; /* Align items to the left */
//         width: 100%; /* Ensure nav-items take full width */
//         margin-bottom: 10px; /* Add spacing between nav-items */
//     }
    
//     .navbar-nav.sidebar .nav-link {
//         display: flex; /* Use flex to align icon and text */
//         align-items: center; /* Center items vertically */
//         text-align: left; /* Align text to the left */
//         width: 100%; /* Make link occupy full width */
//         font-size: 18px; /* Increase font size */
//         padding: 10px; /* Add padding for clickable area */
//         margin-left: 10px; /* Add left margin for spacing */
//     }

//     .navbar-nav.sidebar .nav-link i {
//         font-size: 24px; /* Set a uniform size for icons */
//         width: 24px; /* Fixed width for consistency */
//         height: 24px; /* Fixed height for consistency */
//         line-height: 24px; /* Center vertically if needed */
//         margin-right: 15px; /* Adjust this value for spacing between icon and text */
//     }
// }
