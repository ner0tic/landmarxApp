<?php
    namespace Landmarx\LandmarkBundle\Form\Type;
    
    use Symfony\Component\Form\AbstractType,
        Symfony\Component\Form\FormBuilderInterface,
        Landmarx\LandmarkBundle\Entity\Landmark,
        Oh\GoogleMapFormTypeBundle\Form\Type\GoogleMapType;
    
    class LandmarkType extends AbstractType 
    {
        public function buildForm( FormBuilderInterface $builder, array $options )
        {
            $builder->add( 'name' );
            $builder->add( 'description' );
            $builder->add( 'kind',
                           'entity',   
                           array( 
                               'property' =>  'name', 
                               'class' => 'Landmarx\LandmarkBundle\Entity\LandmarkKind'
            ) );
            $builder->add( 'parent',  
                           'entity',   
                           array( 
                               'property' =>  'name', 
                               'class' => 'Landmarx\LandmarkBundle\Entity\Landmark'
            ) );
            $builder->add( 'categories',  
                           'entity',   
                           array( 
                               'property' =>  'name', 
                               'class' => 'Landmarx\LandmarkBundle\Entity\LandmarkCategory'
            ) );
            $builder->add( 'public',
                           'checkbox', 
                           array(
                                'label'     => 'Show this entry publicly?',
                                'required'  => false,
            ) );
            $builder->add( 'user', 'hidden' );
//            $builder->add( 'attributes', 'hidden' );
            $builder->add( 'latlng', new GoogleMapType() );
        }
        
        public function getName()
        {
            return 'landmark';
        }
    }