<?php
session_start();
require('db.php');
require('logger.php');

if($_GET && $_GET['startTime']) {
    $startTime = htmlspecialchars($_GET['startTime']);
    $startTime = strtotime($startTime);
    $startTime = date('Y-m-d', strtotime('monday this week', $startTime));
}
else $startTime = date('Y-m-d', strtotime('monday this week'));

if($_GET['endTime']) {
    $endTime = htmlspecialchars($_GET['endTime']);
    $endTime = strtotime($endTime);
    $endTime = date('Y-m-d', strtotime('sunday this week', $endTime));
}
else $endTime = date('Y-m-d', strtotime('sunday this week'));

if ($_SESSION['connected'] == true) {
    $requete = $conn->prepare('SELECT * FROM flashnews WHERE Date >= ? AND Date <= ? ORDER BY Date');
    $requete->execute(array($startTime, $endTime));
}
else {
    $error = "Vous n'êtes pas connecté.e";
}

function nl2p($txt){
    return str_replace(["\r\n", "\n\r", "\n", "\r"], '</p><p>', '<p>' . $txt . '</p>');
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="utf-8">
    <title>Flash News petit debs</title>
    <link rel="icon" type="image/png" sizes="16x16" href="https://media.istockphoto.com/vectors/green-succulent-in-clay-flower-pot-16x16-pixel-art-icon-isolated-on-vector-id1147096606?b=1&k=20&m=1147096606&s=170667a&w=0&h=n8PqxW9bJ_pB424T4TrnAO9830kbzNugAAFBvinicJM=">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    td p{margin:0}
    </style
    </head>
    <body>
        <?php require('nav.php'); ?>
        <div class="container mt-3">
    
        <?php if (!$_SESSION['connected']==true) { ?>
            <div class="alert alert-danger">
            Vous n'êtes pas connecté.e
            </div>
        <?php } else { ?>
        
        <!-- ici -->
        <div class="alert alert-warning m-0">
            <h4 class="alert-heading m-0">Consultez les messages flash</h4>
        </div>
            <form action="" method="GET">
                <div class="d-flex flex-row align-items-end">
                    <div class="m-3">
                        <label for="startTime" class="form-label">Date de début (arrondi à la semaine):</label>
                        <input type="date" class="form-control" id="startTime" name="startTime" value="<?php if($startTime) echo $startTime ?>">
                    </div>
                    <div class="m-3">
                        <label for="endTime" class="form-label">Date de fin (arrondi à la semaine):</label>
                        <input type="date" class="form-control" id="endTime" name="endTime" value="<?php if($endTime) echo $endTime ?>">
                    </div>
                    <div class="m-3">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </div>
            </form>
          <!-- fin ici -->
          <div class="row">
             <div class="col-sm-12">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Activités</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  while($data = $requete->fetch()): ?>
                  <tr>
                    <td><?= $data['Nom'] ?></td>
                    <td><?= $data['Prenom'] ?></td>
                    <td><?= nl2p($data['Activites']) ?></td>
                  </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
             </div>
          </div>
        <?php } ?>
       </div> 
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
  </html>
