<?php
    require_once('../simpletest/autorun.php');
    require_once('../app/validation.php'); 

    class testValidationClass extends UnitTestCase
    {
        public function setUp(){
            $this->validator = new Validation();    
        }

        public function testEmailWithNumber(){
            $this->assertFalse(
                $this->validator->isEmailValid(2378423));
        }

        public function testEmailWithNotEmail(){
            $this->assertFalse(
                $this->validator->isEmailValid('hello there'));

            $this->assertFalse($this->validator->isEmailValid('he@k@g.com'));
            $this->assertFalse($this->validator->isEmailValid('he@k@g.com'));
            $this->assertFalse($this->validator->isEmailValid('he...co.uk'));
            $this->assertFalse($this->validator->isEmailValid('he@k@g.com.co.co.uk'));
        }

        public function testEmailWithEmail(){
            $this->assertTrue(
                $this->validator->isEmailValid('jimmy@gmail.com'));
        }

        public function testNumberRangeWithString(){
             $this->expectException('Exception', "gotta have numbers");
             $this->validator->isNumberInRangeValid(
                "hello", "there", "jimmy");                   
        }

        public function testNumberRangeExpectFalse(){
            $this->assertFalse($this->validator->isNumberInRangeValid(22, 1, 10));
        }

        public function testNumberRangeExpectTrue(){
            $this->assertTrue($this->validator->isNumberInRangeValid(2, 1, 90));
        
        }

        public function tearDown(){
            $this->validator = NULL;
        }
    }

?>
