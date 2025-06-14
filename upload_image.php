<?php

//Initialize variables
$metadataOutput = "";
$imagePreviewPath = "";
$uploadSuccess = false;

//If the server recieves a post request method, run this:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_dir = __DIR__ . '/downloaded_images/'; //Sets target directory to downloaded_images; relative file path from this file
    if (!is_dir("downloaded_images")) {
      mkdir("downloaded_images");
    }
    
    $file = $_FILES['fileToUpload'];
    $uploaded_path = $target_dir . basename($file['name']);
    move_uploaded_file($file['tmp_name'], $uploaded_path);
    $imagePreviewPath = 'downloaded_images/' . basename($file['name']);

    $escapedPath = escapeshellarg($uploaded_path);
    $command = "python get_image_info.py $escapedPath 2>&1";
    $metadataOutput = shell_exec($command);

    $uploadSuccess = true;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Upload an Image</title>

  <!--CSS to style all elements on the page. -->
  <style>
    body {
      font-family: sans-serif;
      padding: 40px;
      background: #f4f4f4;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    h2 {
      color: #333;
    }
    .form-container {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      max-width: 340px;
      width: 100%;
      text-align: center;
    }
    .preview img {
      max-width: 100%;
      border-radius: 4px;
      margin-bottom: 15px;
    }
    input[type="file"], input[type="submit"] {
      margin-top: 10px;
    }
    input[type="submit"] {
      background: #28a745;
      border: none;
      color: white;
      padding: 10px 15px;
      border-radius: 4px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background: #218838;
    }
    pre {
      background: #eef;
      padding: 10px;
      border-radius: 4px;
      margin-top: 15px;
      max-width: 340px;
      width: 100%;
      overflow-x: auto;
    }
    /* Modal */
    .modal {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgb(211,211,211, 0.5) ;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .modal-content {
      background: #fff;
      padding: 15px;
      border-radius: 4px;
      text-align: center;
    }

    .modal-content button {
      margin-top: 10px;
      padding: 6px 12px;
      background: #3B719F;
      color: white;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    .result-box {
      background: #eef;
      padding: 10px;
      border-radius: 4px;
      margin-top: 15px;
      max-width: 340px;
      width: 100%;
      overflow-x: auto;
      text-align: left;
    }


  </style>
</head>
<body>

<!--Form to submit an image -->
<form method="post" enctype="multipart/form-data">
  <h2>Select Image</h2>
  <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" required><br>
  <br>
  <div class="form-container">
    <div class="preview form">
      <img id="previewImg" src="<?php echo $imagePreviewPath ?>" style="<?php echo $imagePreviewPath ? '' : 'display:none;' ?>">
    </div>
  </div>
  <input type="submit" value="Process Image">

  <?php if ($metadataOutput): ?>
    <div class="result-box" style="margin-top: 15px; text-align: left;">
      <strong>Image Details:</strong>
      <pre><?php echo htmlspecialchars($metadataOutput)?></pre>
    </div>
  <?php endif; ?>

</form>

<?php if ($uploadSuccess): ?>
  <div class="modal" id="uploadModal">
    <div class="modal-content">
      <p>Upload successful and printed metadata</p>
      <button onclick="document.getElementById('uploadModal').style.display='none'">OK</button>
    </div>
  </div>
<?php endif; ?>

<!--Javascript to display image preview-->
<script>
  document.getElementById('fileToUpload').addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;
    const img = document.getElementById('previewImg');
    const reader = new FileReader();
    reader.onload = e => {
      img.src = e.target.result;
      img.style.display = 'block';
    };
    reader.readAsDataURL(file);
  });
</script>

</body>
</html>
