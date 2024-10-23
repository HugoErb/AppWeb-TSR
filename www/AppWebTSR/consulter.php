<?php
    try{
            $bdd = new PDO('mysql:host=localhost;dbname=bdtsr', 'root', 'root');
            $bdd->exec("SET CHARACTER SET utf8");
        }
        catch(Exception $e){
            die('Erreur de connexion à la base');
        }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Consulter AppWeb TSR</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <script type="text/javascript" src="js/comp.js"></script>
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
            <h1>Consultation</h1>
        </section>
        <section id="sec_article2">
            <article id="art">
                <p id="ptitle">Consulter des données</p>
                <p>Veuillez choisir quel tableau de données vous voulez consulter :</p>
                <center>
                    <div id="icon">
                        <span class="fa-stack fa-lg" style="margin-right: 40px;" onClick="hide1()">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-id-card-o fa-stack-1x fa-inverse"></i>
                            <p>Les compétitions</p>
                        </span>
                        <span class="fa-stack fa-lg" style="margin-right: 40px;" onClick="hide2()">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-user fa-stack-1x fa-inverse"></i>
                            <p>Les tireurs</p>
                        </span>
                        <span class="fa-stack fa-lg" onClick="hide3()">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-home fa-stack-1x fa-inverse"></i>
                            <p>Les clubs</p>
                        </span>
                    </div>
                </center>
                <br /><br />
                <div id="tableauCompet">
                    <h3>Tableau des compétitions</h3>
                    <br />
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        $ordresql = "SELECT `nomCompetition`,`dateCompetition` FROM `competition` ORDER BY `nomCompetition`";
                                        $resultatRequete=$bdd->query($ordresql);
                                        $lesTuplesCompetition=$resultatRequete->fetchall(PDO::FETCH_ASSOC);
                                        foreach ($lesTuplesCompetition as $unTupleCompetition){
                                    ?>
                                <tr>
                                    <td><?php echo $unTupleCompetition['nomCompetition'] ?></td>
                                    <td><?php echo $unTupleCompetition['dateCompetition'] ?></td>
                                </tr>
                                <?php
                                        }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="tableauClub">
                    <h3>Tableau des clubs</h3>
                    <br />
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom du club</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        $ordresql = "SELECT `nomClub` FROM `club` ORDER BY `nomClub`";
                                        $resultatRequete=$bdd->query($ordresql);
                                        $lesTuplesClub=$resultatRequete->fetchall(PDO::FETCH_ASSOC);
                                        foreach ($lesTuplesClub as $unTupleClub){
                                    ?>
                                <tr>
                                    <td><?php echo $unTupleClub['nomClub'] ?></td>
                                </tr>
                                <?php
                                        }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="tableauTireur">
                    <h3>Tableau des tireurs</h3>
                    <br />
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>S1</th>
                                    <th>S2</th>
                                    <th>S3</th>
                                    <th>S4</th>
                                    <th>S5</th>
                                    <th>S6</th>
                                    <th>Total</th>
                                    <th>Compétition</th>
                                    <th>Club</th>
                                    <th>Catégorie</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        $ordresql = "SELECT * FROM `tireur` ORDER BY `nomTireur`";
                                        $resultatRequete=$bdd->query($ordresql);
                                        $lesTuplesTireur=$resultatRequete->fetchall(PDO::FETCH_ASSOC);
                                        foreach ($lesTuplesTireur as $unTupleTireur){
                                            
                                            $idCompet = $unTupleTireur['idCompetition'];
                                            $ordresql = "SELECT `nomCompetition` FROM `competition` WHERE `idCompetition` = $idCompet";
                                            $reponse = $bdd->query($ordresql);
                                            while ($donnees = $reponse->fetch()){
                                                $nomCompet = $donnees['nomCompetition'];
                                            }
                                            
                                            $idClub = $unTupleTireur['idClub'];
                                            $ordresql = "SELECT `nomClub` FROM `club` WHERE `idClub` = $idClub";
                                            $reponse = $bdd->query($ordresql);
                                            while ($donnees = $reponse->fetch()){
                                                $nomClub = $donnees['nomClub'];
                                            }
                                            
                                            $idCateg = $unTupleTireur['idCategorieTireur'];
                                            $ordresql = "SELECT `libelleCategorieTireur` FROM `categorieTireur` WHERE `idCategorieTireur` = $idCateg ";
                                            $reponse = $bdd->query($ordresql);
                                            while ($donnees = $reponse->fetch()){
                                                $nomCateg = $donnees['libelleCategorieTireur'];
                                            }
                                    ?>
                                <tr>
                                    <td><?php echo $unTupleTireur['nomTireur'] ?></td>
                                    <td><?php echo $unTupleTireur['prenomTireur'] ?></td>
                                    <td><?php echo $unTupleTireur['scoreSerie1'] ?></td>
                                    <td><?php echo $unTupleTireur['scoreSerie2'] ?></td>
                                    <td><?php echo $unTupleTireur['scoreSerie3'] ?></td>
                                    <td><?php echo $unTupleTireur['scoreSerie4'] ?></td>
                                    <td><?php echo $unTupleTireur['scoreSerie5'] ?></td>
                                    <td><?php echo $unTupleTireur['scoreSerie6'] ?></td>
                                    <td><?php echo $unTupleTireur['scoreTotalTireur'] ?></td>
                                    <td><?php echo $nomCompet ?></td>
                                    <td><?php echo $nomClub ?></td>
                                    <td><?php echo $nomCateg ?></td>
                                </tr>
                                <?php
                                        }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </article>
        </section>
    </main>
    <footer>
        <p>© Eribon - Lasvaladas<br />Tous Droits Réservés</p>
    </footer>
</body>

</html>