<?php 
class Customer {
    private $name;
    private $email;

    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }

    public function createAccount() {
        // Logic để tạo tài khoản khách hàng
        // ...

        // Trả về true nếu tạo tài khoản thành công, ngược lại trả về false
        return true;
    }
}
use PHPUnit\Framework\TestCase;

class TKTest extends TestCase {
    public function testCreateAccount() {
        // Arrange
        $customer = new Customer('John Doe', 'john@example.com');

        // Act
        $result = $customer->createAccount();

        // Assert
        // $this->assertTrue($result);
        $this->assertFalse($result);
    }

    public function testTrueIsTrue()
{
    $foo = true;
    $this->assertTrue($foo);
}
}


?>