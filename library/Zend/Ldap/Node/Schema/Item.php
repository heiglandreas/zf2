<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Ldap
 * @subpackage Schema
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @namespace
 */
namespace Zend\Ldap\Node\Schema;

/**
 * Zend_Ldap_Node_Schema_Item provides a base implementation for managing schema
 * items like objectClass and attribute.
 *
 * @uses       ArrayAccess
 * @uses       \Zend\Ldap\Exception\BadMethodCallException
 * @uses       Countable
 * @category   Zend
 * @package    Zend_Ldap
 * @subpackage Schema
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Item implements \ArrayAccess, \Countable
{
    /**
     * The underlying data
     *
     * @var array
     */
    protected $_data;

    /**
     * Constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data);
    }

    /**
     * Sets the data
     *
     * @param  array $data
     * @return \Zend\Ldap\Node\Schema\Item Provides a fluid interface
     */
    public function setData(array $data)
    {
        $this->_data = $data;
        return $this;
    }

    /**
     * Gets the data
     *
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * Gets a specific attribute from this item
     *
     * @param  string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->_data)) {
            return $this->_data[$name];
        } else {
            return null;
        }
    }

    /**
     * Checks whether a specific attribute exists.
     *
     * @param  string $name
     * @return boolean
     */
    public function __isset($name)
    {
        return (array_key_exists($name, $this->_data));
    }

    /**
     * Always throws \Zend\Ldap\Exception\BadMethodCallException
     * Implements ArrayAccess.
     *
     * This method is needed for a full implementation of ArrayAccess
     *
     * @param  string $name
     * @param  mixed $value
     * @return null
     * @throws \Zend\Ldap\Exception\BadMethodCallException
     */
    public function offsetSet($name, $value)
    {
        throw new \Zend\Ldap\Exception\BadMethodCallException();
    }

    /**
     * Gets a specific attribute from this item
     *
     * @param  string $name
     * @return mixed
     */
    public function offsetGet($name)
    {
        return $this->__get($name);
    }

    /**
     * Always throws \Zend\Ldap\Exception\BadMethodCallException
     * Implements ArrayAccess.
     *
     * This method is needed for a full implementation of ArrayAccess
     *
     * @param  string $name
     * @return null
     * @throws \Zend\Ldap\Exception\BadMethodCallException
     */
    public function offsetUnset($name)
    {
        throw new \Zend\Ldap\Exception\BadMethodCallException();
    }

    /**
     * Checks whether a specific attribute exists.
     *
     * @param  string $name
     * @return boolean
     */
    public function offsetExists($name)
    {
        return $this->__isset($name);
    }

    /**
     * Returns the number of attributes.
     * Implements Countable
     *
     * @return int
     */
    public function count()
    {
        return count($this->_data);
    }
}
