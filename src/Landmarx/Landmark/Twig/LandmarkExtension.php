<?php

namespace Landmarx\Landmark\Twig;

use Landmarx\Landmark\ItemInterface;

class LandmarkExtension extends \Twig_Extension {
  private $helper;

  /**
   * @param Helper $helper
   */
  public function __construct(Helper $helper) {
    $this->helper = $helper;
  }

  public function getFunctions() {
    return array(
        'landmarx_landmark_get' => new \Twig_Function_Method($this, 'get'),
        'landmarx_landmark_render' => new \Twig_Function_Method($this, 'render', array('is_safe' => array('html'))),
    );
  }

  /**
   * Retrieves an item following a path in the tree.
   *
   * @param ItemInterface|string $landmark
   * @param array                $path
   * @param array                $options
   *
   * @return ItemInterface
   */
  public function get($landmark, array $path = array(), array $options = array()) {
    return $this->helper->get($landmark, $path, $options);
  }

  /**
   * Renders a menu with the specified renderer.
   *
   * @param ItemInterface|string|array $landmark
   * @param array                      $options
   * @param string                     $renderer
   *
   * @return string
   */
  public function render($landmark, array $options = array(), $renderer = null) {
    return $this->helper->render($landmark, $options, $renderer);
  }

  /**
   * @return string
   */
  public function getName() {
    return 'landmarx_landmark';
  }
}