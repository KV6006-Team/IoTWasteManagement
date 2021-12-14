<?php
	//include functions.php code to this file
	require_once('functions.php');

	//echo page start html contents
	echo makePageStart("Waste Management Services", "IoTAss2.css");
	
	//check user is logged-in using the check_login() function.
	//if(check_login()){
		//echo page structure for logged in user, displaying header with a logout button and navigation links with chooseBook.php included.
		echo makeHeader("Waste Management Services");
		
		echo <<<EOT
<style>
.red{
    color: red;
}
.orange{
    color: orange;
}
.green{
    color: green;
}
</style>
EOT;

		echo startMain();

        echo "
            
            ";

		echo "<body>
				<select id='locSelect' name='locationName' onchange='updatePage()'>
					<option value='cis'>CIS</option>
					<option value='ela'>ELB A</option>
					<option value='elb'>ELB B</option>
				</select>
	
				<div id='table'>

				</div>
			  </body>";

		
		echo "<script type='text/javascript' src='updateData.js'></script>";

	//close any main tag, generate the footer and close remaining tags.
	echo endMain();
	echo makeFooter("Wastebin Management 2021");
	echo makePageEnd();
?>

