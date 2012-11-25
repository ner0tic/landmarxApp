<<<<<<< HEAD
Landmarx Landmark Mapping Library
=================================
The LandmarxLandmark library provides object oriented nodes that connect to map given data.  It is used by the [LandmarxBundle](https://github.com/ner0tic/Landmarx/tree/bundle) for Symfony2 but can now be used stand-alone.

```php
<?php
  use Landmarx\LandmarkFacory;
  use Landmarx\Renderer\ListRenderer;

  $factory = new LandmarkFactory();
  $landmarks = $factory->createItem('Landmarks');
  $landmarks->addChild('Appalachian Mountain Range', array());
  $landmarks->getChild('Appalachian Mountain Range')->addChild('Mt. Katahdin');

  $renderer = new ListRenderer();
  echo $renderer->render($landmarks);
```

This would render:
```html
<ul>
  <li>
    <a href="/appalachian-mountain-range">Appalachian Mountain Range</a>
  </li>
  <li>
    <a href="/appalachian-mountain-range/mt-katahdin">Mt. Katahdin</a>
  </li>
</ul>
```

Installation
============
Landmarx does not provide an autoloader but does follow the PSR-0 convention.  You can use any compliant autoloader for the library, for instance the Symfony2 ClassLoader component.  Assuming you cloned the library in vendor/Landmarx, it will be configured this way:
```php
<?php
  $loader->registerNamespaces(array(
      'Landmarx\Landmark' => __DIR__.'/vendor/Landmarx/src'
      // ...
  ));
```

What Now?
==========
- 01 :: Basics
- 02 :: Renderers
- 03 :: Helpers
- 04 :: Twig Integration

Credits
============
Based on [KnpMenu](https://github.com/KnpLabs/KnpMenu)
=======
landmarxApp
===========

landmarx web application
>>>>>>> 6e08810068c7e0999f290a187ce961a151c6da4b
