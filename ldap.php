<?PHP
	//define('GEP', 'GEP.com.sv');
    //define('DN', 'dc=GEP,dc=com,dc=sv');
	// ejemplo de autenticación
	$username = 'GEP\Pc.Damian.Mosquera';
$password = 'Pilo.2536';
$ldapconfig['host'] = '172.16.1.10';
$ldapconfig['port'] = 389;
$ldapconfig['basedn'] = 'dc=domain,dc=com';

$ds=ldap_connect($ldapconfig['host'], $ldapconfig['port']);
ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

$dn="cn=".$username.",ou=Technology,".$ldapconfig['basedn'];
/*
if ($bind=ldap_bind($ds, $dn, $password)) {
    echo("Login correct");
} else {
    echo("Login incorrect");
}*/


//CN:NOMBRE COMUN
//OU UNIDAD ORGANIZATIVA
//DC COMPONENTE DE DOMINIO

/*
------------------------------ 
CN commonName 
L LocalityName 
ST stateOrProvinceName 
O OrganizationName 
OU organizationalUnitName 
C countryName 
CALLE streetAddress 
DC domainComponent 
identificación de usuario UID
*/

$ldapconn = ldap_connect($ldapconfig['host'], $ldapconfig['port'])
          or die("Could not connect to ".$ldapconfig['host']);
$dn = "o=My Company, c=US";
$person  = "damian";
$filter="(|(sn=$person*)(givenname=$person*))";
$justthese = array("ou", "sn", "givenname", "mail");

$sr=ldap_search($ds, $dn, $filter, $justthese);

$info = ldap_get_entries($ds, $sr);

echo $info["count"]." entradas devueltas\n";
?>