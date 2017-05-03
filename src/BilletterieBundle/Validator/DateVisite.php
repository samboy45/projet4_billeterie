<?php
/**
 * Created by PhpStorm.
 * User: 17014
 * Date: 01/05/2017
 * Time: 22:17
 */

namespace BilletterieBundle\Validator;


use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */
class DateVisite extends Constraint
{

    public $message = "La date sélectionnée n'est pas disponible";

    public function validatedBy()
    {
        return 'billetterie_dateVisite';
    }
}