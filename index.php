<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

    <title>Swim Times Converter</title>

    <meta name="author" content="Brian Stanback" />
    <meta name="copyright" content="Brian Stanback" />

    <!-- // Begin Swim Conversion CSS -->
    <style type="text/css" media="all">

        body {
            margin: 0;
            padding: 1px 0 0 0;
            background: #625F57;
            color: #fff;
            font-family: sans-serif;
        }

        p {
            line-height: 1.3em;
            font-size: 0.9em;
            padding: 0;
            margin: 0 0 2em 0;
        }

        div.demo {
            background: #5E84A4;
            padding: 20px 50px;
            margin-bottom: 2px;
        }
        div.demo h1 {
            font-size: 1.5em;
            font-weight: bold;
            text-align: center;
            margin: 1em 0 1.5em 0;
            padding: 0;
        }
        div.demo p.swim-convert-error {
            text-align: center;
        }
        div.demo p.swim-convert-time {
            margin: 0 auto 1em auto;
            padding: 25px;
            width: 275px;
            border: 4px solid #7ea4c4;
            border-radius: 22px;
            font-size: 1.1em;
        }
        div.demo form {
            margin: 0 auto 2em auto;
            padding: 25px;
            width: 275px;
            border: 4px solid #7ea4c4;
            border-radius: 22px;
        }
        div.demo form fieldset {
            border: none;
            margin: 0 0 1em 0;
            padding: 0;
        }
        div.demo form fieldset:last-child {
            margin: 0;
        }
        div.demo form label, div.demo form div.label {
            display: block;
            padding: 0;
            margin: 0 0 12px 0;
        }
        div.demo form input, div.demo form select {
            color: #fff;
            background: #7ea4c4;
            font-size: 1em;
            border: 1px solid #4E7494;
            padding: 2px 3px;
        }
        div.demo form input[type=submit] {
            border-radius: 15px;
            font-weight: bold;
            padding: 4px 18px;
            color: #eee;
            background: linear-gradient(to bottom, #72aad8 0%, #527db2 100%);
            cursor: pointer;
        }
        div.demo form input[type=submit]:hover {
            background: linear-gradient(to bottom, #72aad8 0%, #628dc2 100%);
        }
        div.demo form input[type=submit]:active {
            background: linear-gradient(to bottom, #527db2 0%, #72aad8 100%);
        }

        div.download {
            background: #748081;
            padding: 20px 50px;
            margin-bottom: 2px;
        }
        div.download h2 {
            font-size: 1.4em;
            font-weight: normal;
            margin: 1em 0;
            padding: 0;
        }
        div.download ul {
            margin-bottom: 2em;
        }
        div.download a {
            color: #c4d0d1;
        }

        div.help {
            background: #9FB3AC;
            padding: 20px 50px;
        }
        div.help h2 {
            font-size: 1.4em;
            font-weight: normal;
            margin: 1em 0;
            padding: 0;
        }
        div.help a {
            color: #dff3ec;
        }

        div#footer {
            padding: 2em 50px 0 50px;
            text-align: center;
        }

    </style>
    <!-- // End Swim Conversion CSS -->

</head>
<body>

<div class="demo">

    <h1>Swim Times Converter Demo</h1>

    <!-- // Begin Swim Conversion Form -->

    <?php
        //
        // Include the class for handling the time conversion functions
        //
        require_once('swimconvert.class.php');

        // Instantiate the swim conversions class using the Colorado Swimming conversion factors
        $swim_convert = new SwimConvert('CO');

        // Get post data (if the user submitted the form)
        $swim_convert->get_post_data();

        // Calculate and display the converted time (if the user submitted the form)
        echo $swim_convert->get_converted_time();

        // Display the conversion form
        echo $swim_convert->get_form();
    ?>

    <!-- // End Swim Conversion Form -->

</div>

<div class="download">

    <h2>Download</h2>

    <p>The source code is available here (version 3.0.0, 1/1/2013):</p>

    <ul>
        <li><a href="index.php.txt">Form code (PHP)</a></li>
        <li><a href="swimconvert.class.php.txt">Swim conversion class (PHP)</a></li>
    </ul>

    <h2>GitHub</h2>

    <p>The project is now <a href="http://github.com/Stanback/php-swim-time-conversion">available on GitHub</a>.</p>

    <h2>Terms of Use</h2>

    <p>This script is licensed under the <a href="http://www.gnu.org/licenses/gpl.html">GPLv3</a> license. If you use this script, I'd appreciate a link back to my personal website at the following URL: <a href="http://www.brianstanback.com/">http://www.brianstanback.com/</a>.</p>

</div>

<div class="help">

    <h2>Support</h2>

    <p>You may style the form's HTML and CSS any way you want, eventually I may incorporate support for templates or add additional methods so that users can avoid making changes to the PHP class file.</p>

    <p><a href="mailto:stanback@gmail.com">Drop me a line</a> or <a href="http://github.com/Stanback/php-swim-time-conversion/issues">open an issue</a> you have bug reports, issues setting up the script, or if you have any recommendations. I will consider any requests to port this to other languags or package it into a plugin for Wordpress, Drupal, etc.</p>

    <p>If you make any significant changes to the script, please <a href="http://help.github.com/articles/creating-a-pull-request">create a pull request</a> on <a href="http://github.com/Stanback/php-swim-time-conversion">GitHub</a> and I will consider incorporating the changes into the master release.</p>

</div>

<div id="footer">

    <p>Copyright &copy; 2013 Brian Stanback</p>

</div>

</body>
</html>
