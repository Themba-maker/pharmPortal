<?php
class FunPatient  
{    
    public function __construct(){
		
    }

	
    public function addUser($con,$idNumber,$fname, $lname, $cellNumber, $email, $passwords, $role) {
		
		$password = password_hash($passwords, PASSWORD_DEFAULT);
		    $checkIdnumber = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM tblpatient WHERE id_number = '$idNumber'"));
			$checkMail = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM tblpatient WHERE email = '$email'"));
		if(isset($checkIdnumber)) 
		{
			return "ID number already exist";
		} elseif(isset($checkMail)){
			return "email address already exist";
		}else{
//--------------------------------------------------------------	produce random code	
					if($role=="patient")
					{
						$len = 6;
					}
					else
					{
						$len = 4;
					}
								$bigL ="01234567890123456789";
								$smallL="01234567890123456789";
								$numbers = "0123456789";

								$BigL =str_shuffle($bigL);
								$SmallL =str_shuffle($smallL);
								$numberS = str_shuffle($numbers);

								$sub1 = substr($BigL,0,5);
								  $sub2 = substr($BigL,6,5);
								  $sub3 = substr($BigL,10,5);
								  $sub4 = substr($SmallL,0,5);
								  $sub5 = substr($SmallL,6,5);
								  $sub6 = substr($SmallL,10,5);
								  $sub7 = substr($numberS,0,4);
								  $sub8 = substr($numberS,5,3);
								  $sub9 = substr($numberS,8,3);

								  $randCode1=str_shuffle($sub1.$sub2.$sub3.$sub4.$sub5.$sub6.$sub7.$sub8.$sub9);
								  $randCode2=str_shuffle($randCode1);
								 $randCode=$randCode1.$randCode2;
                                          if($len==6){
							  $patientCd ="220".substr($randCode,0,$len);
										  }else{
											  $patientCd ="20".substr($randCode,0,$len);
										  }
			//--------------------------------------------------------------
 			$sql = "INSERT INTO tbllogin(patient_code,pwd,role) VALUES('$patientCd','$password','$role')";
			$sqlUser = "INSERT INTO tblpatient(patient_code,fname,lname,id_number,email,cell) VALUES('$patientCd','$fname','$lname','$idNumber','$email','$cellNumber')";
			if(mysqli_query($con,$sql) AND mysqli_query($con,$sqlUser)) {	
			 return "Successfully registered           user Code: ".$patientCd;
			} else  {
				
				return "Unsuccessfully registered. ";
			}
		}
    }

	
 	 public function signin($username, $password, $con, $userRole) {		
        $result = mysqli_query($con,"SELECT l.patient_code, l.pwd,l.role,p.fname,p.lname,p.id_number,p.email,p.cell FROM tbllogin l, tblpatient p where l.patient_code = '$username' OR p.email = '$username'");
		if($row = mysqli_fetch_array($result)){
			if(password_verify($password, $row["pwd"])){
					$role = $row["role"];
					$_SESSION["role"] = $row["role"];
					$_SESSION["patientCd"] = $row["patient_code"];
					$_SESSION["id"] = $row["id_number"];
					$_SESSION["firstname"] = $row["fname"];
					$_SESSION["lastname"] = $row["lname"];
					$_SESSION["email"] = $row["email"];
					$_SESSION["cellNumber"] = $row["cell"];
					$_SESSION["password"] = $row["pwd"];						 
					if ($userRole == $role) {
						if($role == 'admin'){	
							return array('status' =>true,'page' => 'admin.php');
						} else {
							return array('status' =>true,'page' => 'patient.php');
						}
					} else {
						if ($userRole == "admin") {
							return array('status' =>false,'message' => 'User not found as a staff');
						} else {
							return array('status' =>false,'message' => 'User not found as a patient');
						}
				
			}
			}
			else
			{
				return array('status' =>false,'message' => 'Wrong password!!!!');
			}
        }
		else
		{
			return array('status' =>false,'message' => 'Wrong patient number!!!!');
		}
	}
		//-------------------------------

		public function getallPatients($con,$role) {
		if($role=="patient")
		{
        $sql = "SELECT l.patient_code, l.pwd,l.role,p.fname,p.lname,p.id_number,p.email,p.cell FROM tbllogin l, tblpatient p where p.patient_code = l.patient_code AND l.role NOT LIKE '%admin%'";
		$check = mysqli_fetch_array(mysqli_query($con,$sql));
		$result = array();
		if(isset($check)){
			$result = $con->query($sql);
		}
		return $result;
		}else{
			   $sql = "SELECT l.patient_code, l.pwd,l.role,p.fname,p.lname,p.id_number,p.email,p.cell FROM tbllogin l, tblpatient p where p.patient_code = l.patient_code AND l.role NOT LIKE '%patient%'";
		$check = mysqli_fetch_array(mysqli_query($con,$sql));
		$result = array();
		if(isset($check)){
			$result = $con->query($sql);
		}
		return $result;
		}
    }
	//-------------------------------
		//-------------------------------

		public function addBooking($con,$date,$time,$pCode) {
			    
				
				 $sql = "SELECT * FROM tblappointment WHERE appoint_date = '$date'  AND patient_code = '$pCode'";
		         $check = mysqli_fetch_array(mysqli_query($con,$sql));
				 
				  $sqls = "SELECT * FROM tblappointment WHERE appoint_date = '$date' AND  appoint_time = '$time'";
		         $result = mysqli_fetch_array(mysqli_query($con,$sqls));
					if(isset($check)){
			
                       return "There's already an appointment booked for you on this day";  
					}
					elseif(isset($result))
					{
				    return "This Time Slot is already booked";  

					}
                    else{
						$sql = "INSERT INTO tblappointment(patient_code,appoint_date,appoint_time) VALUES('$pCode','$date','$time')";
						if(mysqli_query($con,$sql)) {
				            return "Appointment successfuly Booked";
				          } else  {
				                   return "Appointment could not be Booked";
			                      }
					
					    }
        
    }
	
	public function getAppointments($con,$pCode)
	{
        $sql = "SELECT id,appoint_date,appoint_time FROM tblappointment WHERE patient_code = '$pCode'";
		$check = mysqli_fetch_array(mysqli_query($con,$sql));
		$result = array();
		if(isset($check)){
			$result = $con->query($sql);
		}
		return $result;
	}
		public function getAllAppointments($con)
	{
        $sql = "SELECT id,appoint_date,appoint_time,patient_code FROM tblappointment ORDER BY appoint_date";
		$check = mysqli_fetch_array(mysqli_query($con,$sql));
		$result = array();
		if(isset($check)){
			$result = $con->query($sql);
		}
		return $result;
	}
	
		public function cancelAppointment($con,$id){
        $sql = "DELETE from tblappointment where id ='$id'";
		if ($con->query($sql) == TRUE ) {
			return "Appointment Successfully cancelled";
		} else {
			return "Appointment unsuccessfully cancelled";
		}
    }
	
	
		public function deletePatient($con, $pCode){
        $sql = "DELETE from tblpatient where patient_code ='$pCode'";
		$sqlLogin = "DELETE from tbllogin where patient_code ='$pCode'";
		$sqlAppoint = "DELETE from tblappointment where patient_code ='$pCode'";
		
		if ($con->query($sql) == TRUE AND $con->query($sqlLogin) == TRUE AND $con->query($sqlAppoint) == TRUE ) {
			return "Patient is successfully deleted";
		} else {
			return "Patient is unsuccessfully deleted";
		}
    }
	
	public function recoverCode($con,$id,$pwd)
	{
	
		 $result = mysqli_query($con,"SELECT * FROM tbllogin");
		if($row = mysqli_fetch_array($result)){
			if(password_verify($pwd, $row["pwd"])){
				$pass=1;
			}
			else{
				$pass=0;
			}
		}
	
		if($pass==1)
		{
			$check = mysqli_query($con,"SELECT patient_code from tblpatient where id_number='$id' ");
					if($row = mysqli_fetch_array($check)){
						$userCode = $row["patient_code"];
						 
						return "User Code ".$userCode; ;
					}
		      else{
						return "User not found" ;
		           }
        }
	}

}