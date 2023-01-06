<?php

namespace Kestutisbilotas\Controllers;

use Kestutisbilotas\Container\DIContainer;
use Kestutisbilotas\Interfaces\CalcControllerInterface;
use Kestutisbilotas\Exceptions\InputValidationException;
use Kestutisbilotas\Models\CalcAll;
use Kestutisbilotas\Models\DataFromFile;
use Kestutisbilotas\Models\DataToFile;
use Kestutisbilotas\Models\ValidateData;
use Kestutisbilotas\Models\DeleteEntered;

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

    public function showData(): void
    {
        $getData = $this->diContainer->get(DataFromFile::class);
        $data = $getData->fromFile();
    }

    public function deleteEntered(): void
    {
        $delete = $this->diContainer->get(DeleteEntered::class);
        $delete-$this->deleteEntered();
        $this->showData();
    }

    public function countAll(): void
    {
        $count = $this->diContainer->get(CalcAll::class);
        $sums = $count->calc();
        $getData = $this->diContainer->get(DataFromFile::class);
        $data = $getData->fromFile();
    }
}