
/*  ******************* Captchar Functionality ***************************
  *********************************************************************  */
var finalCap;

function captcha() {
    let random_num = Math.random() * 10000;
    let floor_num = Math.floor(random_num);

    let digit = (num, c = 0) => {
        if (num) {
            return digit(Math.floor(num / 10), ++c);
        };
        return c;
    };

    let count = digit(floor_num);

    if (count == 3) {
        finalCap = floor_num + "0";
    }
    else if (count == 2) {
        finalCap = "0" + floor_num + "0";
    }
    else {
        finalCap = floor_num;
    }

    document.getElementById('capch').value = finalCap;

}

/*  ******************* Start Button Functionality ***************************
  *********************************************************************  */
function start() {
    document.getElementById("startbtn").style = "visibility:hidden;";
    // document.getElementById("startbtn").style = "display:none;";
    document.getElementById('submitbtn').disabled = true;
    document.getElementById('submitbtn').style.backgroundColor = "gray";

    document.getElementsByClassName('question')[0].style = "visibility:visible;";
    document.getElementById("opt1").style = "visibility:visible;";
    document.getElementById("opt2").style = "visibility:visible;";
    document.getElementById("opt3").style = "visibility:visible;";
    document.getElementById("opt4").style = "visibility:visible;";
    document.getElementById("currAns").style = "visibility:visible;";
    document.getElementsByClassName('timevisibility')[0].style = "visibility:visible;";
    document.getElementById("btnmargin").style = "visibility:visible;";

   
}


/*  ******************* Next Button Functionality ***************************
  *********************************************************************  */

let i = -1;
function nextfunction() {
    countDownTime = 15000;

    if (i <= 10) {
        i++;
        fetch("content/api").then(function (response) {
            return response.json();
        }).then(function (result) {
            document.getElementsByClassName('myid')[0].innerText = ` ${i + 1} : ${result[i].question}`;

            document.getElementById('opt1').innerHTML = `${result[i].option.opt1}`;
            document.getElementById('opt2').innerHTML = `${result[i].option.opt2}`;
            document.getElementById('opt3').innerHTML = `${result[i].option.opt3}`;
            document.getElementById('opt4').innerHTML = `${result[i].option.opt4}`;

        });

    }
    if (i == 10) {
       
        document.getElementById('submitbtn').disabled = false;
        document.getElementById('submitbtn').style.backgroundColor = "rgb(4, 184, 4)";
        disable();
        hiddenBeforeSubmit();
    }




    clearAllRadios();
    scoreing();
    enable();
}

/*  ******************* Timer Functionality ***************************
  *********************************************************************  */

var countDownTime = 15000;  // seconds in miliseconds

function time() {
    setInterval(function () {
        countdownfun();
    }, 1000);
}
function countdownfun() {
    var seconds = countDownTime / 1000;

    if (seconds > 9) {
        document.getElementById("countdown").innerHTML = seconds;
    }
    else {
        document.getElementById("countdown").innerHTML = "0" + seconds;
        if (seconds < 11 && seconds > 4) {
            document.getElementById("timer").style = "background-color: rgb(250, 135, 0);";
        }
        else if (seconds < 4 && seconds >= 0) {
            document.getElementById("timer").style = "background-color: rgb(250, 58, 0);";
        }
    }

    if (countDownTime > 0) {
        enable();
        countDownTime = countDownTime - 1000;
    }

    else {
        nextfunction();
        disable();
        document.getElementById("timer").style = "background-color: green;";
    }
}



function disable() {
    var radlist = document.getElementsByName('same');

    for (var j = 0; j < radlist.length; j++) {
        radlist[j].disabled = true;
    }
}

function enable() {
    var radlist = document.getElementsByName('same');

    for (var j = 0; j < radlist.length; j++) {
        radlist[j].disabled = false;
    }
}

function clearAllRadios() {
    var radlist = document.getElementsByName('same');
    for (var j = 0; j < radlist.length; j++) {
        if (radlist[j].checked) {
            radlist[j].checked = false;
        }
    }
    document.getElementById('opt1').style.backgroundColor = "rgba(131, 236, 255, 0.555)";
    document.getElementById('opt2').style.backgroundColor = "rgba(131, 236, 255, 0.555) ";
    document.getElementById('opt3').style.backgroundColor = "rgba(131, 236, 255, 0.555)";
    document.getElementById('opt4').style.backgroundColor = "rgba(131, 236, 255, 0.555)";
}



/*  ************** Options CSS (For Yellow Color) Functionality ****************
  *********************************************************************  */

var leave = 0, ansgiven = 0, correct = 0, wrong = 0;
var ans1 = "";

function ansfunction() {

    var type = document.getElementsByName('same');
    if (type[0].checked) {
        ans1 = document.getElementById('opt1').innerText;
        document.getElementById('opt1').style.backgroundColor = "yellow";
        document.getElementById('opt2').style.backgroundColor = "rgba(131, 236, 255, 0.555)";
        document.getElementById('opt3').style.backgroundColor = "rgba(131, 236, 255, 0.555)";
        document.getElementById('opt4').style.backgroundColor = "rgba(131, 236, 255, 0.555)";
    }
    else if (type[1].checked) {
        ans1 = document.getElementById('opt2').innerText;
        document.getElementById('opt2').style.backgroundColor = "yellow";
        document.getElementById('opt1').style.backgroundColor = "rgba(131, 236, 255, 0.555)";
        document.getElementById('opt3').style.backgroundColor = "rgba(131, 236, 255, 0.555)";
        document.getElementById('opt4').style.backgroundColor = "rgba(131, 236, 255, 0.555)";
    }
    else if (type[2].checked) {
        ans1 = document.getElementById('opt3').innerText;
        document.getElementById('opt3').style.backgroundColor = "yellow";
        document.getElementById('opt1').style.backgroundColor = "rgba(131, 236, 255, 0.555)";
        document.getElementById('opt2').style.backgroundColor = "rgba(131, 236, 255, 0.555)";
        document.getElementById('opt4').style.backgroundColor = "rgba(131, 236, 255, 0.555)";
    }
    else if (type[3].checked) {
        ans1 = document.getElementById('opt4').innerText;
        document.getElementById('opt4').style.backgroundColor = "yellow";
        document.getElementById('opt1').style.backgroundColor = "rgba(131, 236, 255, 0.555)";
        document.getElementById('opt2').style.backgroundColor = "rgba(131, 236, 255, 0.555)";
        document.getElementById('opt3').style.backgroundColor = "rgba(131, 236, 255, 0.555)";
    }
}



/*  ******************* Submit Functionality ***************************
  *********************************************************************  */

function subfunction() {
   
    // ********* Score Card *********

    fetch("content/api").then(function (response) {
        return response.json();
    }).then(function (result) {
        document.getElementById('totalquestion').innerHTML = `${result.length}`;
        document.getElementById('percent').innerHTML = `${((correct * 10) / 100) * 100}%`;
        document.getElementById('totalscore').innerHTML = `${(correct * 10)} / ${(result.length * 10)}`;

    });

    document.getElementById('attempt').innerHTML = `${ansgiven + wrong}`;
    document.getElementById('correct').innerHTML = `${correct}`;
    document.getElementById('leave').innerHTML = `${leave + (10 - i)}`;
    document.getElementById('wrong').innerHTML = `${wrong}`;

    var condition;
    if (correct == 10) {
        condition = "Awesome";
    }
    else if (correct > 7 && correct < 10) {
        condition = "Very Good";
    }
    else if (correct > 4 && correct < 8) {
        condition = "Good";
    }
    else if (correct > 2 && correct < 5) {
        condition = "You Need to Hard Work";
    }
    else {
        condition = "Poor";
    }


    document.cookie = "attempt=" + `${ansgiven + wrong}`;
    document.cookie = "correct=" + `${correct}`;
    document.cookie = "wrong=" + `${wrong}`;
    document.cookie = "leave=" + `${leave + (10 - i)}`;
    document.cookie = "score=" + `${(correct * 10)}`;
    document.cookie = "condition=" + `${condition}`;
    document.cookie = "flag=" + `15`;
    window.location.href = "quiz.php";

}

function scoreing() {
    ansfunction();

    fetch("content/api").then(function (response) {
        return response.json();
    }).then(function (result) {
        if (ans1 == result[i - 1].ans) {
            ansgiven++;
            correct++;
            ans1 = "";
        }
        else if (ans1 == "") {
            leave++;
            ans1 = "";
        }
        else {
            wrong++;
            ans1 = "";
        }
        document.getElementById('ansgive').innerHTML = `${(ansgiven + wrong)} / 10`;

    });

}


function hiddenBeforeSubmit() {
    document.getElementsByClassName('question')[0].style = "visibility:hidden;";
    document.getElementById("opt1").style = "visibility:hidden;";
    document.getElementById("opt2").style = "visibility:hidden;";
    document.getElementById("opt3").style = "visibility:hidden;";
    document.getElementById("opt4").style = "visibility:hidden;";
    document.getElementById("currAns").style = "visibility:hidden;";
    document.getElementsByClassName('timevisibility')[0].style = "visibility:hidden;";
    
    document.getElementById('nextbtn').style= "visibility:hidden;";
    document.getElementById("btnmargin").style.marginTop="-12rem";
    document.getElementById("btnmargin").style.marginRight="22rem";

}
// **************************************************************************************