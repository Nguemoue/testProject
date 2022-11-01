<?php

use App\User;

    if(!empty($_POST)){
        require 'vendor/autoload.php';
        extract($_POST);
        extract($_FILES);
        var_dump($_POST);
        $ext = pathinfo($profile['name'],PATHINFO_EXTENSION);
        $photo = uniqid().'.'.$ext;
        move_uploaded_file($profile['tmp_name'],'./avatars/'.$photo);
        $res = User::getUser()->insert(compact('nom','photo','prenom','email','password','password','telephone','birthday','cvv'));
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
    <link rel="stylesheet" type="text/css" href="public/css/opensans-font.css">
    <link rel="stylesheet" type="text/css" href="public/fonts/mdi/css/mdi.min.css">
    <!-- Main Style Css -->
    <link rel="stylesheet" href="public/css/style.css" />
</head>

<body>
    <div class="page-content">
        <div class="form-v1-content">
            <div class="wizard-form">
                <form id="form" class="form-register" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <div id="form-total">
                        <!-- SECTION 1 -->
                        <h2>
                            <p class="step-icon"><span>01</span></p>
                            <span class="step-text"> Information Personneles</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <div class="wizard-header">
                                    <h3 class="heading">informations Personelles</h3>
                                    <p>veuillez entrez vos informations personnels </p>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder">
                                        <fieldset>
                                            <legend>Nom</legend>
                                            <input type="text" class="form-control" id="nom" name="nom" placeholder="First Name" required>
                                        </fieldset>
                                    </div>
                                    <div class="form-holder">
                                        <fieldset>
                                            <legend>Prenom</legend>
                                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Last Name" required>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder form-holder-2">
                                        <fieldset>
                                            <legend>Email</legend>
                                            <input type="text" name="email" id="email" class="form-control" pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" placeholder="example@email.com" required>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder form-holder-2">
                                        <fieldset>
                                            <legend>Password</legend>
                                            <input type="password" name="password" id="password" placeholder="password" class="form-control" required>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder form-holder-2">
                                        <fieldset>
                                            <legend>Photo de Profile</legend>
                                            <input type="file" name="profile" id="profile" class="form-control"  required>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder form-holder-2">
                                        <fieldset>
                                            <legend>Numero de telephone</legend>
                                            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="+237 656898989" required>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder form-holder-2">
                                        <fieldset>
                                        <legend>Birth Date:</legend>
                                        <input type="date" name="birthday" class="form-control border">
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder form-holder-2">
                                        <fieldset>
                                            <legend >CVV Number:</legend>
                                            <input type="text" class="form-control" placeholder="224" id="cvv" name="cvv"  required>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- SECTION 2 -->
                       
                       <div style="display: block;text-align:center">
                       <button style="padding: 6px;cursor:pointer;outline:none;" id="submit" type="submit">Soumettre</button>
                       </div>

                     
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="public/js/jquery-3.3.1.min.js"></script>
    <script src="public/js/jquery.steps.js"></script>
    <script src="public/js/main.js"></script>
    <script>
        let submitBtn = document.getElementById("submit")
        let form= document.getElementById("form")
        submitBtn.addEventListener("click",function(event){
            form.submit()
        })
    </script>
</body>

</html>