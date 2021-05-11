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
        $response = $client->request('GET', 'http://www.themealdb.com/api/json/v1/1/random.php');

        $statusCode = $response->getStatusCode(); // get Response status code 200

        if ($statusCode === 200) {
            $tests = $response->toArray();
            // convert the response (here in JSON) to an PHP array
        }
        var_dump($tests);

                return $this->twig->render('Home/index.html.twig',['tests' => $tests]);
            }
    }
