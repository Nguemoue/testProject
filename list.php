<?php

use App\User;

require 'vendor/autoload.php';

$users = User::getUser()->all();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/bootsrap/css/bootstrap.min.css">
    <title>Listes des Utilisateurs</title>
</head>
<body>
    <nav class="navbar navbar-dark">
        <div>
            <a href="#">Home</a>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Liste des Utilisateur</div>
            </div>
            <div class="card-footer">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>EMail</th>
                                <th>Numero Cvv</th>
                                <th>Date naissance</th>
                                <th>Telephone</th>
                                <th>Photo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as $k=> $user) :?>
                                <tr>
                                    <td><?=$k+1?></td>
                                    <td><?=$user['nom']?></td>
                                    <td><?=$user['prenom']?></td>
                                    <td><?=$user['email']?></td>
                                    <td><?=$user['cvv']?></td>
                                    <td><?=$user['birthday']?></td>
                                    <td><?=$user['telephone']?></td>
                                    <td><img src="avatars/<?=$user['photo']?>" width="80"></td>
                                </tr>
                            
                                <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>