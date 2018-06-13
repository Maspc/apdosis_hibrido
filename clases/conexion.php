<?php
	class conexion {	
		public static function dbCon($dbConect = ''){
			@session_start();
			if ($dbConect==''){
				$bd = 'farma';
				} else {
				$bd = $dbConect;
			}
			$host = 'localhost';
			$user = 'imssisc';
			$pass = "IIMS*2013*%";
			
			$con= mysqli_connect($host,$user,$pass,$bd) or trigger_error(mysqli_error(),E_USER_ERROR);		
			return $con;
		}
		
		public static function trSql($sqSelect,$sqInsert,$sqUpdate,$dbConect=''){
			conexion::dbCon($dbConect);
			if (!empty($sqSelect)){
				if (conexion::cantRow($sqSelect)>0){
					$rows = conexion::trQry($sqUpdate);
					} else {
					$rows = conexion::trQry($sqInsert);
				}
				return $rows;
			}
		}
		
		public static function trQry($Qry,$dbConect=''){
			$con = conexion::dbCon($dbConect);
			$rows = mysqli_query($con, $Qry)or trigger_error(mysqli_error(),E_USER_ERROR);
			mysqli_close($con);
			return $rows;
		}
		
		public static function trQryId($Qry,$dbConect=''){
			$con = conexion::dbCon($dbConect);
			$rows = mysqli_query($con, $Qry)or trigger_error(mysqli_error(),E_USER_ERROR);
			$rowid = mysqli_insert_id($con);
			mysqli_close($con);
			return $rowid;
		}
		
		public static function sqlGet($sql,$dbConect=''){
			$con = conexion::dbCon($dbConect);
			if(!empty($sql)){
				$return = array();
				$query = mysqli_query($con, $sql)or trigger_error(mysqli_error(),E_USER_ERROR);		
				for($a=0;$a<mysqli_num_rows($query);$a++){
					$return[$a] = mysqli_fetch_object($query); 
				}
				mysqli_free_result($query);
				mysqli_close($con);
				return $return;
			}
		}	
		
		public static function cantRow($sql,$dbConect=''){
			$con = conexion::dbCon($dbConect);
			if(!empty($sql)){
				$query = mysqli_query($con, $sql)or trigger_error(mysqli_error(),E_USER_ERROR);
				$rows = mysqli_num_rows($query);
				
				mysqli_free_result($query);
				mysqli_close($con);
				return $rows;
			}
		}
		
	}
?>