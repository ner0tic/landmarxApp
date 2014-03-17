### Landmarx
## Basic Usage

```php
# Parent object
$katahdin = new Landmark('katahdin');
$katahdin->setType(new LandmarkType('Mountain')); # inline Landmark Type 
$katahdin->setAttribute('elevation',5265);
$katahdin->setLatitude(49.40);
$katahdin->setLongitude(70.83);

# child inline
$peak = new LandmarkType('mountain peak');
$baxter = new Landmark('baxter peak', $peak, array('attributes' => array('elevation' => 5265))); # inline creation
$baxter->setCoordinates(48,11,71.00);
$katahdin->addChild($baxter); # add as child

# child adds parent
$hamlin = new Landmark();
$hamlin->setName('hamlin peak'); # add after creation
$hamlin->addAttribute('elevation' => 4356);
$hamlin->setCoords(array(42.99,70.00));
$hamlin->setParent($katahdin); # set parent
```
