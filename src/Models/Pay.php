<?php

namespace Kestutisbilotas\Models;

use Kestutisbilotas\Exceptions\InputValidationException;
use Kestutisbilotas\Interfaces\PayInterface;
use Kestutisbilotas\Container\DIContainer;

class Pay implements PayInterface
{
    public function __construct(private DIContainer $diContainer)
    {
    }

    public function pay(): float
    {
        $count = $this->diContainer->get(CalcAll::class);
        $sums = $count->calc();
        $pay = 0;
        if (sizeof($sums) > 0){
            $sumArr = $this->diContainer->get(CalcAll::class);
            $sums = $sumArr->calc();
            $pay = $sums['suma'];
            $dataArray = [];
            $serializedData[] = json_encode($dataArray, JSON_PRETTY_PRINT);
            file_put_contents('./data.json', $dataArray);
        }else throw new InputValidationException
        ('Prieš mokėdami suskaičiuokite bendrą sumą.');

        return $pay;
    }
}