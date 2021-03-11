<?php
require_once __DIR__ . '/config.php';

require_once __DIR__ . '/functions.php';

$results = get_movies();

$movies = $results['results'];

$title = 'Accueil';

require_once 'inc/header.php';
?>
<header class="mb-4" id="site-header">
    
    <?php 
    require_once 'inc/nav.php';
    require_once 'inc/search.php';
    ?>
    <div class="title-group text-center">
        <h1 class="display-4">CinéMax</h1>
        <p class="text-uppercase fw-lighter mb-3">Ne ratez plus d'infos sur vos films favoris</p>
    </div>
</header>
<main class="mb-4 home">
    <div class="container">
        <div class="row g-2">
            <?php foreach ($movies as $movie) : ?>
                <div class="col-md-2 d-flex flex-column justify-content-between movie_wrapper">
                    <div class="poster">
                        <img class="img-fluid" src="<?= ASSETS_URL . $movie['poster_path'] ?>" alt="">
                        <a class="btn btn-danger w-50 rounded-pill mv-details" href="details.php?movie_id=<?= $movie['id']; ?>">Détails</a>
                    </div>
                    <div class="description d-flex flex-column">
                        <h3 class="movie-title"><?= $movie['title']; ?></h3>
                        <p class="mt-auto mb-0"><?= $movie['vote_average']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php require_once 'inc/footer.php'; ?>