<?php

class Logger {
    public function log($message) {
        echo "Logging: $message\n";
    }
}

class UserService {
    private $logger;

    // Dependency Injection thông qua constructor
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    public function createUser($username) {
        // Logic để tạo người dùng

        // Log thông báo
        $this->logger->log("User '$username' created.");
    }
}

// Tạo đối tượng Logger
$logger = new Logger();

// Tạo đối tượng UserService và chuyển vào Logger thông qua constructor
$userService = new UserService($logger);

// Sử dụng UserService
$userService->createUser("john_doe");

?>