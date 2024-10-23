<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=bdtsr', 'root', 'root');
    $bdd->exec("SET CHARACTER SET utf8");
} catch (Exception $e) {
    die('Erreur de connexion à la base');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Ajouter AppWeb TSR</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./font-awesome/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <script type="text/javascript" src="js/comp.js"></script>
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
</head>

<body>

    <header>
        <a href="index.html"><img id='logo' src="images/logo.png" alt="Logo" /></a>
        <nav>
            <ul>
                <li><a href="ajouter.php">Ajouter</a></li>
                <li><a href="modifier.php">Modifier</a></li>
                <li><a href="consulter.php">Consulter</a>
                <li><a href="lanceraffichage.php">Affichage</a></li>
            </ul>
        </nav>
    </header>
    <main id="mainotherpages">
        <section id="sectionotherpages">
            <h1>Ajout</h1>
        </section>
        <section id="sec_article2">
            <article id="art">
                <p id="ptitle">Ajout d'une entité</p>
                <p>Afin de procéder à l'ajout d'une entité, veuillez d'abord spécifier de quelle type de donnée il
                    s'agit.</p>
                <p>Je veux ajouter :</p>
                <center>
                    <div id="icon">
                        <span class="fa-stack fa-lg" style="margin-right: 40px;" onClick="hide4()">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-id-card-o fa-stack-1x fa-inverse"></i>
                            <p>Une compétition</p>
                        </span>
                        <span class="fa-stack fa-lg" style="margin-right: 40px;" onClick="hide5()">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-user fa-stack-1x fa-inverse"></i>
                            <p>Un tireur</p>
                        </span>
                        <span class="fa-stack fa-lg" onClick="hide6()">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-home fa-stack-1x fa-inverse"></i>
                            <p>Un club</p>
                        </span>
                    </div>
                </center>
                <br /><br /><br />
                <form id="form-compet" action="traitementAjouter.php" method="post">
                    <p id="ptitle">Ajout d'une nouvelle compétition</p>
                    <label for="nomCompet">Nom de la compétition : </label>
                    <input type="text" name="nomCompet" id="nomCompet" class="textAj" size="40" required /><br />
                    <label for="dateCompet">Date de la compétition : </label>
                    <input type="date" name="dateCompet" id="dateCompet" class="textAj" size="85" required /><br /><br />
                    <label for="dateCompet">Se déroule sur 2 jours : </label>
                    <input type="checkbox" id="cbx" name="2jCompet" value="1" style="display: none;">
                    <label for="cbx" class="check">
                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z">
                            </path>
                            <polyline points="1 9 7 14 15 4"></polyline>
                        </svg>
                    </label>
                    <br /><br /><br />
                    <center><input style="width: 300px;" class="btn-grad" type="submit" value="Enregistrer" name="envoiCompet"></center>
                </form>
                <form id="form-tireur" action="traitementAjouter.php" method="post">
                    <p id="ptitle">Ajout d'un nouveau tireur</p>
                    <center>
                        <label for="nomTireur">Nom : </label>
                        <input type="text" name="nomTireur" id="nomTireur" class="textAj" maxlength="20" size="25" required />
                        <label for="prenomTireur" style="margin-left: 5%;">Prénom : </label>
                        <input type="text" name="prenomTireur" id="prenomTireur" class="textAj" maxlength="20" size="25" required /><br /><br />
                        <div id="divAjLeft">
                            <label for="s1">Score de la série n°1 : </label>
                            <input type="number" name="s1" id="s1" class="textAj" size="5" min="0" max="109" step=".1" value="0" required /><br />
                            <label for="s2">Score de la série n°2 : </label>
                            <input type="number" name="s2" id="s2" class="textAj" size="5" min="0" max="109" step=".1" value="0" required /><br />
                            <label for="s3">Score de la série n°3 : </label>
                            <input type="number" name="s3" id="s3" class="textAj" size="5" min="0" max="109" step=".1" value="0" required /><br />
                            <label for="s4">Score de la série n°4 : </label>
                            <input type="number" name="s4" id="s4" class="textAj" size="5" min="0" max="109" step=".1" value="0" required /><br />
                            <label for="s5">Score de la série n°5 : </label>
                            <input type="number" name="s5" id="s5" class="textAj" size="5" min="0" max="109" step=".1" value="0" required /><br />
                            <label for="s6">Score de la série n°6 : </label>
                            <input type="number" name="s6" id="s6" class="textAj" size="5" min="0" max="109" step=".1" value="0" required />
                        </div>
                        <div id="divAjRight">
                            <div class="select">
                                <select class="custom-select" name="slctClub" id="slct" required>
                                    <option selected disabled value="">Choisissez un club</option>
                                    <?php
                                    $ordresql = "SELECT `idClub`,`nomClub` FROM `club` ORDER BY `nomClub`";
                                    $resultatRequete = $bdd->query($ordresql);
                                    $lesTuplesClub = $resultatRequete->fetchall(PDO::FETCH_ASSOC);
                                    foreach ($lesTuplesClub as $unTupleClub) {
                                    ?>
                                        <option value="<?php echo $unTupleClub['idClub'] ?>">
                                            <?php echo $unTupleClub['nomClub'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <br /><br /><br />
                            <div class="select">
                                <select name="slctCompet" id="slct" required>
                                    <option selected disabled value="">Choisissez une compétition</option>
                                    <?php
                                    $ordresql = "SELECT `idCompetition`,`nomCompetition`,`dateCompetition` FROM `competition` ORDER BY `nomCompetition`";
                                    $resultatRequete = $bdd->query($ordresql);
                                    $lesTuplesCompet = $resultatRequete->fetchall(PDO::FETCH_ASSOC);
                                    foreach ($lesTuplesCompet as $unTupleCompet) {
                                    ?>
                                        <option value="<?php echo $unTupleCompet['idCompetition'] ?>">
                                            <?php echo $unTupleCompet['nomCompetition'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <br /><br /><br />
                            <div class="select">
                                <select name="slctCategorie" id="slct" required>
                                    <option selected disabled value="">Choisissez une catégorie</option>
                                    <?php
                                    $ordresql = "SELECT `idCategorieTireur`,`libelleCategorieTireur` FROM `categorietireur` ORDER BY `libelleCategorieTireur`";
                                    $resultatRequete = $bdd->query($ordresql);
                                    $lesTuplesCateg = $resultatRequete->fetchall(PDO::FETCH_ASSOC);
                                    foreach ($lesTuplesCateg as $unTupleCateg) {
                                    ?>
                                        <option value="<?php echo $unTupleCateg['idCategorieTireur'] ?>">
                                            <?php echo $unTupleCateg['libelleCategorieTireur'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </center>
                    <br /><br /><br />
                    <center><input style="width: 300px;" class="btn-grad" type="submit" value="Enregistrer" name="envoiTireur"></center>
                </form>
                <form id="form-club" action="traitementAjouter.php" method="post">
                    <p id="ptitle">Ajout d'un nouveau club</p>
                    <label for="nomClub">Nom du club : </label>
                    <input type="text" name="nomClub" id="nomClub" size="35" class="textAj" required />
                    <br /><br /><br />
                    <center><input style="width: 300px;" class="btn-grad" type="submit" value="Enregistrer" name="envoiClub"></center>
                </form>
            </article>
        </section>
    </main>
    <footer>
        <p>© Eribon - Lasvaladas<br />Tous Droits Réservés</p>
    </footer>
</body>

</html>