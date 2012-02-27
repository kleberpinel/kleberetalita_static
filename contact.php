<?php 
error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

//If the form is submitted
if(isset($_POST['submitted'])) {
	
	// require a name from user
	if(trim($_POST['contactName']) === '') {
		$nameError =  'Enter a name please.'; 
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}
	
	// need valid email
	if(trim($_POST['email']) === '')  {
		$emailError = 'Enter a valid emal address please.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
		
	// we need at least some content
	if(trim($_POST['comments']) === '') {
		$commentError = 'You forgot to enter a message!';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}
		
	// upon no failure errors let's email now!
	if(!isset($hasError)) {
		
		$emailTo = 'niels_dc@skynet.be';
		$subject = 'Submitted message from '.$name;
		$sendCopy = trim($_POST['sendCopy']);
		$body = "Name: $name \n\nEmail: $email \n\nMessage: $comments";
		$headers = 'From: ' .' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
        
        // set our boolean completion value to TRUE
		$emailSent = true;
	}
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
       <meta charset="utf-8"/>
       <title>Exquisito - Contact</title>
       
       <!-- STYLESHEET -->
       <link href="css/style.css" rel="stylesheet" type="text/css" />
       <link href="css/fancybox.css" rel="stylesheet" type="text/css" />
       <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
	   
       <!-- JAVASCRIPTS -->
       <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js" type="text/javascript"></script>
       <script src="js/functions.js"></script>
       <script src="js/jquery.placeholder.min.js"></script>
	   <script src="js/jquery.twitter.js"></script>
	   <script src="js/jquery.fancybox.js"></script>
	   
       <!--[if IE]>
       		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
       <![endif]-->
       
       <!--[if lt IE 9]>
               <link rel="stylesheet" type="text/css" href="css/ie.css" />
       <![endif]-->
       
       <script type="text/javascript">
       	<!--//--><![CDATA[//><!--
       	$(document).ready(function() {
       		$('form#contact-us').submit(function() {
       			$('form#contact-us .error').remove();
       			var hasError = false;
       			$('.requiredField').each(function() {
       				if($.trim($(this).val()) == '') {
       					var labelText = $(this).prev('label').text();
       					$(this).parent().append('<span class="error">Please enter a '+labelText+'.</span>');
       					$(this).addClass('inputError');
       					hasError = true;
       				} else if($(this).hasClass('email')) {
       					var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
       					if(!emailReg.test($.trim($(this).val()))) {
       						var labelText = $(this).prev('label').text();
       						$(this).parent().append('<span class="error">You\'ve entered an invalid '+labelText+'.</span>');
       						$(this).addClass('inputError');
       						hasError = true;
       					}
       				}
       			});
       			if(!hasError) {
       				var formInput = $(this).serialize();
       				$.post($(this).attr('action'),formInput, function(data){
       					$('form#contact-us').slideUp("fast", function() {				   
       						$(this).before('<span class="box green">Your message has been send. We will contact you as soon as possible.</p>');
       					});
       				});
       			}
       			
       			return false;	
       		});
       	});
       	//-->!]]>
       </script>

</head>
<body>

	<div class="main">
	
		<nav class="header">
		
			<h1 class="logo">Exquisito</h1>
			
			<ul class="mainnav">
				<li><a href="index.html">Home</a>
					<ul class="subnav">
						<li><a href="index.html">Caroufredsel</a></li>
						<li><a href="index2.html">Nivo Slider</a></li>
					</ul>
				</li>
				<li><a href="#">Menu</a>
					<ul class="subnav">
						<li><a href="menu_breakfast.html">Breakfast</a></li>
						<li><a href="menu_lunch.html">Lunch</a></li>
						<li><a href="menu_dinner.html">Dinner</a></li>
						<li><a href="menu_desserts.html">Desserts</a></li>
					</ul>
				</li>
				<li><a href="events.html">Events</a></li>
				<li><a href="blog.html">Blog</a>
					<ul class="subnav">
						<li><a href="blog-single.html">Blog Single</a></li>
						<li><a href="blog-grid.html">Blog Grid Style</a></li>
						<li><a href="blog-2.html">Blog style 2</a></li>
					</ul>
				</li>
				<li><a href="#">Pages</a>
					<ul class="subnav">
						<li><a href="about.html">About</a></li>
						<li><a href="page-full.html">Full Width</a></li>
						<li><a href="page-typo.html">Typography</a></li>
						<li><a href="page-codes.html">Shortcodes</a></li>
					</ul>
				</li>
				<li><a href="contact.php" class="active">Contact</a></li>
			</ul><!-- END MAIN NAVIGATION -->
		
		</nav> <!-- END HEADER -->
		
		<div class="top">
		
			<h2>Contact</h2>
		
		</div> <!-- END TOP -->
		
		<div class="clearfix"></div>
		
		<div class="page contact">
		
			<h2 class="pageheader">Let's get in touch</h2>
			
			<p>Cras mattis consectetur purus sit amet fermentum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec ullamcorper nulla non metus auctor fringilla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
			
			<div class="contact-form">
				
					<?php if(isset($hasError) || isset($captchaError) ) { ?>
						<p class="alert">An error occured.</p>
					<?php } ?>
					
					<form id="contact-us" action="contact.php" method="post">
					
						<div class="formblock">
							<label class="screen-reader-text">Name</label>
							<input type="text" name="contactName" id="contactName" class="txt requiredField" placeholder="Name" />
							<?php if($nameError != '') { ?>
								<span class="error"><?php echo $nameError;?></span> 
							<?php } ?>
						</div>
						        
						<div class="formblock">
							<label class="screen-reader-text">Email</label>
							<input type="text" name="email" id="email" class="txt requiredField email" placeholder="Email address" />
							<?php if($emailError != '') { ?>
								<span class="error"><?php echo $emailError;?></span>
							<?php } ?>
						</div>
						        
						<div class="formblock">
							<label class="screen-reader-text">Message</label>
							<textarea name="comments" id="commentsText" class="txtarea requiredField" placeholder="Message"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							<?php if($commentError != '') { ?>
								<span class="error"><?php echo $commentError;?></span> 
							<?php } ?>
						</div>
					        
					<button name="submit" type="submit" class="button-large orange btn">Send</button>
					<input type="hidden" name="submitted" id="submitted" value="true" />
					
				</form>  <!-- END FORM -->	
						
			</div> <!-- END CONTACT FORM -->
			
		</div> <!-- END PAGE -->
		
		<div class="sidebar">
		
			<h3 class="info-head">Contact Details</h3>
			
			<ul class="address">
				<li class="phone">+(32) 15 467 865</li>
				<li class="info"><a href="http://maps.google.be/maps?f=q&amp;source=s_q&amp;hl=nl&amp;geocode=&amp;q=New+York+City,+New+York,+Verenigde+Staten&amp;aq=0&amp;sll=50.967069,4.506993&amp;sspn=0.015635,0.024784&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=New+York+City,+New+York,+Verenigde+Staten&amp;t=m&amp;z=11&amp;ll=40.714353,-74.005973&amp;output=embed" class="fancybox.iframe fancybox">Check the map</a></li>
			</ul>
			
			<h3 class="tweet-head">Latest Tweets</h3>
			<div class="latest_tweet">
				<div class="loading"></div>
			</div>
		
		</div> <!-- END SIDEBAR -->
					
		<div class="clearfix"></div>
		
		<div class="newsletter">
		
			<h2>Subscribe to our newsletter</h2>
			<input type="text" id="text" class="txt" placeholder="Email address">
			<input type="button" id="submit" class="btn button-large orange" value="Subscribe">
		
		</div> <!-- END NEWSLETTER -->
		
	</div> <!-- END MAIN -->
	
	<footer class="footer">
	
		<div class="ft-box meetteam">
		
			<h2>Meet the team</h2>
			
			<p>Maecenas sed diam eget risus varius blandit sit amet non magna. Curabitur blandit tempus porttitor. Maecenas faucibus mollis interdum. Donec ullamcorper nulla non metus auctor fringilla.</p>
			
			<a href="#">Meet the team &rarr;</a>
			
		</div> <!-- END MEET THE TEAM -->
		
		<div class="ft-box hours">
		
			<h2>Opening Hours</h2>
		
			<table>
				<tbody>
					<tr><td class="day">MON</td><td>11.00 - 14.00 &#38; 18.00 - 22.00</td></tr>
					<tr class="even"><td class="day">TUE</td><td>11.00 - 14.00 &#38; 18.00 - 22.00</td></tr>
					<tr><td class="day">WED</td><td>closed</td></tr>
					<tr class="even"><td class="day">THU</td><td>closed &#38; 18.00 - 22.00</td></tr>
					<tr><td class="day">FRI</td><td>11.00 - 14.00 &#38; 17.00 - 22.00</td></tr>
					<tr class="even"><td class="day">SAT</td><td>closed &#38; 18.00 - 22.00</td></tr>
					<tr><td class="day">SUN</td><td>10.00 - 15.00 &#38; 18.00 - 21.00</td></tr>
				</tbody>
			</table>
		
		</div> <!-- END OPENING HOURS -->
		
		<div class="ft-box map">
		
			<h2>Come visit us</h2>
			
			<div class="mapbox">
			
				<iframe width="270" height="114" src="http://maps.google.be/maps?f=q&amp;source=s_q&amp;hl=nl&amp;geocode=&amp;q=Broadway,+New+York,+NY,+USA&amp;aq=0&amp;sll=50.967069,4.506993&amp;sspn=0.015743,0.024784&amp;vpsrc=6&amp;ie=UTF8&amp;hq=&amp;hnear=Broadway,+New+York,+Verenigde+Staten&amp;ll=40.742377,-73.989463&amp;spn=0.018926,0.024784&amp;t=m&amp;z=14&amp;output=embed"></iframe>
			
			</div>
		
		</div> <!-- END MAP -->
		
		<div class="clearfix"></div>
		
		<div class="credits">
		
			<p>Copyrights 2011 <a href="#">Exquisito Theme</a> by <a href="http://nielsdecraecker.be">Niels De Craecker</a></p>
		
			<ul class="pay-options">
				<li class="visa">VISA</li>
				<li class="master">MASTER CARD</li>
				<li class="discover">DISCOVER CARD</li>
				<li class="express">American Express</li>
			</ul>
		
		</div>
	
	</footer> <!-- END FOOTER -->

</body>
</html>