<?php

namespace App\Controller;

use App\Constant\CardConstant;
use App\Helper\Card\CardSeedHelper;
use App\Repository\CardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/test", name: "app_test_")]
class TestController extends AbstractController
{
    #[Route("", name: "index")]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }

    #[Route("/seed", name: "seed")]
    public function seed(CardRepository $cardRepository): Response
    {
        $helper = new CardSeedHelper($cardRepository);
        $helper->seed();
        dd($cardRepository->findAll());
    }

    #[Route("/cards", name: "cards", methods: ["GET"])]
    public function cards(CardRepository $cardRepository): Response
    {
        $result = "";
        foreach ($cardRepository->findAll() as $card) {
            $result .= "
                <tr>
                    <td><img src='".$card->getCard()."' alt='".$card->getName()."'></td>
                    <td>".$card->getName()."</td>
                    <td>".$card->getSymbol()."</td>
                    <td>".CardConstant::getColourName($card->getColour())."</td>
                </tr>
            ";
        }

        return new Response(
            "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>X1 cards</title>
            </head>
            <body>
                <table>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Symbol</th>
                        <th>Colour</th>
                    </tr>
                    $result
                </table>
            </body>
            </html>"
        );
    }
}
