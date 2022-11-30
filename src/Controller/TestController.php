<?php

namespace App\Controller;

use App\Constant\CardConstant;
use App\Helper\Card\CardSeedHelper;
use App\Messenger\TestPublish;
use App\Repository\CardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;

#[Route("/", name: "app_test_")]
class TestController extends AbstractController
{
    public function __construct(
        private readonly MessageBusInterface $messageBusInterface
    ) {}

    #[Route("", name: "index")]
    public function index(): Response
    {
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
                <a href='/seed'>Seed</a>
                <a href='/cards'>Cards</a>
                <a href='/publishClass'>Publish Class</a>
                <a href='/publishMercure'>Publish Mercure</a>
                <a href='/test.html'>Test html</a>
            </body>
            </html>"
        );
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

    #[Route("/publishClass", name: "publish_class")]
    public function publishClass(): Response
    {
        new TestPublish($this->messageBusInterface);

        return new Response("Test published with class!");
    }

    #[Route("/publishMercure", name: "publish_mercure")]
    public function publishMercure(): Response
    {
        $update = new Update(
            "testPublish",
            json_encode(["test" => "Hello World!"])
        );

        $this->messageBusInterface->dispatch($update);

        return new Response("Test published with Mercure!");
    }
}
