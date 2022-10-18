

<?php
 include "connection.php";
 session_start();

     $uid = $_SESSION['userid'];
     $myStatus = $_SESSION['status'];

if(isset($_COOKIE['flag'])){
       
        submitfunction();

        // delete cookie 
        setcookie('flag','',time()-3600);
        setcookie('attempt','',time()-3600);
        setcookie('correct','',time()-3600);
        setcookie('wrong','',time()-3600);
        setcookie('leave','',time()-3600);
        setcookie('score','',time()-3600);
        setcookie('condition','',time()-3600);
    // }
}

    function submitfunction(){
        include "connection.php";
        $uid = $_SESSION['userid'];

        $statusUpdateSql = "UPDATE `userdata` SET `status` = '0' WHERE `userdata`.`userid` = {$uid};
        ";
        mysqli_query($conn,$statusUpdateSql);


        $attempt = $_COOKIE['attempt'];
        $correct = $_COOKIE['correct'];
        $wrong = $_COOKIE['wrong'];
        $leave = $_COOKIE['leave'];
        $score = $_COOKIE['score'];
        $condition = $_COOKIE['condition'];

        $sql1 = "UPDATE `userdata` SET `attempt` = '{$attempt}', `correct` = '{$correct}', `wrong` = '{$wrong}', `leave` = '{$leave}', `score` = '{$score}', `condition` = '{$condition}' WHERE `userdata`.`userid` = {$uid}";
        mysqli_query($conn,$sql1);

        
    }


     $currStatus = "SELECT status FROM userdata WHERE userid = {$uid}";
    $statusResult =mysqli_query($conn,$currStatus);
    while($finalStatusRes = mysqli_fetch_assoc($statusResult)){
        $myStatus = $finalStatusRes['status'];
    }


    $sql = "SELECT * FROM userdata WHERE userid = '{$uid}'";
    $result = mysqli_query($conn,$sql);
   
    while($row = mysqli_fetch_assoc($result)){
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $mail = $row['mail'];
        $image = $row['image'];
        $gender = $row['gender'];
        $condition = $row['condition'];
        $score = $row['score'];
     }


   
     if($myStatus == 0){
     

        $sql3 = "SELECT * FROM userdata WHERE userid = '{$uid}'";
        $result3 = mysqli_query($conn,$sql3);
   
    while($row3 = mysqli_fetch_assoc($result3)){
        $attempt = $row3['attempt'];
        $correct = $row3['correct'];
        $wrong = $row3['wrong'];
        $leave = $row3['leave'];
        $score = $row3['score'];
     
     }
    }
     
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    
    
    <!-- BootStrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
        <link rel="stylesheet" href="quizstyle.css">

        <script src="quiz.js"></script>
</head>

<body id="back" >
    <div class="container-fluid">
        <div class="row mt-4 text-center">
            <div class="col-md-6" id="title" style="border-bottom: 1px solid rgb(82, 81, 81);">
                <h1 id="wellcome">Wellcome <?php echo strToUpper($firstname); ?> To Quiz4U</h1>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-9 justify-content-end">
                <div class="mainbox">
                    <h5><b>Rules</b></h5>
                    <marquee width="90%" direction="left">

                        <span style="color: red; padding: 0 2rem 0 1rem;">1. In this Quiz, there will be 10 easy
                            questions that you have to
                            answer.
                        </span>
                        <span style="color: rgb(37, 114, 7); padding: 0 2rem 0 2rem;"> 2. Tick the right answer and if
                            your answers Correct then
                            youget 10 points.</span>
                        <span style="color: rgb(7, 41, 114); padding: 0 2rem 0 2rem;"> 3. After completing 10 questions,
                            click on the Submit.
                        </span>
                        <span style="color: rgb(114, 7, 78); padding: 0 4rem 0 2rem;"> 4. Your score will be displayed
                            on the screen in the end.
                        </span>
                        <span> 5. Good Luck for the game ,and I hope you do well. </span>
                    </marquee>

                </div>
            </div>
            <div class="col-md-3 mt-3 text-center">
             
                <span style="font-size: 1.4rem;padding:0.4rem;font-weight: bold;background-color: white;color: rgb(0, 110, 80);border-radius:0.3rem;"><?php echo "Hello ". ucfirst($firstname); ?></span>
                
                <a href="logout.php" class="btn btn-danger ms-2 mb-2">Log Out</a>
               
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4 mb-3">
                <div class="mainbox p-3">
                    <img src="profiles_photos/<?php echo $image ?>" style="height:12rem;width:12rem; border-radius:50%;" alt="" >
                    <h4 id="welnames"> <?php echo ucfirst($firstname ." " . $lastname); ?></h4>

                    <div class="row mt-4">

                        <div class="col-md-12">
                            <div id="simplecontent">
                                <div id="fnaming"><b>First Name &nbsp;: </b> <?php echo $firstname; ?> </div>
                                <div id="lnaming"><b>Last Name &nbsp;&nbsp;:  </b> <?php echo $lastname; ?> </div>
                                <div id="gendering"><b>Gender &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> <?php echo $gender ?> </div>
                                <div id="emailing"><b>Mail ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> <?php echo $mail ?> </div>
                                <div id="status" style="font-weight:bold;"><b>Condition &nbsp;&nbsp;: </b> </b> <?php echo $condition ?> </div>
                                <div id="gamestatus" style="font-weight:bold;"><b style='color:black;'>Score &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> <?php echo $score ?> </div>
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="col-md-8">
                <div class="mainbox mb-3 p-4 text-start">

                    <div class="paddingcss"></div>
                    <div class="row question">
                        <div class="col-md-12">
                            <div class="myid"></div>
                        </div>
                    </div>


                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-check-inline" id="opti1">
                                    <input type="radio" class="form-check-input" id="option1" name="same"
                                        onclick="ansfunction()" style="display:none">
                                    <label for="option1" class="form-check-label" id="opt1"></label>
                                </div>

                                <div class="form-check-inline" id="opti2">
                                    <input type="radio" class="form-check-input" id="option2" name="same"
                                        onclick="ansfunction()" style="display:none">
                                    <label for="option2" class="form-check-label" id="opt2"></label>
                                </div>

                                <div class="form-check-inline" id="opti3">
                                    <input type="radio" class="form-check-input" id="option3" name="same"
                                        onclick="ansfunction()" style="display:none">
                                    <label for="option3" class="form-check-label" id="opt3"></label>
                                </div>

                            
                                <div class="form-check-inline" id="opti4">
                                    <input type="radio" class="form-check-input" id="option4" name="same"
                                        onclick="ansfunction()" style="display:none">
                                    <label for="option4" class="form-check-label" id="opt4"></label>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4" style="margin-top:2rem;">
                         
                        <?php if($myStatus == -1){ ?>

                            <button data-bs-toggle="modal" role="button" onclick="nextfunction(),time(),start()"
                                id="startbtn">
                                Start
                            </button>
                            <?php }else{ ?>
                            <button class="btn btn-success" style="position: relative; right:-3rem;visibility: visible;"
                                data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal"
                                id="seeScoreCardbtn"> Your Score Card </button>
                            <?php } ?>
                            
                        </div>

                        <div class="col-md-4 timevisibility">
                            <div id="timer">
                                <h2 id="countdown"></h2>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4 mb-2">
                        <div class="col-md-4 mt-0">
                            <div id="currAns"><span><b>Answer :- </b></span> &nbsp; <span id="ansgive">0 / 10</span>
                            </div>
                        </div>
                        <div class="col-md-8">

                            <div class="modal fade" id="exampleModalToggle" aria-hidden="true"
                                aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Your Score</h3>
                                            </div>

                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped table-bordered table-light">

                                                <tbody class="text-center">
                                                    <tr>
                                                        <th scope="row">Total Question</th>
                                                        <td id="totalquestion">10</td>
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Attempt</th>
                                                        <td id="attempt"><?php echo $attempt; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Correct</th>
                                                        <td id="correct"><?php echo $correct; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Wrong</th>
                                                        <td id="wrong"><?php echo $wrong; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Leave</th>
                                                        <td id="leave"><?php echo $leave; ?></td>
                                                    </tr>
                                                   
                                                    <tr>
                                                        <th scope="row">Your Total Score</th>
                                                        <td id="totalscore"><?php echo ($correct*10); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="text-center">
                                                <h3 id="thxnname" style="color: rgb(236, 18, 127);"></h3>
                                                <button class="btn btn-danger"
                                                    style="position: relative; left:-2rem; margin:0.7rem;"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button class="btn btn-success"
                                                    style="position: relative; right:-2rem; margin:0.7rem;"
                                                    data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                                                    data-bs-dismiss="modal" onclick="viewans()">View Answer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModalToggle2" aria-hidden="true"
                                aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                <div class="modal-dialog modal-xl mt-2 mb-0 modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalToggleLabel2">Quiz Answer</h5>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped table-bordered table-light">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th scope="col">S.No</th>
                                                        <th scope="col">Question</th>
                                                        <th scope="col">Answer</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                     $quesNo=1;
                                                     while($quesNo <= 10){

                                                   $quesAns = "SELECT * FROM questionanswer WHERE questionid= {$quesNo}";
                                                    $quesAnsresult = mysqli_query($conn,$quesAns);
                                                   
                                                    while($quesAnsrow = mysqli_fetch_assoc($quesAnsresult)){
                                                        
                                                      
                                                        
                                                ?>
                                                    <tr>
                                                        <th scope="row" id="idnum"><?php echo $quesAnsrow['questionid']; ?></th>
                                                        <td id="ques"><?php echo $quesAnsrow['questions']; ?></td>
                                                        <td id="answ"><?php echo $quesAnsrow['answer']; ?></td>
                                                    </tr>

                                                    <?php
                                                         
                                                       }
                                                       $quesNo++;

                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" data-bs-target="#exampleModalToggle"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">Back to Previous
                                                Page</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                           
                           <div id="btnmargin">
                            <form method="post" >
                                <input type="submit" value="Submit" name="submithua" onclick="subfunction()" id="submitbtn">
                            </form>
                            

                            <button id="nextbtn" onclick="nextfunction()">Next</button>

                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</body>
<!-- BootStrap JS Link -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>

</html>

<!-- ************************************************************************************** -->
