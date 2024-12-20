# AppWeb-TSR

## Explications et fonctionnement de l’application

Cette solution logicielle a pour but d’afficher les classements d’une compétition de tir sportif en cours. Pour cela vous devez, sur l’application, créer la compétition en question, puis y ajouter des tireurs avec leur score, leur club, leur catégorie etc… 
Une fois cela fait, une option permet d’afficher en temps réel et de manière automatique tous les classements de la compétition. Cet affichage est optimisé pour être projeté ou affiché sur grand écran.

Il est également possible à la fin d’une compétition de générer un fichier PDF regroupant tous les classements, afin de posséder un fichier à imprimer ou à distribuer électroniquement. 

Cette solution logicielle est une application web fonctionnant sur Google Chrome, n’hésitez donc pas à vous servir des raccourcis natifs du navigateur, comme par exemple “Ctrl + f” pour afficher une barre de recherche permettant de trouver un certain mot sur la page (utile et recommandé pour la page “Modification” et “Consultation”), ou encore “F11” afin d’afficher l’interface actuelle en plein écran (recommandé pour l’affichage des classements).

Note : L'application n'est pas responsive, ce qui veut dire qu'elle est théoriquement seulement disponible sur un écran d'ordinateur, et non un écran de téléphone portable etc.

## Installation 

Pour installer AppWeb TSR, téléchargez l’application, puis dézippez la dans le dossier d’installation de votre choix. 

À noter que pour que l’application fonctionne, vous devez avoir Google Chrome à jour et configuré en tant que navigateur par défaut. De plus, désinstallez Skype ou tout autre logiciel occupant le port 81 de votre ordinateur.

## Lancement de l’application

Afin de lancer l’application, rendez vous dans le dossier contenant l’application, et recherchez le fichier “Uwamp.exe”, puis double cliquez sur celui-ci. Par la suite, vous pourrez créer un raccourci de ce fichier, et pourquoi pas le placer sur votre bureau.

La machine virtuelle Uwamp se lance. Vérifiez bien que la fenêtre Uwamp possède le serveur Apache et MySQL démarré.

Cliquez sur le bouton “Navigateur www” pour ouvrir l’application.

## Ajouter une entité

Cette section à pour but d’ajouter des données dans la base. Vous pourrez y entrer 3 types d’entités différentes : une nouvelle compétition, un nouveau tireur ou un nouveau club. Pour cela, cliquez sur une des trois icônes pour ajouter la donnée correspondante.

## Ajouter une compétition

Pour l’ajout d’une nouvelle compétition, vous devez entrer le nom de la compétition, la date ainsi que renseigner si oui ou non l'événement se déroule sur 2 jours grâce à la case à cocher.

Pour entrer la date, vous pouvez simplement cliquer sur la petite icône de calendrier afin de faire apparaître une fenêtre affichant les jours et les mois. Sélectionnez ensuite le premier jour de la compétition.

## Ajouter un tireur

Pour l’ajout d’un tireur, vous devez renseigner nom, prénom, scores de séries, son club, ainsi que la compétition et la catégorie à laquelle il participe.

Si un tireur participe plusieurs fois à la même compétition, mais dans plusieurs catégories différentes, alors vous devrez le rentrer une nouvelle fois dans la base de donnée.

Par défaut, vous pouvez mettre les scores de séries d’un tireur à 0 lorsqu’il vient s’inscrire à une compétition (logique, puisqu’il n’a pas encore tiré) et les renseigner par la suite, une fois que le tireur a fini de tirer, grâce à l’onglet “Modification”.
Sinon, vous pouvez rentrer le tireur dans l’application seulement lorsqu’il a fini de tirer.

## Ajouter un club

L’ajout d’un nouveau club ne demande que d’entrer le nom de ce dernier, à vous de vérifier que vous ne faites pas de doublons.

Note : il est important de savoir que certains caractères tels que les apostrophes ne sont pas supportés par l’application. En effet, cela causera une erreur si vous tentez d’enregistrer une nouvelle donnée avec un nom comportant une apostrophe par exemple.

## Modifier une entité

La page de modification d’entité permet de changer les données d’un tireur, d’une compétition ou d’un club déjà créé. Pour cela, comme pour ajouter de nouvelles données, vous devrez cliquer sur une des trois icônes afin de modifier l’entité correspondante.

Une fois que vous avez modifié les données d’une entité, utilisez le bouton “Enregistrer” (icône de disquette) au bout de la ligne afin d’enregistrer la modification.

Vous pouvez également supprimer une entité en cliquant sur la croix rouge au bout de la ligne. 
Avant d’effectuer cette opération, il est important de savoir que ce processus est instantané et n’affiche pas de fenêtre de validation. En effet, l’entité sera supprimée dès l’appui sur l'icône de croix rouge. De plus, si vous supprimez une compétition ou un club, chaque tireur présent dans cette compétition ou ayant ce club seront également supprimés afin d’éviter les incohérences dans la base de données.

Vous ne pouvez modifier qu’une ligne à la fois.

Note : Un tireur possède beaucoup de données modifiables, il se peut donc que certaines données ne soient pas directement affichées sur votre écran. Pour y avoir accès, servez-vous de la barre de défilement en bas du tableau des tireurs ou maintenez la touche “Shift” et scrollez à l’aide de la molette de votre souris.
Vous pouvez également utiliser le raccourci “Ctrl + f” afin d’afficher une petite barre de recherche en haut à droite de votre écran et ainsi rechercher une donnée que vous souhaitez modifier.

## Consulter les données

Cette section permet simplement de consulter les données des compétitions, des clubs ou des tireurs. Pour cela, comme pour ajouter de nouvelles données, vous devrez cliquer sur une des trois icônes afin de consulter l’entité correspondante.

Note : Vous pouvez utiliser le raccourci “Ctrl + f” afin d’afficher une petite barre de recherche en haut à droite de votre écran et ainsi rechercher une donnée que vous souhaitez consulter.

## Affichage des classements

Cette section permet de créer un affichage dynamique du classement de toutes les catégories d’une compétition. 

Pour cela vous devez, sur l’application, créer la compétition en question, puis y ajouter des tireurs avec leur score, leur club, leur catégorie etc… 
Une fois cela fait, sur la page d’affichage, sélectionnez dans la liste déroulante de la première section la compétition que vous souhaitez afficher et cliquez sur le bouton “Lancer l’affichage”. Un nouvel onglet contenant l’affichage automatique s’ouvre alors sur Google Chrome. Avec votre souris, cliquez sur ce nouvel onglet en haut de votre écran, maintenez le et faites le glisser vers votre deuxième écran. Appuyez ensuite sur F11 afin de mettre l’affichage en plein écran.

Chaque changement effectué sur l’application se fera également sur l’affichage. En effet, tout est géré automatiquement une fois la fonctionnalité d’affichage lancée.

Vous pouvez passer à la catégorie affichée suivante en appuyant sur la touche espace. Sinon, chaque interface de l’affichage est programmée pour rester plus ou moins longtemps en fonction du nombre de personnes présentes sur l’écran.

Cet affichage est optimisé pour être projeté ou affiché sur grand écran.

## Générer un fichier PDF

Cette fonctionnalité, disponible sur la page “Affichage” de l’application, permet de générer un fichier PDF contenant tous les résultats d’une compétition. Pour faire simple, c’est la page d’affichage des classements qui sera projetée sur des feuilles A4 en format paysage et exportée au format PDF. 

Pour obtenir le fichier PDF, rendez vous sur la page “Affichage” et sélectionnez dans la liste déroulante de la deuxième section de la page la compétition dont vous voulez obtenir les résultats. Une fenêtre s'affiche alors pour vous informer que le PDF est en cours de création. Une fois le PDF terminé, il se télécharge automatiquement sur votre ordinateur, dans le dossier des téléchargements.
Fermeture de l’application 

Lorsque vous avez fini d’utiliser l’application, fermez simplement Google Chrome, puis Uwamp (qui peut s’être réduit dans la barre des tâches) en fermant également Apache et MySQL lorsque la fenêtre s’affichera. 

Il est possible qu’une erreur apparaisse à la fermeture d’Uwamp. N’y prêtez pas attention et fermez simplement la fenêtre d’erreur.
