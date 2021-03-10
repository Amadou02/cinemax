<?php
require_once __DIR__ . '/config.php';

require_once __DIR__ . '/functions.php';

require_once __DIR__ . '/inc/header.php';
$message = ''; $email = ''; $subject = '';
if($_REQUEST['REQUEST_METHOD'] == 'POST'){
    extract($_POST);
    if(!empty($message) && !empty($email) && !empty($message)){
        if(sendMessage($subject, $email, $message)){
            $noticeSuccess = true;
        }
    }
}
?>
<header class="mb-4" id="site-header">
    <?php
    require_once 'inc/nav.php';
    ?>
    <div class="title-group text-center">
        <h1 class="display-4">CinéMax</h1>
        <p class="text-uppercase fw-lighter mb-3">Ne ratez plus d'infos sur vos films favoris</p>
    </div>
</header>
<main>
    <section class="container">
        <header class="mb-4 text-center">
            <h2 class="display-2">Nous contacter</h2>
            <p>Une suggestion, une question, un signalement ? <br>Nous sommes à votre écoute</p>
        </header>

        <div class="row justify-content-center mb-5">
            <div class="col-md-6">
                <h3 class="mb-4">Quel est votre demande ?</h3>
                <form action="" method="post">

                    <div class="form-floating mb-3">
                        <input class="form-control form-control-lg" type="text" placeholder="Demande d'informations">
                        <label for="subject">Motif de contact</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control form-control-lg" type="email" placeholder="jdoe@gmail.com">
                        <label for="email">Votre email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea style="height: 18vh" class="form-control" name="message" id="message" cols="30" rows="10" placeholder="message..."></textarea>
                        <label for="message">Votre Message</label>
                    </div>
                    <div>
                        <input class="btn btn-primary" type="submit" value="Envoyer mon message">
                    </div>
                </form>
            </div>
        </div>

    </section>
</main>
<?php require_once 'inc/footer.php';
