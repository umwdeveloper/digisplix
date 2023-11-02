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
  const currentMode = getMode();

    const lightThemeURL = assetUrls.lightThemeURL;
    const darkThemeURL = assetUrls.darkThemeURL;
    const lightLogoURL = assetUrls.lightLogoURL;
    const darkLogoURL = assetUrls.darkLogoURL;

  if (currentMode === "dark") {
    $("#theme-link").attr("href", darkThemeURL);
    $("#logo-image").attr("src", darkLogoURL);
    $("#logo-image-sm").attr("src", darkLogoURL);
  } else {
    $("#theme-link").attr("href", lightThemeURL);
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
      $("#logo-image").attr("src", darkLogoURL);
      $("#logo-image-sm").attr("src", darkLogoURL);
    } else {
      $("#theme-link").attr("href", lightThemeURL);
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
document.getElementById(
  "copyright-year"
).textContent = `Copyright © ${currentYear} DigiSplix, LLC. All Rights Reserved`;
