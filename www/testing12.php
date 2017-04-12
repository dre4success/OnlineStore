<?php


	include 'Employee.php';
	include 'SalariedEmployee.php';
	include 'hourlyEmployee.php';
	include 'commissionedEmployee.php';
	include 'salaryCommissionEmployee.php';

	$emp = new SalariedEmployee(20000, "Dipo Mene", 26, "Fixed Salary Earner");


	echo $emp->modeOfPayment();

	$hor = new hourlyEmployee(60, 1000, "Damo Tosure", 27, "Hourly Salary Earner");

	echo '<br>';

	echo $hor->modeOfPayment(); 

	$comm = new CommisionEmployee(1000000, "New Age", 30, "Commission Salary Earner");

	echo '<br>';

	echo $comm->modeOfPayment();

	$salCom = new salaryCommission(20000, 100000, "Don Jazzy", 35, "Salary Commission Earner");

	echo '<br>';

	echo $salCom->modeOfPayment();