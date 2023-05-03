<?php
// Initialize the session
session_start();
include("global.php");  
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="stylesheet" type="text/css" href="./css/upload.css">
    <link rel="stylesheet" type="text/css" href="./css/index.css">
    <link rel="stylesheet" type="text/css" href="./css/videos.css">
    <style>
        .box {
    border: 1px solid black;
    border-radius: 5px;
    padding: 4px;
    overflow:hidden;
    background-color: #FFF;
}
.box > h3 {
    margin-top: 0px; 
    margin-bottom: 2px;
    font-size: 15px;
}
.box > form > input {
    margin-bottom: 2px;
    float:right;
    overflow:hidden;
}
.box > form > label {
    overflow:hidden;
    float:left;
}
.boxheader {
    padding: 4px;
    padding-bottom: 0;
    font-size: 15px;
    margin-top: -22px;
    margin-bottom: -13px;
    margin-left: -5px;
    margin-right: -5px;
    background: rgb(99,99,99);
    color: white;
}
.fvid {
    margin-top: -10px;
}
.fvid > a {
    align-content: center !important;
    text-align: center;
    font-size: 13px;
    font-weight:bold;
    margin: auto;
}
.vimg90 {
    width: 90px;
    height: 70px;
    border: 1px solid #999;
}
</style>
</head>
<body>
    <div class="container">
        <!--start header-->
<?php include("header.php"); ?>
<!--end header-->
<?php
$statement = $mysqli->prepare("SELECT `username`, `id`, `description`, `date` FROM `users` WHERE `username` = ? LIMIT 1");
$statement->bind_param("s", $_GET['user']);
$statement->execute();
$result = $statement->get_result();
if($result->num_rows === 0) echo("<script>window.location.href = '/index.php?msg=This user does not exist!';</script>");
while($row = $result->fetch_assoc()) {
	$ago_join = time_elapsed_string(''.$row['date'].'');
    $joindate = date("F d, Y", strtotime($row["date"]));
echo '<h1></h1>
			<!-- Personal Information: -->
			<div class="box" style="width: 300px;float: left;">
        <div class="boxheader profile">';
        echo '<!--<h3>'.$row['username'].'&apos;s Channel <a style="float: right; margin: 0; font-size: 10px; border-radius:2px; padding: 5px;padding-top:3px;padding-bottom:3px;margin-top:-1px;color: #994800;text-decoration: none;border: 1px solid #fde367;" class="uploadbutton" href="#">Subscribe</a></h3>
        --></div>
        <img src="/defaultpfp.png" width="96px" style="float: left;padding-right:5px;">
		<small>
            <br>
			Joined: <span title="'.$ago_join.'">'.$joindate.'</span>
            <br><em>'.$row['description'].'</em>
       	</small>';}?>
                </div> 
                <div class="box" style="width:460px;float: right;">
                <div class="boxheader profile">
                <h3>Videos</h3>
                </div>
                <div class="fvidcont" style="padding: 5px;padding-top: 10px;">
                <?php
                $statement = $mysqli->prepare("SELECT * FROM `videos` WHERE `author` = ? LIMIT 5");
                    $statement->bind_param("s", $_SESSION['username']);
                    $statement->execute();
                    $result = $statement->get_result();
                    if($result->num_rows !== 0){
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="fvid">
                        <img src="/content/thumb/'.$row['thumb'].'" class="vimg90">
                        <br>
                        <a href="/watch?v='.$row['vid'].'">'.$row['videotitle'].'</a>
                        <br>
                        <a href="#" style="color: darkgray;"><small>'.$row['views'].' views</small></a>
                        </div>';
                    }
                    }
                    else{
                        echo("This channel has no videos.");
                    }
                    $statement->close();
                    ?>
                </div>
                </div>
                <?php
$statement = $mysqli->prepare("SELECT `username`, `id`, `description`, `date` FROM `users` WHERE `username` = ? LIMIT 1");
$statement->bind_param("s", $_GET['user']);
$statement->execute();
$result = $statement->get_result();
if($result->num_rows === 0) echo("<script>window.location.href = 'index.php?msg=This user does not exist!';</script>");
while($row = $result->fetch_assoc()) {
    echo '
                <div class="box" style="margin-top: 10px;width:300px;float:left;">
                <div class="boxheader profile">
                <h3>Connect with '.$row["username"].'</h3>
                </div>
<center><a href="#">Send a Message</a><br><a href="#">Add Comment</a><br><a href="#">Share Channel</a>
<br><a href="http://revid.pw/user/'.$row["username"].'"><small style="font-size: smaller;">http://revid.pw/user/'.$row["username"].'</small></a>
                </div>			
			'; } ?>
</body>
</html>
</div>
<?php include("footer.php"); ?>