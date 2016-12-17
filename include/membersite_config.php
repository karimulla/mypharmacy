<?PHP
require_once("./include/fg_membersite.php");

$fgmembersite = new FGMembersite();

//Provide your site name here
$fgmembersite->SetWebsiteName('mypharmacytest.azurewebsites.net');

//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('user11@user11.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$fgmembersite->InitDB(/*hostname*/'mypharmacytest.database.windows.net',
                      /*username*/'sqladmin',
                      /*password*/'admin123!',
                      /*database name*/'mypharmacytest2',
                      /*table name*/'dbo.SalesMen');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$fgmembersite->SetRandomKey('qSRcVS6DrTzrPvr');

?>