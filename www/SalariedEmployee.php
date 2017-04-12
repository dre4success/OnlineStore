<?php
	
		class SalariedEmployee extends Employee{

			private $fixedSalary;

			public function __construct($fx, $name, $age, $employeeStatus) {

				Parent::__construct($name, $age, $employeeStatus);

				$this->fixedSalary = $fx;
			}

			public function getSalary() {

				return $this->fixedSalary;
			}

			public function modeOfPayment() {

				echo "<p> Employee Name: ". $this->getName(). "</p>";
				echo "<p> Employee Age: ". $this->getAge(). "</p>";
				echo "<p> Employee Status: ". $this->getEmpStatus()."</p>";
				echo "<p> Employee Salary: ". $this->getSalary()."</p>";

			}
		}
