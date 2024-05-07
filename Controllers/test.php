<?php 

interface Salary {
    public function calcSalary($a, $b);
}

class calcSalary implements Salary {
    public function calcSalary($a, $b) {
        echo $a + $b;
    }
}

class Service {
    private $salary;
    public function __construct(Salary $salary) {
        $this->salary = $salary;
    }

    public function doSomeThing() {
        $this->salary->calcSalary(1,2);
    }
}

$sala = new calcSalary();
$service = new Service($sala);
$service->doSomeThing();

?>