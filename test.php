<?php


/*

$myServer = "SQL5031.SmarterASP.NET";
$myUser = "DB_A0FDB5_mirakql_admin";
$myPass = "mirakql1";
$myDB = "db_a0fdb5_mirakql"; 

//connection to the database
$dbhandle = mssql_connect($myServer, $myUser, $myPass)
  or die("Couldn't connect to SQL Server on $myServer"); 

//select a database to work with
$selected = mssql_select_db($myDB, $dbhandle)
  or die("Couldn't open database $myDB"); 

//declare the SQL statement that will query the database
$query = "SELECT ClientID, ClientName";
$query .= "FROM dbo.Clients ";


//execute the SQL query and return records
$result = mssql_query($query);

$numRows = mssql_num_rows($result); 
echo "<h1>" . $numRows . " Row" . ($numRows == 1 ? "" : "s") . " Returned </h1>"; 

//display the results 
while($row = mssql_fetch_array($result))
{
  echo "<li>" . $row["id"] . $row["name"] . $row["year"] . "</li>";
}
//close the connection
mssql_close($dbhandle);

*/


$serverName = "SQL5031.SmarterASP.NET"; //serverName\instanceName
$connectionInfo = array( "Database"=>"db_a0fdb5_mirakql", "UID"=>"DB_A0FDB5_mirakql_admin", "PWD"=>"mirakql1");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$rowsPerPage = 10;



$tsql = "SELECT COUNT(ManufactureID) FROM dbo.Manufactures"; 
/* Execute the query. */ 
$stmt = sqlsrv_query($conn, $tsql); 
if($stmt === false) 
{ 
    echo "Error in query execution."; 
    die( print_r( sqlsrv_errors(), true)); 
}

/* Get the number of rows returned. */ 
$rowsReturned = sqlsrv_fetch_array($stmt); 
if($rowsReturned === false) 
{ 
    echo "Error in retrieving number of rows."; 
    die( print_r( sqlsrv_errors(), true)); 
} 
elseif($rowsReturned[0] == 0) 
{ 
    echo "No rows returned."; 
} 
else 
{     
    /* Display page links. */ 
    $numOfPages = ceil($rowsReturned[0]/$rowsPerPage); 
    for($i = 1; $i<=$numOfPages; $i++) 
    { 
        $pageNum = "?pageNum=$i"; 
        print("<a href=$pageNum>$i</a>&nbsp;&nbsp;"); 
    } 
    echo "<br/><br/>"; 
}




//display data 

$tsql = "SELECT * FROM (SELECT ROW_NUMBER() OVER(ORDER BY ManufactureID)  AS RowNumber,  ManufactureID,   ManufactureName  FROM dbo.Manufactures)  AS Temp WHERE RowNumber BETWEEN ? AND ?"; 
/* Determine which row numbers to display. */ 
$rowsPerPage = 10;
$lowRowNum = 1; 
$highRowNum = $rowsPerPage; 

if(isset($_GET['pageNum'])) {
  $highRowNum = $_GET['pageNum']  * $rowsPerPage;
  $lowRowNum = $highRowNum - $rowsPerPage +1;  
} 
print $rowsPerPage . "low" . $lowRowNum . "high:" . $highRowNum;

/*
if(isset($_GET['pageNum'])) 
{ 
    $highRowNum = $_GET['pageNum'] * $rowsPerPage; 
    $lowRowNum = $highRowNum – $rowsPerPage + 1; 
} 
else 
{ 
    $lowRowNum = 1; 
    $highRowNum = $rowsPerPage; 
}
*/

/* Set query parameter values. */ 
$params = array(&$lowRowNum, &$highRowNum);

/* Execute the query. */ 
$stmt2 = sqlsrv_query($conn, $tsql, $params); 
if($stmt2 === false) 
{ 
    echo "Error in query execution."; 
    die( print_r( sqlsrv_errors(), true)); 
} 
/* Print table header. */ 
print("<table border='1px'> 
        <tr> 
            <td>Row Number</td> 
            <td>Product Name</td> 
            <td>Product ID</td> 
        </tr>"); 
/* Display results. */ 
while($row = sqlsrv_fetch_array($stmt2) ) 
{ 
    print("<tr> 
            <td>$row[0]</td> 
            <td>$row[1]</td> 
            <td>$row[2]</td> 
          </tr>"); 
}

/* Close table. */ 
print("</table>");




/*

$tsql = "SELECT * FROM (SELECT ROW_NUMBER() OVER(ORDER BY ManufactureID) AS ManufactureID, ManufactureName FROM dbo.Manufactures) AS TEST WHERE RowNumber BETWEEN ? AND ? + 1";

$stmt = $conn->prepare($tsql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

if(isset($_GET['lowRowNum']) && isset($_GET['highRowNum'])) 
{ 
    $lowRowNum = $_GET['lowRowNum']; 
    $highRowNum = $_GET['highRowNum']; 
} 
else 
{ 
    $lowRowNum = 1; 
    $highRowNum = $rowsPerPage; 
}

$stmt->execute(array($lowRowNum, $highRowNum));
while( $obj = sqlsrv_fetch_object($stmt)) {
    print_r($obj);
    //print $obj->ManufactureID . "name ::" . $obj->ManufactureName;
    //print "<br/>";
}

*/


/*
$tsql = "SELECT * FROM ( SELECT ROW_NUMBER() OVER (ORDER BY ManufactureID) AS  ManufactureID, ManufactureName FROM dbo.Manufactures  AS TEST WHERE ManufactureID BETWEEN ? AND ? + 1";

if(isset($_GET['lowRowNum']) && isset($_GET['highRowNum'])) {
  $lowRowNum = $_GET['lowRowNum'];
  $highRowNum = $_GET['highRowNum'];
} else {
  $lowRowNum = 1;
  $highRowNum = $rowsPerPage;
}
$params = array(&$lowRowNum, &$highRowNum);

if($result = sqlsrv_query($conn, $tsql, $params, array("Scrollable" => "keyset" )) !== false) {  
  while( $obj = sqlsrv_fetch_object($result)) {
    print_r($obj);
    //print $obj->ManufactureID . "name ::" . $obj->ManufactureName;
    //print "<br/>";
  }
} else{
    die(print_r(sqlsrv_errors(), true));
}

*/

/*
SELECT ManufactureID, ManufactureName FROM dbo.Manufactures 
if ($conn){
    echo "connected";
    if(($result = sqlsrv_query($conn,"SELECT * from dbo.Clients")) !== false){
        while( $obj = sqlsrv_fetch_object( $result )) {
             print $obj->ClientID . "name ::" . $obj->ClientName;
              print "<br/>";

        }
    }
}else{
    die(print_r(sqlsrv_errors(), true));
}
*/

?>







