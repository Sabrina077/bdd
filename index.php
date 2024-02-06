<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>AFCI BDD</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <a href="?page=role"><li>role</li></a>
                <a href="?page=centres"><li>centres</li></a>
                <a href="?page=formations"><li>formations</li></a>
                <a href="?page=pedagogie"><li>pedagogie</li></a>
                <a href="?page=session"><li>session</li></a>
                <a href="?page=apprenants"><li>apprenants</li></a>
                <a href="?page=affecter"><li>affecter</li></a>
            </ul>
        </nav>
    </header>

<?php
$host = "localhost"; 
$dbname = "afci";
$user = "root";
$pass = ""; 

    // Création d'une nouvelle instance de la classe PDO
    $bdd = new PDO ("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

    // Configuration des options PDO
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // echo "Connexion réussie !";

//GESTION DE LA PAGE ROLE

if (isset($_GET["page"])&& $_GET["page"] == "role"){
    $sql = "SELECT * FROM role";
    $requete = $bdd->query($sql);
    $results = $requete->fetchAll(PDO::FETCH_ASSOC);
?> 
 <div class="centreDiv">
    <table>
        <tr>
            <th>ID</th>
            <th>Nom Role</th>
            <th>modifier</th>
            <th>Action</th>
       </tr>
     <?php
       foreach ($results as $item){
        echo '<th>';
        echo '<td>' . $item['id_role'] . '</td>';
        echo '<td>' . $item['nom_role'] . '</td>';
        echo '<input type="hidden" name="hiddenRole" value="' . $item['id_role'] . '">';
        echo '<td><a href="?page=role&type=modifier&id=' . $item['id_role'] . '"><button>Modifier</button></a></td>';
        echo '<td><button>supprimer</button></td>';
        echo '</tr>';
       }
 ?>
    </table>
        <form method="POST">
            <h2>Ajout Role</h2>
            <label>Nom du role</label>
            <input type="text" name="nomRole">

            <input type="submit" name="submitRole" value="enregistré">
        </form>
    </div>
 <?php
     if (isset($_GET['type'])&& $_GET['type'] == "modifier"){

         $id = $_GET["id"];
         $sqlId = "SELECT * FROM role WHERE id_role = $id";
         $requeteId = $bdd->query($sqlId);
         $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
        ?>
        <h2> modifier role</h2>
       <form method="POST">
         <input type="hidden" name="updateIdRole" value="<?php echo $resultsId['id_role']; ?> ">
         <input type="text" name="updateNomRole" value="<?php echo $resultsId['nom_role']; ?> ">
         <input type="submit" name="updateRole" value="update Role">
       </form> 
     <?php
       if (isset($_POST["updateRole"])){
        $updateIdRole = $_POST["updateIdRole"];
        $updateNomRole = $_POST["updateNomRole"];
        $sqlupdate = "UPDATE `role` SET `nom_Role` ='$updateNomRole' WHERE id_role = $updateIdRole";
         $bdd->query($sqlupdate);
         echo "Données modifiée";
       }
     }

    // $sql = "SELECT * FROM role";
    // $requete = $bdd->query($sql);
    // $results = $requete->fetchAll(PDO::FETCH_ASSOC);

    // foreach( $results as $value ){
    //     foreach($value as $data){
    //         echo $data;
    //         echo"<br>";
    //     }
    //     echo "<br>";
    // }
    
    if (isset($_POST['submitRole'])){
        $nomRole = $_POST['nomRole'];
        $sql = "INSERT INTO `role`(`nom_role`) VALUES ('$nomRole')";
        $bdd->query($sql);
        echo "data ajoutée dans la bdd";
    }
}

//GESTION DE LA PAGE CENTRE 
    if (isset($_GET["page"])&& $_GET["page"] == "centres"){
    $sql = "SELECT * FROM centres";
    $requete = $bdd->query($sql);
    $results = $requete->fetchAll(PDO::FETCH_ASSOC);
?> 
<div class="centreDiv">
    <table>
        <tr>
            <th>ID</th>
            <th>Ville centre</th>
            <th>Adresse centre</th>
            <th>CP centre</th>
            <th>Modifier</th>
            <th>Action</th>
        </tr>
    <?php
        foreach ($results as $item) {
            echo '<tr>';
            echo '<td>' . $item['id_centre'] . '</td>';
            echo '<td>' . $item['ville_centre'] . '</td>';
            echo '<td>' . $item['adresse_centre'] . '</td>';
            echo '<td>' . $item['code_postal_centre'] . '</td>';
            echo '<td><a href="?page=centres&type=modifier&id=' . $item['id_centre'] . '"><button>Modifier</button></a></td>';
            echo '<td><button>Supprimer</button></td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>
        <form method="POST">
            <h2>Ajout Centres</h2>
            <label>Nom du centre</label>
            <input type="text" name="nomCentre">
            <label>Adresse</label>
            <input type="text" name="adresseCentre">
            <label>Code Postal</label>
             <input type="text" name="codePostaleCentre">
            <input type="submit" name="submitRole" value="enregistré">
        </form>
    </div>
 <?php
     if (isset($_GET['type'])&& $_GET['type'] == "modifier"){

         $id = $_GET["id"];
         $sqlId = "SELECT * FROM centres WHERE id_centre = $id";
         $requeteId = $bdd->query($sqlId);
         $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
    ?>
       <form method="POST">
         <input type="hidden" name="updateIdCentre" value="<?php echo $resultsId['id_centre']; ?> ">
         <input type="text" name="updateNomRole" value="<?php echo $resultsId['nom_role']; ?> ">
         <input type="text" name="updateAdresseCentre" value="<?php echo $resultsId['adresse_centre']; ?> ">
         <input type="text" name="updateCodePostalCentre" value="<?php echo $resultsId['code_postal_centre']; ?> ">
         <input type="submit" name="updateCentre" value="UpdateCentres">
       </form>
    <?php 
     }
     if (isset($_POST['submitCentres'])){
         $villeCentre = $_POST['villeCentre'];
         $adresseCentre = $_POST['adresseCentre'];
         $codePostaleCentre = $_POST['codePostalCentre'];
         $sql = "INSERT INTO `centres`( `ville_centre`, `adresse_centre`, `code_postal_centre`) VALUES ('$villeCentre','$adresseCentre','$codePostalCentre')";
         $bdd->query($sql);
         echo "data ajoutée dans la bdd";
        }
    }

//GESTION DE LA PAGE FORMATION 
    if (isset($_GET["page"])&& $_GET["page"] == "formations"){
        $sql = "SELECT * FROM formations";
        $requete = $bdd->query($sql);
        $results = $requete->fetchAll(PDO::FETCH_ASSOC);
    ?> 
    <div class="centreDiv">
    <table>
        
        <tr>
            <th>ID</th>
            <th>Nom formation</th>
            <th>Duree formation</th>
            <th>Niveau fin</th>
            <th>Description</th>
            <th>Modifier</th>
            <th>Action</th>
        </tr>

        <?php
        foreach ($results as $item) {
            echo '<tr>';
            echo '<td>' . $item['id_formation'] . '</td>';
            echo '<td>' . $item['nom_formation'] . '</td>';
            echo '<td>' . $item['duree_formation'] . '</td>';
            echo '<td>' . $item['niveau_sortie_formation'] . '</td>';
            echo '<td>' . $item['description'] . '</td>';
            echo '<td><a href="?page=formation&type=modifier&id=' . $item['id_formation'] . '"><button>Modifier</button></a></td>';
            echo '<td><button>Supprimer</button></td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>

<form method="POST">
    <h2>Ajout Formations</h2>
    <label>Nom de formation</label>
    <input type="text" name="nomFormations">
    <label for="">Duree de formation</label>
    <input type="text" name="dureeFormations">
    <label for="">Niveau a la sortie de formation</label>
    <input type="text" name="niveauSortieFormations">
    <label for="">description</label>
    <input type="text" name="description">
    <input type="submit" name="submitFormations" value="enregistré">
</form>

 <?php
     if (isset($_GET['type'])&& $_GET['type'] == "modifier"){

         $id = $_GET["id"];
         $sqlId = "SELECT * FROM formation WHERE id_formation = $id";
         $requeteId = $bdd->query($sqlId);
         $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
        ?>
       <form method="POST">
         <input type="hidden" name="updateIdFormations" value="<?php echo $resultsId['id_formations']; ?> ">
         <input type="text" name="updateDureeFormations" value="<?php echo $resultsId['duree_formations']; ?> ">
         <input type="text" name="updateNiveauSortieFormation" value="<?php echo $resultsId['niveau_sortie_formations']; ?> ">
         <input type="text" name="updateDescription" value="<?php echo $resultsId['description']; ?> ">
         <input type="submit" name="updateFormations" value="UpdateFormations">
       </form> 
     <?php
     }
     //    $sql = 
     //    "SELECT * FROM formations";
     //    $requete = $bdd->query($sql);
     //    $results = $requete->fetchAll(PDO::FETCH_ASSOC);
     
     //     foreach( $results as $value ){
         //         foreach($value as $data){
             //             echo $data;
             //             echo"<br>";
             //         }
             //         echo "<br>";
             //     }
             
             if (isset($_POST['submitFormations'])){
                 $nomFormations = $_POST['nomFormations'];
                 $dureeFormations = $_POST['dureeFormations'];
                 $niveauSortieFormations = $_POST['niveauSortieFormations'];
                 $description = $_POST['description'];
                 $sql = "INSERT INTO `formations`( `nom_formation`, `duree_formation`, `niveau_sortie_formation`, `description`) VALUES ('$nomFormations','$dureeFormations','$niveauSortieFormations','$description')";
                 $bdd->query($sql);
                 echo "data ajoutée dans la bdd";
                }
}

//GESTION DE LA PAGE PEDAGOGIE
    if (isset($_GET["page"])&& $_GET["page"] == "pedagogie"){

        $sql = "SELECT * FROM pedagogie";
        $requete = $bdd->query($sql);
        $results = $requete->fetchAll(PDO::FETCH_ASSOC);
    ?> 
     <div class="centreDiv">
       <table>
            <tr>
                <th>ID</th>
                <th>nom Pedagogie</th>
                <th>prémon Pedagogie</th>
                <th>mail Pedagogie</th>
                <th>num Pedagogie</th>
                <th>Modifier</th>
                <th>Action</th>
            </tr>
        <?php
            foreach ($results as $item) {
                echo '<tr>';
                echo '<td>' . $item['id_pedagogie'] . '</td>';
                echo '<td>' . $item['nom_pedagogie'] . '</td>';
                echo '<td>' . $item['prenom_pedagogie'] . '</td>';
                echo '<td>' . $item['mail_pedagogie'] . '</td>';
                echo '<td>' . $item['num_pedagogie'] . '</td>';
                echo '<td><a href="?page=pedagogie&type=modifier&id=' . $item['id_pedagogie'] . '"><button>Modifier</button></a></td>';
                echo '<td><button>Supprimer</button></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
        <form method="POST">
            <h2>Ajout Pedagogie</h2>
            <label>Nom pedagogie</label>
            <input type="text" name="nomPedagogie">
            <label for="">Prenom pedagogie</label>
            <input type="text" name="prenomPedagogie">
            <label for="">Mail pedagogie</label>
            <input type="text" name="mailPedagogie">
            <label for="">Num pedagogie</label>
            <input type="text" name="numPedagogie">
            <label>Role</label>
            <select name="idPedagogie" id="">
        </form>
           
  <?php
     if (isset($_GET['type'])&& $_GET['type'] == "modifier"){

         $id = $_GET["id"];
         $sqlId = "SELECT * FROM pedagogie WHERE id_pedagogie = $id";
         $requeteId = $bdd->query($sqlId);
         $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
    ?>
       <form method="POST">
         <input type="hidden" name="updateIdPedagogie" value="<?php echo $resultsId['id_pedagogie']; ?> ">
         <input type="text" name="updateNomPedagogie" value="<?php echo $resultsId['nom_pedagogie']; ?> ">
         <input type="text" name="updatePrenomPedagogie" value="<?php echo $resultsId['prenom_pedagogie']; ?> ">
         <input type="text" name="updateMailPedagogie" value="<?php echo $resultsId['mail_pedagogie']; ?> ">
         <input type="text" name="updateNumPedagogie" value="<?php echo $resultsId['num_pedagogie']; ?> ">
         <input type="submit" name="updatePedagogie" value="Update Pedagogie">
       </form> 
     <?php
     }
     
     if (isset($_POST['submitPedagogie'])){
         $nomPedagogie = $_POST['nomPedagogie'];
         $prenomPedagogie = $_POST['prenomPedagogie'];
         $mailPedagogie = $_POST['mailPedagogie'];
         $numPedagogie = $_POST['numPedagogie'];
         $idPedagogie = $_POST['idPedagogie'];
         $sql = "INSERT INTO `pedagogie`( `nom_pedagogie`, `prenom_pedagogie`, `mail_pedagogie`, `num_pedagogie`, `id_role`) VALUES ('$nomPedagogie','$prenomPedagogie','$mailPedagogie','$numPedagogie','$idPedagogie')";
         $bdd->query($sql);
         echo "data ajoutée dans la bdd";
        }
    }

    //GESTION DE LA PAGE SESSION
    if (isset($_GET["page"])&& $_GET["page"] == "session"){

        $sqlp = "SELECT * FROM pedagogie ";
        $requetep = $bdd->query($sqlp);
        $resultsp = $requetep->fetchAll(PDO::FETCH_ASSOC);

        $sqlf = "SELECT * FROM formations ";
        $requetef = $bdd->query($sqlf);
        $resultsf = $requetef->fetchAll(PDO::FETCH_ASSOC);

        $sqlc = "SELECT * FROM centres ";
        $requetec = $bdd->query($sqlc);
        $resultsc = $requetec->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="centreDiv">
    <table>
        <tr>
            <th>ID</th>
            <th>Nom session</th>
            <th>Date debut session</th>
            <th>Modifier</th>
            <th>Action</th>
        </tr>
    <?php
      $sql = "SELECT * FROM session";
      $requete = $bdd->query($sql);
      $results = $requete->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $item) {
            echo '<tr>';
            echo '<td>' . $item['id_session'] . '</td>';
            echo '<td>' . $item['nom_session'] . '</td>';
            echo '<td>' . $item['date_debut'] . '</td>';
            echo '<td><a href="?page=session&type=modifier&id=' . $item['id_session'] . '"><button>Modifier</button></a></td>';
            echo '<td><button>Supprimer</button></td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>

        <form method="POST">
            <h2>Ajout Session</h2>
            <label>NomSession</label> 
            <input type="text" name="nomSession">
            <label for="">Date de debut</label>
            <input type="text" name="dateDebutSession">
            <label for="">IdPedagogie</label> 
            <select name="idPedagogie" id="">
                <?php
                    foreach($resultsp as $valuep){
                    echo '<option value="' . $valuep['id_pedagogie'] . '">' . $valuep['id_pedagogie'] . $valuep['nom_pedagogie'] . '</option>';
                    }
                ?>
            </select>
            <label for="">Formation</label>
            <select name="idFormations" id="">
            <?php
                foreach($resultsf as $valuef){
                    echo '<option value="' . $valuef['id_formation'] . '">' . $valuef['id_formation'] . $valuef['nom_formation'] . '</option>';
                }
            ?>
            </select>
            <label for="">Centre</label>
            <select name="idCentres" id="">
                <?php
                    foreach($resultsc as $valuec){
                        echo '<option value="' . $valuec['id_centre'] . '">' . $valuec['id_centre'] . $valuec['ville_centre'] . '</option>';
                    }
                ?>
            </select>
            <input type="submit" name="submitSession" value="enregistré">
       </form>

<?php  
    if (isset($_GET['type'])&& $_GET['type'] == "modifier"){

    $id = $_GET["id"];
    $sqlId = "SELECT * FROM session  WHERE id_session = $id";
    $requeteId = $bdd->query($sqlId);
    $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
    ?>
    <form method="POST">
    <input type="hidden" name="updateIdSession" value="<?php echo $resultsId['id_session']; ?> ">
    <input type="text" name="updateNomSesion" value="<?php echo $resultsId['nom_session']; ?> ">
    <input type="text" name="updateDateDebut" value="<?php echo $resultsId['date_debut']; ?> ">
    <input type="submit" name="updateSession" value="UpdateSession">
    </form>
    <?php 
      

        // foreach( $results as $value ){
        //     foreach($value as $data){
        //         echo $data;
        //         echo"<br>";
        //     }
        //     echo "<br>";
        // }
    }
    if (isset($_POST['submitSession'])){
        $nomSession = $_POST['nomSession'];
        $dateDebutSession = $_POST['dateDebutSession'];
        $idPedagogie = $_POST['idPedagogie'];
        $idFormations = $_POST['idFormations'];
        $idCentres = $_POST['idCentres'];
        
        $sql = "INSERT INTO `session`(`nom_session`, `date_debut`, `id_pedagogie`, `id_formation`, `id_centre`) VALUES ('$nomSession', '$dateDebutSession',
        '$idPedagogie','$idFormations', '$idCentres')";
        $bdd->query($sql);
        echo "data ajoutée dans la bdd";
    }
    }
//GESTION DE LA PAGE APPRENANT
    if (isset($_GET["page"])&& $_GET["page"] == "apprenants"){

        $sql2 = "SELECT * FROM role";
        $requete2 = $bdd->query($sql2);
        $results2 = $requete2->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM Session";
        $requete = $bdd->query($sql);
        $results = $requete->fetchAll(PDO::FETCH_ASSOC);
    ?>
     <div class="centreDiv">
    <table>
        <tr>
            <th>ID</th>
            <th>Nom appenannts</th>
            <th>Prenom apprenants</th>
            <th>Mail apprenants</th>
            <th>Adresse apprenants</th>
            <th>Ville apprenants</th>
            <th>Code postal apprenants</th>
            <th>Tel  apprenants</th>
            <th>Date de naissance apprenats</th>
            <th>Niveau apprenants</th>
            <th>Num PE apprenants</th>
            <th>Num Secu apprenants</th>
            <th>Rib apprenant</th>
            <th>Modifier</th>
            <th>Action</th>
        </tr>
    <?php
      $sql = "SELECT * FROM apprenants";
      $requete = $bdd->query($sql);
      $results = $requete->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $item) {
            echo '<tr>';
            echo '<td>' . $item['id_apprenant'] . '</td>';
            echo '<td>' . $item['nom_apprenant'] . '</td>';
            echo '<td>' . $item['prenom_apprenant'] . '</td>';
            echo '<td>' . $item['mail_apprenant'] . '</td>';
            echo '<td>' . $item['adresse_apprenant'] . '</td>';
            echo '<td>' . $item['ville_apprenant'] . '</td>';           
            echo '<td>' . $item['code_postal_apprenant'] . '</td>';
            echo '<td>' . $item['tel_apprenant'] . '</td>';
            echo '<td>' . $item['date_naissance_apprenant'] . '</td>';
            echo '<td>' . $item['niveau_apprenant'] . '</td>';
            echo '<td>' . $item['num_PE_apprenant'] . '</td>';
            echo '<td>' . $item['num_secu_apprenant'] . '</td>';
            echo '<td>' . $item['rib_apprenant'] . '</td>';
            echo '<td><a href="?page=apprenants&type=modifier&id=' . $item['id_apprenant'] . '"><button>Modifier</button></a></td>';
            echo '<td><button>Supprimer</button></td>';
            echo '</tr>';
        }
    
        ?>
    </table>
    
    <form method="POST">
    <h2>Ajout Apprenants</h2>
    <label>Nom apprenant</label>
    <input type="text" name="nomApprenants">
    <label for="">Prenom</label>
    <input type="text" name="prenomApprenants">
    <label for="">adresse</label> 
    <input type="text" name="adresseApprenants">
    <label for="">Ville</label>
    <input type ="text" name="villeApprenants">
    <label for="">CP</label>
    <input type ="text" name="codePostalApprenants">
    <label for="">Telephone</label>
    <input type ="text" name="telApprenants">
    <label for="">Mail</label>
    <input type ="text" name="mailApprenants">
    <label for="">Date de naissance</label>
    <input type ="text" name="dateDeNaissanceApprenants">
    <label for="">Niveau</label>
    <input type ="text" name="niveauApprenants">
    <label for="">Num Pole Emploie</label>
    <input type ="text" name="numPeApprenants">
    <label for="">Num de secu</label>
    <input type ="text" name="numSecuApprenants">
    <label for="">Rib apprenant</label>
    <input type ="text" name="ribApprenants">
    <label for="">Role</label>
    <select name="idRole" id="">

        <?php
            foreach($results2 as $value){
            echo '<option value="' . $value['id_role'] . '">' . $value['id_role'] . $value['nom_role'] . '</option>';
             }
        ?>
    </select>
        <label for="">Session</label>
     <select name="idSession" id="">
        <?php
            foreach($results as $value){
             echo '<option value="' . $value['id_session'] . '">' . $value['id_session'] . $value['nom_session'] . '</option>';
            }
        ?>
     </select>
        <input type="submit" name="submitApprenants" value="enregistré">

  </form>
        </div>

    
<?php
        $sql = "SELECT * FROM apprenants";
        $requete = $bdd->query($sql);
        $results = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach( $results as $value ){
            foreach($value as $data){
                // echo $data;
                echo"<br>";
            }
            echo "<br>";
        } 
        if (isset($_POST['submitApprenants'])){
            $nomApprenant = $_POST['nomApprenants'];
            $prenomApprenant = $_POST['prenomApprenants'];
            $adresseApprenant = $_POST['adresseApprenants'];
            $mailApprenant = $_POST['mailApprenants'];
            $villeApprenant = $_POST['villeApprenants'];
            $codePostalApprenant = $_POST['codePostalApprenants'];
            $telApprenant = $_POST['telApprenants'];
            $detaDeNaissanceApprenant = $_POST['dateDeNaissanceApprenants']; 
            $niveauApprenant = $_POST['niveauApprenants'];
            $numPeApprenant = $_POST['numPeApprenants'];
            $numSecuApprenant = $_POST['numSecuApprenants'];
            $ribApprenant = $_POST['ribApprenants'];
            $idRole = $_POST['idRole'];
            $idSession = $_POST['idSession'];
            
        $sql = "INSERT INTO `apprenants`(`nom_apprenant`, `prenom_apprenant`,`adresse_apprenant`, `mail_apprenant`,  `ville_apprenant`,
         `code_postal_apprenant`, `tel_apprenant`, `date_naissance_apprenant`, `niveau_apprenant`, `num_PE_apprenant`, `num_secu_apprenant`,
          `rib_apprenant`, `id_role`, `id_session`) VALUES ('$nomApprenant','$prenomApprenant','$adresseApprenant','$mailApprenant','$villeApprenant',
          '$codePostalApprenant','$telApprenant','$detaDeNaissanceApprenant','$niveauApprenant','$numPeApprenant','$numSecuApprenant','$ribApprenant',
          '$idRole', '$idSession')";
        $bdd->query($sql);
        echo "data ajoutée dans la bdd";

    }
}


//GESTION DE LA PAGE Affecter

if (isset($_GET["page"])&& $_GET["page"] == "affecter"){
    $sqlp = "SELECT * FROM pedagogie ";
    $requete = $bdd->query($sqlp);
    $results = $requete->fetchAll(PDO::FETCH_ASSOC);

    $sqlc = "SELECT * FROM centres ";
    $requete = $bdd->query($sqlc);
    $results = $requete->fetchAll(PDO::FETCH_ASSOC);
?> 
 <div class="centreDiv">
    <table>
        <tr>
            <th>Id pedagogie</th>
            <th>Id centre</th>
            <th>Supprimer</th>
       </tr>
     <?php
       foreach ($results as $item){
        echo '<th>';
        echo '<td>' . (isset($item['id_pedagogie']) ? $item['id_pedagogie'] : '') . '</td>';
        echo '<td>' .  (isset($item['id_centre']) ? $item['id_centre'] : '') . '</td>';
        echo '<input type="hidden" name="hiddenRole" value="' . $item['id_pedagogie'] . '">';
        echo '<td><a href="?page=role&type=supprimer&id_pedagogie=' . $item['id_pedagogie'] . "&id_centre=" . $item['id_centre'] . '"><button>Modifier</button></a></td>';
        echo '</tr>';
       }
 ?>
    </table>
    <form method="POST">
            <h2>Affecter</h2>
            <label for="">IdPedagogie</label> 
            <select name="idPedagogie" id="">
                <?php
                    foreach($results as $value){
                    echo '<option value="' . $value['id_pedagogie'] . '">' . $value['id_pedagogie'] . $value['nom_pedagogie'] . '</option>';
                    }
                ?>
            </select>
            <label for="">Centre</label>
            <select name="idCentres" id="">
                <?php
                    foreach($results as $value){
                        echo '<option value="' . $value['id_centre'] . '">' . $value['id_centre'] . $value['ville_centre'] . '</option>';
                    }
                ?>
            </select>
            <input type="submit" name="submitAffecter" value="enregistré">
       </form>
    </div>

    
 <?php
     if(isset($_POST["submitAffecter"])) {
        $idPedagogie = $_POST['id_pedagogie'];
        $idCentre = $_POST['id_centre'];

        $sql = "INSERT INTO `affecter`(`id_pedagogie`, `id_centre`) VALUES ('$idPedagogie','$idCentre')";
        $bdd->query($sql);
        echo "affecter avec succès";
     }
     if (isset($_GET['type'])&& $_GET['type'] == "modifier"){

         $id = $_GET["id"];
         $sqlId = "SELECT * FROM role WHERE id_role = $id";
         $requeteId = $bdd->query($sqlId);
         $resultsId = $requeteId->fetch(PDO::FETCH_ASSOC);
        ?>
        <h2> modifier role</h2>
       <form method="POST">
         <input type="hidden" name="updateIdRole" value="<?php echo $resultsId['id_role']; ?> ">
         <input type="text" name="updateNomRole" value="<?php echo $resultsId['nom_role']; ?> ">
         <input type="submit" name="updateRole" value="update Role">
       </form> 
     <?php
       if (isset($_POST["updateRole"])){
        $updateIdRole = $_POST["updateIdRole"];
        $updateNomRole = $_POST["updateNomRole"];
        $sqlupdate = "UPDATE `role` SET `nom_Role` ='$updateNomRole' WHERE id_role = $updateIdRole";
         $bdd->query($sqlupdate);
         echo "Données modifiée";
       }
     }
    
    if (isset($_POST['submitRole'])){
        $nomRole = $_POST['nomRole'];
        $sql = "INSERT INTO `role`(`nom_role`) VALUES ('$nomRole')";
        $bdd->query($sql);
        echo "data ajoutée dans la bdd";
    }
}

    ?> 
    
    
</body>
</html>