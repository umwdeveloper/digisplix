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
// const twoHours = 2 * 60 * 60 * 1000; // 2 hours in milliseconds
// const now = new Date();
// const twoHoursLater = new Date(now.getTime() + twoHours);

// Cookies.set('preloader', 'set', {
//     expires: twoHoursLater,
//     path: '/'
// });

// Cookies.remove("preloader", { path: '/' })

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

// Delete Confirmation
let deleteForm;
$(document).on('click', '.delete, .delete-anchor', function (e) {
    e.preventDefault();
    deleteForm = null;

    deleteForm = $(this).closest('form')
    $('#deleteModal').modal('show')
})

$('#confirmDelete').click(function () {
    deleteForm.submit()
})

var pdf;
const generatePDF = function (data) {
    window.jsPDF = window.jspdf.jsPDF;
    pdf = new jsPDF({
        orientation: 'p',
        unit: 'mm',
        format: 'a4',
        lineHeight: 1.5
    });

    pdf.setProperties({
        title: data.invoice_id
    })

    pdf.setFont('Poppins-Regular', 'normal')

    var x = 10;
    var y = 10;

    function pageWidth() {
        return pdf.internal.pageSize.width;
    }

    function pageHeight() {
        return pdf.internal.pageSize.height;
    }

    function getTextWidth(text, fontSize) {
        // Text width in mm
        return (pdf.getStringUnitWidth(text) * pdf.getFontSize()) / (72 / 25.6)
    }

    pdf.addImage(baseUrl + '/images/DigiSplix-logo-for-dark-mode.png', 'PNG', x, y + 1, 45, 12)

    pdf.setFontSize(12)
    pdf.setTextColor('#5c607b')
    pdf.text('Invoice: ', pageWidth() - x - getTextWidth('Invoice: ') - getTextWidth(data.invoice_id) - 6.5, y)
    pdf.text('#' + data.invoice_id, pageWidth() - x - getTextWidth('#' + data.invoice_id), y)

    y += 7;
    const date = data.created_at ? new Date(data.created_at) : new Date();
    var options = { day: 'numeric', month: 'short', year: 'numeric' };
    var formattedDate = date.toLocaleDateString('en-US', options);
    pdf.text('Invoice Date: ', pageWidth() - x - getTextWidth('Invoice Date: ') - getTextWidth('formattedDate'), y)
    pdf.text(formattedDate, pageWidth() - x - getTextWidth(formattedDate), y)

    y += 7;
    const dueDate = data.due_date ? new Date(data.due_date) : new Date();
    options = { day: 'numeric', month: 'short', year: 'numeric' };
    formattedDate = dueDate.toLocaleDateString('en-US', options);
    pdf.text('Due Date: ', pageWidth() - x - getTextWidth('Due Date: ') - getTextWidth('formattedDate'), y)
    pdf.text(formattedDate, pageWidth() - x - getTextWidth(formattedDate), y)

    y += 10
    pdf.setFillColor('#0963ce')
    pdf.rect(0, y, pageWidth() - 80, 10, 'F')

    pdf.setTextColor('#000000')
    pdf.setFontSize(34)
    pdf.setFont("Poppins-Bold", "normal")
    pdf.text('INVOICE', pageWidth() - 80 + 5, y + 9)

    pdf.setFillColor('#0963ce')
    pdf.rect(pageWidth() - 20, y, pageWidth(), 10, 'F')

    y += 22
    pdf.setTextColor('#212529')
    pdf.setFontSize(16)
    pdf.setFont("Poppins-Regular", "normal")
    pdf.text('Invoice From: ', x, y)

    pdf.text('Invoice To: ', pageWidth() - 100, y)

    y += 10
    pdf.setFontSize(13)

    var originalAddress = data.invoice_from;
    var substringToHighlight = "DigiSplix, LLC";
    var startIndex = originalAddress.indexOf(substringToHighlight);
    var highlightedSubstring = ''
    if (startIndex !== -1) {
        highlightedSubstring = originalAddress.substring(startIndex, startIndex + substringToHighlight.length);
        originalAddress = originalAddress.replace(highlightedSubstring, '');

        pdf.setFont("Poppins-Bold", "normal")
        pdf.text(highlightedSubstring, x, y)
    }

    pdf.setFont("Poppins-Regular", "normal")
    pdf.text(originalAddress, x, y)

    var invoiceTo = data.invoice_to;
    var lines = invoiceTo.split('\n');
    var name = lines.shift();
    var address = lines.join('\n');

    pdf.setFont("Poppins-Bold", "normal")
    pdf.text(name, pageWidth() - 100, y)

    y += 7
    pdf.setFont("Poppins-Regular", "normal")
    pdf.text(address, pageWidth() - 100, y)
    var newLines = (data.invoice_to.match(/\n/g) || []).length;

    var lines = pdf.splitTextToSize(data.invoice_to, pdf.internal.pageSize.width);
    var lineHeight = pdf.internal.getFontSize() / pdf.internal.scaleFactor + 2;
    var height = lines.length * lineHeight + 10 + 5;

    if (newLines >= 4) {
        y += 35
    } else {
        y += 30
    }
    const headers = [
        // 'Sr No.',
        'Description',
        'Price',
        'Qty',
        'Total'];
    const rows = [];

    if (data.items.length > 0) {
        data.items.forEach((item, index) => {
            rows.push([
                // index + 1,
                item.description || '',
                '$' + Math.floor((+item.price)),
                item.quantity || '',
                '$' + Math.floor((+item.total))
            ])
        })
    }

    pdf.autoTable({
        head: [headers],
        body: rows,
        startY: y,
        theme: 'plain',
        tableLineColor: '#cccccc',
        tableLineWidth: 0.3,
        fontSize: 12,
        margin: { top: 5, right: 10, bottom: 5, left: 10 },
        styles: {
            cellPadding: 3
        },
        headStyles: {
            fillColor: '#E6EFFA',
            lineColor: '#ffffff',
            lineWidth: { right: 0.5 },
            textColor: '#0963ce',
            // halign: 'center',
        },
        didParseCell: function (data) {
            if (data.column.index === 0) {
                data.cell.styles.halign = 'left'; // Left-align "Description" column in the header row
            } else {
                data.cell.styles.halign = 'center'; // Center-align other columns in the header row
            }
        },
    });

    y = (pdf.lastAutoTable.finalY || 10) + 12
    var totalY = y + 10
    pdf.setTextColor('#212529')
    pdf.setFont('Poppins-Bold', 'normal')
    pdf.setFontSize(14)
    pdf.text('Thank you for your business', x, y)

    pdf.setFont('Poppins-Regular', 'normal')
    pdf.text('Subtotal: ', pageWidth() - 75, y)

    pdf.text('$' + Math.floor((+data.total)), pageWidth() - getTextWidth('$' + Math.floor((+data.total))) - x, y)

    if (data.termsNConditions != null && data.termsNConditions.trim().length > 0) {
        y += 10
        pdf.setFont('Poppins-Bold', 'normal')
        pdf.setFontSize(13)
        pdf.text('Terms & Conditions:', x, y)

        y += 8
        pdf.setFont('Poppins-Regular', 'normal')
        pdf.setFontSize(12)
        pdf.text(data.termsNConditions, x, y, { maxWidth: 100 })

        var lines = pdf.splitTextToSize(data.termsNConditions, pdf.internal.pageSize.width);
        var lineHeight = pdf.internal.getFontSize() / pdf.internal.scaleFactor + 2;
        var height = lines.length * lineHeight + 10 + 5;
    }

    if (data.note != null && data.note.trim().length > 0) {
        if (data.termsNConditions != null && data.termsNConditions.trim().length > 0) {
            y += height
        } else {
            y += 10
        }
        pdf.setFont('Poppins-Bold', 'normal')
        pdf.setFontSize(13)
        pdf.text('Note:', x, y)

        y += 8
        pdf.setFont('Poppins-Regular', 'normal')
        pdf.setFontSize(12)
        pdf.text(data.note, x, y, { maxWidth: 100 })
    }

    pdf.setFillColor('#0963ce')
    pdf.rect(pageWidth() - 80, totalY, pageWidth(), 10, 'F')

    pdf.setFont('Poppins-Bold', 'normal')
    pdf.setFontSize(16)
    pdf.setTextColor('#ffffff')
    pdf.text("Total Amount", pageWidth() - 75, totalY + 7)

    pdf.text('$' + Math.floor((+data.total)), pageWidth() - getTextWidth('$' + Math.floor((+data.total))) - x, totalY + 7)

    pdf.setDrawColor('#0963ce')
    pdf.line(0, pageHeight() - 20, pageWidth(), pageHeight() - 20)

    pdf.addImage(baseUrl + '/images/envelope-fill.png', 'PNG', x, pageHeight() - 12, 5, 5)

    pdf.setTextColor('#212529')
    pdf.setFont('Poppins-Regular', 'normal')
    pdf.setFontSize(12)
    pdf.text('info@digisplix.com', x + 10, pageHeight() - 8)

    pdf.addImage(baseUrl + '/images/browser-chrome.png', 'PNG', (pageWidth() / 2) - 20, pageHeight() - 12, 5, 5)

    pdf.text('www.digisplix.com', (pageWidth() / 2) - 21 + 10, pageHeight() - 8)

    pdf.addImage(baseUrl + '/images/telephone-fill.png', 'PNG', pageWidth() - 55, pageHeight() - 12, 5, 5)

    pdf.text('+1 (737) 338 8038', pageWidth() - 47, pageHeight() - 8)

    var blobPDF = new Blob([pdf.output('blob')], { type: "application/pdf" })
    var blobURL = URL.createObjectURL(blobPDF)

    $('#preview-frame').attr('src', blobURL + '#toolbar=0&navpanes=0')
}

const downloadPDF = function (title) {
    pdf.save(title + '.pdf')
}

// Tooltips
var tooltipTriggerList2 = [].slice.call(document.querySelectorAll('.main-area [data-bs-toggle="tooltip"]'));
var tooltipList2 = tooltipTriggerList2.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

// Sidebar Tooltips
var titles = [];
var sidebar = document.getElementById('sidebar');
var tooltipTriggerList = [].slice.call(document.querySelectorAll('#sidebar [data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    titles.push(tooltipTriggerEl.title);
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

// Function to initialize tooltips
function initializeTooltips() {
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl, index) {
        tooltipTriggerEl.setAttribute("title", titles[index])
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

// Function to destroy tooltips
function destroyTooltips() {
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        var tooltipInstance = bootstrap.Tooltip.getInstance(tooltipTriggerEl);
        if (tooltipInstance) {
            tooltipInstance.dispose();
        }
    });
}

// Initialize tooltips if sidebar is initially collapsed
if (sidebar.classList.contains('collapsed')) {
    initializeTooltips();
} else {
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        tooltipTriggerEl.setAttribute("data-bs-original-title", "");
    });
}

document.getElementById("btn-collapse").addEventListener('click', function () {
    if (sidebar.classList.contains('collapsed')) {
        // Sidebar is about to be expanded, remove tooltips
        destroyTooltips();
    } else {
        // Sidebar is about to be collapsed, add tooltips
        initializeTooltips();
    }
    // Toggle the 'collapsed' class on the sidebar
    // sidebar.classList.toggle('collapsed');
});

