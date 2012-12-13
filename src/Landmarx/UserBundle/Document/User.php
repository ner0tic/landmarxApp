<?php
// src/Acme/UserBundle/Document/User.php

namespace Landmarx\UserBundle\Document;

use FOS\UserBundle\Document\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class User extends BaseUser
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;
    
    protected $facebook_id;
    
    protected $foursquare_id;
    
    protected $oauth2_id;

    public function __construct()
    {
        parent::__construct();
    }
    
    public function getFacebookId()
    {
      return $this->facebook_id;
    }
    
    public function setFacebookId($id)
    {
      if(null === $id)
      {
        throw \InvalidArgument('Must supply a facebook id');
      }
      
      return $this->facebook_id;
    }
    
    public function getFoursquareId()
    {
      return $this->foursquare_id;
    }
    
    public function setFoursquareId($id)
    {
      if(null === $id)
      {
        throw \InvalidArgument('Must supply a foursquare id');
      }
      
      return $this->foursquare_id;
    }
    
    public function getOAuth2Id()
    {
      return $this->oauth2_id;
    }
    
    public function setOAuth2Id($id)
    {
      if(null === $id)
      {
        throw \InvalidArgument('Must supply an oauth2 id');
      }
      
      return $this->oauth2_id;
    }
}