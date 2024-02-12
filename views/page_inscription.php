<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Actu CAN 2023</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="../style.css" type="text/css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/f506928136.js" crossorigin="anonymous"></script>

</head>

<body>

    <?php require_once __DIR__ . '/templates/header.php'; ?>
    <div class="container mt-5  full-height">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center text-white">Inscription</h3>
                    </div>
                    <div class="card-body">
                        <form action="../src/controllers/CrudControllers.php?action=inscription" method="post">
                            <div class="form-group">
                                <label for="lastname">Nom </label>
                                <input type="text" class="form-control focus-ring focus-ring-success" name="lastname" required>
                            </div>
                            <div class="form-group">
                                <label for="firstname">prenom</label>
                                <input type="text" class="form-control focus-ring focus-ring-success" name="firstname" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control focus-ring focus-ring-success" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Mot de passe :</label>
                                <input type="password" class="form-control focus-ring focus-ring-success" name="password" required>
                            </div>

                            <div class="d-flex flex-row justify-content-between ">
                                <button type="submit" class="btn mt-4  btn-primary btn-block">S'inscrire</button>
                                <!-- <button type="submit" class="btn mt-4  btn-secondary btn-block">Se connecter</button> -->
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once __DIR__ . '/templates/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>