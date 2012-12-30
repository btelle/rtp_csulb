<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{$header.title} :: RTP@CSULB</title>
        
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="author" content="{$header.author}" />
	<meta name="keywords" content="{$header.keywords}" />
	<meta name="description" content="{$header.description}" />
        
        <link href="css/rtp.css" rel="stylesheet" type="text/css" media="all" />
        <script type="text/javascript" src="js/jquery-1.7.min.js"></script>
    </head>
    <body>
        <div id="content">
            <header>
                <div id="logo">RTS@CSULB</div>
                <form action="/login.php">
                    <fieldset id="login">
                        <input type="text" name="username" placeholder="Username" value="" />
                        <input type="password" name="password" value="" />
                        <input type="submit" value="Log in" />
                    </fieldset>
                </form>
                <nav>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/lots.php">Lot Detail</a></li>
                        <li><a href="/events.php">Events</a></li>
                        <li><a href="/help.php">Help</a></li>
                    </ul>
                </nav>
            </header>

            <div id="main">
