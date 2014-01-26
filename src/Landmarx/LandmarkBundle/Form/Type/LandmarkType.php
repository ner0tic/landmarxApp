<?php
namespace Landmarx\LandmarkBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Oh\GoogleMapFormTypeBundle\Form\Type\GoogleMapType;

use Landmarx\LandmarkBundle\Document\Landmark;

class LandmarkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('description');
        $builder->add(
            'type',
            'entity',
            array(
                'property' =>  'name',
                'class' => 'Landmarx\LandmarkBundle\Document\Type'
           )
        );
        $builder->add(
            'parent',
            'entity',
            array(
                    'property' =>  'name',
                    'class' => 'Landmarx\LandmarkBundle\Document\Landmark'
           )
        );
        $builder->add(
            'categories',
            'entity',
            array(
              'property' =>  'name',
              'class' => 'Landmarx\LandmarkBundle\Document\Category'
           )
        );
        $builder->add(
            'public',
            'checkbox',
            array(
                'label'     => 'Show this landmark publicly?',
                'required'  => false,
          )
        );
        $builder->add('created_by', 'hidden');
        $builder->add('updated_by', 'hidden');
        $builder->add('latlng', new GoogleMapType());
        $builder->add(
            'attributes',
            'entity',
            array(
                'property' => 'name',
                'class' => 'Landmarx\LandmarkBundle\Document\LandmarkAttribute'
           )
        );
    }

    public function getName()
    {
          return 'landmark';
    }
}
