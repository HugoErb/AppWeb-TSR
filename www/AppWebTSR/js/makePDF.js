window.addEventListener("load", (event) => {
	let result_pdf = new Pdf();
});


class Pdf {

	constructor() {
		Swal.fire({
			title: 'Génération du PDF en cours...',
			showCancelButton: false,
			showConfirmButton: false,
			confirmButtonColor: '#FF512F'
		});
		Swal.showLoading();
		this.pages = [];
		data_tireur.forEach((tireur_set, i) => {
			tireur_set.sort(Tireur.has_a_betterScoreTot);
			console.log(tireur_set);
			this.html = this.build_HTML(tireur_set, 0);
		});
		let opt = {
			margin: 0,
			filename: 'Classement ' + data_tireur[0][0].get_nomCompetition() + '.pdf',
			image: {
				type: 'png',
				quality: 1
			},
			html2canvas: {
				scale: 2,
				width: window.screen.width / 1.66,
				height: window.innerheight,
				unit: 'in',
			},
			jsPDF: {
				orientation: 'landscape'
			}
		};
		let worker = html2pdf();
		this.pages.forEach((page, i) => {
			worker = worker.set(opt).from(page).toContainer().toCanvas().toPdf().get('pdf').then((pdf) => {
				if (i + 1 < this.pages.length)
					pdf.addPage();
			});
		});
		worker.save().then(() => {
			Swal.fire({
				title: 'PDF généré avec succès !',
				icon: 'success',
				text: 'Le classement a été téléchargé sur votre ordinateur. Vous allez être redirigé vers la page d\'affichage.',
				confirmButtonColor: '#FF512F',
				confirmButtonText: 'Confirmer'
			}).then(() => {
				window.location.href = "lanceraffichage.php";
			});
		});

	}

	build_HTML(data_tireur, index) {

		let current_slide = `
<div id="generatePDF">
		<div>
    		<center><p style="margin-top: 75px; margin-bottom: 25px; font-size:2.8em; letter-spacing:2px; color :#303030; display:block;">CLASSEMENTS</p></center><br><br><br>
    		<div id='container' class="slideshow-container">
   					<h3>${data_tireur[0].get_nomCompetition()}<br> ${data_tireur[0].get_libelleCategorieTireur()}</h3><br>
                         <div class="current">
                            <table style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Rang</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th style="width:400px">Club</th>`;

		for (let i = 0; i < data_tireur[0].get_nb_series(); i++) {
			current_slide += `<th>S${i+1}</th>`;

		}
		current_slide += `<th>Total</th>
    		             </tr>
    		           </thead>`;
		data_tireur.forEach((tireur, i, array) => {
			if (i < 10) {
				current_slide += `<tr>   
								<td>${index+i+1}</td>
	              				<td>${tireur.get_nom()}</td>
	      	       				<td>${tireur.get_prenom()}</td>
	                			<td>${tireur.get_assoc()}</td>`;

				tireur.get_series().forEach((serie, j) => {
					current_slide += `<td>${serie}</td>`;
				});
				current_slide += `<td>${tireur.get_scoreTot()}</td>
	       		      		  </tr>`;
			}
		});

		current_slide += `</table>
              		    </div>
					</div>
    			<br>
			<div>`;

		this.pages.push(current_slide);
		if (data_tireur.slice(10, data_tireur.length).length != 0) {
			this.build_HTML(data_tireur.slice(10, data_tireur.length), index + 10);
		}
		return current_slide;
	}
}