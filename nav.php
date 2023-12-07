<nav class="navbar navbar-expand-sm navbar-dark bg-dark" style="background-color: #03304f !important;">
    <div class="container-fluid">
    <a class="navbar-brand" href="javascript:void(0)"><img src="https://bilbok83.fr/wp-content/uploads/2020/11/petits-debrouillards-logo.png"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Ajouter un message flash</a>
        </li>
        <li class="nav-item">
            <a  class="nav-link" href="read.php">Consulter les messages flashs</a>
        </li>
        <!--<li class="nav-item">
            <a  class="nav-link" href="https://demo.hedgedoc.org/s/vwylwykKA#">Cadre de communication interne (lien externe)</a>
        </li>-->
        </ul>
        <form class="form-inline my-2 my-lg-0" method="POST">
        <?php if ($_SESSION['connected']) { ?>
            <input type="hidden" name="flashnews-logout">
            <button type="submit" class="btn btn-primary">Déconnexion</button>
        <?php } else { ?>
            <label for="flashnews-password" class="sr-only">Mot de passe</label>
            <input type="password" class="form-control mr-sm-2" id="flashnews-password" name="flashnews-password" placeholder="Mot de passe">
            <button type="submit" class="btn btn-outline-primary my-2 my-sm-0">Connexion</button>
        <?php } ?>
        </form>
    </div>
    </div>
</nav>
