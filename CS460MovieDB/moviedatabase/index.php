
<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<style>
		.divider{
			width:5px;
			height:auto;
			display:inline-block;
		}
	
		
		</style>
    </head>

    <body>
		
		<div class ="container">
		
		<form action = "" method = "post" style="text-align:right">
			Login to your email: <input name="inputEmail" input type ="text">
			<input type ="submit" value = "Log in">
		</form> 

		<form action = "" method = "post" style="text-align:right">
			<input type="submit" name = "logout" value = "Log out"> 
		</form> 
		
		<form action = "registration.php" method = "post" style="text-align:left">
			<input type="submit" name = "signup" value = "Sign up"> 
		</form> 
		
		</div>

		<?php /*
		if(isset($_SESSION['user_name'])) {
			echo "<div id = 'User'> Welcome: " . htmlspecialchars($_SESSION['user_name']) . "</div>";
		
		}
		*/ ?>
		
		
		<div class="container">
            <?php
			if(!empty($_POST["inputEmail"])) {
			$loggedin = $_POST["inputEmail"] ?? "";
			$_SESSION['user_name'] = $loggedin;
			}
		  ?>
        </div>
		
		
		<div class="container">
            <?php
                if(isset($_POST['logout']))
				{ 
					$_SESSION = array();
					session_destroy(); 
				}
			?> 
		</div>	
		
		<div class="container">
		<li class='active' style ='float:right;'>
			<?php 
		if(isset($_SESSION['user_name'])) {
			echo "<div id = 'User'> You are logged in as: " . htmlspecialchars($_SESSION['user_name']) . "</div>";
		}
		else {
			echo "You have logged out.";
		}
		
		?>
		 </div>
		 
		<div class="container">
            <h1 style="text-align:center"> CS460 Project 1 Movie Database </h1><br>
        </div>

		<div class = "container">
            <form id="q1" method="post" action="">
                <div class="input-group mb-3">
                    <input type="submit" name = "allTables" value = "Show all tables in the database"> 
                </div>
            </form>
        </div>
		
		<div class="container">
            <?php
                if(isset($_POST['allTables']))
                {
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'Tables</th></tr></thead>";

                    class TableRows extends RecursiveIteratorIterator {
                        function __construct($it) {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current() {
                            // return "<td style='width: 30px; border: 1px solid black;'>" . parent::current(). "</td>";
                            return "<td style='text-align:center'>" . parent::current(). "</td>";
                        }

                        function beginChildren() {
                            echo "<tr>";
                        }

                        function endChildren() {
                            echo "</tr>" . "\n";
                        }
                    }

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cs460 project 1 movie database";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("show tables");
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
					
					
                }
            ?>
        </div>
	   
		<div class = "container">
            <form id="q2" method="post" action="">
                <div class="input-group mb-3">
					<input type="text" name="nameSearch">
                    <input type="submit" name = "q2Name" value = "Search a motion picture"> 
                </div>
            </form>
        </div>
		
		<div class="container">
            <?php
                if(isset($_POST['q2Name']))
                { if (!empty($_POST['nameSearch'])) {
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Name</th><th class='col-md-2'>Rating</th><th class='col-md-2'>Budget</th><th class='col-md-2'>Production</th></tr></thead>";

                    class TableRows extends RecursiveIteratorIterator {
                        function __construct($it) {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current() {
                            // return "<td style='width: 30px; border: 1px solid black;'>" . parent::current(). "</td>";
                            return "<td style='text-align:center'>" . parent::current(). "</td>";
                        }

                        function beginChildren() {
                            echo "<tr>";
                        }

                        function endChildren() {
                            echo "</tr>" . "\n";
                        }
                    }

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cs460 project 1 movie database";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT name, rating, production, budget 
												FROM motionpicture 
												WHERE name = '$_POST[nameSearch]';");
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
					
				}
				else {
					echo "You must enter a movie name";
				}
                }
            ?>
        </div>
	   
		<div class = "container">
            <form id="q3" method="post" action="">
                <div class="input-group mb-3">
					<input type="text" name="likedBySearch">
                    <input type="submit" name = "q3LikedBy" value = "Motion pictures liked by a user"> 
                </div>
            </form>
        </div>
		
		<div class="container">
            <?php
                if(isset($_POST['q3LikedBy']))
                { if (!empty($_POST['likedBySearch'])) {
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Name</th><th class='col-md-2'>Rating</th><th class='col-md-2'>Budget</th><th class='col-md-2'>Production</th></tr></thead>";

                    class TableRows extends RecursiveIteratorIterator {
                        function __construct($it) {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current() {
                            // return "<td style='width: 30px; border: 1px solid black;'>" . parent::current(). "</td>";
                            return "<td style='text-align:center'>" . parent::current(). "</td>";
                        }

                        function beginChildren() {
                            echo "<tr>";
                        }

                        function endChildren() {
                            echo "</tr>" . "\n";
                        }
                    }

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cs460 project 1 movie database";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT mo.name, mo.rating, mo.production, mo.budget 
												FROM motionpicture mo JOIN likes l ON l.mpid = mo.id 
												WHERE l.uemail ='$_POST[likedBySearch]';");
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
					
				}
				else {
					echo "You must enter an email";
				}
                }
            ?>
        </div>
		
		<div class = "container">
            <form id="q4" method="post" action="">
                <div class="input-group mb-3">
					<input type="text" name="locationShot">
                    <input type="submit" name = "q4Loc" value = "Search by shooting location country"> 
                </div>
            </form>
        </div>
		
		<div class="container">
            <?php
                if(isset($_POST['q4Loc']))
                { if (!empty($_POST['locationShot'])) {
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Name</th></tr></thead>";

                    class TableRows extends RecursiveIteratorIterator {
                        function __construct($it) {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current() {
                            // return "<td style='width: 30px; border: 1px solid black;'>" . parent::current(). "</td>";
                            return "<td style='text-align:center'>" . parent::current(). "</td>";
                        }

                        function beginChildren() {
                            echo "<tr>";
                        }

                        function endChildren() {
                            echo "</tr>" . "\n";
                        }
                    }

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cs460 project 1 movie database";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT DISTINCT mp.name
												FROM motionpicture mp JOIN location loc ON mp.id = loc.mpid 
												WHERE loc.country ='$_POST[locationShot]';");
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
					
				}
				else {
					echo "You must enter a location";
				}
                }
            ?>
        </div>
	   
		<div class = "container">
            <form id="q5" method="post" action="">
                <div class="input-group mb-3">
					<input type="text" name="dirZipCode">
                    <input type="submit" name = "q5Zip" value = "Search directors who have directed TV series shot in a certain zip code"> 
                </div>
            </form>
        </div>
		
		<div class="container">
            <?php
                if(isset($_POST['q5Zip']))
                { if (!empty($_POST['dirZipCode'])) {
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Director Name</th><th class='col-md-2'>TV Series</th></tr></thead>";

                    class TableRows extends RecursiveIteratorIterator {
                        function __construct($it) {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current() {
                            // return "<td style='width: 30px; border: 1px solid black;'>" . parent::current(). "</td>";
                            return "<td style='text-align:center'>" . parent::current(). "</td>";
                        }

                        function beginChildren() {
                            echo "<tr>";
                        }

                        function endChildren() {
                            echo "</tr>" . "\n";
                        }
                    }

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cs460 project 1 movie database";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT director.name AS 'Director', serie.name AS 'Series' FROM 
												(SELECT DISTINCT p.name, r.mpid FROM role r 
												JOIN people p ON p.id = r.pid WHERE role_name = 'Director') director 
												JOIN (SELECT mp.id, mp.name FROM motionpicture mp JOIN 
												(SELECT s.mpid FROM location loc JOIN series s ON s.mpid = loc.mpid WHERE zip = '$_POST[dirZipCode]') locatedSerie 
												ON mp.id = locatedSerie.mpid) serie ON director.mpid = serie.id;");
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
					
				}
				else {
					echo "You must enter a zip code";
				}
                }
            ?>
        </div>
		
		<div class = "container">
            <form id="q6" method="post" action="">
                <div class="input-group mb-3">
					<input type="text" name="awardSameYear">
                    <input type="submit" name = "q6Award" value = "Search people who have won more than a certain number of awards for a single motion picture in the same year"> 
                </div>
            </form>
        </div>
		
		<div class="container">
            <?php
                if(isset($_POST['q6Award']))
                { if (!empty($_POST['awardSameYear'])) {
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Motion Picture</th><th class='col-md-2'>Person Name</th><th class='col-md-2'>Award Year</th><th class='col-md-2'>Number of Awards</th></tr></thead>";
                    
                    class TableRows extends RecursiveIteratorIterator {
                        function __construct($it) {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current() {
                            // return "<td style='width: 30px; border: 1px solid black;'>" . parent::current(). "</td>";
                            return "<td style='text-align:center'>" . parent::current(). "</td>";
                        }

                        function beginChildren() {
                            echo "<tr>";
                        }

                        function endChildren() {
                            echo "</tr>" . "\n";
                        }
                    }

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cs460 project 1 movie database";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT DISTINCT mp.name AS 'Motion Pic', p.name AS 'Person', aw.award_year AS 'Year', aw.award_count AS 'Award Count' FROM 
												(SELECT DISTINCT * FROM award NATURAL JOIN 
												(SELECT mpid, pid, award_year, COUNT(*) AS award_count FROM 
												award GROUP BY mpid, pid, award_year HAVING COUNT(*) > '$_POST[awardSameYear]') AS more_than 
												ORDER BY mpid, award_year) AS aw 
												JOIN motionpicture mp  ON aw.mpid = mp.id 
												JOIN people p ON p.id = aw.pid;");
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
					
				}
				else {
					echo "You must enter a number";
				}
                }
            ?>
        </div>
	   
		 
		 <div class = "container">
            <form id="testing" method="post" action="">
                <div class="input-group mb-3">
                    <input type="submit" name = "youngestOldestAward" value = "Youngest/Oldest award winning actors"> 
                </div>
            </form>
        </div>


		 <div class="container">
            <?php
                if(isset($_POST['youngestOldestAward']))
                {
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Name</th><th class='col-md-2'>Age</th></tr></thead>";

                    class TableRows extends RecursiveIteratorIterator {
                        function __construct($it) {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current() {
                            // return "<td style='width: 30px; border: 1px solid black;'>" . parent::current(). "</td>";
                            return "<td style='text-align:center'>" . parent::current(). "</td>";
                        }

                        function beginChildren() {
                            echo "<tr>";
                        }

                        function endChildren() {
                            echo "</tr>" . "\n";
                        }
                    }

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cs460 project 1 movie database";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT p.name, (a.award_year - YEAR(p.dob)) FROM people p, award a WHERE (p.id = a.pid AND (a.award_year - YEAR(p.dob)) >= 
										ALL (SELECT MAX(a2.award_year - YEAR(p2.dob)) FROM people p2, award a2 WHERE p2.id = a2.pid AND a2.award_name = 'Best Actor') AND (a.award_name = 'Best Actor' or a.award_name = 'Best Actor By Popular Vote')) 
										OR (p.id = a.pid AND (a.award_year - YEAR(p.dob)) <= 
										ALL (SELECT MIN(a2.award_year - YEAR(p2.dob)) FROM people p2, award a2 WHERE p2.id = a2.pid AND a2.award_name = 'Best Actor') AND (a.award_name = 'Best Actor' or a.award_name = 'Best Actor By Popular Vote'))");
											
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
                }
            ?>
        </div>
		
		<div class = "container">
            <form id="q8" method="post" action="">
                <div class="input-group mb-3">
					<input type="text" name="xboxcollection"><input type="text" name="ybudget">
                    <input type="submit" name = "q8Money" value = "Movies with a box collection of >= x and a budget of <= than y"> 
                </div>
            </form>
        </div>
		
		<div class="container">
            <?php
                if(isset($_POST['q8Money']))
                { if (!empty($_POST['xboxcollection'])) {
					if (!empty($_POST['ybudget'])) {
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Producer Name</th><th class='col-md-2'>Movie Name</th><th class='col-md-2'>Box Office Collection</th><th class='col-md-2'>Budget</th></tr></thead>";
                    
                    class TableRows extends RecursiveIteratorIterator {
                        function __construct($it) {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current() {
                            // return "<td style='width: 30px; border: 1px solid black;'>" . parent::current(). "</td>";
                            return "<td style='text-align:center'>" . parent::current(). "</td>";
                        }

                        function beginChildren() {
                            echo "<tr>";
                        }

                        function endChildren() {
                            echo "</tr>" . "\n";
                        }
                    }

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cs460 project 1 movie database";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT american_producer.name AS 'Producer', mp.name AS 'Motion Pic', mp.budget, mo.boxoffice_collection FROM 
												(SELECT r.mpid, p.name FROM role r, people p 
												WHERE r.pid = p.id AND p.nationality = 'USA' AND r.role_name = 'Producer') american_producer 
												JOIN motionpicture mp ON mp.id = american_producer.mpid 
												JOIN movie mo ON mo.mpid = american_producer.mpid 
												WHERE mo.boxoffice_collection >= '$_POST[xboxcollection]' AND mp.budget <= '$_POST[ybudget]';");
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
					}
				else {
					echo "You must enter the box office collection!";
				}
				}
				else {
					echo "You must enter a budget";
				}
                }
            ?>
        </div>
		
		<div class = "container">
            <form id="q9" method="post" action="">
                <div class="input-group mb-3">
					<input type="text" name="q9rating">
                    <input type="submit" name = "q9Actor" value = "Search the actors who played multiple roles in a motion picture with rating > x"> 
                </div>
            </form>
        </div>
		
		<div class="container">
            <?php
                if(isset($_POST['q9Actor']))
                { if (!empty($_POST['q9rating'])) {
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Name</th><th class='col-md-2'>Motion Picture</th><th class='col-md-2'>No. of Roles</th></tr></thead>";

                    class TableRows extends RecursiveIteratorIterator {
                        function __construct($it) {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current() {
                            // return "<td style='width: 30px; border: 1px solid black;'>" . parent::current(). "</td>";
                            return "<td style='text-align:center'>" . parent::current(). "</td>";
                        }

                        function beginChildren() {
                            echo "<tr>";
                        }

                        function endChildren() {
                            echo "</tr>" . "\n";
                        }
                    }

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cs460 project 1 movie database";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT p.name AS 'Person', mp.name AS 'Motion Pic', role_twice.role_cnt AS 'Role Count' FROM 
												(SELECT pid, mpid, COUNT(*) AS role_cnt FROM role GROUP BY pid, mpid HAVING COUNT(*) > 1) role_twice 
												JOIN motionpicture mp ON mp.id = role_twice.mpid 
												JOIN people p ON p.id = role_twice.pid 
												WHERE mp.rating > '$_POST[q9rating]';");
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
					
				}
				else {
					echo "You must enter a location";
				}
                }
            ?>
        </div>
			
		 <div class = "container">
            <form id="testing" method="post" action="">
                <div class="input-group mb-3">
                    <input type="submit" name = "q10Thriller" value = "Top 2 Thrillers Shot Exclusively in Boston"> 
                </div>
            </form>
        </div>

		 <div class="container">
            <?php
                if(isset($_POST['q10Thriller']))
                {
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Name</th><th class='col-md-2'>Rating</th></tr></thead>";

                    class TableRows extends RecursiveIteratorIterator {
                        function __construct($it) {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current() {
                            // return "<td style='width: 30px; border: 1px solid black;'>" . parent::current(). "</td>";
                            return "<td style='text-align:center'>" . parent::current(). "</td>";
                        }

                        function beginChildren() {
                            echo "<tr>";
                        }

                        function endChildren() {
                            echo "</tr>" . "\n";
                        }
                    }

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cs460 project 1 movie database";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT DISTINCT mp.name, mp.rating FROM 
												(SELECT mpid FROM location WHERE mpid NOT IN 
												(SELECT bost.mpid FROM (SELECT mpid FROM location WHERE city = 'Boston') bost 
												JOIN (SELECT * FROM location where city != 'Boston') notbost ON bost.mpid = notbost.mpid) AND city = 'Boston' ) boston_only 
												JOIN genre g ON g.mpid = boston_only.mpid 
												JOIN motionpicture mp ON mp.id = boston_only.mpid 
												WHERE g.genre_name = 'Thriller' ORDER BY mp.rating DESC LIMIT 2;");
											
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
                }
            ?>
        </div>
		
		<div class = "container">
            <form id="q11" method="post" action="">
                <div class="input-group mb-3">
					<input type="text" name="xlikes"><input type="text" name="yage">
                    <input type="submit" name = "q11Likes" value = "Movies with more than x likes by users of age less than y"> 
                </div>
            </form>
        </div>
		
		<div class="container">
            <?php
                if(isset($_POST['q11Likes']))
                { if (!empty($_POST['xlikes'])) {
					if (!empty($_POST['yage'])) {
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Motion Picture</th><th class='col-md-2'>Likes</th></tr></thead>";
                    
                    class TableRows extends RecursiveIteratorIterator {
                        function __construct($it) {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current() {
                            // return "<td style='width: 30px; border: 1px solid black;'>" . parent::current(). "</td>";
                            return "<td style='text-align:center'>" . parent::current(). "</td>";
                        }

                        function beginChildren() {
                            echo "<tr>";
                        }

                        function endChildren() {
                            echo "</tr>" . "\n";
                        }
                    }

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cs460 project 1 movie database";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT mp.name, mp_likes.like_cnt FROM (SELECT l.mpid, COUNT(*) AS like_cnt
												FROM likes l, user u 
												WHERE u.email = l.uemail AND u.age < '$_POST[yage]' GROUP BY mpid) mp_likes 
												JOIN movie mo ON mo.mpid = mp_likes.mpid 
												JOIN motionpicture mp ON mp.id = mp_likes.mpid 
												WHERE mp_likes.like_cnt > '$_POST[xlikes]';");
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
					}
				else {
					echo "You must enter the number of likes";
				}
				}
				else {
					echo "You must enter an age";
				}
                }
            ?>
        </div>
		
		
		<div class = "container">
            <form id="q12query" method="post" action="">
                <div class="input-group mb-3">
                    <input type="submit" name = "q12" value = "Actors who have played a role in both “Marvel” and “Warner Bros” productions"> 
                </div>
            </form>
        </div>


		 <div class="container">
            <?php
                if(isset($_POST['q12']))
                {
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Actor</th><th class='col-md-2'>Marvel Movie</th><th class='col-md-2'>Warner Bros Movie</th></tr></thead>";

                    class TableRows extends RecursiveIteratorIterator {
                        function __construct($it) {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current() {
                            // return "<td style='width: 30px; border: 1px solid black;'>" . parent::current(). "</td>";
                            return "<td style='text-align:center'>" . parent::current(). "</td>";
                        }

                        function beginChildren() {
                            echo "<tr>";
                        }

                        function endChildren() {
                            echo "</tr>" . "\n";
                        }
                    }

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cs460 project 1 movie database";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT p.name AS 'Person', MA_roles.name AS 'Marvel role', WB_roles.name AS 'Warner Bros role' FROM
						(SELECT MA.name, r.pid FROM role r JOIN
						(SELECT id, name FROM motionpicture WHERE production = 'Marvel') MA ON r.mpid = MA.id) MA_roles
						JOIN (SELECT WB.name, r.pid FROM role r JOIN 
						(SELECT id, name FROM motionpicture WHERE production = 'Warner Bros') WB
						ON r.mpid = WB.id) WB_roles
						ON MA_roles.pid = WB_roles.pid
						JOIN people p ON WB_roles.pid = p.id");
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
                }
            ?>
        </div>
		
		<div class = "container">
            <form id="q13query" method="post" action="">
                <div class="input-group mb-3">
                    <input type="submit" name = "q13" value = "Motion pictures that have a higher rating than the average rating of all comedy motion pictures"> 
                </div>
            </form>
        </div>
		
		<div class="container">
            <?php
                if(isset($_POST['q13']))
                {
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Motion Picture</th><th class='col-md-2'>Rating</th></tr></thead>";

                    class TableRows extends RecursiveIteratorIterator {
                        function __construct($it) {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current() {
                            // return "<td style='width: 30px; border: 1px solid black;'>" . parent::current(). "</td>";
                            return "<td style='text-align:center'>" . parent::current(). "</td>";
                        }

                        function beginChildren() {
                            echo "<tr>";
                        }

                        function endChildren() {
                            echo "</tr>" . "\n";
                        }
                    }

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cs460 project 1 movie database";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT name, rating FROM motionpicture WHERE rating > 
						(SELECT AVG(rating) FROM motionpicture mp, genre g WHERE mp.id = g.mpid AND g.genre_name = 'Comedy') ORDER BY rating DESC;");
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
                }
            ?>
        </div>
		
		
		<div class = "container">
            <form id="q14" method="post" action="">
                <div class="input-group mb-3">
                    <input type="submit" name = "q14Roles" value = "Top 5 movies with highest amount of people playing a role"> 
                </div>
            </form>
        </div>

		
		 <div class="container">
            <?php
                if(isset($_POST['q14Roles']))
                {
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Movie Name</th><th class='col-md-2'>People Count</th><th class='col-md-2'>Role Count</th></tr></thead>";

                    class TableRows extends RecursiveIteratorIterator {
                        function __construct($it) {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current() {
                            // return "<td style='width: 30px; border: 1px solid black;'>" . parent::current(). "</td>";
                            return "<td style='text-align:center'>" . parent::current(). "</td>";
                        }

                        function beginChildren() {
                            echo "<tr>";
                        }

                        function endChildren() {
                            echo "</tr>" . "\n";
                        }
                    }

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cs460 project 1 movie database";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT info.mpid, info.p_cnt, info.role_cnt FROM (SELECT mpid, COUNT(DISTINCT pid) AS p_cnt, COUNT(DISTINCT role_name) AS role_cnt FROM role GROUP BY mpid) info JOIN motionpicture mp on mp.id = info.mpid ORDER BY p_cnt DESC LIMIT 5;");
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
                }
            ?>
        </div>
		
		<div class = "container">
            <form id="q15" method="post" action="">
                <div class="input-group mb-3">
                    <input type="submit" name = "q15Birthdays" value = "Actors with the same birthday!"> 
                </div>
            </form>
        </div>

		
		 <div class="container">
            <?php
                if(isset($_POST['q15Birthdays']))
                {
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Actor</th><th class='col-md-2'>Actor 2</th><th class='col-md-2'>Birthday</th></tr></thead>";

                    class TableRows extends RecursiveIteratorIterator {
                        function __construct($it) {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current() {
                            // return "<td style='width: 30px; border: 1px solid black;'>" . parent::current(). "</td>";
                            return "<td style='text-align:center'>" . parent::current(). "</td>";
                        }

                        function beginChildren() {
                            echo "<tr>";
                        }

                        function endChildren() {
                            echo "</tr>" . "\n";
                        }
                    }

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cs460 project 1 movie database";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT a1.name AS Actor, a2.name AS Actor2, a1.dob FROM people a1, people a2 WHERE (a1.dob = a2.dob AND a1.name <> a2.name AND a1.id < a2.id)");
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
                }
            ?>
        </div>
		
		<div class = "container">
            <form id="testing2" method="post" action="">
                <div class="input-group mb-3">
                    <input type="submit" name = "movie" value = "View all motion pictures"> 
                </div>
            </form>
			</div>
		
		 <div class="container">
            <?php
				$row = 0;
                if(isset($_POST['movie']))
                {
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
					
                    class TableRows extends RecursiveIteratorIterator {
                        function __construct($it) {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current() {
                            // return "<td style='width: 30px; border: 1px solid black;'>" . parent::current(). "</td>";
                            return "<td style='text-align:center'>" . parent::current(). "</td>";
                        }
						
                        function beginChildren() {
                            echo "<tr>";
                        }

                        function endChildren() {
                            echo "</tr>" . "\n";
					
                        }
						
                    }

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cs460 project 1 movie database";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT name from motionpicture");
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
							$lasteffort[] = $v;
							
                        }
                    }
					
					
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
					
                    $conn = null;
                    echo "</table>";
                }
				    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cs460 project 1 movie database";
					
					if(isset($lasteffort)) { ?>		
					<form method = "post">
					<?php 
					foreach ( $lasteffort as $heck ) {
					echo $heck; ?> 
					<p><input type="checkbox" name="likesArray[]" value="<?php echo $heck; ?>" /></p>
					<?php } echo "\n";?> 
					<input type = "Submit" name = "ThisISTHEWAY" value = "Like">
					</form> 
					<?php
						
                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT * from motionpicture");
                        $stmt->execute();
					}
					
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
					}
            ?>
        </div>
		
		<div class="container">
		<?php
				
				if(isset($_SESSION['user_name'])) {
					if(isset($_POST["ThisISTHEWAY"])) {
					if(!empty($_POST["likesArray"])) { 
						foreach ($_POST["likesArray"] as $likesA)
						{
							echo '<h3>You have liked the following motion pictures</h3>';
							echo '<p>' . $likesA .' as ' . $_SESSION['user_name'] .'</p>';
							try {
								$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
								$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

								// SQL
					
								$stmt = $conn->prepare("INSERT INTO likes  
														VALUES ((SELECT id from motionpicture where name = @likesA), (SELECT email from user where email = '{$_SESSION['user_name']}'))");
							
								$stmt->execute();
								
								
					}
					
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
						}
					}
					
				}
				}				
				?> 
			</div>
	
    </body>
</html>