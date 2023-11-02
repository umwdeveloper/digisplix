  // ==================================================chat screen mobile responsiveness
  
  // $(window).resize(function() {
    if ($(window).width() < 1200) {
        $(".chats-msgs").css("display", "none");
        $(".conversation").on("click", function () {
          $('.chats-name').css("display", "none");
          $(".chats-msgs").css("display", "block");
        });
        $(".go-back").on("click", function () {
          $('.chats-name').css("display", "block");
          $(".chats-msgs").css("display", "none");
        });
      } 
     
  
  // =========================================================file upload on chat screen
  document.addEventListener('DOMContentLoaded', function () {
    // Function to display previews of selected files
    function displayFilePreviews(input, previewElement, parentDiv) {
      if (input.files && input.files.length > 0) {
        // Clear previous content
        previewElement.innerHTML = '';
  
        for (var i = 0; i < input.files.length; i++) {
          var file = input.files[i];
          var reader = new FileReader();
  
          reader.onload = function (e) {
            var fileExtension = file.name.split('.').pop().toLowerCase();
            var filePreviewContainer = document.createElement('div');
            filePreviewContainer.className = 'file-preview';
  
            if (file.type.startsWith('image/')) {
              // Display image preview
              var img = document.createElement('img');
              img.src = e.target.result;
              filePreviewContainer.appendChild(img);
            } else if (file.type.startsWith('video/')) {
              // Display video preview
              var video = document.createElement('video');
              video.src = e.target.result;
              video.controls = true;
              filePreviewContainer.appendChild(video);
            } else if (fileExtension === 'pdf') {
              // Display PDF file preview (You may need a PDF viewer here)
              var pdfIcon = document.createElement('i');
              pdfIcon.className = 'bi bi-file-earmark-pdf-fill'; // You can use a PDF icon here
              filePreviewContainer.appendChild(pdfIcon);
            } else if (['txt', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx'].includes(fileExtension)) {
              // Display generic file preview for text and document files
              var fileIcon = document.createElement('i');
              fileIcon.className = 'bi bi-file-earmark-fill'; // You can use a generic file icon here
              filePreviewContainer.appendChild(fileIcon);
            }
  
            // Create a close icon for this item
            var closeIcon = document.createElement('span');
            closeIcon.className = 'close-icon';
            closeIcon.innerHTML = '&times;';
            closeIcon.addEventListener('click', function () {
              // Remove this item when the close icon is clicked
              filePreviewContainer.remove();
  
              // Hide the parent div if there are no previews left
              if (parentDiv.querySelectorAll('.file-preview').length === 0) {
                parentDiv.style.display = 'none';
              }
            });
            filePreviewContainer.appendChild(closeIcon);
  
            // Show the preview element
            previewElement.appendChild(filePreviewContainer);
            previewElement.style.display = 'flex';
  
            // Show the parent div
            parentDiv.style.display = 'flex';
          };
  
          reader.readAsDataURL(file);
        }
      } else {
        previewElement.innerHTML = ''; // Clear the preview element
        previewElement.style.display = 'none';
      }
    }
  
    // Add a change event listener to the file input
    var fileInput = document.getElementById('fileInput');
    var filePreview = document.getElementById('filePreview');
    var previews = document.querySelector('.previews');
    fileInput.addEventListener('change', function () {
      displayFilePreviews(fileInput, filePreview, previews);
    });
  
    // Add a change event listener to the media input
    var mediaInput = document.getElementById('mediaInput');
    var mediaPreview = document.getElementById('mediaPreview');
    mediaInput.addEventListener('change', function () {
      displayFilePreviews(mediaInput, mediaPreview, previews);
    });
  
    // Add a click event listener to the file button
    document.getElementById('fileButton').addEventListener('click', function () {
      fileInput.click();
    });
  
    // Add a click event listener to the media button
    document.getElementById('mediaButton').addEventListener('click', function () {
      mediaInput.click();
    });
    // Add a click event listener to the send message buttons
    var sendButtons = document.querySelectorAll('.send-msg');
    sendButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        // // Clear the previews when a send message button is clicked
        // fileInput.value = '';
        // mediaInput.value = '';
        // previews.innerHTML = '';
        previews.style.display = 'none';
      });
    });
  });
  
  
// Remove footer when virtusl keyboard is open
var initialScreenSize = window.innerHeight; 
window.addEventListener("resize", function() {
   if(window.innerHeight < initialScreenSize){
        $(".menu-footer").hide(); 
            //  $(".chat__screen").css("height","calc(100vh - 190px)"); 
            // $(".chat__screen-chats").css("height","calc(100vh - 190px)"); 
            // $(".chat__screen-chats-wrapper").css("height","calc(100vh - 250px)"); 
            // $(".chat__screen-body-msgs").css("height","calc(100vh - 250px)"); 
   } else{ 
        if($(window).width() < 580) {
            $(".menu-footer").show(); 
       
        }
       
   } 
    
});

