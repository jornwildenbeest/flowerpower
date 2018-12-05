<?php require_once "assets/incl/header.php";

require_once 'classes/login_handler.php';

if (isset($_POST["register"])) {
    $login_handler = new login_handler();
    $login_handler->register($_POST);
}

?>
<div class="login-clean" style="background-color:rgb(255,255,255);padding-top:20px;padding-bottom:0px;padding-left:30;">
    <form method="post">
        <h1>Registeren</h1>
        <div class="form-group">
            <input class="form-control" type="text" name="voornaam" placeholder="Voornaam" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="text" name="achternaam" placeholder="Achternaam" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="email" name="email" placeholder="E-mailadres" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Wachtwoord" id="firstpassword" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="herhaalwachtwoord" placeholder="Herhaal wachtwoord" id="secondpassword" required>
        </div>
        <div class="form-group">
            <ul class="register_errors">
                <?php
                if(!empty($login_handler->register_errors)){
                    foreach($login_handler->register_errors as $error){
                        echo "<li style='color: red;'> $error </li>";
                    }
                }
                ?>
            </ul>
        </div>
        <div class="form-group">
            <input type="submit" id="inputVerzonden" name="register" class="btn btn-primary btn-block" value="Registreren" style="background-color:rgb(145,145,145);">    
        </div>
       
        
    </form>
</div>

<?php require_once "assets/incl/footer.php"; ?>