<?php

namespace Kestutisbilotas\Framework;



use Kestutisbilotas\Container\DIContainer;
use Kestutisbilotas\Controllers\CalcController;

class Router
{
    public function __construct(private DIContainer $diContainer)
    {
    }

    public function process(string $method): void
    {
        $controller = $this->diContainer->get(CalcController::class);
        if ($method == 'POST'){
            if (isset($_POST['data'])){
                $controller->enterData();
            }
        } elseif ($method == 'DELETE'){
            $controller->deleteEntered();
        } elseif ($method == 'COUNT'){
            $controller->countAll();
        } elseif ($method == 'PAY'){
            $controller->finalPay();
        }
        else {
            $controller->showData();
        }
    }
}