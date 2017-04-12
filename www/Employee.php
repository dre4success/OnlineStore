<?php

	abstract class Employee {

		protected $name;
		protected $age;
		//protected $weeklyPayment;
		protected $employeeStatus;


		public function __construct($name, $age, $employeeStatus){

			$this->name = $name;
			$this->age = $age;
			//$this->weeklyPayment = $weeklyPayment;
			$this->employeeStatus = $employeeStatus;
		}

		public function getName() {

			return $this->name;
		}

		public function getAge() {

			return $this->age;
		}

		public function getEmpStatus() {

			return $this->employeeStatus;
		}

		abstract public function modeOfPayment();
		
		abstract public function getSalary();
	}