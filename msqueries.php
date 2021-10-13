.
Using PHP to Connect to Microsoft SQL Server

Introduction | Getting Started | Limitations | More on Data Types | Troubleshooting
Example MS SQL Server Setup

We were able to set up MS SQL Server 2005 Express (free download) and connect to it via PHP by the following steps. There are several versions of MS SQL Server, so additional configuration may be required for other versions.

    Install MS SQL Server 2005 Express.
    Set up a database and table.
    Set up a SQL user.
    Enable Mixed Authentication.
    Add permissions on the database for the created user.
    Add permissions on the table for the created user.
    Access the Server according to the steps outlined below.

Connecting to a MS SQL Server database with PHP

Connecting to a MS SQL Server database with PHP is very similar to connecting to a MySQL database. The following example demonstrates how to connect to a MS SQL database from PHP. Note that the function names contain mssql, not mysql.

<?php
$host ="xxx.xxx.xxx.xxx"; 
$username ="username";
$password ="password";
$database ="database";

mssql_connect($host, $username, $password);
mssql_select_db($database);
?>

Running MS SQL Queries from PHP

Many of the MS SQL functions in PHP are the same as those for MySQL, except that mysql is replaced by mssql in the function name. See the full list of MS SQL functions in PHP at php.net.

The following script is an example of an MS SQL SELECT query run from PHP.

<?php
$query ="SELECT col1,col2 FROM tablename";
$result =mssql_query($query);
while ( $record = mssql_fetch_array($result) )
{
	echo $record["col1"] .", ". $record["col2"] ."<br />";
}
?>

And here are two simple example scripts that demonstrate UPDATE and INSERT queries

<?php
$query ="UPDATE tablename SET
	col1 = 15,
	col2 = 'Hello, World!'"
$result =mssql_query($query);
?>

<?php
$query ="INSERT INTO tablename
	(col1,col2)
	VALUES(16,'Hello, again!')";
$result =mssql_query($query);
?>


