//category filter thing
var divs = ["Div1", "Div2", "Div3", "Div4", "Div5", "Div6"];
    var visibleDivId = null;
    function divVisibility(divId) {
      if(visibleDivId === divId) {
        visibleDivId = null;
      } else {
        visibleDivId = divId;
      }
      hideNonVisibleDivs();
    }
    function hideNonVisibleDivs() {
      console.log(visibleDivId);
      var i, divId, div;
      for(i = 0; i < divs.length; i++) {
        divId = divs[i];
        div = document.getElementById(divId);
        if(visibleDivId === divId) {
          div.style.display = "block";
        } else {
          div.style.display = "none";
        }
      }
    }

//text expander
shortcuts = {
  "cg" : "CodeGorilla",
  "js" : "JavaScript",
  "aj" : "Arend-Jan",
  "grn" : "Groningen",
  "jdb" : "Jorik de Boer",
  "jvd" : "Julia van Drunen",
  "evd" : "Eelke van Dijk"
}

window.onload = function() {
  var ta = document.getElementById("textinput");
  var timer = 0;
  var re = new RegExp("\\b(" + Object.keys(shortcuts).join("|") + ")\\b", "g");

  update = function() {
      ta.value = ta.value.replace(re, function($0, $1) {
          return shortcuts[$1.toLowerCase()];
      });
  }

  ta.onkeydown = function() {
      clearTimeout(timer);
      timer = setTimeout(update, 200);

  }

}

//comment delete button
function deleteComment(commentid) {
 var xhr = new XMLHttpRequest();
 var url = 'https://localhost/week4/deletecomment.php?id='+commentid;
 //console.log(url);
 var r = confirm("Delete this comment?");
 if (r == true) {

 xhr.open('post', url , false);
 xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
 xhr.send();

 location.reload();

  } else {

  }
}
