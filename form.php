<!DOCTYPE html>
<html>
<head>
  <title>Image Display Example</title>
</head>
<body>
  <div>
    <input type="file" id="imageInput" accept="image/*" />
    <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 300px; max-height: 300px; display: none;" />
  </div>
  
  <script>
    var imageInput = document.getElementById("imageInput");
    var imagePreview = document.getElementById("imagePreview");

    imageInput.addEventListener("change", function () {
      var file = imageInput.files[0];
      var reader = new FileReader();

      reader.onload = function (e) {
        imagePreview.src = e.target.result;
        imagePreview.style.display = "block";
      };

      reader.readAsDataURL(file);
    });
  </script>
</body>
</html>
