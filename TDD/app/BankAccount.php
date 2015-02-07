<?php 
    class BankAccount {
        function __construct() {
            $this->balance = 0;               
        }

        public function getBalance(){
            return $this->balance;
        }

        public function setBalance($ammount){
            
            if(! is_numeric($ammount))
                return false;

            $this->balance = $ammount;
        }

        public function withdraw($ammount){
            if(! is_numeric($ammount))
                return false;
            
            $bal = $this->balance - $ammount;
           
            if($bal >= 0)
                $this->balance = $bal;
                  
        }

        public function deposit($ammount){
            
            if(! is_numeric($ammount))
                return false;

            $this->balance = $ammount + $this->balance;

        }
    }

?>
