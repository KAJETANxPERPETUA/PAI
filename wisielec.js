var haslo = word;
haslo = haslo.toUpperCase();
var hasloTransform = "";
var missed = 0;

var y = new Audio("yes.wav");
var n = new Audio("no.wav");

for (i = 0; i < haslo.length; i++) {
    if (haslo.charAt(i) == " ") hasloTransform = hasloTransform + " ";
    else hasloTransform = hasloTransform + "-";
} 
function displayHaslo() {
    document.getElementById("haslo").innerHTML = hasloTransform;
}

window.onload = startGame;

var litery = ["A","Ą","B","C","Ć","D","E","Ę","F","G","H","I","J","K","L","Ł","M","N","Ń",
                "O","Ó","P","Q","R","S","Ś","T","U","V","W","X","Y","Z","Ź","Ż"];

function startGame() {

    var divContent = "";

    for (i = 0; i < 35; i++) {
        var divName = "lit" + i;
        divContent = divContent + '<div class="litera" onclick="check('+ i +')" id="'
            + divName +'">'+ litery[i] +'</div>';
        if ((i+1) % 7 == 0) divContent = divContent + '<div style="clear:both"></div>';
    }

    document.getElementById("litery").innerHTML = divContent;
    displayHaslo();
}

String.prototype.ustawZnak = function(miejsce, znak) {
    if (miejsce > this.length - 1) {
        return this.toString();
    }
    else {
        return this.substr(0, miejsce) + znak + this.substr(miejsce+1);
    }
}

function check(number) {
    var trafiona = false;
    for (i = 0; i < haslo.length; i++) {
        if (haslo.charAt(i) == litery[number]) {
            hasloTransform = hasloTransform.ustawZnak(i, litery[number]);
            trafiona = true;
        }
    } 

    if (trafiona == true) {
        y.play();
        var divName = "lit" + number;
        document.getElementById(divName).style.background = "#06c258";
        document.getElementById(divName).style.color = "#059142";
        document.getElementById(divName).style.border = "3px solid #059142";
        document.getElementById(divName).style.cursor = "default";
    
        displayHaslo();
    }
    else {
        n.play();
        var divName = "lit" + number;
        document.getElementById(divName).style.background = "#9b1003";
        document.getElementById(divName).style.color = "#e3242b";
        document.getElementById(divName).style.border = "3px solid #e3242b";
        document.getElementById(divName).style.cursor = "default";
        document.getElementById(divName).setAttribute("onclick",";");

        missed++;
        var obraz = "img/s" + missed + ".jpg";
        document.getElementById("szubienica").innerHTML = '<img src="'+ obraz +'" alt=""/>';
    }

    if (haslo == hasloTransform) {
        document.getElementById("litery").innerHTML ='<span class="win">WINNER!</span><br/><br/>Prawidłowe hasło: ' + haslo + '<br/><br/><span class="reset" onclick="location.reload()">Play again!</span>';
    }

    if (missed >= 9) {
        document.getElementById("litery").innerHTML = '<span class="lose">LOSER!</span><br/><br/>Prawidłowe hasło: ' + haslo + '<br/><br/><span class="reset" onclick="location.reload()">Play again!</span>';
    }
}
