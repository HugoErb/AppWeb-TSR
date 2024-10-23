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
    <title>Génération PDF AppWeb TSR</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script type="text/javascript" src="js/tireur.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
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
	<script type="text/javascript" src="js/makePDF.js"></script>
</head> 
<body>
	
</body>
</html>
