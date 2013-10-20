<?php
namespace Landmarx\LandmarkBundle\Document;

final class AttributeTypes
{
    const TEXT = 'text';
    const NUMBER = 'number';
    const CHOICE = 'choice';
    const CHECKBOX = 'checkbox';

    /**
     * Get attribute types
     * @return array attribute types
     */
    public static function getChoices()
    {
        return array(
            self::TEXT => 'Text',
            self::NUMBER => 'Number',
            self::CHOICE => 'Choice',
            self::CHECKBOX => 'Checkbox'
        );
    }
}
