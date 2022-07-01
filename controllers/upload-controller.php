<?php

// Nous recherchons si $_FILES["fileToUpload"] existe pour éviter toutes erreurs pour la suite
if (isset($_FILES["fileToUpload"])) {

    // Nous allons créer une variable qui contiendra le message du statut d'upload.
    $uploadMessage = '';

    // nous allons créer une variable qui va définir si des erreurs présentes.
    $uploadOk = true;

    // Nous controlons que l'utilisateur à bien sélectionné une image à l'aide du code error, il doit être égal à 0
    if ($_FILES["fileToUpload"]["error"] !== 0) {
        $uploadMessage = "Veuillez sélectionner une image à uploader";
        $uploadOk = false;
    } else {

        // Nous contrôlons si l'image choisie est bien une image à l'aide d'une getimagesize()
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check === false) {
            $uploadMessage = "Veuillez sélectionner une vraie image";
            $uploadOk = false;
        }

        // Nous contrôlons la taille de d'image : 8mo = 8000000
        if ($_FILES["fileToUpload"]["size"] > 8000000) {
            $uploadMessage = "La taille de l'image est trop grande";
            $uploadOk = false;
        }

        // Nous allons récupérer l'extension du fichier pour la stocker dans une variable : $imageFileType
        // l'extension sera en minuscule à l'aide de la fonction strtolower()
        $target_file = basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // nous effectuons un tableau contenant les extensions autorisées
        $arrayExtensions = ['jpg', 'png', 'jpeg', 'webp'];

        // Nous contrôlons si l'extension n'est pas présente dans le tableau à l'aide la fonction !in_array()
        if (!in_array($imageFileType, $arrayExtensions)) {
            $uploadMessage = "Désolé, seuls les formats : jpg, png, jpeg et webp sont autorisés";
            $uploadOk = false;
        }

        // Nous controlons si le tableau d'erreurs est vide
        if ($uploadOk == true) {

            // Nous indiquons le chemin du répertoire dans lequel les images vont être téléchargés.
            $target_dir = "public/img/";

            // Nous allons définir $new_name qui aura un nom d'image unique avec : la fonction uniqid() et une extension '.webp'
            $new_name = uniqid() . '.webp';

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $new_name)) {
                $uploadMessage = "C'est GOOD :)";
            } else {
                $uploadMessage = "Erreur lors de l'upload de votre fichier";
                $uploadOk = false;
            }
        }
    }
}