<?php

namespace Kestutisbilotas\Controllers;

use Kestutisbilotas\Container\DIContainer;
use Kestutisbilotas\Interfaces\CalcControllerInterface;
use Kestutisbilotas\InventoryChecker\Exception\InputValidationException;
use Kestutisbilotas\Models\DataFromFile;
use Kestutisbilotas\Models\DataToFile;
use Kestutisbilotas\Models\ValidateData;

class CalcController implements CalcControllerInterface
{
    public function __construct(private DIContainer $diContainer)
    {
    }

    public function enterData(): void
    {
        $enterData = $this->diContainer->get(DataToFile::class);
        $validateData = $this->diContainer->get(ValidateData::class);
        try {
            $dataToWrite = $validateData->validate();
            $enterData->toFile($dataToWrite);
        } catch (InputValidationException $exception){
            $exception->getMessage();
        }
        $getData = $this->diContainer->get(DataFromFile::class);
        $data = $getData->fromFile();
    }
}