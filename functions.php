<?php

require __DIR__ . '/vendor/autoload.php';

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

function get_movies()
{
    $options = [
        'query' => [
            'api_key' => API_KEY,
            'language' => LANG
        ]

    ];
    $response = make_request('movie/popular', $options);

    $contents = $response->getBody()->getContents();
    return json_decode($contents, true);
}

function get_movie_details($id)
{
    $options = [
        'query' => [
            'api_key' => API_KEY,
            'append_to_response' => 'similar',
            'language' => LANG
        ]
    ];
    $uri = "movie/$id";
    $response = make_request($uri, $options);

    $contents = $response->getBody()->getContents();
    return json_decode($contents, true);
}

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
