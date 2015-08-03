<?php
//survey_view
/**
 * demo_idb.php is both a test page for your IDB shared mysqli connection, and a starting point for 
 * building DB applications using IDB connections
 *
 * @package nmCommon
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 2.09 2011/05/09
 * @link http://www.newmanix.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see config_inc.php  
 * @see header_inc.php
 * @see footer_inc.php 
 * @todo none
 */
# '../' works for a sub-folder.  use './' for the root
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials
spl_autoload_register('MyAutoLoader::NamespaceLoader');

$config->titleTag = smartTitle(); #Fills <title> tag. If left empty will fallback to $config->titleTag in config_inc.php
$config->metaDescription = smartTitle() . ' - ' . $config->metaDescription; 



//END CONFIG AREA ---------------------------------------------------------- 

# check variable of item passed in - if invalid data, forcibly redirect back to demo_list.php page
if(isset($_GET['id']) && (int)$_GET['id'] > 0){#proper data must be on querystring
	 $myID = (int)$_GET['id']; #Convert to integer, will equate to zero if fails
}else{
	myRedirect(VIRTUAL_PATH . "surveys/index.php");
}

get_header(); #defaults to header_inc.php
?>
<h3 align="center">Survey View</h3>
<?php

$mySurvey = new SurveySez\Survey($myID);
//dumpDie($mySurvey);

if($mySurvey->isValid)
{//if the survey exsits, show data
	echo '<p>Survey Title:<b>' . $mySurvey->Title . '</b></p>';
	$mySurvey->showQuestions();
}
else{//appologise
	echo '<div>There appears to be no such survey</div>';
}

get_footer(); #defaults to footer_inc.php
