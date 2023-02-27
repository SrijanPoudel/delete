
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel='stylesheet'  href='Home.css'>
    <title>Delete questions</title>
    <style>
        h1{
            background-color:yellow;
			color:black;

        }
        input{
            width:30%;
            text-color:#fff;
            height:5%;
            border:1px;
            border-radius:05px;
            padding:8px 15px 8px 15px;
        }
        table td{
            color:#fff;
            font-size:1.2em;
            padding:10px;
            text-align:center;
        }
        .btn{
            background:#fff;
            color:darkorange;
            font-size:1.2em;
            padding:5px 30px;
            text-decoration:none;
        }

        
    </style>
</head>
<body>
<div class="backgroundNHC">
     <video src="My Movie 13.mov" muted loop autoplay></video> 
            <div class="overlay"></div> 
    <div class="QandA">
    <h2 class="head"><img src="file:///Users/srijanpoudel/Downloads/logo.png"width='250'></h2>
    <div class="main-container center">
        <!-- progress indicator -->
        <div class="circle-container center">
            <div class="semicircle"></div>
            <div class="semicircle"></div>
            <div class="semicircle"></div>
            <div class="outermost-circle"></div>
        </div>
        <div class="timer-container center">
            <div class="timer center"></div>
        </div>
</div>
    <center>    
        <h1>Delete Your Questions</h1>
        <table border="2">
            <tr>
                <th>Question number</th>
                <th>Questions</th>
                <th>Choices</th>
                <th>Operation</th>
            </tr>
            <?php
            include("db.php");
            if (isset($_GET['question_number'])){
                $question_number=$_GET['question_number'];
                
                // Delete from 'choices' table
                $delete_choices = mysqli_query($connection, "DELETE FROM `choices` WHERE question_number = '$question_number'");
                
                // Delete from 'questions' table
                $delete_questions = mysqli_query($connection, "DELETE FROM `questions` WHERE question_number = '$question_number'");
                
                if ($delete_choices && $delete_questions) {
                    echo '<script type="text/javascript">alert("Data Deleted")</script>';
                } else {
                    echo '<script type="text/javascript">alert("Data not Deleted")</script>';
                }
            }
            
            $query = "SELECT * FROM questions q JOIN choices c ON q.question_number=c.question_number";
            $data = mysqli_query($connection,$query);
            $total = mysqli_num_rows($data);
            
            if($total != 0){
                while(($result = mysqli_fetch_assoc($data))){
                    echo "
                    <tr>
                        <td>".$result['question_number']."</td>
                        <td>".$result['question_text']."</td>
                        <td>".$result['choice']."</td>
                        <td>
                            <a href='delete.php?question_number=".$result['question_number']."' class='btn'>Delete</a>
                        </td>
                    </tr>
                    ";
                }
            } else{
                echo "No records found";
            }
            
            ?>
        </table>
    </center>
</body>
</html>
