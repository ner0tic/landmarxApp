<?php
namespace Landmarx\UserBundle\Document;

use Landmarx\UserBundle\Document\TimestampableInterface;

interface AttributeInterface extends TimestampableInterface
{
    /**
     * Get attribute name
     * @return string attribute name
     */
    public function getName();

    /**
     * Set attribute name
     * @param string $name attribute name
     */
    public function setName($name);

    /**
     * Get attribute display name
     * @return string attribute display name
     */
    public function getDisplay();

    /**
     * Set attribute display name
     * @param string $display attribute display name
     */
    public function setDisplay($display);

    /**
     * Get attribute type
     * @return string attribute type
     */
    public function getType();

    /**
     * Set attribute type
     * @param string $type attribute type
     */
    public function setType($type);

    /**
     * Get attribute configuration
     * @return string configuration
     */
    public function getConfiguration();

    /**
     * Set attribute configuration
     * @param string $config configuration
     */
    public function setConfiguration($config);
}
