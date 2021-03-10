<?php
require_once __DIR__ . '/config.php';

require_once __DIR__ . '/functions.php';

if (empty($_GET['movie_id'])) {
    header('Location: index.php');
    exit();
}

$id =  htmlentities($_GET['movie_id']);

$movie = get_movie_details($id);

$trailerResponse = get_movie_trailer($id);

$trailer = $trailerResponse['results'];

require_once __DIR__ . '/inc/header.php';
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
<main class="mb-4">
    <div class="single container">
        <div class="row">
            <div class="col-md-4 sticky-md-top">
                <div class="poster mb-2">
                    <img class="img-fluid img-thumbnail" src="<?= ASSETS_URL . $movie['poster_path'] ?>" alt="">
                </div>
                <div class="grid g-2">
                    <a data-fancybox class="btn btn-danger w-100 mb-2" href="https://www.youtube.com/watch?v=<?= $trailer[0]['key'] ?>">Bande annonce</a>
                    <a class="btn btn-warning w-100" href="#">Louer ce film</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="header mb-4">
                    <h1 class="mb-3"><?= $movie['title'] ?></h1>
                    <div class="d-flex">
                        <p class="d-flex align-items-center me-4"><span class="icon add-favorite text-uppercase me-2"><i class="fas fa-heart"></i></span> <span class="text-uppercase">Favoris</span> </p>
                        <p class="d-flex align-items-center"><span class="icon share me-2"><i class="fas fa-share-alt"></i></span> <span class="text-uppercase">Partager</span> </p>
                    </div>
                </div>
                <div class="main d-flex mb-4">
                    <div class="rate border w-25 d-flex flex-column align-items-center justify-content-center">
                        <p class="m-0"><?= $movie['vote_average']; ?> / 10</p>
                        <p class="m-0"><?= $movie['vote_count']; ?> votes</p>
                    </div>
                    <div class="rate-stars ps-2 border flex-grow-1 d-flex align-items-center">
                        <b class="me-1 text-capitalize">Notes du film : </b>
                        <?php for ($i = 1; $i <= $movie['vote_average']; $i++) : ?>
                            <i class="fas fa-star text-warning me-1"></i>
                        <?php endfor; ?>
                    </div>
                </div>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-uppercase active" id="pills-overview-tab" data-bs-toggle="pill" data-bs-target="#pills-overview" type="button" role="tab" aria-controls="pills-overview" aria-selected="true">Résumé</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-uppercase" id="pills-reviews-tab" data-bs-toggle="pill" data-bs-target="#pills-reviews" type="button" role="tab" aria-controls="pills-reviews" aria-selected="false">Commentaires</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-uppercase" id="pills-Media-tab" data-bs-toggle="pill" data-bs-target="#pills-Media" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Media</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-uppercase" id="pills-related-movie-tab" data-bs-toggle="pill" data-bs-target="#pills-related-movies" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Films similaires</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-overview" role="tabpanel" aria-labelledby="pills-overview-tab">
                        <p>
                            <?= $movie['overview'];  ?>
                        </p>
                    </div>
                    <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
                        <?php if (empty($movie['reviews']['total_results'])) : ?>
                            <p>Aucun commentaire pour ce film</p>
                        <?php else : ?>
                            <?php foreach ($movie['reviews']['results'] as $review) :  ?>
                                <p><?= $review['author'] ?></p>
                                <p><?= date('d/m/Y', strtotime($review['created_at'])); ?></p>
                                <p><?= $review['content'] ?></p>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="tab-pane fade" id="pills-Media" role="tabpanel" aria-labelledby="pills-Media-tab">
                        ...
                    </div>
                    <div class="tab-pane fade" id="pills-related-movies" role="tabpanel" aria-labelledby="pills-related-movies-tab">
                        <?php if (empty($movie['similar']['total_results'])) : ?>
                            <p>Aucun similaire n'est trouvé</p>
                        <?php else : ?>
                            <div class="header my-2">
                                <h2 class=""><span class="fw-3">Films liés à </span><?= $movie['title'] ?></h2>
                            </div>
                            <p class="my-2">Total films trouvés : <?= $movie['similar']['total_results']; ?></p>

                            <div class="similar g-3 d-flex flex-wrap">
                                <?php foreach ($movie['similar']['results'] as $similar_movie) :  ?>
                                    <?php if ($similar_movie['poster_path']) : ?>
                                        <div class="m-1">
                                            <a data-text="voir" href="?movie_id=<?= $similar_movie['id'] ?>">
                                                <img class="img-thumbnail img-fluid h-100" src="http://image.tmdb.org/t/p/w92<?= $similar_movie['poster_path'] ?>" alt="">
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
require_once __DIR__ . '/inc/footer.php';
?>