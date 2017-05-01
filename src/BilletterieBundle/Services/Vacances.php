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

   //public function getVacances()
   //{
   //    $maDate = new \DateTime();
   //    $year = $maDate->format("y");
   //    $G = $year%19;
   //    $C = floor($year/100);
   //    $H = ($C - floor($C/4) - floor((8*$C+13)/25) + 19*$G + 15)%30;
   //    $I = $H - floor($H/28)*(1 - floor($H/28)*floor(29/($H + 1))*floor((21 - $G)/11));
   //    $J = ($year + floor($year/4) + $I + 2 - $C + floor($C/4))%7;
   //    $L = $I - $J;
   //    $MoisPaques = 3 + floor(($L + 40)/44);
   //    $JourPaques = $L + 28 - 31*floor($MoisPaques/4);

   //    $vacances = [
   //        //Année courant
   //        new \DateTime($year.'-01-01'), //jour de l'an
   //        new \DateTime($year.'-05-01'), //fête du travail
   //        new \DateTime($year.'-05-08'), //8 mai 1945
   //        new \DateTime($year.'-07-14'), //Fête nationale
   //        new \DateTime($year.'-08-15'), //Assomption
   //        new \DateTime($year.'-11-01'), //Toussaint
   //        new \DateTime($year.'-11-11'), //Armistice
   //        new \DateTime($year.'-12-25'), //Noel
   //        new \DateTime($year. '-'. ($MoisPaques-1).'-'. $JourPaques),//Paques
   //        new \DateTime($year. '-'. ($MoisPaques-1).'-'. ($JourPaques+1)),//lundi de paques
   //        new \DateTime($year. '-'. ($MoisPaques-1).'-'. ($JourPaques+39)),//Ascension
   //        new \DateTime($year. '-'. ($MoisPaques-1).'-'. ($JourPaques+49)),//jourPaques
   //        new \DateTime($year. '-'. ($MoisPaques-1).'-'. ($JourPaques+50)),//LundiPentecote
   //        //Année suivante
   //        new \DateTime(($year+1).'-01-01'), //jour de l'an
   //        new \DateTime(($year+1).'-05-01'), //fête du travail
   //        new \DateTime(($year+1).'-05-08'), //8 mai 1945
   //        new \DateTime(($year+1).'-07-14'), //Fête nationale
   //        new \DateTime(($year+1).'-08-15'), //Assomption
   //        new \DateTime(($year+1).'-11-01'), //Toussaint
   //        new \DateTime(($year+1).'-11-11'), //Armistice
   //        new \DateTime(($year+1).'-12-25'), //Noel
   //        new \DateTime(($year+1). '-'. ($MoisPaques-1).'-'. $JourPaques),//Paques
   //        new \DateTime(($year+1). '-'. ($MoisPaques-1).'-'. ($JourPaques+1)),//lundi de paques
   //        new \DateTime(($year+1). '-'. ($MoisPaques-1).'-'. ($JourPaques+39)),//Ascension
   //        new \DateTime(($year+1). '-'. ($MoisPaques-1).'-'. ($JourPaques+49)),//jourPaques
   //        new \DateTime(($year+1). '-'. ($MoisPaques-1).'-'. ($JourPaques+50)),//LundiPentecote
   //    ];

   //    return $vacances ;
   //}

    public function getHolidays($year)
    {
        $date = new \DateTime($year);
        $easterDate = new \DateTime('@'.easter_date($date->format($year)));

        $holidays = array(
            new \DateTime($date->format($year.'-01-01')),  // Jour de l'an
            new \DateTime($date->format($year.'-05-01')),  // Fête du travail
            new \DateTime($date->format($year.'-05-08')),  // 8 mai 1945
            new \DateTime($date->format($year.'-07-14')),  // Fête nationale
            new \DateTime($date->format($year.'-08-15')),  // Assomption
            new \DateTime($date->format($year.'-11-01')),  // Toussaint
            new \DateTime($date->format($year.'-11-11')),  // Armistice
            new \DateTime($date->format($year.'-12-25')),  // Noël
            (new \DateTime($easterDate->format('Y-m-d')))->modify('+ 2 day'),  // Lundi de Pâques
            (new \DateTime($easterDate->format('Y-m-d')))->modify('+ 40 day'), // Jeudi de l'Ascension
            (new \DateTime($easterDate->format('Y-m-d')))->modify('+ 50 day'), // Lundi de Pentecôte
        );

        return $holidays;
    }



}