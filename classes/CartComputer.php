<?php

class CartComputer {

    public $id;
    public $modelId;
    public $modelTitle;
    public $basePrice;
    public $quantity;
    public $parts = array();


    function __construct($computerId,$modelId,$modelTitle,$basePrice,$quantity) {
        $this->id = $computerId;
        $this->modelId = $modelId;
        $this->modelTitle = $modelTitle;
        $this->basePrice = $basePrice;
        $this->quantity = $quantity;
    }

    function addPart($partId,$partTitle,$partCost) {
        $part['partId'] = $partId;
        $part['partTitle'] = $partTitle;
        $part['partCost'] = $partCost;
        $this->parts[] = $part;
    }

    function removePart($partId) {
        foreach ((array)$this->parts as $key => $part) {
            if ($part['partId'] == $partId) {
                unset($this->parts[$key]);
            }
        }
    }

    function getTotal() {
        $total = 0;
        foreach ((array)$this->parts as $part) {
            $total = $total + $part['partCost'];
        }
        $total = $total + $this->basePrice;
        if ($this->quantity > 1) {
            $total = $total * $this->quantity;
        }
        return $total;
    }
}

?>
