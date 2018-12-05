<?php require_once "assets/incl/header.php"; 
require_once 'classes/login_handler.php';

if (isset($_POST["login"])) {
    $login_handler = new login_handler();
    $login_handler->login($_POST);
    if(empty($login_handler->login_errors)){
        // redirect to homepage if login succesfull.
        ?>
        <script type="text/javascript">
        window.location.href = 'https://www.jorn-wildenbeest.gcmediavormgeving.nl/flowerpower/';
        </script>
        <?php
    }
}

?>

<div class="login-clean">
    <form method="post" action="">
        <h1>Inloggen</h1>
        <div class="form-group">
            <input class="form-control" type="email" name="email" placeholder="E-mailadres" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Wachtwoord" required>
        </div>
        <div class="form-group">
            <ul>
                <?php
                if(!empty($login_handler->login_errors)){
                    foreach($login_handler->login_errors as $error){
                        echo "<li style='color: red;'> $error </li>";
                    }
                }
                ?>
            </ul>
        </div>
        <div class="form-group">
            <input type="submit" id="inputVerzonden" name="login" class="btn btn-primary btn-block" value="Log In" style="background-color:rgb(145,145,145);">    
        </div>
        <a href="" class="forgot">Wachtwoord vergeten?</a>
        <a href="" class="forgot">Nog geen account? Registeren</a> 
    </form>
</div>

<?php require_once "assets/incl/footer.php"; ?>