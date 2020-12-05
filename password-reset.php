<?php

    error_reporting(0);
    set_time_limit(0);

    function koken_rand()
    {
        $base = function_exists('mt_rand') ? mt_rand() : rand();
        return md5(uniqid($base, true));
    }

    define('BASEPATH', true);
    include('app/libraries/Hash.php');

    $dbConfig = include('storage/configuration/database.php');
    
    if (isset($KOKEN_DATABASE))
    {
        $dbConfig = $KOKEN_DATABASE;
    }
    
    class PasswordResetDB {
        private $dbConfig;
        private $link;

        function __construct($dbConfig)
        {
            $this->dbConfig = $dbConfig;

            if ($this->dbConfig['driver'] === 'mysqli')
            {
                $this->link = mysqli_connect($this->dbConfig['hostname'], $this->dbConfig['username'], $this->dbConfig['password'], $this->dbConfig['database'] , null, $this->dbConfig['socket']);
            }
            else
            {
                mysql_connect($this->dbConfig['hostname'], $this->dbConfig['username'], $this->dbConfig['password']);
                mysql_select_db($this->dbConfig['database']);
            }
        }

        function query($query)
        {
            if ($this->dbConfig['driver'] === 'mysqli')
            {
                return mysqli_query($this->link, $query);
            }
            else
            {
                return mysql_query($query);
            }
        }

        function getRow($result)
        {
            if ($this->dbConfig['driver'] === 'mysqli')
            {
                return mysqli_fetch_row($result);
            }
            else
            {
                return mysqli_fetch_row($result);
            }
        }

    }

    $db = new PasswordResetDB($dbConfig);

    $new = substr(koken_rand(), 0, 8);
    $h = new Hash();
    $db_new = Hash::HashPassword($new);

    $user = $db->getRow($db->query("SELECT email from {$KOKEN_DATABASE['prefix']}users LIMIT 1"));

    $email = $user[0];

    $db->query("UPDATE {$KOKEN_DATABASE['prefix']}users SET password='$db_new'");

    unlink(__FILE__);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Koken - Setup</title>

    <!-- css -->
    <link rel="stylesheet" href="//s3.amazonaws.com/install.koken.me/css/screen.css">

    <!--[if IE]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>

    <div id="container">

        <img id="logo" src="//s3.amazonaws.com/install.koken.me/img/koken_logo.svg" width="71" height="71" />

        <div id="content">

            <div style="display:block">

                <header>

                    <h1>Password reset</h1>

                    <div class="front">

                        <p id="test-wait">Your password has been reset. You can login with the following credentials:</p>

                        <code class="row" style="margin:3em auto 0;display:inline-block;text-align:left;">
                            <p>&nbsp;&nbsp;&nbsp;Email: <?php echo $email; ?></p>
                            <p>Password: <?php echo $new ?></p>
                        </code>

                        <div class="row" style="margin-top:3em;">

                            <p>
                                <?php
                                    if (file_exists(__FILE__))
                                    {
                                        echo "For security purposes, please delete this file from your web server immediately.";
                                    }
                                    else
                                    {
                                        echo "For security purposes, this file has been automatically removed from your web server.<br>If you need to use it again, re-upload it to the Koken folder.";
                                    }
                                ?>
                            </p>

                        </div>

                </header>

            </div>

        </div> <!-- close #content -->

    </div> <!-- close #container -->

</body>

</html>