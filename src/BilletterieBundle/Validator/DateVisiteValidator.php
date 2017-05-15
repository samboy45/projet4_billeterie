<?php
/**
 * Created by PhpStorm.
 * User: 17014
 * Date: 01/05/2017
 * Time: 22:20
 */

namespace BilletterieBundle\Validator;


use BilletterieBundle\Entity\commande;
use BilletterieBundle\Services\Vacances;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class DateVisiteValidator extends ConstraintValidator
{

    private $vacances;
    private $em;
    private $ticketslimit ;

    public function __construct( EntityManagerInterface $em, Vacances $vacances,$ticketslimit)
    {
        $this->vacances = $vacances;
        $this->em = $em;
        $this->ticketslimit = $ticketslimit;
    }
    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        //$today = date("Y-m-d",mktime(0, 0, 0, date('m'), date('d'), date('Y')));
        //$nextYear = date("Y-m-d",mktime(0, 0, 0, date('m'), date('d'), date('Y')+1));
        $today = new \Datetime('-1 day');
        $nextYear = new \Datetime(date('Y').'-12-31'.'+1 year');

        $vacance1 = $this->vacances->getHolidays(date('Y'));
        $vacance2 = $this->vacances->getHolidays(date('Y')+1);
        $vacances = array_merge($vacance1, $vacance2);

        $joursVisite = date('l', $value->getTimestamp());

        $totaBillets = $this->em->getRepository('BilletterieBundle:commande')->findTicketsByDate($value);
        $maxBillets = $this->ticketslimit;

        if (in_array($value, $vacances) ||
            $value < $today ||
            $value > $nextYear ||
            $joursVisite == "Tuesday" ||
            $joursVisite == "Sunday" ||
            $totaBillets >= $maxBillets){
            $this->context->addViolation($constraint->message);
        }
    }
}