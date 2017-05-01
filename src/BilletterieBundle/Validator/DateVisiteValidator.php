<?php
/**
 * Created by PhpStorm.
 * User: 17014
 * Date: 01/05/2017
 * Time: 22:20
 */

namespace BilletterieBundle\Validator;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class DateVisiteValidator extends ConstraintValidator
{


    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        // TODO: Implement validate() method.
    }
}