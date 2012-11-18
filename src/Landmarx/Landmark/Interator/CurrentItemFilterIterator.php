<?php

namespace Landmarx\Landmark\Iterator;

use Landmarx\Landmark\Matcher\MatcherInterface;

/**
 * Filter iterator keeping only current items
 */
class CurrentItemFilterIterator extends \FilterIterator {
  private $matcher;

  public function __construct(\Iterator $iterator, MatcherInterface $matcher) {
    $this->matcher = $matcher;

    parent::__construct($iterator);
  }

  public function accept() {
    return $this->matcher->isCurrent($this->current());
  }
}