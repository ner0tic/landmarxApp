<?php
namespace Landmarx\LandmarkBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Landmarx\LandmarkBundle\Document\Category;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('description');
        $builder->add(
            'parent',
            'entity',
            array(
                'property' =>  'name',
                'class' => 'Landmarx\LandmarkBundle\Document\Category',
                'required' => false
           )
        );
        $builder->add(
            'public',
            'checkbox',
            array(
                'label'     => 'Show this entry publicly?',
                'required'  => false,
           )
        );
    }

    public function getName()
    {
        return 'category';
    }
}
