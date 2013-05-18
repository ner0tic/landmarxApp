<?php

    namespace Landmarx\LandmarkBundle\Form\Type;
    
    use Symfony\Component\Form\AbstractType,
        Symfony\Component\Form\FormBuilderInterface,
        Landmarx\LandmarkBundle\Entity\LandmarkKind;
    
    class LandmarkKindType extends AbstractType
    {
        public function buildForm( FormBuilderInterface $builder, array $options )
        {
            $builder->add( 'name' );
            $builder->add( 'description' );
            $builder->add( 'parent',  
                           'entity',   
                           array( 
                               'property' =>  'name', 
                               'class' => 'Landmarx\LandmarkBundle\Entity\Landmark',
                               'required' => false
            ) );
            $builder->add( 'public',
                           'checkbox', 
                           array(
                                'label'     => 'Show this entry publicly?',
                                'required'  => false,
            ) );
        }
        
        public function getName()
        {
            return 'landmark_kind';
        }
    }
        