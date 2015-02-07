<?php 
    /**
    * Provides methods to validate emails, number ranges and strings
    *
    * @author Matthew O'Neill
    * @version 0.1
    */
    class validation{
       
        /**
        * checks if email valid
        * @param $toValidate the thing to check 
        * @return true or false if valid email 
        */
        public function isEmailValid($toValidate){
            
            return preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/', $toValidate) == 1;
        }       
        
        /**
        * checks if number is in a given range
        * @param $num the number
        * @param $max the max num in range
        * @param $min the min num in range
        * @return true or false depending on if in range
        */
        public function isNumberInRangeValid($num, $min, $max){
             if(!is_numeric($num) ||
                !is_numeric($min) ||
                !is_numeric($max) ){
                throw new Exception("gotta have numbers");
             }

             return $num <= $max && $num >= $min;
        }
        
        /**
        * checks if it's the right string length
        * @param $s the string to check
        * @param $len the length to check s for
        * @return true or false depending on if right len
        */
        public function isLengthStringValid($s, $len){
            if(!is_numeric($len))
                throw new Exception("len is not a number");

            if(!is_string($s))
                throw new Exception("s is not a string");

            return strlen($s) <= $len;
        }
    }

?>
