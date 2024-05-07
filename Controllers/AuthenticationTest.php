<?php

class User
{
    private $username;
    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }
}

// z(Lớp chứa logic xác thực)
class AuthService
{
    public function authenticate(User $user)
    {
        // Logic xác thực ảo
        // Ở đây, tạo ra 1 danh sách ảo để test.
        //Trong ứng dụng thực tế, điều này sẽ bao gồm kiểm tra thông tin đăng nhập với cơ sở dữ liệu hoặc hệ thống xác thực khác.
        $array = [
            [
                'username' => 'phucn1435',
                'password' => 'phuc29'
            ],
            [
                'username' => 'huyen2882',
                'password' => 'huyen123'
            ],
            [
                'username' => 'suongmm282',
                'password' => 'suongm2'
            ],
            [
                'username' => 'kien2323',
                'password' => 'kien1'
            ]
        ];
        $flag = 0;
        foreach ($array as $item) {
            if ($item['username'] === $user->getUsername() && $item['password'] === $user->getPassword()) {
                $flag = 1;
                break;
            }
        }

        if ($flag === 1) {
            return true;
        }

        return false;
    }
}

// File: AuthServiceTest.php (Tệp kiểm thử PHPUnit)
use PHPUnit\Framework\TestCase;

class AuthenticationTest extends TestCase
{
    public function testAuthentication()
    {
        // Tạo một đối tượng người dùng giả mạo với thông tin đăng nhập hợp lệ
        $mockUser = $this->createMock(User::class);
        $mockUser->method('getUsername')->willReturn('phucn1433');
        $mockUser->method('getPassword')->willReturn('phuc29');

        // Tạo một đối tượng AuthService
        $authService = new AuthService();

        // Thực hiện xác thực và kiểm tra rằng nó thành công
        $this->assertTrue($authService->authenticate($mockUser), "Tên đăng nhập hoặc mật khẩu không đúng");
    }


}
