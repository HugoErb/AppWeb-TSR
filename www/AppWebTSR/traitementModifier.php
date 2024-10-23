<!DOCTYPE html>
<html>

<head>
    <title>Modifier AppWeb TSR</title>
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

        $ordresql = "SELECT * FROM `competition` ORDER BY `nomCompetition`";
        $resultatRequete=$bdd->query($ordresql);
        $lesTuplesCompetition=$resultatRequete->fetchall(PDO::FETCH_ASSOC);
        foreach ($lesTuplesCompetition as $unTupleCompetition){
            $idCompet = $unTupleCompetition['idCompetition'];
            
            //Si le formulaire de modification d'une competition est soumis
            if(isset($_POST['envoiCompet'.$idCompet])){

                //Récupèration des données du formulaire
                $nomCompet = $_POST['nomCompet'.$idCompet];
                $dateCompet = $_POST['dateCompet'.$idCompet];

                //Insertion des données dans la base de données
                $sqlUpdate = "UPDATE `competition` SET `nomCompetition`=?,`dateCompetition`=? WHERE `idCompetition` = ?";
                $info = $bdd->prepare($sqlUpdate);
                $info->execute([$nomCompet,$dateCompet,$idCompet]);
                $count = $info->rowCount();
                if($count == 1){
                    echo "<script type='text/javascript'>Swal.fire({
                            title: 'Modification réussie !',
                            text: 'La mise à jour s\'est déroulée avec succès. Vous allez être redirigé vers la page de modification.', 
                            icon: 'success',
                            confirmButtonColor: '#FF512F',
                            confirmButtonText: 'Confirmer'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = './modifier.php';
                            }
                        })</script>";
                }else{
                    echo "<script type='text/javascript'>Swal.fire({
                            title: 'Erreur lors de la modification',
                            text: 'Aucune modification n\'a été detectée. Veuillez réessayer. Si le problème persiste, contactez les développeurs.',
                            icon: 'error',
                            confirmButtonColor: '#FF512F',
                            confirmButtonText: 'Confirmer'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = './modifier.php';
                            }
                        })</script>";
                }
            }
            
            //Si le formulaire de suppression d'une compétition est soumis
            if(isset($_POST['supprCompet'.$idCompet])){ 
                //Suppression des données dans la base de données
                $sqlDelete = "DELETE FROM `competition` WHERE `idCompetition` = $idCompet";
                if($bdd->exec($sqlDelete) == 1){
                    echo "<script type='text/javascript'>Swal.fire({
                            title: 'Suppression réussie !',
                            text: 'La suppression s\'est déroulée avec succès. Vous allez être redirigé vers la page de modification.', 
                            icon: 'success',
                            confirmButtonColor: '#FF512F',
                            confirmButtonText: 'Confirmer'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = './modifier.php';
                            }
                        })</script>";
                }else if($bdd->exec($sqlDelete) == 0){
                    echo "<script type='text/javascript'>Swal.fire({
                            title: 'Erreur lors de la suppression',
                            text: 'Aucune suppression effectuée. Veuillez réessayer. Si le problème persiste, contactez les développeurs.',
                            icon: 'error',
                            confirmButtonColor: '#FF512F',
                            confirmButtonText: 'Confirmer'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = './modifier.php';
                            }
                        })</script>";
                }
            }
        }
    
        $ordresql = "SELECT * FROM `tireur` ORDER BY `nomTireur`";
        $resultatRequete=$bdd->query($ordresql);
        $lesTuplesTireur=$resultatRequete->fetchall(PDO::FETCH_ASSOC);
        foreach ($lesTuplesTireur as $unTupleTireur){
            $idTireur = $unTupleTireur['idTireur'];
            $idCompet = $_POST['nomCompet'.$idTireur];
            $idCateg = $_POST['nomCateg'.$idTireur];
            
            //Si le formulaire de modification d'un tireur est soumis
            if(isset($_POST['envoiTireur'.$idTireur])){

                //Récupèration des données du formulaire
                $nomTireur = $_POST['nomTireur'.$idTireur];
                $prenomTireur = $_POST['prenomTireur'.$idTireur];
                $scoreSerieUn = $_POST['scoreSerieUn'.$idTireur];
                $scoreSerieDeux = $_POST['scoreSerieDeux'.$idTireur];
                $scoreSerieTrois = $_POST['scoreSerieTrois'.$idTireur];
                $scoreSerieQuatre = $_POST['scoreSerieQuatre'.$idTireur];
                $scoreSerieCinq = $_POST['scoreSerieCinq'.$idTireur];
                $scoreSerieSix = $_POST['scoreSerieSix'.$idTireur];
                $idClub = $_POST['nomClub'.$idTireur];

                // On vérifie si le tireur est le dernier de sa catégorie dans la compétition, si oui, alors on doit supprimer la catégorie dans la table avoir
                $sqlRecupCategTireur = "SELECT idCategorieTireur FROM `tireur` WHERE `idTireur` = :idTireur";
                $stmt = $bdd->prepare($sqlRecupCategTireur);
                $stmt->bindValue(':idTireur', $idTireur);
                $stmt->execute();
                $ancienneCategTireur = $stmt->fetchColumn();
                $sqlCheckAvoir = "SELECT count(*) FROM `tireur` WHERE `idCategorieTireur` = :idCateg AND `idCompetition` = :idCompet";
                $stmt = $bdd->prepare($sqlCheckAvoir);
                $stmt->bindValue(':idCateg', $ancienneCategTireur);
                $stmt->bindValue(':idCompet', $idCompet);
                $stmt->execute();
                $nbCategTireurDansCompet = $stmt->fetchColumn();
                if($nbCategTireurDansCompet == 1){
                    $sqlDeleteAvoir = "DELETE FROM `avoir` WHERE `idCategorieTireur` = :idCateg AND `idCompetition` = :idCompet";
                    $stmt = $bdd->prepare($sqlDeleteAvoir);
                    $stmt->bindValue(':idCateg', $ancienneCategTireur);
                    $stmt->bindValue(':idCompet', $idCompet);
                    $stmt->execute();
                }

                //Insertion des données dans la base de données
                $sqlUpdate = "UPDATE `tireur` SET `nomTireur`=?,`prenomTireur`=?,`scoreSerie1`=?,`scoreSerie2`=?,`scoreSerie3`=?,`scoreSerie4`=?,`scoreSerie5`=?,`scoreSerie6`=?,`scoreTotalTireur`=0,`idCompetition`=?,`idClub`=?,`idCategorieTireur`=? WHERE `idTireur` =?";
                $info = $bdd->prepare($sqlUpdate);
                $info->execute([$nomTireur,$prenomTireur,$scoreSerieUn,$scoreSerieDeux,$scoreSerieTrois,$scoreSerieQuatre,$scoreSerieCinq,$scoreSerieSix,$idCompet,$idClub,$idCateg,$idTireur]);
                $count = $info->rowCount();
                if($count == 1){
                    echo "<script type='text/javascript'>Swal.fire({
                            title: 'Modification réussie !',
                            text: 'La mise à jour s\'est déroulée avec succès. Vous allez être redirigé vers la page de modification.', 
                            icon: 'success',
                            confirmButtonColor: '#FF512F',
                            confirmButtonText: 'Confirmer'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = './modifier.php';
                            }
                        })</script>";
                }else{
                    echo "<script type='text/javascript'>Swal.fire({
                            title: 'Erreur lors de la modification',
                            text: 'Aucune modification n\'a été detectée. Veuillez réessayer. Si le problème persiste, contactez les développeurs.',
                            icon: 'error',
                            confirmButtonColor: '#FF512F',
                            confirmButtonText: 'Confirmer'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = './modifier.php';
                            }
                        })</script>";
                }
            }
            
            //Si le formulaire de suppression d'un tireur est soumis
            if(isset($_POST['supprTireur'.$idTireur])){

                // On vérifie si le tireur est le dernier de sa catégorie dans la compétition, si oui, alors on doit supprimer la catégorie dans la table avoir
                $sqlCheckAvoir = "SELECT count(*) FROM `tireur` WHERE `idCategorieTireur` = :idCateg AND `idCompetition` = :idCompet";
                $stmt = $bdd->prepare($sqlCheckAvoir);
                $stmt->bindValue(':idCateg', $idCateg);
                $stmt->bindValue(':idCompet', $idCompet);
                $stmt->execute();
                $nbCategTireurDansCompet = $stmt->fetchColumn();
                if($nbCategTireurDansCompet == 1){
                    $sqlDeleteAvoir = "DELETE FROM `avoir` WHERE `idCategorieTireur` = :idCateg AND `idCompetition` = :idCompet";
                    $stmt = $bdd->prepare($sqlDeleteAvoir);
                    $stmt->bindValue(':idCateg', $idCateg);
                    $stmt->bindValue(':idCompet', $idCompet);
                    $stmt->execute();
                    echo "row deleted in avoir";
                }

                //Suppression des données dans la base de données
                $sqlDelete = "DELETE FROM `tireur` WHERE `idTireur` = $idTireur";
                if($bdd->exec($sqlDelete) == 1){
                    echo "<script type='text/javascript'>Swal.fire({ 
                            title: 'Suppression réussie !',
                            text: 'La suppression s\'est déroulée avec succès. Vous allez être redirigé vers la page de modification.', 
                            icon: 'success',
                            confirmButtonColor: '#FF512F',
                            confirmButtonText: 'Confirmer'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = './modifier.php';
                            }
                        })</script>";
                }else if($bdd->exec($sqlDelete) == 0){
                    echo "<script type='text/javascript'>Swal.fire({
                            title: 'Erreur lors de la suppression',
                            text: 'Aucune suppression effectuée. Veuillez réessayer. Si le problème persiste, contactez les développeurs.',
                            icon: 'error',
                            confirmButtonColor: '#FF512F',
                            confirmButtonText: 'Confirmer'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = './modifier.php';
                            }
                        })</script>";
                }
            }
        }

        $ordresql = "SELECT * FROM `club` ORDER BY `nomClub`";
        $resultatRequete=$bdd->query($ordresql);
        $lesTuplesClub=$resultatRequete->fetchall(PDO::FETCH_ASSOC);
        foreach ($lesTuplesClub as $unTupleClub){
            $idClub = $unTupleClub['idClub'];

            //Si le formulaire de modification d'un club est soumis
            if(isset($_POST['envoiClub'.$idClub])){ 
                //Récupèration des données du formulaire
                $nomClub = $_POST['nomClub'.$idClub];
                //Insertion des données dans la base de données
                $sqlUpdate = "UPDATE `club` SET `nomClub`=? WHERE `idClub` =?";
                $info = $bdd->prepare($sqlUpdate);
                $info->execute([$nomClub,$idClub]);
                $count = $info->rowCount();
                if($count == 1){
                    echo "<script type='text/javascript'>Swal.fire({
                            title: 'Modification réussie !',
                            text: 'La mise à jour s\'est déroulée avec succès. Vous allez être redirigé vers la page de modification.', 
                            icon: 'success',
                            confirmButtonColor: '#FF512F',
                            confirmButtonText: 'Confirmer'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = './modifier.php';
                            }
                        })</script>";
                }else{
                    echo "<script type='text/javascript'>Swal.fire({
                            title: 'Erreur lors de la modification',
                            text: 'Aucune modification n\'a été detectée. Veuillez réessayer. Si le problème persiste, contactez les développeurs.',
                            icon: 'error',
                            confirmButtonColor: '#FF512F',
                            confirmButtonText: 'Confirmer'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = './modifier.php';
                            }
                        })</script>";
                }
            }
            
            //Si le formulaire de suppression d'un club est soumis
            if(isset($_POST['supprClub'.$idClub])){ 
                //Suppression des données dans la base de données
                $sqlDelete = "DELETE FROM `club` WHERE `idClub` = $idClub";
                if($bdd->exec($sqlDelete) == 1){
                    echo "<script type='text/javascript'>Swal.fire({
                            title: 'Suppression réussie !',
                            text: 'La suppression s\'est déroulée avec succès. Vous allez être redirigé vers la page de modification.', 
                            icon: 'success',
                            confirmButtonColor: '#FF512F',
                            confirmButtonText: 'Confirmer'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = './modifier.php';
                            }
                        })</script>";
                }else if($bdd->exec($sqlDelete) == 0){
                    echo "<script type='text/javascript'>Swal.fire({
                            title: 'Erreur lors de la suppression',
                            text: 'Aucune suppression effectuée. Veuillez réessayer. Si le problème persiste, contactez les développeurs.',
                            icon: 'error',
                            confirmButtonColor: '#FF512F',
                            confirmButtonText: 'Confirmer'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = './modifier.php';
                            }
                        })</script>";
                }
            }
        }
    ?>
</body>