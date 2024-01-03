// document.addEventListener("DOMContentLoaded", function () {
//   const toggleButton = document.getElementById("toggleTheme");
//   const themeLink = document.getElementById("theme-link");
//   const logoImage = document.getElementById("logo-image");
//   const logoImagesm = document.getElementById("logo-image-sm");
//   const lightThemeURL = "assets/css/light-theme.css";
//   const darkThemeURL = "assets/css/dark-theme.css";
//   const lightLogoURL = "assets/images/DigiSplix-Logo-for-Light-Mode.png";
//   const darkLogoURL = "assets/images/DigiSplix-logo-for-dark-mode.png";

//   toggleButton.addEventListener("click", function () {
//     if (themeLink.href.includes(lightThemeURL)) {
//       themeLink.href = darkThemeURL;
//       logoImage.src = darkLogoURL; // Update the logo for dark theme
//       logoImagesm.src = darkLogoURL; // Update the logo for dark theme
//       // alert("Switching to dark theme");
//     } else {
//       themeLink.href = lightThemeURL;
//       logoImage.src = lightLogoURL; // Update the logo for light theme
//       logoImagesm.src = lightLogoURL; // Update the logo for light theme
//       // alert("Switching to light theme");
//     }
//   });
// });

// Toggle theme
$(document).ready(function () {

    if (typeof assetUrls !== 'undefined') {
        const currentMode = getMode();
        const lightThemeURL = assetUrls.lightThemeURL;
        const darkThemeURL = assetUrls.darkThemeURL;
        const lightLogoURL = assetUrls.lightLogoURL;
        const darkLogoURL = assetUrls.darkLogoURL;
        const lightThemeURLChat = assetUrls.lightThemeURLChat;
        const darkThemeURLChat = assetUrls.darkThemeURLChat;

        if (currentMode === "dark") {
            $("#theme-link").attr("href", darkThemeURL);
            $("#theme-link-chat").attr("href", darkThemeURLChat);
            $("#logo-image").attr("src", darkLogoURL);
            $("#logo-image-sm").attr("src", darkLogoURL);
        } else {
            $("#theme-link").attr("href", lightThemeURL);
            $("#theme-link-chat").attr("href", lightThemeURLChat);
            $("#logo-image").attr("src", lightLogoURL);
            $("#logo-image-sm").attr("src", lightLogoURL);
        }

        $("#toggleTheme").click(function () {
            const currentMode = getMode();
            const newMode = currentMode === "dark" ? "light" : "dark";
            toggleMode(newMode);
        });

        function setMode(mode) {
            // Set a cookie named "preferredMode" with the mode value
            Cookies.set("preferredMode", mode, { expires: 365 }); // Cookie expires in 365 days

            if (mode === "dark") {
                $("#theme-link").attr("href", darkThemeURL);
                $("#theme-link-chat").attr("href", darkThemeURLChat);
                $("#logo-image").attr("src", darkLogoURL);
                $("#logo-image-sm").attr("src", darkLogoURL);
            } else {
                $("#theme-link").attr("href", lightThemeURL);
                $("#theme-link-chat").attr("href", lightThemeURLChat);
                $("#logo-image").attr("src", lightLogoURL);
                $("#logo-image-sm").attr("src", lightLogoURL);
            }
        }

        function getMode() {
            // Get the value of the "preferredMode" cookie
            return Cookies.get("preferredMode");
        }

        function toggleMode(newMode) {
            setMode(newMode);
        }
    }
});

// Toggle sidebar
$(document).ready(function () {
    const currentSidebar = getSidebar();

    if (currentSidebar === "open") {
        $("#sidebar").removeClass("collapsed");
    } else {
        $("#sidebar").addClass("collapsed");
    }

    $("#btn-collapse").click(function () {
        const currentSidebar = getSidebar();
        const newSidebar = currentSidebar === "open" ? "close" : "open";
        toggleSidebar(newSidebar);
    });

    function setSidebar(sidebar) {
        // Set a cookie named "preferredSidebar" with the Sidebar value
        Cookies.set("preferredSidebar", sidebar, { expires: 365 }); // Cookie expires in 365 days

        if (sidebar === "open") {
            $("#sidebar").removeClass("collapsed");
        } else {
            $("#sidebar").addClass("collapsed");
        }
    }

    function getSidebar() {
        // Get the value of the "preferredSidebar" cookie
        return Cookies.get("preferredSidebar");
    }

    function toggleSidebar(newSidebar) {
        setSidebar(newSidebar);
    }
});

// expand screen
$(document).ready(function () {
    $("#fullscreen-button").on("click", function () {
        var element = document.documentElement; // Get the HTML element

        if (
            !document.fullscreenElement && // If no element is in full screen
            !document.mozFullScreenElement &&
            !document.webkitFullscreenElement &&
            !document.msFullscreenElement
        ) {
            // Check if any fullscreen element is present
            if (element.requestFullscreen) {
                element.requestFullscreen(); // Enter fullscreen mode
            } else if (element.mozRequestFullScreen) {
                element.mozRequestFullScreen();
            } else if (element.webkitRequestFullscreen) {
                element.webkitRequestFullscreen();
            } else if (element.msRequestFullscreen) {
                element.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen(); // Exit fullscreen mode
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
    });
});

// =====================================quick menu
$(".side-menu-quick-btn").on("click", function () {
    $("#side-menu-quick").css("right", "0px");
    $("#overlay-all").css("display", "block");
});
$(".close-btn").on("click", function () {
    $("#side-menu-quick").css("right", "-400px");
    $("#overlay-all").css("display", "none");
});
$("#documents-btn").on("click", function () {
    $("#documents-menu").css("right", "0px");
    $("#overlay-all").css("display", "block");
});
$(".close-btn").on("click", function () {
    $("#documents-menu").css("right", "-400px");
    $("#overlay-all").css("display", "none");
});
$("#overlay-all").on("click", function () {
    $(this).css("display", "none");
    $("#side-menu-quick").css("right", "-400px");
    $("#documents-menu").css("right", "-400px");
    $(".side-menu-ticket").css("right", "-400px");
    $(".menu-footer-popup").toggleClass("menu-footer-popup-show");
    $(".overlay").toggleClass("overlay-show");
    $("#show-more-menu").toggleClass("active-footer-menu");
});

// =====================================ticket menu
$(".side-menu-ticket-btn").on("click", function () {
    $(".side-menu-ticket").css("right", "0px");
    $("#overlay-all").css("display", "block");
});
$(".close-btn").on("click", function () {
    $(".side-menu-ticket").css("right", "-400px");
    $("#overlay-all").css("display", "none");
});
//   =============================================chat
$(".chat-btn").on("click", function () {
    $(".chat__popup").css("bottom", "30px");
});
$(".close-chat").on("click", function () {
    $(".chat__popup").css("bottom", "-700px");
});

// ======================================more footer
// $("#show-more-menu").on("click", function () {
//   $(".menu-footer-popup").toggle('.menu-footer-popup-show');
//   $("#overlay").css("display", "block");
//   // $(".menu-footer").css("box-shadow","none")

// });
$("#show-more-menu").on("click", function () {
    $(".menu-footer-popup").toggleClass("menu-footer-popup-show");
    $(".menu-footer").toggleClass("menu-footer-shadow");
    $(".overlay").toggleClass("overlay-show");
    $(this).toggleClass("active-footer-menu");
});

function applyStyles2() {
    const screenWidth = $(window).width();

    // Check if the screen width is less than 991px
    if (screenWidth < 991) {
        $("#overlay-all").on("click", function () {
            // $(".theme").css("overflow", "auto");
            $(".theme").toggleClass("theme-override");
        });
        $(".side-menu-ticket-btn").on("click", function () {
            // $(".theme").css("overflow", "hidden");
            $(".theme").toggleClass("theme-override");
        });
        $(".close-btn").on("click", function () {
            // $(".theme").css("overflow", "auto");
            $(".theme").toggleClass("theme-override");
        });
        $(".side-menu-quick-btn").on("click", function () {
            // $(".theme").css("overflow", "hidden");
            $(".theme").toggleClass("theme-override");
        });
        $("#show-more-menu").on("click", function () {
            $(".theme").toggleClass("theme-override");
        });
    }
}

// Listen for the resize event
$(window).on("resize", applyStyles2);

// Initial application of styles
applyStyles2();

// ==============================================footer date
// Get the current year
const currentYear = new Date().getFullYear();

// Update the content of the element with the current year
var copyrightYear = document.getElementById("copyright-year")
if (copyrightYear) {
    copyrightYear.textContent = `Copyright © ${currentYear} DigiSplix, LLC. All Rights Reserved`;
}


// Show preloader only once in 2 hours
const twoHours = 2 * 60 * 60 * 1000; // 2 hours in milliseconds
const now = new Date();
const twoHoursLater = new Date(now.getTime() + twoHours);

Cookies.set('preloader', 'set', {
    expires: twoHoursLater,
    path: '/'
});

// Cookies.remove("preloader", {path: '/'})

// Active menu item
$("nav li a").each(function () {

    var currentUrl = window.location.href;
    var url = new URL(currentUrl);
    var pathname = url.pathname;
    var segments = pathname.split('/');
    var partSegment = segments[1];

    if (partSegment.length == 0) {
        $(".dashboard-link").addClass("active-menu");
    } else if (currentUrl.includes($(this).attr("href")) && partSegment.length > 0) {
        if ($(this).hasClass('dashboard-link')) {
            return;
        }
        $(this).addClass("active-menu");
    } else {
        $(this).removeClass("active-menu");
    }
});

// Active footer menu item
$(".footer-menu-link, .more-footer-link").each(function () {

    var currentUrl = window.location.href;
    var url = new URL(currentUrl);
    var pathname = url.pathname;
    var segments = pathname.split('/');
    var partSegment = segments[1];

    if (partSegment.length == 0) {
        $(".dashboard-link").addClass("active-footer-menu");
    } else if (currentUrl.includes($(this).find('a').attr("href")) && partSegment.length > 0) {
        if ($(this).hasClass('dashboard-link')) {
            return;
        }

        if ($(this).hasClass('more-footer-link')) {
            $('#show-more-menu').addClass("active-footer-menu")
        }
        $(this).addClass("active-footer-menu");
    } else {
        $(this).removeClass("active-footer-menu");
    }
});

$('.dataTables_wrapper .dropdown-toggle').on('click', function () {
    $(this).next('.dropdown-menu').appendTo('body');
});

// Toggle password hide/show
$('.toggle-password').click(function () {
    var passInput = $(this).siblings('input')
    if (passInput.prop('type') == 'text') {
        passInput.prop('type', 'password')
    } else {
        passInput.prop('type', 'text')
    }
})

// Fetch unread messages from database
window.onload = function () {
    if (typeof messagesRoute !== 'undefined') {
        setInterval(() => {
            $.ajax({
                type: "GET",
                url: messagesRoute,
                success: data => {
                    if (data == 0) {
                        $('.messages-count').remove()
                        $('.messages-count-sm').remove()
                    } else if (data == 1) {
                        $('.messages-count-container-sm').append(`<span class="messages-count-sm">${data}</span>`)
                        $('.messages-count-container').append(`<span class="messages-count">${data}</span>`)
                    } else {
                        $('.messages-count-sm').text(data);
                        $('.messages-count').text(data);
                    }
                },
                error: err => console.log(err),
            });
        }, 1000);
    }
}
