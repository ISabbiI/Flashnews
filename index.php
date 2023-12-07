<?php
session_start();
require('db.php');
require('logger.php');

if($_POST) {
  $nom = htmlspecialchars($_POST['Nom']);
  $prenom = htmlspecialchars($_POST['Prenom']);
  $activites = htmlspecialchars($_POST['Activites']);
  $date = htmlspecialchars($_POST['Date']);
  $password = htmlspecialchars($_POST['flashnews-password']);
  $success = false;
  $hash = 'hash-du-mot-de-passe'; // à remplacer
  if($_SESSION['connected']==true) {
    if (!isset($_POST['flashnews-password'])) {
        if($nom && $prenom && $activites && $date) {
            $requete_insert = $conn->prepare('INSERT INTO flashnews(Nom, Prenom, Activites,Date) VALUES(?, ?, ?, ?)');
            $requete_insert->execute(array($nom, $prenom, $activites, $date));
            $success = true;
            $_SESSION['connected'] = true;
        }
        else {
            $error = "Les champs sont vides";
        }
    }
  }  
  else {
        $error = "Vous n'êtes pas connecté.e";
  }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Flash News petit debs</title>
    <link rel="icon" type="image/png" sizes="16x16" href="https://media.istockphoto.com/vectors/green-succulent-in-clay-flower-pot-16x16-pixel-art-icon-isolated-on-vector-id1147096606?b=1&k=20&m=1147096606&s=170667a&w=0&h=n8PqxW9bJ_pB424T4TrnAO9830kbzNugAAFBvinicJM=">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php require('nav.php'); ?>
    <div class="container mt-3">
        
      <?php if (!$_SESSION['connected']==true) { ?>
        <div class="alert alert-danger">
            Vous n'êtes pas connecté.e
        </div>
      <?php } else { ?>
        <div class="alert alert-warning m-0">
            <h4 class="alert-heading m-0">Ajoutez un message flash</h4>
            <p class="m-0">Racontez succintement ce que vous avez fait cette semaine.</p>
        </div>
        
        <?php if($success == true): ?>
            <div class = "row">
                <div class="alert alert-success">
                    Votre activité a bien été enregistrée. Merci !
                </div>
                <div class="col-sm-12">
                    <a href="read.php">Consulter les messages</a>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <?php if($error): ?>
                <div class="alert alert-danger">
                    <?= $error ?> <!-- A la place de php echo -->
                </div>
                <?php endif; ?>
            <!-- Les colonnes -->
                <div class="col-sm-12">
                <form action="index.php" method="POST">
                    <div class="d-flex flex-row align-items-start">
                    <div class="mb-3 mt-3 mr-3">
                        <label for="nom" class="form-label">Nom:</label>
                        <input type="text" class="form-control" id="nom" placeholder="Nom" name="Nom" value="<?php if($nom) echo $nom ?>">
                    </div>
                    <div class="mb-3 mt-3 mr-3">
                        <label for="prenom" class="form-label">Prénom:</label>
                        <input type="text" class="form-control" id="prenom" placeholder="Prénom" name="Prenom" value="<?php if($prenom) echo $prenom ?>">
                    </div>
                    <div class="mb-3 mt-3 mr-3">
                        <label for="date" class="form-label">Date (semaine):</label>
                        <input type="date" class="form-control" id="date" name="Date" value="<?php if($date) echo $date ?>">
                    <span class="badge bg-dark" style="color: white"> semaine du lundi <?= date('d-m-Y',strtotime('monday this week')); ?> au dimanche <?= date('d-m-Y',strtotime('sunday this week')); ?>
                    </span>
                    </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="Activites" class="form-label">Activités:</label>
                        <textarea  class="form-control" rows="7" id="Activites" placeholder="Qu'avez vous fait cette semaine ?" name="Activites"><?php if($activites) echo $activites ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                    <br><br>
                    
                </form>
                </div>
                
            </div>
        <?php endif; ?>
        <?php } ?>
    </div> 
    
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $('').datepicker({
        language: "fr",
        calendarWeeks: true,
        todayHighlight: true
    });
    </script>
</body>
</html>
