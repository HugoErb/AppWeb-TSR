window.onload = () => {
  var httpRequest = new XMLHttpRequest();
  console.log(data_tireur);
  if (data_tireur[0].length === 0) {
    console.log('Page mise à jour');
    setTimeout(() => {
      window.location.reload(1);
    }, 20000);
  } else {
    let my_slide = new SlideShow(data_tireur);
  }
}

class SlideShow {

  constructor(data) {

    this.data_container = data;
    this.nb_displayed = 0;
    this.size_slide = 15;
    this.index_start = 0;
    data.forEach((tireur_set, i) => {
      tireur_set.sort(Tireur.has_a_betterScoreTot);
    });
    this.current_data = this.data_container[0];
    this.next_data = this.data_container[1];
    this.display_Slide_Show();
  }

  reStart() {

    window.location.reload(1);
  }

  static get_size_slide() {

    return this.size_slide;
  }

  display_Slide_Show() {

    let current_slide = `<h3>${this.current_data[0].get_nomCompetition()}<br> ${this.current_data[0].get_libelleCategorieTireur()}</h3><br>
                         <div class="current">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Classement</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Club</th>`;

    for (let i = 0; i < this.current_data[0].get_nb_series(); i++) {
      current_slide += `<th>S${i+1}</th>`;
    }

    current_slide += `<th>Total</th>
                   </tr>
                </thead>`;

    this.nb_displayed = 0;
    this.current_data.forEach((tireur, i, array) => {
      if (i >= this.index_start && i < this.index_start + this.size_slide) {
        current_slide += `<tr>
                              <td>${i+1}</td>
                              <td>${tireur.get_nom()}</td>
                              <td>${tireur.get_prenom()}</td>
                              <td>${tireur.get_assoc()}</td>`;

        tireur.get_series().forEach((serie, j) => {
          current_slide += `<td>${serie}</td>`;
        });

        current_slide += `<td>${tireur.get_scoreTot()}</td>
                      </tr>`;
        this.nb_displayed++;
      }
    });

    this.index_start += this.size_slide;
    current_slide += `</table>
                  </div>`;

    let container = window.document.getElementById('container');
    container.innerHTML = current_slide;
    container.style.display = 'block';

    setTimeout(() => {
      this.Next_Slide(this.next_data);
    }, this.nb_displayed * 1000 + 10000);
  }

  update_Data(new_Data) {

    if (this.current_data.length < this.index_start) {
      this.current_data = new_Data;
      this.next_data = this.data_container[this.data_container.indexOf(new_Data) + 1];
      window.document.getElementById('container').innerHTML = '';
      this.index_start = 0;
    }
  }

  Next_Slide(new_Data) {

    if (new_Data === undefined) {
      this.reStart();
    } else {
      this.update_Data(new_Data);
      this.display_Slide_Show();
    }
  }
}