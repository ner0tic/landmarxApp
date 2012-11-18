<?php

namespace Landmarx\Landmark\Matcher\Voter;

use Landmarx\Landmark\ItemInterface;

/**
 * Voter based on the uri
 */
class UriVoter implements VoterInterface {
  private $uri;

  public function __construct($uri = null) {
    $this->uri = $uri;
  }

  public function setUri($uri) {
    $this->uri = $uri;
  }

  public function matchItem(ItemInterface $item) {
    if (null === $this->uri || null === $item->getUri()) {
      return null;
    }

    if ($item->getUri() === $this->uri) {
      return true;
    }

    return null;
  }
}