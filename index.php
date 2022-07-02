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
    <!-- CSS Bootstrap 5.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>

    <h1 class="text-center my-5">TP UPLOAD PHP</h1>

    <div class="row align-items-center flex-column m-0 p-0">

        <div class="col-lg-3">

            <!-- Penser à créer un "form" avec un enctype="multipart/form-data" pour pouvoir upload des fichiers-->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="input-group mb-3">
                    <!-- input type="file" pour recuperer l'image -->
                    <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
                </div>
                <div class="text-center">
                    <!-- Nous insérons le message d'erreur ou de succés à l'aide d'un echo court et également la syntaxe '??'  -->
                    <p><?= $uploadMessage ?? ''  ?></p>
                    <button class="btn btn-dark">Upload</button>
                </div>
            </form>

        </div>

        <div class="col-lg-3 bg-light text-center border border-secondary preview-area rounded mt-3 p-2">
            <!-- preview de l'image à uploader -->
            <img id="imgPreview" onerror="this.src='public/img/bad-format.png'">
        </div>

    </div>

    <!-- appel du JS -->
    <script src="public/js/uploadPreview/uploadPreview.js"></script>

</body>

</html>