<?php
	
		class CommisionEmployee extends Employee{

			private $sales;
			private $salary;

			public function __construct($sl, $name, $age, $employeeStatus) {

				Parent::__construct($name, $age, $employeeStatus);

				$this->sales = $sl;
			}

			public function getSalary() {

				$this->salary = $this->sales * 0.01;

				return $this->salary;
			}

			public function modeOfPayment() {

				echo "<p> Employee Name: ". $this->getName(). "</p>";
				echo "<p> Employee Age: ". $this->getAge(). "</p>";
				echo "<p> Employee Status: ". $this->getEmpStatus()."</p>";
				echo "<p> Employee Salary: ". $this->getSalary()."</p>";

			}
		}
