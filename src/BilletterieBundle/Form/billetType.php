<?php

namespace BilletterieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class billetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomVisiteur', TextType::class, array(
                'label' => 'Nom',
            ))
            ->add('prenomVisiteur', TextType::class, array(
                'label' => 'Prénom'
            ))
            ->add('visiteurPays', CountryType::class, array(
                'label' => 'Pays',
                'label_attr' => array( 'class' => 'hidden'),
                'placeholder' => 'Choisissez votre pays',
                'attr'=>array(
                    'class'=> 'browser-default','input-field col s12'
                )
            ))
            ->add('visiteurDateNaissance', BirthdayType::class, array(
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' =>array(
                    'class' =>'dateOfBirth'
                )
                ))
            ->add('tarifReduit', CheckboxType::class, array(
                'label' => 'Tarif réduit ( Sur présentaion d\'un justificatif à l\'entrée )',
                'required' => false,
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BilletterieBundle\Entity\billet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'billetteriebundle_billet';
    }


}
