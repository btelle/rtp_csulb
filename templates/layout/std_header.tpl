<!DOCTYPE html> 
<html lang="en">
    <head>
        <title>{$header.title} :: RTP@CSULB</title>
        
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="viewport" content="width=device-width" />
        <meta name="author" content="{$header.author}" />
	<meta name="keywords" content="{$header.keywords}" />
	<meta name="description" content="{$header.description}" />
        
        <link href="css/rtp.css" rel="stylesheet" type="text/css" media="screen" />
        
        <link href="css/rtp.mobile.css" rel="stylesheet" type="text/css" media="only screen and (max-width: 480px), only screen and (max-device-width: 480px)" />
        {if $header.homepage}<link href="css/rtp.lots.css" rel="stylesheet" type="text/css" media="screen" />{/if}
        <link href="css/sunny/jquery-ui-1.8.16.custom" rel="stylesheet" type="text/css"/>
        
        <script type="text/javascript" src="js/jquery/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="js/rtp.init.js"></script>
    </head>
    <body>
        <div id="content">
            <header>
                {if !$user['id']}
                <form action="login.php" method="post">
                    <fieldset id="login">
                        <input type="email" name="email" placeholder="Username" value="" />
                        <input type="password" name="password" value="" /> <br />
                        <input type="submit" name="submit" value="Log in" /> 
                        <a href="account.php">Create an Account</a>
                    </fieldset>
                </form>
                <div id="login_small">
                    <a href="./login.php">Login</a>
                </div>
                {else}
                <div id="userdata">
                    Welcome {$user['name']} | <a href="account.php?mode=settings">Settings</a> | {if $user['role']}<a href="admin/">Admin</a> | {/if}<a href="logout.php">Logout</a>
                </div>    
                {/if}
                <div id="logo"><a href="{$data.homelink}"><img src="./images/logo_1.png" alt=""></a></div>
                <!--<div id="disclaimer">RTP is a student-created project</div>-->
                <nav>
                    <ul>
                        {$data.headermenu}
                    </ul>
                </nav>
            </header>

            <div id="main">
