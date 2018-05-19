<?php
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        $name = strip_tags(trim($_POST["name"]));
				$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $old_date =$_POST["dateChoice"];
        $venue=$_POST["venue-list"];
        $myDateTime = DateTime::createFromFormat('Y-m-d', $old_date);
		$date = $myDateTime->format('l dS F Y');
		if ((empty($name) )OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
           
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }
else{
echo "Your message has been sent.";
echo " <br/>Those were your contact details:<br/>Your name is ".$name.".<br/>Your email is ".$email." and you would like to book ".$venue." on ".$date;
     
       }
}
?>
