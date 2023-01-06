<?php

namespace Kestutisbilotas\Models;

use Kestutisbilotas\Interfaces\DeleteEnteredInterface;
use Kestutisbilotas\Container\DIContainer;

class DeleteEntered implements DeleteEnteredInterface
{
    public function __construct(private DIContainer $diContainer)
    {
    }

    public function deleteEntered(): void
    {
        $data = $this->diContainer->get(DataFromFile::class);
        $dataArray = $data->fromFile();
        $myID = $_POST['delete'];
        if (key_exists($myID, $dataArray)) {
            unset($dataArray[$myID]);
            $serializedData[] = json_encode($dataArray, JSON_PRETTY_PRINT);
            file_put_contents('./data.json', $serializedData);
        }
    }
}