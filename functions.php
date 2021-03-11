<?php

require __DIR__ . '/vendor/autoload.php';
/**
 * Permet d'effectuer des appels à l'API
 * @param string @uri | uri de la route, exemple `movie/popular`.
 * @param string @options | contient les paramètres d'url et autres paramètrage de la requête. 
 */
function make_request($uri, $options)
{
    try {

        $client = new \GuzzleHttp\Client([
            'base_uri' => BASE_URI,
            'timeout' => 2.0
        ]);
        $response = $client->request('GET', $uri, $options);
        return $response;
    } catch (Exception $e) {
        printf("Ooups, l'application a planté avec le message %s", $e->getMessage());
        exit();
    }
}

/**
 * Permet de récupérer une liste de films
 * 
 * @return array
 */
function get_movies()
{
    // En paramètre d'url, on passe la clé de l'API et la langue dans laquelle on souhaite récupérer les données.
    $options = [
        'query' => [
            'api_key' => API_KEY,
            'language' => LANG
        ]

    ];
    $response = make_request('movie/popular', $options);
    // on extrait les données contenus dans le corps de la réponse `JSON`.
    $contents = $response->getBody()->getContents();
    // On decode le json en tableau associatif PHP grâce au booléen `true`
    return json_decode($contents, true);
}
/**
 * Permet de récupérer les données d'un film
 * @param mixed $id | l'identifiant du film dans la base de données TMDB
 */
function get_movie_details($id)
{
    $options = [
        'query' => [
            'api_key' => API_KEY,
            'append_to_response' => 'similar', // permet de faire deux appels en un `movie/{movie_id}` et `/movie/{movie_id}/videos`
            'language' => LANG
        ]
    ];
    $uri = "movie/$id";
    $response = make_request($uri, $options);

    $contents = $response->getBody()->getContents();
    return json_decode($contents, true);
}
/**
 * On récupère la video à part car les données en fr ne propose pas de video de bande annonce
 * 
 */
function get_movie_trailer($id)
{
    $options = [
        'query' => [
            'api_key' => API_KEY
        ]
    ];
    $uri = "movie/$id/videos";
    $response = make_request($uri, $options);

    $contents = $response->getBody()->getContents();
    return json_decode($contents, true);
}
