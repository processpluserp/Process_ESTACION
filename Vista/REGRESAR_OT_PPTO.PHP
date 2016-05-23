<?PHP	
	ini_set('memory_limit', '512M');
	ini_set('max_execution_time','360');
	$user = 'pr1';
	$pass = '1234';
	$server = 'COMTOTALSQL01\TORO_LOVE';
	$database = 'Consolidado';
	$connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database"; 
	$conn = odbc_connect($connection_string,$user,$pass);
	if ($conn) {
	} else{
		die("PROBLEMA CON LA CONEXIÓN ".odbc_errormsg());
	}
	
	$c = 2;
	$cur=odbc_exec($conn,""); 
					$i = 1;
					while(odbc_fetch_row($cur)){
						$codigo_cliente = odbc_result($cur,"codigo_cliente");
					}
	
?>