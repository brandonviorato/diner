<?php

class StuffedPet extends Pet
{
    private $_size;
    private $_stuffingType;
    private $_material;

    public function __construct($animal="unknown", $color="unknown", $size="", $stuffingType="", $material="")
    {
        // Pass animal and color to Pet constructor
        parent::__construct($animal, $color);

        // Set StuffedPet fields
        $this->_size = $size;
        $this->_stuffingType = $stuffingType;
        $this->_material = $material;
    }

    public function getStuffingType()
    {
        return $this->_stuffingType;
    }

    public function setStuffingType($stuffingType): void
    {
        $this->_stuffingType = $stuffingType;
    }

    public function getSize()
    {
        return $this->_size;
    }

    public function setSize($size): void
    {
        $this->_size = $size;
    }

    public function getMaterial()
    {
        return $this->_material;
    }

    public function setMaterial($material): void
    {
        $this->_material = $material;
    }
}
