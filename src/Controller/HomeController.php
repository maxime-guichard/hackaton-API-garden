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

    public function index(): string
    {
        $monday = [];
        $tuesday = [];
        $wednesday = [];
        $thursday = [];
        $friday = [];
        $saturday = [];
        
        $client = HttpClient::create();
        $responseMonday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52781');
        $responseTuesday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52782');
        $responseWednesday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52788');
        $responseThursday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52780');
        $responseFriday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52784');
        $responseSaturday = $client->request('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52785');
       
        $statusCode = $responseMonday->getStatusCode();

        if ($statusCode === 200) {
            $monday = $responseMonday->toArray();
            $tuesday = $responseTuesday->toArray();
            $wednesday = $responseWednesday->toArray();
            $thursday = $responseThursday->toArray();
            $friday = $responseFriday->toArray();
            $saturday = $responseSaturday->toArray();
            
        }

        return $this->twig->render('Home/index.html.twig', [
            'monday'  => $monday, ['monday'],
            'tuesday' => $tuesday, ['tuesday'],
            'wednesday' => $wednesday, ['wednesday'],
            'thursday' => $thursday, ['thursday'],
            'friday' => $friday, ['friday'],
            'saturday' => $saturday, ['saturday']
        ]);
    }
}
