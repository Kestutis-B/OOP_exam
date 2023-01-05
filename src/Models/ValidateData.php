<?php

namespace Kestutisbilotas\Models;

use DateTime;
use Kestutisbilotas\Exceptions\InputValidationException;
use Kestutisbilotas\Interfaces\ValidateDataInterface;

class ValidateData implements ValidateDataInterface
{

    public function validate(): array
    {
        $finalData = [];
        $newData = $_POST['data'];
        $arrayData = explode(' ', $newData);

        //jei vartotojas iveda per daug duomenu, tada meta klaida
        if (isset($arrayData[4])){
            throw new InputValidationException
            ("Neteisingai įvesti duomenys. Patikslinkite ir bandykite dar kartą");
        }

        //elektros kWh kieki paimam i array
        if (isset($arrayData[0]) && is_numeric($arrayData[0])){
            $finalData['amount'] = $arrayData[0];
        } else throw new InputValidationException
        ("Neteisingai įvesti duomenys. Patikslinkite ir bandykite dar kartą");

        // tarifa paimam i array
        if (isset($arrayData[1]) && is_numeric($arrayData[1])){
            $finalData['price'] = $arrayData[1];
        } else throw new InputValidationException
        ("Neteisingai įvesti duomenys. Patikslinkite ir bandykite dar kartą");

        // paros meta paimam i array
        if (isset($arrayData[2]) && ($arrayData[2] === 'diena' || $arrayData[2] === 'naktis')){
            $finalData['period'] = $arrayData[2];
        } else throw new InputValidationException
        ("Neteisingai įvesti duomenys. Patikslinkite ir bandykite dar kartą");

        //jei mėnuo ivestas teisingai, nevėluoja ir ne per anskti mokėjimas, paimam į array
        if (isset($arrayData[3]) && is_numeric($arrayData[3]) && $arrayData[3] > 0 && $arrayData[3] < 13){
            if ($arrayData[3] + 1 < date('m')){
                //pasitikrinti ar gerai veikia datu intervalas
                $firstDate = new DateTime('now', 'Europe/Vilnius');
                $firstDate->format('d');
                $secondDate = new DateTime($arrayData[3]);
                $secondDate->modify('last day of this month');
                $secondDate->format('d');
                $diffDate = $firstDate->diff($secondDate);
                throw new InputValidationException
                ("Jūs vėluojate sumokėti mokesčius " . $diffDate . " dienų.");
            }elseif ($arrayData[3] + 1 > date('m')){
                throw new InputValidationException
                ("Mokėjimas atliekamas per anksti");
            }else {
                $finalData['month'] = $arrayData[3];
            }
        }else throw new InputValidationException
        ("Neteisingai įvesti duomenys. Patikslinkite ir bandykite dar kartą");

        return $finalData;

    }
}