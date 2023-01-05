<?php

namespace Kestutisbilotas\Models;

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
            echo "Neteisingai įvesti duomenys. Patikslinkite ir bandykite dar kartą";
        }

        //elektros kWh kieki paimam i array
        if (isset($arrayData[0]) && is_numeric($arrayData[0])){
            $finalData['amount'] = $arrayData[0];
        } else echo "Neteisingai įvesti duomenys. Patikslinkite ir bandykite dar kartą";

        // tarifa paimam i array
        if (isset($arrayData[1]) && is_numeric($arrayData[1])){
            $finalData['price'] = $arrayData[1];
        } else echo "Neteisingai įvesti duomenys. Patikslinkite ir bandykite dar kartą";

        // paros meta paimam i array
        if (isset($arrayData[2]) && ($arrayData[2] === 'diena' || $arrayData[2] === 'naktis')){
            $finalData['period'] = $arrayData[2];
        } else echo "Neteisingai įvesti duomenys. Patikslinkite ir bandykite dar kartą";

        //jei mėnuo ivestas teisingai, nevėluoja ir ne per anskti mokėjimas, paimam į array
        if (isset($arrayData[3]) && is_numeric($arrayData[3]) && $arrayData[3] > 0 && $arrayData[3] < 13){
            if ($arrayData[3] + 1 < date('m')){
                echo "Jūs vėluojate sumokėti mokesčius ... dienų.";
            }elseif ($arrayData[3] + 1 > date('m')){
                echo "Mokėjimas atliekamas per anksti";
            }else {
                $finalData['month'] = $arrayData[3];
            }
        }else echo "Neteisingai įvesti duomenys. Patikslinkite ir bandykite dar kartą";

        return $finalData;

    }
}