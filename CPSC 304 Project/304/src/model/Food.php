<?php 

/**
*	Class food 
* Information about the food item, it's name and the quantity ordered
*/
class Food 
{
    /**
     * @var food_name Food item's name 
     */
		public $food_name = null;
    /**
     * @var food_quantity The number of times this food is ordered 
     */
		public $food_quantity = 0;
    /**
     * @var food_price The price of this food that is ordered 
     */
		public $food_price = 0;

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$food = new Food();"
     */
    public function __construct($food_name, $food_quantity, $food_price)
    {
			$this->food_name = $food_name;
			$this->food_quantity = $food_quantity;
			$this->food_price = $food_price;
    }



}
