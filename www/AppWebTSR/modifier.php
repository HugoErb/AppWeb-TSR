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
    <title>Modifier AppWeb TSR</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <script type="text/javascript" src="js/comp.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
            <h1>Modification</h1>
        </section>
        <section id="sec_article2">
            <article id="art">
                <p id="ptitle">Modification d'une entité</p>
                <p>Afin de procéder à la modification d'une entité, veuillez d'abord spécifier de quelle type de donnée
                    il s'agit. Par la suite, choisissez la ligne à modifier dans le tableau.</p>
                <p>Je veux modifier :</p>
                <center>
                    <div id="icon">
                        <span class="fa-stack fa-lg" style="margin-right: 40px;" onClick="hide1()">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-id-card-o fa-stack-1x fa-inverse"></i>
                            <p>Une compétition</p>
                        </span>
                        <span class="fa-stack fa-lg" style="margin-right: 40px;" onClick="hide2()">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-user fa-stack-1x fa-inverse"></i>
                            <p>Un tireur</p>
                        </span>
                        <span class="fa-stack fa-lg" onClick="hide3()">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-home fa-stack-1x fa-inverse"></i>
                            <p>Un club</p>
                        </span>
                    </div>
                </center>
                <br /><br />
                <div id="tableauCompet">
                    <h3>Tableau des compétitions</h3>
                    <br />
                    <form name="formModif" method="post" action="traitementModifier.php">
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
                                            $ordresql = "SELECT * FROM `competition` ORDER BY `nomCompetition`";
                                            $resultatRequete=$bdd->query($ordresql);
                                            $lesTuplesCompetition=$resultatRequete->fetchall(PDO::FETCH_ASSOC);
                                            foreach ($lesTuplesCompetition as $unTupleCompetition){
                                                $idCompetition = $unTupleCompetition['idCompetition'];
                                                $nomCompet = "nomCompet".$idCompetition;
                                                $dateCompet = "dateCompet".$idCompetition;
                                                $buttonM = "envoiCompet".$idCompetition;
                                                $buttonS = "supprCompet".$idCompetition;
                                                $nomCompetition = $unTupleCompetition['nomCompetition'];
                                                $dateCompetition = $unTupleCompetition['dateCompetition'];
                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo "<input type=\"text\" class=\"inputTextModif\" name=\"$nomCompet\" size=\"35\" value=\"$nomCompetition\" required>";?>
                                        </td>
                                        <td>
                                            <?php echo "<input type=\"text\" class=\"inputTextModif\" name=\"$dateCompet\" size=\"35\" value=\"$dateCompetition\" required>";?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php echo "<button type=\"submit\" name=\"$buttonM\" class=\"buttonModif\"><i style=\"color:#555555;\" class=\"fa fa-floppy-o fa-2x\" aria-hidden=\"true\"></i></button>";?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php echo "<button type=\"submit\" name=\"$buttonS\" class=\"buttonModif\"><i style=\"color:#B80101;\" class=\"fa fa-times-circle fa-2x\" aria-hidden=\"true\"></i></button>";?>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div id="tableauClub">
                    <h3>Tableau des clubs</h3>
                    <br />
                    <form name="formModif" method="post" action="traitementModifier.php">
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nom du club</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $ordresql = "SELECT * FROM `club` ORDER BY `nomClub`";
                                        $resultatRequete=$bdd->query($ordresql);
                                        $lesTuplesClub=$resultatRequete->fetchall(PDO::FETCH_ASSOC);
                                        foreach ($lesTuplesClub as $unTupleClub){
                                            $idClub = $unTupleClub['idClub'];
                                            $buttonM = "envoiClub".$idClub;
                                            $buttonS = "supprClub".$idClub;
                                            $nomClubID = "nomClub".$idClub;
                                            $nomClub = $unTupleClub['nomClub'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo "<input type=\"text\" class=\"inputTextModif\" name=\"$nomClubID\" size=\"55\" value=\"$nomClub\" required>";?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php echo "<button type=\"submit\" name=\"$buttonM\" class=\"buttonModif\"><i style=\"color:#555555;\" class=\"fa fa-floppy-o fa-2x\" aria-hidden=\"true\"></i></button>";?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php echo "<button type=\"submit\" name=\"$buttonS\" class=\"buttonModif\"><i style=\"color:#B80101;\" class=\"fa fa-times-circle fa-2x\" aria-hidden=\"true\"></i></button>";?>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div id="tableauTireur">
                    <h3>Tableau des tireurs</h3>
                    <br />
                    <form name="formModif" method="post" action="traitementModifier.php">
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
                                            
                                            $idTireur = $unTupleTireur['idTireur'];
                                            
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
                                            
                                            $idTireur = $unTupleTireur['idTireur'];
                                            $nomTireur = $unTupleTireur['nomTireur'];
                                            $prenomTireur = $unTupleTireur['prenomTireur'];
                                            $scoreSerieUn = $unTupleTireur['scoreSerie1'];
                                            $scoreSerieDeux = $unTupleTireur['scoreSerie2'];
                                            $scoreSerieTrois = $unTupleTireur['scoreSerie3'];
                                            $scoreSerieQuatre = $unTupleTireur['scoreSerie4'];
                                            $scoreSerieCinq = $unTupleTireur['scoreSerie5'];
                                            $scoreSerieSix = $unTupleTireur['scoreSerie6'];
                                            $nomTireurID = "nomTireur".$idTireur;
                                            $prenomTireurID = "prenomTireur".$idTireur; 
                                            $scoreSerieUnID = "scoreSerieUn".$idTireur;
                                            $scoreSerieDeuxID = "scoreSerieDeux".$idTireur;
                                            $scoreSerieTroisID = "scoreSerieTrois".$idTireur;
                                            $scoreSerieQuatreID = "scoreSerieQuatre".$idTireur;
                                            $scoreSerieCinqID = "scoreSerieCinq".$idTireur;
                                            $scoreSerieSixID = "scoreSerieSix".$idTireur; 
                                            $nomCompetID = "nomCompet".$idTireur;
                                            $nomClubID = "nomClub".$idTireur;
                                            $nomCategID = "nomCateg".$idTireur;
                                            $buttonM = "envoiTireur".$idTireur;
                                            $buttonS = "supprTireur".$idTireur;
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo "<input type=\"text\" class=\"inputTextModif\" name=\"$nomTireurID\" size=\"15\" value=\"$nomTireur\" required>";?>
                                        </td>
                                        <td>
                                            <?php echo "<input type=\"text\" class=\"inputTextModif\" name=\"$prenomTireurID\" size=\"15\" value=\"$prenomTireur\" required>";?>
                                        </td>
                                        <td>
                                            <?php echo "<input type=\"number\" class=\"inputTextModif\" name=\"$scoreSerieUnID\" value=\"$scoreSerieUn\" min=\"0\" max=\"109\" step=\".1\" required>";?>
                                        </td>
                                        <td>
                                            <?php echo "<input type=\"number\" class=\"inputTextModif\" name=\"$scoreSerieDeuxID\" value=\"$scoreSerieDeux\" min=\"0\" max=\"109\" step=\".1\" required>";?>
                                        </td>
                                        <td>
                                            <?php echo "<input type=\"number\" class=\"inputTextModif\" name=\"$scoreSerieTroisID\" value=\"$scoreSerieTrois\" min=\"0\" max=\"109\" step=\".1\" required>";?>
                                        </td>
                                        <td>
                                            <?php echo "<input type=\"number\" class=\"inputTextModif\" name=\"$scoreSerieQuatreID\" value=\"$scoreSerieQuatre\" min=\"0\" max=\"109\" step=\".1\" required>";?>
                                        </td>
                                        <td>
                                            <?php echo "<input type=\"number\" class=\"inputTextModif\" name=\"$scoreSerieCinqID\" value=\"$scoreSerieCinq\" min=\"0\" max=\"109\" step=\".1\" required>";?>
                                        </td>
                                        <td>
                                            <?php echo "<input type=\"number\" class=\"inputTextModif\" name=\"$scoreSerieSixID\" value=\"$scoreSerieSix\" min=\"0\" max=\"109\" step=\".1\" required>";?>
                                        </td>
                                        <td>
                                            <div class="select">
                                                <select name="<?php echo $nomCompetID; ?>" required>
                                                    <option selected value="<?php echo $idCompet; ?>">
                                                        <?php echo $nomCompet; ?></option>
                                                    <?php
                                                $ordresql = "SELECT `idCompetition`,`nomCompetition` FROM `competition` WHERE `idCompetition` != $idCompet ORDER BY `nomCompetition`";
                                                $resultatRequete=$bdd->query($ordresql);
                                                $lesTuplesCompetitionDeux=$resultatRequete->fetchall(PDO::FETCH_ASSOC);
                                                foreach ($lesTuplesCompetitionDeux as $unTupleCompetitionDeux){
                                            ?>
                                                    <option
                                                        value="<?php echo $unTupleCompetitionDeux['idCompetition'] ?>">
                                                        <?php echo $unTupleCompetitionDeux['nomCompetition'] ?></option>
                                                    <?php
                                                }
                                            ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="select">
                                                <select name="<?php echo $nomClubID; ?>" required>
                                                    <option selected value="<?php echo $idClub; ?>">
                                                        <?php echo $nomClub; ?></option>
                                                    <?php
                                                $ordresql = "SELECT * FROM `club` WHERE idClub != $idClub ORDER BY `nomClub`";
                                                $resultatRequete=$bdd->query($ordresql);
                                                $lesTuplesClubDeux=$resultatRequete->fetchall(PDO::FETCH_ASSOC);
                                                foreach ($lesTuplesClubDeux as $unTupleClubDeux){
                                            ?>
                                                    <option value="<?php echo $unTupleClubDeux['idClub'] ?>">
                                                        <?php echo $unTupleClubDeux['nomClub'] ?></option>
                                                    <?php
                                                }
                                            ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="select">
                                                <select name="<?php echo $nomCategID; ?>" required>
                                                    <option selected value="<?php echo $idCateg; ?>">
                                                        <?php echo $nomCateg; ?></option>
                                                    <?php
                                                $ordresql = "SELECT `idCategorieTireur`,`libelleCategorieTireur` FROM `categorietireur` WHERE idCategorieTireur != $idCateg";
                                                $resultatRequete=$bdd->query($ordresql);
                                                $lesTuplesCategDeux=$resultatRequete->fetchall(PDO::FETCH_ASSOC);
                                                foreach ($lesTuplesCategDeux as $unTupleCategDeux){
                                            ?>
                                                    <option
                                                        value="<?php echo $unTupleCategDeux['idCategorieTireur'] ?>">
                                                        <?php echo $unTupleCategDeux['libelleCategorieTireur'] ?>
                                                    </option>
                                                    <?php
                                                }
                                            ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php echo "<button type=\"submit\" name=\"$buttonM\" class=\"buttonModif\"><i style=\"color:#555555;\" class=\"fa fa-floppy-o fa-2x\" aria-hidden=\"true\"></i></button>";?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php echo "<button type=\"submit\" name=\"$buttonS\" class=\"buttonModif\"><i style=\"color:#B80101;\" class=\"fa fa-times-circle fa-2x\" aria-hidden=\"true\"></i></button>";?>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </article>
        </section>
    </main>
    <footer>
        <p>© Eribon - Lasvaladas<br />Tous Droits Réservés</p>
    </footer>
</body>

</html>