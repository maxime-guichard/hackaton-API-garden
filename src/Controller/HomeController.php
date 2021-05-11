<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;

class HomeController extends AbstractController
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
        $responseMonday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52781');
        $responseTuesday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52782');
        $responseWednesday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52783');
        $responseThursday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52780');
        $responseFriday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52784');
        $responseSaturday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52785');
        $responseSunday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52786');

        $statusCode = $responseMonday->getStatusCode(); // get Response status code 200
        $statusCode = $responseTuesday->getStatusCode();
        $statusCode = $responseWednesday->getStatusCode();
        $statusCode = $responseThursday->getStatusCode();
        $statusCode = $responseFriday->getStatusCode();
        $statusCode = $responseSaturday->getStatusCode();
        $statusCode = $responseSunday->getStatusCode();

        if ($statusCode === 200) {
            $tests = $responseMonday->toArray();
            $tests1 = $responseTuesday->toArray();
            $tests2 = $responseWednesday->toArray();
            $tests3 = $responseThursday->toArray();
            $tests4 = $responseFriday->toArray();
            $tests5 = $responseSaturday->toArray();
            $tests6 = $responseSunday->toArray();
        
            // convert the response (here in JSON) to an PHP array
        }

        return $this->twig->render('Home/index.html.twig',[
            'tests'  =>  $tests,
            'tests1' => $tests1,
            'tests2' => $tests2,
            'tests3' => $tests3,
            'tests4' => $tests4,
            'tests5' => $tests5,
            'tests6' => $tests6
        ]);
    }
    public function recipe()
    {
        $client = HttpClient::create();
        $responseMonday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52771');
        $responseTuesday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52770');
        $responseWednesday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52777');
        $statusCode = $responseMonday->getStatusCode();
        if ($statusCode === 200) {
            $monday = $responseMonday->toArray();
            $tuesday = $responseTuesday->toArray();
            $wednesday = $responseWednesday->toArray();
            return $this->twig->render('Home/recipes.html.twig', [
                'monday' => $monday, ['monday'],
                'tuesday' => $tuesday, ['tuesday'],
                'wednesday' => $wednesday, ['wednesday'],
            ]);
        }
    }
}
