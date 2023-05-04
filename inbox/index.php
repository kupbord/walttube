<!DOCTYPE html>
<?php include '../global.php';?>
<?php include '../bancheck.php';?>
<html dark-theme='light'>
<head>
    <link rel="stylesheet" type="text/css" href="../css/global.css">
    <link rel="stylesheet" type="text/css" href="../css/upload.css">
    <link rel="stylesheet" type="text/css" href="../css/inbox.css">
</head>
<body>
    <?php include("../header.php");?>
    <a style="float:right;" href="compose.php">New Message</a>
    <strong><h2>Inbox</h2></strong>
    <hr>
    <table>
                        <thead>
                          <tr>
                            <th>From</th>
                            <th>Subject</th>
                            <th>Content</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
            <?php
                    $statement = $mysqli->prepare("SELECT * FROM inbox WHERE reciever = ? ORDER BY id DESC");
                $statement->bind_param("s", $_SESSION['profileuser3']);
                $statement->execute();
                $result = $statement->get_result();
                if($result->num_rows !== 0){
                    while($row = $result->fetch_assoc()) {
                        $out = strlen($row['content']) > 25 ? mb_substr($row['content'],0,25)."..." : $row['content'];
                        echo '
                          <tr class="message">
                            <td>'.$row['sender'].'</td>
                            <td>'.$row['subject'].'</td>
                            <td>'.$out.'</td>
                            <td><a href="view?id='.$row['id'].'">View</a></td>
                          </tr>
                          <tr>
                        ';
                    }
                }
                else{
                    echo "You have no mail.";
                }
                $statement->close();
            ?>
            </tbody>
                      </table>
	<?php include("../footer.php") ?>
</body>
</html>