<?php

require_once 'classes/CartComputer.php';

class Cart {
	var $cartName;       // The name of the cart/session variable
	var $cartComputers = array(); // The array for storing items in the cart

	function __construct($name) {
		$this->cartName = $name;
		$this->cartComputers = null;
	}
    
    function addComputer($computer) {
        $this->cartComputers[] = $computer;
    }

    function deleteComputer($computerId) {
        foreach((array)$this->cartComputers as $key => $computer) {
            if ($computer->id == $computerId) {
                unset($this->cartComputers[$key]);
            }
        }
    }

    function getTotal() {
        $total = 0;
        foreach((array)$this->cartComputers as $computer) {
            $total = $total + $computer->getTotal();
        }

        return $total;
    }
    

    function getCartComputer($computerId) {
        foreach ((array)$cartComputers as $cartComputer) {
            if ($computerId == $cartComputer->id) {
                return $cartComputer;
            }
        }
    }

}
?>
