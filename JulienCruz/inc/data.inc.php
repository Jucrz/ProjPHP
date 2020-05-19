<?php 
          $experience = $pdo->query("SELECT * FROM experience ORDER BY id_experience desc");

          /////////////////////////// Suppression d'une experience dans la base de données ///////////////////////////

            if(!empty($_GET['id'])) {
              $del = $_GET['id'];
              $supr = $pdo->exec("DELETE FROM experience WHERE id_experience = $del"); 
            }

          /////////////////////////// Modification d'une experience dans la base de données ///////////////////////////

            if(isset($_POST['modification']))
            {
                $resultat = $pdo->exec("UPDATE experience SET poste='$_POST[posteM]', domaine='$_POST[domaineM]', description='$_POST[descriptionM]', periode='$_POST[periodeM]' WHERE id_experience='$_POST[id_exp]'; ");
            }

          /////////////////////////// Ajout d'une experience dans la base de données ///////////////////////////

            if(isset($_POST['ajout']))
            {
                $result = $pdo->exec("INSERT INTO experience (poste, domaine, description, periode) VALUES ('$_POST[poste]', '$_POST[domaine]', '$_POST[description]', '$_POST[periode]')");
            }

        ?>



        <?php

          /////////////////////////// Création d'un formulaire de modification d'une experience avec la methode POST,
          /////////////////////////// grace a la super globale GET on cible l'experience que l'on souhaite modifier avec l'id de cette dernière.

            if(!empty($_GET['modif'])) {
              $modification = $_GET['modif']; 
              $selectModif = $pdo->query("SELECT * FROM experience WHERE id_experience = $modification");
              $experience = $selectModif->fetch(PDO::FETCH_OBJ);?>
              <form method="post" action="admin.php" name="modification">
              <label for="poste">Poste</label><br>
              <input type="text" name="posteM" placeholder="Votre poste" id="posteM" class="Formexp" value="<?php echo $experience->poste ?>"><br><br>
              <label for="domaine">Domaine</label><br>
              <input type="text" name="domaineM" placeholder="Dans quel domaine travaillez-vous" id="domaineM" class="Formexp" required="" value="<?php echo $experience->domaine ?>" ><br><br>
              <label for="description">Description</label><br>
              <input type="text" name="descriptionM" placeholder="1000 mots maximum" id="descriptionM" class="Formexp" value="<?php echo $experience->description ?>" ><br><br>
              <label for="periode">Periode travail</label><br>
              <input type="text" name="periodeM" placeholder="Ex : Decembre 2011 - Mars 2013 " id="periodeM" class="Formexp" value="<?php echo $experience->periode ?>"><br><br>
              <input type="hidden" name="id_exp" id="id_exp" value="<?php echo $experience->id_experience  /////////////// on récupère l'id de l'expérience dans un input caché du formulaire pour pouvoir l'utiliser dans le POST pour cibler notre experience?>">
              <input type="submit" name="modification"><br><br>
              </form>
        <?php } ?>

