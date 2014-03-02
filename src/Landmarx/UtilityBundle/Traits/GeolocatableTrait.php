<?php
namespace Landmarx\UtilityBundle\Traits;

trait GeolocatableTrait
{
    /**
     * @ODM\EmbedOne(targetDocument="Landmarx\UtilityBundle\Document\Geolocation")
     */
    protected $geolocation;

}
