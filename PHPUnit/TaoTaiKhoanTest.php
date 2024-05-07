<?php 
// Calculator.php
class Calculator {
    public function add($a, $b) {
        return $a + $b;
    }

    public function subtract($a, $b) {
        return $a - $b;
    }
}
// CalculatorTest.php
use PHPUnit\Framework\TestCase;

class TaoTaiKhoanTest extends TestCase {

    public function testAdd() {
        $calculator = new Calculator();
        $result = $calculator->add(3, 5);
        $this->assertEquals(8, $result);
    }

    public function testSubtract() {
        $calculator = new Calculator();
        $result = $calculator->subtract(10, 4);
        $this->assertEquals(6, $result);
    }
}

?>