<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		$host = "192.168.20.4";
		$user = "MDI";
		$pass = "gvH,fuwv";

		$objConnect = mssql_connect($host,$user,$pass);
		if($objConnect)
		{
		echo "Database Connected.";
		}
		else
		{
		echo "Database Connect Failed.";
		}
		mssql_close($objConnect);


		// $servername = '192.168.20.4'; //​กำ​หนดชื่อ​ server
		// $databasename = 'a1'; //​กำ​หนดชื่อ​ database ​บน​ Microsoft SQL
		// $user = 'MDI'; //​กำ​หนดชื่อ​ user name ​ที่​จะ​ connect database
		// $pass = 'gvH,fuwv'; //​กำ​หนด​ password ​ที่​จะ​ connect ​ไปที่​ database
		// $connection_string = "DRIVER={SQL Server};SERVER=$servername;DATABASE=$databasename;AutoTranslate=no"; //​เป็น​การกำ​หนด​ connection string ​ใน​การ​ connect ODBC
		// $cid = odbc_connect($connection_string,$user, $pass) or die (”​เชื่อม​ไม่​ได้​”);

		

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */