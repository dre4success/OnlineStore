<?php

	class hourlyEmployee extends Employee{

			private $hourlySalary;
			private $hour;
			private $salary;
			private $expectedHours = 40;
			

			public function __construct($hr, $hx, $name, $age, $employeeStatus) {

				Parent::__construct($name, $age, $employeeStatus);


				$this->hourlySalary = $hx;
				$this->hour = $hr;

			}

			public function getSalary() {
				$overtime = 0;
				if($this->hour > $this->expectedHours) {
					$overtime = $this->hour - $this->expectedHours;
					$this->salary = ($this->hourlySalary * $this->expectedHours) + ($overtime * $this->hourlySalary);
				} else {

					$this->salary = ($this->hourlySalary * $this->expectedHours);		
				}

				return $this->salary;
			} 

			public function modeOfPayment() {

				echo "<p> Employee Name: ". $this->getName(). "</p>";
				echo "<p> Employee Age: ". $this->getAge(). "</p>";
				echo "<p> Employee Status: ". $this->getEmpStatus()."</p>";
				echo "<p> Employee Salary: ". $this->getSalary()."</p>";

			}
		}