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
                'widget' => 'single_text',
                'html5' => false
            ))
            ->add('typeBillet', ChoiceType::class, array(
                'label' => 'Type de billet',
                'choices' => array(
                    'journée' => 'journée',
                    'demie-journée' => 'demi-journée'
                ),
                'attr'=>array(
                    'class'=>'input-field col s12'
                )
            ))
            ->add('billets', CollectionType::class, array(
                'entry_type' => billetType::class,
                'allow_add' => true,
                'allow_delete' =>true,
                'label' => 'Billets',
                'by_reference' => false,
                'label_attr' => array( 'class' => 'hidden')
            ))
            ->add('email', TextType::class, array(
                'label' => 'Email'
            ))
            ->add('valider', SubmitType::class, array(
                'label' => 'Valider la commande',
                'attr' => array('class' => 'btn green')
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
