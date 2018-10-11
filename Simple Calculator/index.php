<?php
session_start();
ob_start();
extract($_POST);

function validate()
{
    $pw = file("./credentials.config");
    for ($i = 0; $i < count($pw); $i++) {
        $line = explode(",", $pw[$i]);
        $emailcredentials = $line[0];
        $pwcredentials = $line[1];
        if (trim($_SESSION["email"]) === trim($line[0]) && trim($_SESSION["password"]) === trim($line[1])) {
            return true;
        }
    }

    return false;
}

if (!validate()) {
    header("Location: login.php");
}

if (!isset($_POST["submit"])) {
    $_SESSION["score"] = 0;
    $_SESSION["total"] = 0;
}

?>
<form class="form-horizontal" role="form" action="logout.php" method="post">
    <div class="form-group">
        <div class="col-sm-2 col-sm-offset-8">
            <div class="btn-group">
                <button type="submit" name="logout" class="btn btn-primary">logout</button>
            </div>
        </div>
    </div>
</form>

<head>
    <title>Math Game</title>
<link href="styles/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link rel="stylesheet" href="styles/math.css">
</head>
<body>
    <div class="basic-wrapper1">
    </div>
</body>
<form class="form-horizontal" role="form" action="index.php" method="post">
    
    <div class="center">
    <h3>Math Game</h3>
    <?php
$firstnum = rand(0, 50);
$secondnum = rand(0, 50);
$operation = array(
    ' + ',
    ' - '
);
$decision = rand(0, 1);
$equation = $firstnum . " " . $operation[$decision] . " " . $secondnum;
$sign = $operation[$decision];
$prev_firstnum = (int)$_POST["first_number"];
$prev_secondnum = (int)$_POST["second_number"];
$prev_operation = $_POST["operation"];
$prev_score = $_POST["score"];
$prev_total = $_POST["total"];
$prev_equation = $prev_firstnum . $prev_operation . $prev_secondnum;
echo $equation;
echo '<input type="hidden" name="first_number" value="' . $firstnum . '"/>';
echo '<input type="hidden" name="decision" value="' . $decision . '"/>';
echo '<input type="hidden" name="operation" value="' . $sign . '"/>';
echo '<input type="hidden" name="second_number" value="' . $secondnum . '"/>';
echo '<input type="hidden" name="equation" value="' . $equation . '"/>';
echo '<input type="hidden" name="score" value="' . $_SESSION["score"] . '"/>';
echo '<input type="hidden" name="total" value="' . $_SESSION["total"] . '"/>';
?>

    <div class="form=group">
        <div class="col-sm-2 col-sm-offset-5">
            <input type="text" class="form-control" name="answer" placeholder="Enter answer">
        </div>
    </div> 
        
    <div id="message">
        <?php

if (isset($message)) {
    echo $message;
}

?>
    </div>
    <br/><br/>
        
    <div class="form-group">
        <div class="col-sm-2 col-sm-offset-5">
            <div class="btn-group">
                <button type="submit" name="submit" class="btn btn-primary">Sumbit</button>
            </div>
        </div>
    </div>
        
        <?php

if (isset($_POST["submit"])) {
    if (is_numeric($_POST["answer"]) && !empty($_POST["answer"])) {
        if ((int)$_POST["decision"] === 0) {
            if ((int)($_POST["answer"]) === ($prev_firstnum + $prev_secondnum)) {
                echo '<p class="correct"> CORRECT!</p> ';
                $_SESSION["score"]+= 1;
                $_SESSION["total"]+= 1;
            }
            else {
                $_SESSION["total"]+= 1;
                echo '<p class="incorrect"> INCORRECT!</p> ';
                echo $prev_equation . " = " . ($prev_firstnum + $prev_secondnum);
            }
        }
        else {
            if ((int)($_POST["answer"]) === ($prev_firstnum - $prev_secondnum)) {
                echo '<p class="correct"> CORRECT!</p> ';
                $_SESSION["score"]+= 1;
                $_SESSION["total"]+= 1;
            }
            else {
                $_SESSION["total"]+= 1;
                echo '<p class="incorrect"> INCORRECT!</p> ';
                echo $prev_equation . " = " . ($prev_firstnum - $prev_secondnum);
            }
        }
    }
    else {
        echo '<p class="incorrect">You must enter number!</p>';
    }
}

echo "<br/>";
echo $_SESSION["score"] . " / " . $_SESSION["total"];
?>
    </div>    

</form>





