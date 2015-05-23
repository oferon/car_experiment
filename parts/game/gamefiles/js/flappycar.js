/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function btnClickHandler()
{
    var client = new XMLHttpRequest();
    var postdata= "action=1&state=1";
    
    
    client.open("POST", "./php/saveClickData.php");
    client.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        
    client.onreadystatechange = function () {
        if (client.readyState == client.DONE && client.status == 200) {
            alert(client.responseText);
        }
    };
    
    client.send(postdata);
    
}

function showDialog()
{
    
    var w = window.innerWidth;
    var h = window.innerHeight;
    
    
    var dialog = document.getElementById("rating_dialog");
    dialog.style.display = "block";
    dialog.style.position = "absolute";
    dialog.style.left = ((w - dialog.offsetWidth) / 2)+"px";
    dialog.style.top = ((h - dialog.offsetHeight) / 2)+"px";
    
    var checkbox = document.getElementById("rating_c_box");
    checkbox.checked = false;
    
    isGamePaused = true;
    
}

function hideRatingDialog()
{   
    var dialog = document.getElementById("rating_dialog");
    dialog.style.display = "none";   
    isGamePaused = false;   
}


function saveRatingDialog(client_score)
{
    var state2 = (session * 10);
    var client = new XMLHttpRequest();
    var postdata = "action=" + encodeURIComponent(unescape(client_score)) + "&state=" + encodeURIComponent(unescape(state2));
    client.open("POST", "gamefiles/php/saveClickData.php");
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.send(postdata);
    //alert('popup'+popup);
    if(client_score===-999) // user decided to bail out...
    {
        overide=true;
        var yyy=false;
        var client = new XMLHttpRequest();
        var postdata = "popup=" + encodeURIComponent(unescape(yyy));
        client.open("POST", "gamefiles/php/setShowPopup.php");
        client.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        client.send(postdata);  
        popup = false;
    }
    

    var boxes = document.getElementsByClassName("score_cbox");
    
    for (var i = 0; i < boxes.length; i++)
    {
        boxes[i].checked = false;
    }

    var dialog = document.getElementById("rating_dialog");
    dialog.style.display = "none";
    isGamePaused = false;
}

