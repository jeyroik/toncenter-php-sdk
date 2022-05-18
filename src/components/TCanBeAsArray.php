<?php
namespace tonc\components;

/**
 * Implements ICanBeAsArray interface
 */
trait TCanBeAsArray
{
    protected array $attributes = [];

    public function __toArray(): array
    {
        return $this->attributes ?? [];
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->config[$name]);
    }

    /**
     * @var int
     */
    protected int $currentKey = 0;

    /**
     * @var array
     */
    protected array $keyMap = [];

    /**
     * @param array $data
     * @return $this
     */
    public function __merge(array $data)
    {
        foreach ($data as $key => $value) {
            $this->attributes[$key] = $value;
        }

        return $this;
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->attributes[$offset]);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->attributes[$offset] ?? null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->attributes[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return isset($this->keyMap[$this->currentKey]);
    }

    /**
     * @return string|null
     */
    public function key()
    {
        return $this->keyMap[$this->currentKey] ?? null;
    }

    /**
     * @return void
     */
    public function next()
    {
        $this->currentKey++;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->attributes[$this->keyMap[$this->currentKey]];
    }

    /**
     * @return void
     */
    public function rewind()
    {
        $this->currentKey = 0;
    }
}
