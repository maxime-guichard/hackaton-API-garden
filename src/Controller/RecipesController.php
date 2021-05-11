<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;

class RecipesController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $client = HttpClient::create();
        $responseMonday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52771');
        $responseTuesday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52770');
        $responseWednesday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52777');
        $responseThu = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52772');
        $responseFri = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52772');

        $statusCode = $responseMonday->getStatusCode();
        if ($statusCode === 200) {
            $monday = $responseMonday->toArray();
            $tuesday = $responseTuesday->toArray();
            $wednesday = $responseWednesday->toArray();
            $thu = $responseThu->toArray();
            $fri = $responseFri->toArray();

            return $this->twig->render('Home/recipes.html.twig', [
                'monday' => $monday, ['monday'],
                'tuesday' => $tuesday, ['tuesday'],
                'wednesday' => $wednesday, ['wednesday'],
                'thu' => $thu, ['thu'],
                'fri' => $fri, ['fri'],
            ]);
        }
    }
}
