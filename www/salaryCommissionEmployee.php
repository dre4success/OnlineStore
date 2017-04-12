<?php

	class salaryCommission extends Employee {

	 	private	$baseSalary;
	 	private $sales;
	 	private $salary;

	 		public function __construct($bs, $sl, $name, $age, $employeeStatus) {


	 			Parent::__construct($name, $age, $employeeStatus);

	 			$this->baseSalary = $bs;
	 			$this->sales = $sl;
	 		}

	 		public function getSalary() {

	 			$this->salary = $this->baseSalary + ($this->sales * 0.01);

	 			return $this->salary;
	 		}

	 		public function currentPayPeriod() {

	 			$this->salary = $this->baseSalary + ($this->baseSalary * 0.1) + ($this->sales * 0.01);

	 			return $this->salary;
	 		}

	 		public function modeOfPayment() {

	 			echo '<p> Employee Name: '.$this->getName().'</p>';
	 			echo '<p> Employee Age: '.$this->getAge().'</p>';
	 			echo '<p> Employee Status: '.$this->getEmpStatus().'</p>';
	 			echo '<p> Employee Salary: '.$this->getSalary().'</p>';
	 			echo '<p> Employee Pay For Current Period: '.$this->currentPayPeriod().'</p>'; 
	 		}

	}