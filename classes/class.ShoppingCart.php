<?php 

class ShoppingCart implements iterator {
	protected $items;
	
	function __construct() {
		
	}
	
	function addToCart($product_identifier, $quantity) {
		$this->items[$product_identifier] = array(
			'quantity' => $quantity
		);
	}
	
	
	/* Iterator Methods */
	public function rewind() {
        reset($this->items);
    }
  
	public function current() {
		$var = current($this->items);
		return $var;
    }
  
    public function key() {
        $var = key($this->items);
        return $var;
    }
  
    public function next() {
        $var = next($this->items);
        return $var;
    }
    
    public function valid() {
        $key = key($this->items);
        $var = ($key !== NULL && $key !== FALSE);
        return $var;
    }
}
