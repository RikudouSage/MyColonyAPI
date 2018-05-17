<?php

namespace MyColony\Response\Collection;

use MyColony\Response\Response;

/**
 * The base collection class, all collections should extend this.
 *
 * Implements Countable, ArrayAccess and Iterator so the collection
 * can be used as array.
 *
 * @package MyColony\Response\Collection
 */
abstract class Collection implements \Countable, \ArrayAccess, \Iterator {

  /**
   * @var string
   */
  protected $rawData;

  /**
   * @var array
   */
  protected $data;

  /**
   * @var Response[]
   */
  protected $elements = [];

  /**
   * @var int
   */
  protected $i = 0;

  /**
   * Takes the raw input string from api and converts it to array.
   *
   * @param string $data
   */
  public function __construct(string $data) {
    $this->rawData = $data;
    if (($this->data = json_decode($data, TRUE)) === false) {
      throw new \InvalidArgumentException("The data is not a valid JSON");
    }
    $this->populateElements();
  }

  /**
   * Returns the raw data returned by api
   *
   * @return string
   */
  public function getRawJson() {
    return $this->rawData;
  }

  /**
   * Returns all the elements in collection
   *
   * @return \MyColony\Response\Response[]
   */
  public function getData() {
    return $this->elements;
  }

  /**
   * Populates the elements array with data
   *
   * @return void
   */
  abstract protected function populateElements();

  /**
   * Return the current element
   *
   * @link http://php.net/manual/en/iterator.current.php
   * @return Response Can return any type.
   * @since 5.0.0
   */
  public function current() {
    return $this->elements[$this->i];
  }

  /**
   * Move forward to next element
   *
   * @link http://php.net/manual/en/iterator.next.php
   * @return void Any returned value is ignored.
   * @since 5.0.0
   */
  public function next() {
    $this->i++;
  }

  /**
   * Return the key of the current element
   *
   * @link http://php.net/manual/en/iterator.key.php
   * @return int scalar on success, or null on failure.
   * @since 5.0.0
   */
  public function key() {
    return $this->i;
  }

  /**
   * Checks if current position is valid
   *
   * @link http://php.net/manual/en/iterator.valid.php
   * @return boolean The return value will be casted to boolean and then
   *   evaluated. Returns true on success or false on failure.
   * @since 5.0.0
   */
  public function valid() {
    return $this->offsetExists($this->i);
  }

  /**
   * Rewind the Iterator to the first element
   *
   * @link http://php.net/manual/en/iterator.rewind.php
   * @return void Any returned value is ignored.
   * @since 5.0.0
   */
  public function rewind() {
    $this->i = 0;
  }

  /**
   * Whether a offset exists
   *
   * @link http://php.net/manual/en/arrayaccess.offsetexists.php
   *
   * @param mixed $offset <p>
   * An offset to check for.
   * </p>
   *
   * @return boolean true on success or false on failure.
   * </p>
   * <p>
   * The return value will be casted to boolean if non-boolean was returned.
   * @since 5.0.0
   */
  public function offsetExists($offset) {
    return isset($this->elements[$offset]);
  }

  /**
   * Offset to retrieve
   *
   * @link http://php.net/manual/en/arrayaccess.offsetget.php
   *
   * @param mixed $offset <p>
   * The offset to retrieve.
   * </p>
   *
   * @return Response Can return all value types.
   * @since 5.0.0
   */
  public function offsetGet($offset) {
    return $this->elements[$offset];
  }

  /**
   * Offset to set
   *
   * @link http://php.net/manual/en/arrayaccess.offsetset.php
   *
   * @param mixed $offset <p>
   * The offset to assign the value to.
   * </p>
   * @param mixed $value <p>
   * The value to set.
   * </p>
   *
   * @return void
   * @since 5.0.0
   */
  public function offsetSet($offset, $value) {
    throw new \LogicException("You cannot overwrite values in the collection");
  }

  /**
   * Offset to unset
   *
   * @link http://php.net/manual/en/arrayaccess.offsetunset.php
   *
   * @param mixed $offset <p>
   * The offset to unset.
   * </p>
   *
   * @return void
   * @since 5.0.0
   */
  public function offsetUnset($offset) {
    unset($this->elements[$offset]);
  }

  /**
   * Count elements of an object
   *
   * @link http://php.net/manual/en/countable.count.php
   * @return int The custom count as an integer.
   * </p>
   * <p>
   * The return value is cast to an integer.
   * @since 5.1.0
   */
  public function count() {
    return count($this->elements);
  }
}