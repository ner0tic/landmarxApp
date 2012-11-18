<?php

namespace Landmarx\Landmark\Twig;

use Landmarx\Landmark\ItemInterface;
use Landmarx\Landmark\Renderer\RendererProviderInterface;
use Landmarx\Landmark\Provider\MenuProviderInterface;

/**
 * Helper class containing logic to retrieve and render landmark from templating engines
 *
 */
class Helper {
  private $rendererProvider;
  private $menuProvider;

  /**
   * @param RendererProviderInterface  $rendererProvider
   * @param MenuProviderInterface|null $menuProvider
   */
  public function __construct(RendererProviderInterface $rendererProvider, MenuProviderInterface $menuProvider = null) {
    $this->rendererProvider = $rendererProvider;
    $this->menuProvider = $menuProvider;
  }

  /**
   * Retrieves item in the landmark, eventually using the landmark provider.
   *
   * @param ItemInterface|string $landmark
   * @param array                $path
   * @param array                $options
   *
   * @return ItemInterface
   *
   * @throws \BadMethodCallException   when there is no menu provider and the menu is given by name
   * @throws \LogicException
   * @throws \InvalidArgumentException when the path is invalid
   */
  public function get($landmark, array $path = array(), array $options = array()) {
    if (!$landmark instanceof ItemInterface) {
      if (null === $this->landmarkProvider) {
        throw new \BadMethodCallException('A landmark provider must be set to retrieve a landmark');
      }

      $landmarkName = $landmark;
      $landmark = $this->landmarkProvider->get($landmarkName, $options);

      if (!$landmark instanceof ItemInterface) {
        throw new \LogicException(sprintf('The landmark "%s" exists, but is not a valid landmark item object. Check where you created the landmark to be sure it returns an ItemInterface object.', $landmarkName));
      }
    }

    foreach ($path as $child) {
        $landmark = $landmark->getChild($child);
        if (null === $landmark) {
            throw new \InvalidArgumentException(sprintf('The landmark has no child named "%s"', $child));
        }
    }

    return $landmark;
  }
  /**
   * Renders a landmark with the specified renderer.
   *
   * If the argument is an array, it will follow the path in the tree to
   * get the needed item. The first element of the array is the whole landmark.
   * If the landmark is a string instead of an ItemInterface, the provider
   * will be used.
   *
   * @param ItemInterface|string|array $landmark
   * @param array                      $options
   * @param string                     $renderer
   *
   * @return string
   *
   * @throws \InvalidArgumentException
   */
  public function render($landmark, array $options = array(), $renderer =  null) {
    if (!$landmark instanceof ItemInterface) {
      $path = array();
      if (is_array($landmark)) {
        if (empty($landmark)) {
          throw new \InvalidArgumentException('The array cannot be empty');
        }
        $path = $menu;
        $landmark = array_shift($path);
      }

      $landmark = $this->get($landmark, $path);
    }

    return $this->rendererProvider->get($renderer)->render($menu, $options);
  }
}