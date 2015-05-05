<?php
require_once __DIR__ . "/../simpletest/autorun.php";
require_once __DIR__ . "/../app/controllers/helpers.php";

class someTests extends UnitTestCase{

    public function testAverageIsCorrectWithNumbers(){
        $fName = "number";
        $expectedAverage = 4;
        $arrayToTest = array(
            0 => array($fName => 2),
            1 => array($fName => 3),
            2 => array($fName => 7),
            3 => array($fName => 1),
            4 => array($fName => 2),
            5 => array($fName => 9)
        );

        $this->assertEqual(average($arrayToTest, $fName), $expectedAverage);
    }

    public function testAverageWithNotArrayThrowsException(){
        $fakeArray = "this isn't an array!";
        try{
            average($fakeArray, "field");
            $this->fail();
        }
        catch (InvalidArgumentException $e){
            $this->pass();
        }
    }

    public function testAverageWithNullThrowsException(){
        $nullArray = null;
        try{
            average($nullArray, "field");
            $this->fail();
        }
        catch (InvalidArgumentException $e){
            $this->pass();
        }
    }

    public function testAverageWithEmptyArrayThrowsException(){
        $empty = array();
        try{
            average($empty, "field");
            $this->fail();
        }
        catch (InvalidArgumentException $e){
            $this->pass();
        }
    }

    public function testAverageWithWrongFieldTypeThrowsException(){
        $wrongFName = 6;
        $correctFName = "number";

        $arrayToTest = array(
            0 => array($correctFName => 2),
            1 => array($correctFName => 3),
            2 => array($correctFName => 7),
            3 => array($correctFName => 1),
            4 => array($correctFName => 2),
            5 => array($correctFName => 9)
        );

        try {
            average($arrayToTest, $wrongFName);
            $this->fail();
        }
        catch (OutOfBoundsException $e) {
            $this->pass();
        }
    }

    public function testAverageWithWrongFieldNameThrowsException(){
        $wrongFName = "wrong field";
        $correctFName = "number";

        $arrayToTest = array(
            0 => array($correctFName => 2),
            1 => array($correctFName => 3),
            2 => array($correctFName => 7),
            3 => array($correctFName => 1),
            4 => array($correctFName => 2),
            5 => array($correctFName => 9)
        );

        try {
            average($arrayToTest, $wrongFName);
            $this->fail();
        }
        catch (OutOfBoundsException $e) {
            $this->pass();
        }
    }

    public function testAverageWithNonNumbersThrowsException(){
        $fName = "number";

        $arrayToTest = array(
            0 => array($fName => 2),
            1 => array($fName => "this should fail"),
            2 => array($fName => 7),
            3 => array($fName => 1),
            4 => array($fName => 2),
            5 => array($fName => 9)
        );

        try {
            average($arrayToTest, $fName);
            $this->fail();
        }
        catch (UnexpectedValueException $e) {
            $this->pass();
        }
    }

    public function testStdDevIsCorrect(){
        $fName = "number";
        $expectedStdDev = 2.16;

        $arrayToTest = array(
            0 => array($fName => 2),
            1 => array($fName => 4),
            2 => array($fName => 5),
            3 => array($fName => 8)
        );

        $this->assertWithinMargin(stdDev($arrayToTest, $fName), $expectedStdDev, .01);
    }

    public function testStdDevWithNotArrayThrowsException(){
        $fakeArray = "this isn't an array!";
        try{
            stdDev($fakeArray, "field");
            $this->fail();
        }
        catch (InvalidArgumentException $e){
            $this->pass();
        }
    }

    public function testStdDevWithNullThrowsException(){
        $nullArray = null;
        try{
            stdDev($nullArray, "field");
            $this->fail();
        }
        catch (InvalidArgumentException $e){
            $this->pass();
        }
    }

    public function testStdDevWithEmptyArrayThrowsException(){
        $empty = array();
        try{
            stdDev($empty, "field");
            $this->fail();
        }
        catch (InvalidArgumentException $e){
            $this->pass();
        }
    }

    public function testStdDevWithWrongFieldTypeThrowsException(){
        $wrongFName = 6;
        $correctFName = "number";

        $arrayToTest = array(
            0 => array($correctFName => 2),
            1 => array($correctFName => 3),
            2 => array($correctFName => 7),
            3 => array($correctFName => 1),
            4 => array($correctFName => 2),
            5 => array($correctFName => 9)
        );

        try {
            stdDev($arrayToTest, $wrongFName);
            $this->fail();
        }
        catch (OutOfBoundsException $e) {
            $this->pass();
        }
    }

    public function testStdDevWithWrongFieldNameThrowsException(){
        $wrongFName = "wrong field";
        $correctFName = "number";

        $arrayToTest = array(
            0 => array($correctFName => 2),
            1 => array($correctFName => 3),
            2 => array($correctFName => 7),
            3 => array($correctFName => 1),
            4 => array($correctFName => 2),
            5 => array($correctFName => 9)
        );

        try {
            stdDev($arrayToTest, $wrongFName);
            $this->fail();
        }
        catch (OutOfBoundsException $e) {
            $this->pass();
        }
    }

    public function testStdDevWithNonNumbersThrowsException(){
        $fName = "number";

        $arrayToTest = array(
            0 => array($fName => 2),
            1 => array($fName => "this should fail"),
            2 => array($fName => 7),
            3 => array($fName => 1),
            4 => array($fName => 2),
            5 => array($fName => 9)
        );

        try {
            stdDev($arrayToTest, $fName);
            $this->fail();
        }
        catch (UnexpectedValueException $e) {
            $this->pass();
        }
    }


}
?>
