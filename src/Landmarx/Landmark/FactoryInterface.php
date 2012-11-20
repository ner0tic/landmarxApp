<?php

namespace Landmarx\Landmark;

/**
 * Interface implemented by the factory to create items
 */
interface FactoryInterface {
    /**
     * Creates a landmark item
     *
     * @param string $name
     * @param array  $options
     *
     * @return ItemInterface
     */
    public function createItem($name, array $options = array());

    /**
     * Create a landmark item from a NodeInterface
     *
     * @param NodeInterface $node
     *
     * @return ItemInterface
     */
    public function createFromNode(NodeInterface $node);

    /**
     * Creates a new landmark item (and tree if $data['children'] is set).
     *
     * The source is an array of data that should match the output from LandmarkItem->toArray().
     *
     * @param array $data The array of data to use as a source for the landmark tree
     *
     * @return ItemInterface
     */
    public function createFromArray(array $data);
}