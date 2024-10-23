<!DOCTYPE html>
<?php
  $id_competition = $_POST['slct'];
  try{
          $bdd = new PDO('mysql:host=localhost;dbname=bdtsr', 'root', 'root');
          $bdd->exec("SET CHARACTER SET utf8");
      }
      catch(Exception $e){
          die('Erreur de connexion à la base');
      }

      $ordre_categories = "SELECT `idCategorieTireur` FROM `avoir`
	                     WHERE `idCompetition` = $id_competition";

      $resultatRequete = $bdd->query($ordre_categories);
      $id_categories = $resultatRequete->fetchall(PDO::FETCH_ASSOC);
      $_index = 0;
      foreach($id_categories as $id_categorie) {
        $id_cat_tireur = $id_categorie['idCategorieTireur'];
        $ordre_tireurs = "SELECT * FROM tireur, club, competition, categorietireur
                            WHERE tireur.idCategorieTireur = $id_cat_tireur
                              AND tireur.idCompetition = $id_competition
                              AND club.idClub = tireur.idClub
                              AND tireur.idCategorieTireur = categorietireur.idCategorieTireur
                              AND tireur.idCompetition = competition.idCompetition";

        $resultatRequete = $bdd->query($ordre_tireurs);
        $data[$_index] = $resultatRequete->fetchall(PDO::FETCH_ASSOC);
        $_index += 1;
      }
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Classements AppWeb TSR</title>
    <meta name="viewport" content="initial-scale=1.0">
	<script type="text/javascript" src="js/tireur.js"></script>
	<script type="text/javascript" src="js/slide_show.js"></script>
    <script src="jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
      function receive_data() {
		let data_tireur = [];
        let req_data = [];
		try {
			req_data =<?php echo json_encode($data);?>;
		}catch(error) {
			console.log('Aucune donnée');
			return [];
		}
        data_tireur = [];
        req_data.forEach((tireur_tab, i) => {
          let cat_tireur = []
          let series = [];
          tireur_tab.forEach((tireur, i) => {
            let index = 1;
            while(Reflect.get(tireur, 'scoreSerie'+index) != undefined) {
              series.push(Reflect.get(tireur, 'scoreSerie'+index.toString()));
              index++;
            }
            cat_tireur.push(new Tireur(tireur.prenomTireur, tireur.nomTireur, tireur.nomClub, series, tireur.scoreTotalTireur, tireur.nomCompetition, tireur.libelleCategorieTireur));
            series = [];
          });
          data_tireur.push(cat_tireur);
        });
		return data_tireur;
      }
	  var data_tireur = receive_data();
    </script>
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
</head>

<body>
    <img src="images/logoFFTir.png" alt="Logo FFTir" style=" top: 0; left:0; width: 200px; margin: 30px; position: absolute;"/>
    <img src="images/logo.png" alt="Logo TSR" style="top: 0; right:0; width: 150px; margin: 30px; position: absolute;"/>
    <center><p style="margin-top: 75px; margin-bottom: 25px; font-size:2.8em; letter-spacing:2px; color :#303030; display:block;">CLASSEMENTS</p></center><br><br><br>
    <div id='container' class="slideshow-container">

        <div class="mySlides fade">

        </div>

    </div>
    <br>

</body>

</html>
