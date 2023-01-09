<?php

namespace Kestutisbilotas\Models;

use Kestutisbilotas\Interfaces\DataFromFileInterface;

class DataFromFile implements DataFromFileInterface
{

    public function fromFile(): array
    {
        $data = file_get_contents('./data.json');
        $dataArray = json_decode($data, true);
        if (is_array($dataArray) && sizeof($dataArray) > 0){
            $output = $dataArray;
        } else {
            $output = [];
        }
        return $output;
    }
}