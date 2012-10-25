<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
    <meta charset="utf-8" />
    <title>Raspcontrol - The Raspberry Pi Control Centre</title>
    <link rel="stylesheet" href="_lib/styles/style.css" type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="_lib/styles/menu.css" type="text/css" media="screen" charset="utf-8">
    
    <script type="text/javascript">
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-33662683-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>

</head>

<body>
    <div id="topContainer">
        <div class="topWrapper">
            <div style="float: left;">
               <h1><img src="_lib/images/smallLogo.png" style="float: left; margin-top: -15px;"> Raspcontrol.</h1>

                <h2>The Raspberry Pi Control Centre</h2>
                <br/>
                <a href="https://twitter.com/Raspcontrol" class="twitter-follow-button" data-show-count="false">Follow @Raspcontrol</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>	
            </div>

			<?php
				if($_SESSION['username'] == ""){
					
				}else{
					$distroTypeRaw = exec("sudo cat /etc/*-release | grep PRETTY_NAME=", $out); 
					$distroTypeRawEnd = str_ireplace('PRETTY_NAME="', '', $distroTypeRaw);
					$distroTypeRawEnd = str_ireplace('"', '', $distroTypeRawEnd);	
					
					$kernel = exec("sudo uname -mrs");
                    $firmware = exec("sudo uname -v");
					?>
					
					<div style="text-align: right; padding-top: 4px; color: #FFFFFF; font-family: Arial; font-size: 13px; float: right; width:500px;">
		                <strong>Hostname:</strong> <?php echo gethostname(); ?> &middot; 
		                <strong>Internal IP:</strong> <?php echo $_SERVER['SERVER_ADDR']; ?><br/>
		                <strong>Accessed From:</strong> <?php echo $_SERVER['SERVER_NAME']; ?> &middot; 
		                <strong>Port:</strong> <?php echo $_SERVER['SERVER_PORT']; ?> &middot; 
		                <strong>HTTP:</strong> <?php echo $_SERVER['SERVER_SOFTWARE']; ?><br/><br/>
		                <?php echo "<strong>Distribution:</strong> ".$distroTypeRawEnd; ?><br/>
		                <?php echo "<strong>Kernel:</strong> ".$kernel; ?><br/>
                        <?php echo "<strong>Firmware:</strong> ".$firmware; ?>
                        
		            </div>
					
				<?php }
			?>
            
        </div>
    </div>

	<div class="clear"></div>
<?php
	if($_SESSION['username'] == ""){				
	}else{ ?>
			
    <div id="subNavContainer">
        <div class="subNavWrapper">
            
			<ul id="menu">
				<li>
					<a href="#">Home</a>
					<ul>
						<li><a href="index.php">Reload page</a></li>
						<li><a href="" onclick="rebootWarn()">Reboot Raspberry Pi</a></li>
					</ul>
				</li>
				<li>
					<a href="#">System</a>
					<ul>
						<li><a href="_lib/commands/_updatesources.php">Update Sources</a></li>
						<li><?php if (file_exists("/usr/bin/rpi-update")) { ?>
                    		<a href="" onclick="firmwareMsg()">Update Firmware</a>
							<?php } else { ?>
		            		<a href="_lib/commands/_installfirmware.php">Install Firmware Updater</a>
		            		<?php } ?>
		            	</li>
					</ul>
				</li>
				<li>
					<a href="#">Services</a>
					<ul>
						<?php
							$json = file_get_contents(dirname(__FILE__)."/services.json");
							$services = json_decode($json);
							foreach ($services as $key => $value) {
								echo '<li><a href="_lib/includes/services.php?cmd='.$key.'">'.$key.'</a></li>';
								}
						?>
					</ul>
				</li>
				<li><a href="#">About</a></li>
				<li><a href="#">Contact</a></li>
			</ul>           

        </div>
    </div>

<?php
	}

