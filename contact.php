<?php
require_once __DIR__ . '/config.php';

require_once __DIR__ . '/functions.php';

require_once 'helper.php';

$title = 'Contact';

require_once __DIR__ . '/inc/header.php';

$message = '';
$email = '';
$subject = '';
// Vérifie qu'une requête post a été envoyer au serveur avant de commencer le traitement
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // extrait le données dans des variables qui seront nommées du même nom que les clés du tableau
    extract($_POST);
    // On vérifie que le a été renseigné avant d'être envoyé.
    if (!empty($message) && !empty($email) && !empty($message)) {
        if (sendMessage($subject, $email, $message)) {
            // en cas de succès, on crée un notice qui permettra de faire apparaitre une notification à l'utilisateur.
            $noticeSuccess = true;
        }
    }
}

if(isset( $noticeSuccess))  :
?>
<div class="toast-container position-absolute" style="z-index: 999; right: 0; top: 3.2rem;" id="toastPlacement">
    <div class="toast bg-success">
        <div class="toast-header">
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        <p>Votre message a été envoyé !</p>
           

        </div>
    </div>
</div>
<?php endif; ?>
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
                        <input name="subject" class="form-control form-control-lg" type="text" placeholder="Demande d'informations">
                        <label for="subject">Motif de contact</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="email" class="form-control form-control-lg" type="email" placeholder="jdoe@gmail.com">
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
