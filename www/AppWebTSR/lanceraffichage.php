<?php
    try{
            $bdd = new PDO('mysql:host=localhost;dbname=bdtsr', 'root', 'root');
            $bdd->exec("SET CHARACTER SET utf8");
        }
        catch(Exception $e){
            die('Erreur de connexion à la base');
        }

        $ordresql = "SELECT `idCompetition`,`nomCompetition` FROM `competition` ORDER BY `nomCompetition`";
        $resultatRequete=$bdd->query($ordresql);
        $lesTuples=$resultatRequete->fetchall(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Affichage AppWeb TSR</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link rel="stylesheet" href="./font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <script type="text/javascript" src="js/comp.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.1.1/jspdf.umd.min.js"></script>
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
</head>

<body>
    <header>
        <a href="index.html"><img id='logo' src="images/logo.png" alt="Logo" /></a>
        <nav>
            <ul>
                <li><a href="ajouter.php">Ajouter</a></li><li><a href="modifier.php">Modifier</a></li><li><a href="consulter.php">Consulter</a><li><a href="lanceraffichage.php">Affichage</a></li>
            </ul>
        </nav>
    </header>
    <main id="mainotherpages">
        <section id="sectionotherpages">
            <h1>Affichage</h1>
        </section>
        <section id="sec_article2">
            <article id="art">
                <p id="ptitle">Affichage des classements</p>
                <p>Afin de procéder à la projection des classements, veuillez choisir la compétition à afficher :</p>
                <form action="affichage.php" method="post" TARGET=_BLANK>
                    <div class="select">
                        <select name="slct" id="slct" required>
                            <option selected disabled value="">Choisissez une compétition</option>
                            <?php
                            foreach ($lesTuples as $unTuple){
                              $idCompetition = $unTuple['idCompetition'];
                              $nomCompetition = $unTuple['nomCompetition'];
                              echo "<option value='$idCompetition'> $nomCompetition </option>";
                            }
                        ?>
                        </select>
                    </div>
                    <br />
                    <center><input style="width: 300px;" name="envoiCompet" class="btn-grad" type="submit"
                            value="Lancer l'affichage"></center>
                </form>
                <br>
                <p id="ptitle">Générer un PDF</p>
                <p>Afin de procéder à la génération d'un fichier PDF détaillant les classements, veuillez choisir la
                    compétition à afficher :</p>
                <form action="pdf_competition.php" method="post">
                    <div class="select">
                        <select name="slct" id="slct" required>
                            <option selected disabled value="">Choisissez une compétition</option>
                            <?php
                            foreach ($lesTuples as $unTuple){
                              $idCompetition = $unTuple['idCompetition'];
                              $nomCompetition = $unTuple['nomCompetition'];
                              echo "<option value='$idCompetition'> $nomCompetition </option>";
                            }
                        ?>
                        </select>
                    </div>
                    <br />
                    <center><input style="width: 300px;" id="genererPDF" name="envoiCompet" class="btn-grad"
                            type="submit" value="Générer un PDF"></center>
                </form>
            </article>
        </section>
    </main>
    <footer>
        <p>© Eribon - Lasvaladas<br />Tous Droits Réservés</p>
    </footer>
</body>

</html>