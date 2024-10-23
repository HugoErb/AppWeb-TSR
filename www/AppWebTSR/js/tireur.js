class Tireur {
  prenom;
  nom;
  assoc;
  series;
  scoreTot;
  nomCompetition;
  libelleCategorieTireur;

  constructor(prenom, nom, assoc, series, scoreTot, nomCompetition, libelleCategorieTireur) {
    this.prenom = prenom;
    this.nom = nom;
    this.assoc = assoc;
    this.series = series;
    this.scoreTot = scoreTot;
    this.nomCompetition = nomCompetition;
    this.libelleCategorieTireur = libelleCategorieTireur;
  }

  get_prenom() {
    return this.prenom;
  }

  get_nom() {
    return this.nom;
  }

  get_assoc() {
    return this.assoc;
  }

  get_series() {
    return this.series;
  }

  get_scoreTot() {
    return this.scoreTot;
  }

  get_nb_series() {
    return this.series.length;
  }

  get_nomCompetition() {
    return this.nomCompetition;
  }

  get_libelleCategorieTireur() {
    return this.libelleCategorieTireur;
  }

  static has_a_betterScoreTot(tireur1, tireur2) {
    return (tireur2.get_scoreTot() - tireur1.get_scoreTot());
  }

}

//let data2 = <?php echo json_encode($tireurs); ?>;