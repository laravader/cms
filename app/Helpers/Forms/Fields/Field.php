<?php

namespace App\Helpers\Forms\Fields;

use App\Helpers\Formatters\String;

abstract class Field {

    /**
     * All field attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Set the field attributes
     *
     * @param array $attributes
     * @return null
     */
    private function setAttributes($fieldName, array $attributes) {
        $this->attributes = array_merge($this->attributes, [
            'label'            => String::labelize($fieldName),
            'name'             => $fieldName,
            'hidden'           => false,
            'disabled'         => false,
            'readonly'         => false,
            'required'         => true,
            'value'            => null
        ], $attributes);
    }

    /**
     * Create the HTML of the field
     *
     * @return string
     */
    public function create($fieldName, array $attributes = []) {
        $this->setAttributes($fieldName, $attributes);
        return $this;
    }

    /**
     * Return all the attributes set
     *
     * @return static
     */
    protected function getAttributes() {
        return collect($this->attributes);
    }

    /**
     * Return the field value
     *
     * @return static
     */
    protected function getValue() {
        return $this->getAttributes()->get("value");
    }

    /**
     * Return the field HTML
     *
     * @return string
     */
    public function getField() {
        return $this->getHTML($this->getAttributes());
    }

    /**
     * Return the field HTML
     *
     * @return string
     */
    public function getAttribute($name) {
        return $this->getAttributes()->get($name);
    }

    /**
     * Add a attribute to the field
     *
     * @param $name
     * @param $value
     * @param null $mode
     * @return $this
     */
    protected function addAttribute($name, $value) {
        $this->attributes[$name] = $value;
        return $this;
    }

    /**
     * Method the HTML of the input field
     *
     * @return string
     */
    protected abstract function getHTML($attributes);

}
