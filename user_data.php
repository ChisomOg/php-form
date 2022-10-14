<?php
//index.php

$nameErr = $emailErr  = $dateofbirthErr = $genderErr = $countryErr = "";
$name = '';
$email = '';
$dateofbirth = '';
$gender = '';
$country = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $nameErr .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }

 if(empty($_POST["email"]))
 {
  $emailErr .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }

 if(empty($_POST["dateofbirth"]))
 {
  $dateofbirthErr .= '<p><label class="text-danger">Subject is required</label></p>';
 }
 else
 {
  $dateofbirth = clean_text($_POST["dateofbirth"]);
 }
 
 if(empty($_POST["gender"]))
 {
  $genderErr .= '<p><label class="text-danger">Message is required</label></p>';
 }
 else
 {
  $gender = clean_text($_POST["gender"]);
 }

 if(empty($_POST["country"]))
 {
  $countryErr .= '<p><label class="text-danger">Message is required</label></p>';
 }
 else
 {
  $country = clean_text($_POST["country"]);
 }

 if($error == '')
 {
  $file_open = fopen("userdata.csv", "a");
  $no_rows = count(file("userdata.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'sr_no'  => $no_rows,
   'name'  => $name,
   'email'  => $email,
   'dateofbirth' => $dateofbirth,
   'gender' => $gender,
   'country' => $country
  );
  fputcsv($file_open, $form_data);
  print_r($form_data);
  $error = '<label class="text-success">Thank you for contacting us</label>';
  $name = '';
  $email = '';
  $dateofbirth = '';
  $gender = '';
  $country = '';
 }
}