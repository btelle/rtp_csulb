<?php
/**
 * database.php
 *
 * Contains functions like insert to access the database
 * and the results are returned
 *
 * @author Chethan G
 */
	include_once('./config/mysql.config.php');


	Class Database {

		function insert($query='') {
			$result = mysql_query($query);
			$id = mysql_insert_id($result);
			return $id;
		}

		function query($query='') {
			$result = mysql_query($query);
			return $result;
		}

		function dbclose() {
			mysql_close($con);
		}

		function printlog($log, $type = 'error') {
			$fp = fopen($type.'.log', 'w');
			fwrite($fp, $log);
			fclose($fp);
		}
	}

	$db = new Database();
?>