<!DOCTYPE html>
<html>

<head>
    <title>Ajouter AppWeb TSR</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
</head>

<body>

    <?php
        //Connexion à la base de données
        try{
                $bdd = new PDO('mysql:host=localhost;dbname=bdtsr', 'root', 'root');
                $bdd->exec("SET CHARACTER SET utf8");
        }catch(Exception $e){
                die('Erreur de connexion à la base');
        }

        //Si le formulaire d'ajout d'une nouvelle competition est soumis
        if(isset($_POST['envoiCompet'])){ 
            //Récupèration des données du formulaire
            $nomCompet = $_POST['nomCompet'];
            $dateCompet = $_POST['dateCompet'];
            if (isset($_POST['2jCompet'])){
                $jCompet = $_POST['2jCompet'];
            }else{
                $jCompet = 0;
            }
            $dateCompet = date('d-m-Y ', strtotime($dateCompet));
            if ($jCompet == 1){
                $dateCompetLendemain = date('d-m-Y', strtotime($dateCompet. ' + 1 days'));
                $dateCompet = $dateCompet."et ".$dateCompetLendemain;
            }
            $dateCompet = str_replace("-", "/", $dateCompet);
            //Insertion des données dans la base de données
            $sqlInsert = "INSERT INTO `competition` (`idCompetition`, `nomCompetition`, `dateCompetition`) VALUES (NULL, '$nomCompet', '$dateCompet')";
            if($bdd->exec($sqlInsert) == 1){
                echo "<script type='text/javascript'>Swal.fire({
                        title: 'Insertion réussie !',
                        text: 'L\'opération s\'est déroulée avec succès. Vous allez être redirigé vers la page d\'ajout.', 
                        icon: 'success',
                        confirmButtonColor: '#FF512F',
                        confirmButtonText: 'Confirmer'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = './ajouter.php';
                        }
                    })</script>";
            }else{
                echo "<script type='text/javascript'>Swal.fire({
                        title: 'Erreur lors de l\'insertion',
                        text: 'Veuillez réessayer l\'enregistrement. Si le problème persiste, contactez les développeurs.',
                        icon: 'error',
                        confirmButtonColor: '#FF512F',
                        confirmButtonText: 'Confirmer'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = './ajouter.php';
                        }
                    })</script>";
            }
        }

        //Si le formulaire d'ajout d'un nouveau tireur est soumis
        if(isset($_POST['envoiTireur'])){ 
            //Récupèration des données du formulaire
            $nomTireur = $_POST['nomTireur'];
            $prenomTireur = $_POST['prenomTireur'];
            $s1 = $_POST['s1'];
            $s2 = $_POST['s2'];
            $s3 = $_POST['s3'];
            $s4 = $_POST['s4'];
            $s5 = $_POST['s5'];
            $s6 = $_POST['s6'];
            $clubTireur = $_POST['slctClub'];
            $categTireur = $_POST['slctCategorie'];
            $competTireur = $_POST['slctCompet'];
            //Insertion des données dans la base de données
            $sqlInsert = "INSERT INTO `tireur` (`idTireur`, `nomTireur`, `prenomTireur`, `scoreSerie1`, `scoreSerie2`, `scoreSerie3`, `scoreSerie4`, `scoreSerie5`, `scoreSerie6`, `scoreTotalTireur`, `idCompetition`, `idClub`, `idCategorieTireur`) VALUES (NULL, '$nomTireur', '$prenomTireur', '$s1', '$s2', '$s3', '$s4', '$s5', '$s6', '0', '$competTireur', '$clubTireur', '$categTireur');";
            if($bdd->exec($sqlInsert) == 1){
                echo "<script type='text/javascript'>Swal.fire({
                        title: 'Insertion réussie !',
                        text: 'L\'opération s\'est déroulée avec succès. Vous allez être redirigé vers la page d\'ajout.', 
                        icon: 'success',
                        confirmButtonColor: '#FF512F',
                        confirmButtonText: 'Confirmer'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = './ajouter.php';
                        }
                    })</script>";
            }else{
                echo "<script type='text/javascript'>Swal.fire({
                        title: 'Erreur lors de l\'insertion',
                        text: 'Veuillez réessayer l\'enregistrement. Si le problème persiste, contactez les développeurs.',
                        icon: 'error',
                        confirmButtonColor: '#FF512F',
                        confirmButtonText: 'Confirmer'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = './ajouter.php';
                        }
                    })</script>";
            }
        }

        //Si le formulaire d'ajout d'un nouveau club est soumis
        if(isset($_POST['envoiClub'])){ 
            //Récupèration des données du formulaire
            $nomClub = $_POST['nomClub'];
            //Insertion des données dans la base de données
            $sqlInsert = "INSERT INTO `club` (`idClub`, `nomClub`) VALUES (NULL, '$nomClub')";
            if($bdd->exec($sqlInsert) == 1){
                echo "<script type='text/javascript'>Swal.fire({
                        title: 'Insertion réussie !',
                        text: 'L\'opération s\'est déroulée avec succès. Vous allez être redirigé vers la page d\'ajout.', 
                        icon: 'success',
                        confirmButtonColor: '#FF512F',
                        confirmButtonText: 'Confirmer'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = './ajouter.php';
                        }
                    })</script>";
            }else{
                echo "<script type='text/javascript'>Swal.fire({
                        title: 'Erreur lors de l\'insertion',
                        text: 'Veuillez réessayer l\'enregistrement. Si le problème persiste, contactez les développeurs.',
                        icon: 'error',
                        confirmButtonColor: '#FF512F',
                        confirmButtonText: 'Confirmer'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = './ajouter.php';
                        }
                    })</script>";
            }
        }
    ?>
</body>