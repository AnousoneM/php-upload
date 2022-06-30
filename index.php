<?php

// Nous recherchons si $_FILES["fileToUpload"] existe pour éviter toutes erreurs pour la suite
if (isset($_FILES["fileToUpload"])) {

    // Nous allons créer une variable qui contiendra le message du statut d'upload
    $arrayErrors = [];

    // Nous controlons que l'utilisateur à bien sélectionné une image à l'aide du code error, il doit être égal à 0
    if ($_FILES["fileToUpload"]["error"] !== 0) {
        $arrayErrors['upload'] = "Veuillez sélectionner une image à uploader";
    } else {

        // Nous contrôlons si l'image choisie est bien une image à l'aide d'une getimagesize()
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check === false) {
            $arrayErrors['upload'] = "Veuillez sélectionner une vraie image";
        }

        // Nous contrôlons la taille de d'image : 8mo = 8000000
        if ($_FILES["fileToUpload"]["size"] > 8000000) {
            $arrayErrors['upload'] = "La taille de l'image est trop grande";
        }

        // Nous allons récupérer l'extension du fichier pour la stocker dans une variable : $imageFileType
        // l'extension sera en minuscule à l'aide de la fonction strtolower()
        $target_file = basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // nous effectuons un tableau contenant les extensions autorisées
        $arrayExtensions = ['jpg', 'png', 'jpeg', 'webp'];

        // Nous contrôlons si l'extension n'est pas présente dans le tableau à l'aide la fonction !in_array()
        if (!in_array($imageFileType, $arrayExtensions)) {
            $arrayErrors['upload'] = "Désolé, seuls les formats : jpg, png, jpeg et webp sont autorisés";
        }

        // Nous controlons si le tableau d'erreurs est vide
        if (count($arrayErrors) == 0) {

            // Nous indiquons le chemin du répertoire dans lequel les images vont être téléchargés.
            $target_dir = "public/img/";

            // Nous allons définir $new_name qui aura un nom d'image unique avec : la fonction uniqid() et une extension '.webp'
            $new_name = uniqid() . '.webp';

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $new_name)) {
                $arrayErrors['upload'] = "C'est GOOD :)";
            } else {
                $arrayErrors['upload'] = "Erreur lors de l'upload de votre fichier";
            }
        }
    }
}

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
                    <p class="text-danger"><?= isset($arrayErrors['upload']) ? $arrayErrors['upload'] : ''  ?></p>
                    <button class="btn btn-secondary">Upload</button>
                </div>
            </form>

        </div>

    </div>

    <!-- appel du JS -->
    <script src="public/js/uploadPreview/uploadPreview.js"></script>

</body>

</html>