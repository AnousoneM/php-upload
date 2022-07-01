<?php

require_once 'controllers/upload-controller.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>- TP UPLOAD PHP -</title>
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>

    <h1 class="text-center">TP UPLOAD PHP</h1>

    <div class="row align-items-center flex-column m-0 p-0">

        <div class="col-lg-4 text-center">
            <!-- preview de l'image -->
            <img id="imgPreview">
        </div>

        <div class="col-lg-4">

            <!-- penser à créer un "form" avec un enctype="multipart/form-data" -->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                </div>
                <div class="text-center">
                    <p class="text-danger"><?= isset($uploadMessage) ? $uploadMessage : ''  ?></p>
                    <button class="btn btn-secondary">Upload</button>
                </div>
            </form>

        </div>

    </div>

    <!-- appel du JS -->
    <script src="public/js/uploadPreview/uploadPreview.js"></script>

</body>

</html>