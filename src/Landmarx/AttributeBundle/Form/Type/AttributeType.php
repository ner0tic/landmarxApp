<?php
namespace Landmarx\AttributeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Landmarx\AttributeBundle\Document\Attribute;

class AttributeType extends AbstractType
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
                'class' => 'Landmarx\AttributeBundle\Document\Type'
           )
        );
        $builder->add(
            'groups',
            'entity',
            array(
                    'property' =>  'name',
                    'class' => 'Landmarx\AttributeBundle\Document\Group'
           )
        );
        $builder->add(
            'public',
            'checkbox',
            array(
                'label'     => 'Show this attribute publicly?',
                'required'  => false,
          )
        );
        $builder->add('created_by', 'hidden');
        $builder->add('updated_by', 'hidden');
    }

    public function getName()
    {
          return 'attribute';
    }
}
