<?php

namespace BilletterieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class commandeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateVisite', DateType::class, array(
                'label' => 'Date de visite',
                'html5' => false,
                'attr' => ['class' => 'datepicker'],
            ))
            ->add('typeBillet', ChoiceType::class, array(
                'label' => 'Type de billet',
                'choices' => array(
                    'journée' => 'journée',
                    'demie-journée' => 'demi-journée'
                )
            ))
            ->add('billets', billetType::class, array(
                'label' => 'Billets',
                'label_attr' => array( 'class' => 'hidden')
            ))
            ->add('email', TextType::class, array(
                'label' => 'Email'
            ))
            ->add('valider', SubmitType::class, array(
                'label' => 'Valider la commande',
                'attr' => array('class' => 'btn-success')
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BilletterieBundle\Entity\commande'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'billetteriebundle_commande';
    }


}
