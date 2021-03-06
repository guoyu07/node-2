<?php

/**
 * A simple Tree&Node Component for PHP.
 *
 * (c) Thomas Breuss <me@tebe.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tebe;

class Node implements \IteratorAggregate
{

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var Node
     */
    private $parent;

    /**
     * @var array[Node]
     */
    private $children;

    /**
     * @param mixed $value
     */
    public function __construct($value = null)
    {
        $this->value = $value;
        $this->parent = null;
        $this->children = [];
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->children);
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isRoot()
    {
        return null === $this->parent;
    }

    /**
     * @param Node $parent
     */
    public function setParent(Node $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return null|Node
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return bool
     */
    public function hasParent()
    {
        return null !== $this->parent;
    }

    /**
     * @param Node $child
     */
    public function addChild(Node $child)
    {
        $child->setParent($this);
        $this->children[] = $child;
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return !empty($this->children);
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @return $this|Node
     */
    public function root()
    {
        if (is_null($this->parent)) {
            return $this;
        } else {
            return $this->parent->root();
        }
    }
}
