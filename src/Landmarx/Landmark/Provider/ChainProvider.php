<?php

namespace Landmarx\Landmark\Provider;

class ChainProvider implements LandmarkProviderInterface {
  /**
   * @var MenuProviderInterface[]
   */
  private $providers;

  public function __construct(array $providers) {
    $this->providers = $providers;
  }

  public function get($name, array $options = array()) {
    foreach ($this->providers as $provider) {
      if ($provider->has($name, $options)) {
        return $provider->get($name, $options);
      }
    }

    throw new \InvalidArgumentException(sprintf('The landmark "%s" is not defined.', $name));
  }

  public function has($name, array $options = array()) {
    foreach ($this->providers as $provider) {
      if ($provider->has($name, $options)) {
        return true;
      }
    }

    return false;
  }
}