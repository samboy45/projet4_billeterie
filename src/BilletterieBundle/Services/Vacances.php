<?php
/**
 * Created by PhpStorm.
 * User: 17014
 * Date: 01/05/2017
 * Time: 09:39
 */

namespace BilletterieBundle\Services;


class Vacances
{

    function getHolidays($year = null)
    {
        if ($year === null)
        {
            $year = intval(date('Y'));
        }

        $easterDate  = easter_date($year);
        $easterDay   = date('j', $easterDate);
        $easterMonth = date('n', $easterDate);
        $easterYear   = date('Y', $easterDate);

        $holidays = array(
            // These days have a fixed date
            date("Y-m-d",mktime(0, 0, 0, 1,  1,  $year)),  // 1er janvier
            date("Y-m-d",mktime(0, 0, 0, 5,  1,  $year)),  // Fête du travail
            date("Y-m-d",mktime(0, 0, 0, 5,  8,  $year)),  // Victoire des alliés
            date("Y-m-d",mktime(0, 0, 0, 7,  14, $year)),  // Fête nationale
            date("Y-m-d",mktime(0, 0, 0, 8,  15, $year)),  // Assomption
            date("Y-m-d",mktime(0, 0, 0, 11, 1,  $year)),  // Toussaint
            date("Y-m-d",mktime(0, 0, 0, 11, 11, $year)),  // Armistice
            date("Y-m-d",mktime(0, 0, 0, 12, 25, $year)),  // Noel

            // These days have a date depending on easter
            date("Y-m-d",mktime(0, 0, 0, $easterMonth, $easterDay + 2,  $easterYear)),
            date("Y-m-d",mktime(0, 0, 0, $easterMonth, $easterDay + 40, $easterYear)),
            date("Y-m-d",mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear)),
        );

        sort($holidays);

        return $holidays;
    }

}