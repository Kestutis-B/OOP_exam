<?php

namespace Kestutisbilotas\Models;

use Kestutisbilotas\Interfaces\CalcAllInterface;
use Kestutisbilotas\Container\DIContainer;

class CalcAll implements CalcAllInterface
{
    public function __construct(private DIContainer $diContainer)
    {
    }


    public function calc(): array
    {
        $output = [
            'diena' => 0,
            'naktis' => 0,
            'suma' => 0
        ];
        $data = $this->diContainer->get(DataFromFile::class);
        $dataArray = $data->fromFile();
        foreach ($dataArray as $value){
            if ($value['period'] === 'diena'){
                $output['diena'] += $value ['amount'] * $value ['price'];
            }
            if ($value['period'] === 'naktis'){
                $output['naktis'] += $value ['amount'] * $value ['price'];
            }
        }
        $output['suma'] = $output ['diena'] + $output ['naktis'];


        return $output;
    }
}