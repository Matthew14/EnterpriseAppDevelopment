<?php
    
    require_once('../app/BankAccount.php');
    require_once('../simpletest/autorun.php');
        
    
    class BankAccountTests extends UnitTestCase {
        
        public function setUp(){
            $this->bankAccount = new BankAccount();
        }
        
        public function testInitalBalance(){
            $this->assertEqual(0, $this->bankAccount->balance);
        }

        public function testCannotBecomeNegative(){
            $initialBal = $this->bankAccount->balance;
            $this->bankAccount->withdraw($initialBal + 1);

            $this->assertTrue($this->bankAccount->balance >= 0);
        }

        public function testDeposit(){
            $toDeposit = 45;
            $startBal = $this->bankAccount->balance;
            $this->bankAccount->deposit($toDeposit);
            $this->assertEqual($this->bankAccount->balance, $startBal + $toDeposit);
        }
        
        public function testWithdraw(){
            $this->bankAccount->balance = 20;
            
            $toWithdraw = 10;
            $startBal = $this->bankAccount->balance;
            $this->bankAccount->withdraw($toWithdraw);
            
            $this->assertEqual($this->bankAccount->balance, $startBal - $toWithdraw);
        }

        public function testDepositWithString(){
             $startBal = $this->bankAccount->balance;
             $this->bankAccount->deposit("hello there");
             $this->assertEqual($this->bankAccount->balance, $startBal);
        }

        public function testWithdrawWithString(){
             $startBal = $this->bankAccount->balance;
             $this->bankAccount->withdraw("hello there");
             $this->assertEqual($this->bankAccount->balance, $startBal);
        }

        public function testSetBalanceWithString(){
            $startBal = $this->bankAccount->balance;
            $this->bankAccount->setBalance("hello there");
            $this->assertEqual($this->bankAccount->balance, $startBal);

        }

        public function testGetBalance(){
            $this->assertEqual($this->bankAccount->balance, $this->bankAccount->balance);   
        }
            
        public function testSetBalance(){
            $newBal = 109;                             
            $this->bankAccount->setBalance($newBal); 
            $this->assertEqual($newBal, $this->bankAccount->balance); 
        }

        public function tearDown(){
            $this->bankAccount = NULL;
        }

    }
    
?>
