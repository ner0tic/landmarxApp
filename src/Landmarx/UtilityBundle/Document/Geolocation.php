<?php
namespace Landmarx\UtilityBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;
use Oh\GoogleMapFormTypeBundle\Validator\Constraints as OhAssert;

/** 
 * @ODM\EmbeddedDocument
 */
class Geolocation
{
    /**
     * @ODM\Id
     */
    private $id;

    public function getId()
    {
        return $this->id;
    }

    /**
     * Latitude
     * @var float
     * @ODM\Float
     */
    protected $latitude = null;

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($lat)
    {
        $this->latitude = $lat;

        return $this;
    }

    /**
     * Longitude
     * @var float
     * @ODM\Float
     */
    protected $longitude = null;

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($lng)
    {
        $this->longitude = $lng;

        return $this;
    }

    public function getCoords($asString = false)
    {
        if ($asString) {
            return $this->getLatitude().', '.$this->getLongitude();
        }

        return array($this->getLatitude(), $this->getLongitude());
    }

    public function setCoords($lat, $lng = null)
    {
        if (!is_array($lat) && null == $lng) {
            return false;
        } elseif (is_array($lat)) {
            $this->setLatitude($lat['lat'])->setLongitude($lat['lng']);
        } else {
            $this->setLatitude($lat)->setLongitude($lng);
        }

        return $this;
    }

    public function setLatLng($latlng)
    {
        $this->setLatitude($latlng['lat']);
        $this->setLongitude($latlng['lng']);
        return $this;
    }

    /**
     * @Assert\NotBlank()
     * @OhAssert\LatLng()
     */
    public function getLatLng()
    {
        return array('lat'=>$this->getLatitude(),'lng'=>$this->getLongitude());
    }
}
