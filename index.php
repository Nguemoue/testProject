<?php

use App\Bank;
use App\User;

if (!empty($_POST)) {
    require 'vendor/autoload.php';
    extract($_POST);
    extract($_FILES);
    $ext = pathinfo($profile['name'], PATHINFO_EXTENSION);
    $photo_path = uniqid() . '.' . $ext;
    move_uploaded_file($profile['tmp_name'], './avatars/' . $photo_path);
    $user_id = User::getInstance()->insert(compact('nom', 'photo_path', 'prenom', 'email', 'password', 'telephone', 'birthday'));
    //j'enregistre les information bancaires a present
    $res = Bank::getInstance()->insert([
        'nom' => $card_nom,
        'month_expired' => $month_expired,
        'year_expired' => $year_expired,
        'user_id' => $user_id,
        'numero'=>$card_number,
        'cvv'=>$card_cvv,
        'card_type'=>$card_type
    ]);
    header('Location:list.php');
    
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Test page</title>
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Font-->
    <link rel="stylesheet" type="text/css" href="public/fonts/mdi/css/materialdesignicons.css">
    <!-- Main Style Css -->
    <link rel="stylesheet" href="public/bs/css/bs.min.css" />
    <style>
        input {
            box-shadow: none !important;
        }

        body {
            font-family: "Fira Code";
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <form class="form-check border p-1 mt-1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" style="box-shadow: 0px 0px 3px #ccc,1px 1px 3px #333 ;" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-6 col-md-6 col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>
                                    Donnes Personnelles
                                </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="form" class="form-register" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                                <section>
                                    <div>
                                        <label class="form-label">Nom</label>
                                        <div class="input-group">
                                            <span class="input-group-text mdi mdi-account"></span>
                                            <input type="text" class="form-control" id="nom" name="nom" placeholder="First Name" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label">Prenom</label>
                                        <div class="input-group">
                                            <span class="input-group-text mdi mdi-account"></span>
                                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Last Name" required>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text mdi mdi-mail"></span>
                                            <input type="text" name="email" id="email" class="form-control" pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" placeholder="example@email.com" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text mdi mdi-key"></span>
                                            <input type="password" name="password" id="password" placeholder="password" class="form-control" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label">Photo de Profile</label>
                                        <div class="input-group">
                                            <input type="file" name="profile" id="profile" class="form-control" required accept="image/*">
                                            <span class="input-group-text">
                                                <img class="img-fluid" id="profile-photo" src="" alt="image">
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label">Numero de telephone</label>
                                        <div class="input-group">
                                            <span class="input-group-text mdi mdi-phone"></span>
                                            <input pattern="[+0]+[0-9]*" type="text" class="form-control" id="telephone" name="telephone" placeholder="+237 656898989" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label">Birth text:</label>
                                        <div class="input-group">
                                            <span class="input-group-text mdi mdi-calendar-range"></span>
                                            <input type="date" required name="birthday" class="form-control border">
                                        </div>
                                    </div>
                                </section>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Donnees Bancaires</h4>
                        </div>
                        <div class="card-body">
                            <div>
                                <div>
                                    <label class="form-label">Nom de la carte:</label>
                                    <div class="input-group">
                                        <span class="input-group-text mdi mdi-credit-card"></span>
                                        <input type="text" name="card_nom" class="form-control " required placeholder="nom du proprietaire">
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Numero de la carte:</label>
                                    <div class="input-group">
                                        <span class="input-group-text mdi mdi-credit-card"></span>
                                        <input type="text" name="card_number" class="form-control " required placeholder="Numero de la carte">
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <label class="form-label">Type de carte:</label>
                                    <div class="input-group">
                                        <span class="input-group-text mdi mdi-calendar-range"></span>
                                        <select name="card_type" id="card_type" class="form-select" required>
                                            <option value="visa">Visa</option>
                                            <option value="visa">Master</option>
                                            <option value="visa">AmExpress</option>
                                            <option value="visa">Discover</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="month_expired" class="form-label">Expire le </label>
                                    <div class="col">
                                        <select name="month_expired" id="month" class="form-select" required>
                                            <?php foreach (range(01, 10) as $month) : ?>
                                                <option value="<?= $month ?>"><?= str_pad($month, 2, 0, STR_PAD_LEFT) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select name="year_expired" id="year" class="form-select" required>
                                            <?php foreach (range(date('y'), date('y') + 10) as $year) : ?>
                                                <option value="<?= $year ?>"><?= $year ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                CVV number
                                            </span>
                                            <input type="text" name="card_cvv" class="form-control" placeholder="cvv number" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="mx-auto mt-1 w-25 btn btn-success">
                    <span class="mdi mdi-check"></span>
                    Valider
                </button>
            </div>
        </form>
    </div>
</body>
<script>
    let profile = document.getElementById("profile")
    let profilePhoto = document.getElementById("profile-photo")
    let fr = new FileReader()
    fr.onload = function(data) {
        console.log(data)
        profilePhoto.src = data.target.result
    }
    profile.addEventListener('change', (event) => {
        let files = event.target.files
        if (files.length && files[0]) {
            fr.readAsDataURL(files[0])
        }
    })
</script>

</html>