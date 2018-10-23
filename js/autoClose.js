let code_area = document.querySelector("#code_area");

$("#code_area").keydown(function(e) {
    if(e.shiftKey && e.which == 219) {
        e.preventDefault();
        insertBracket(code_area,"{}");
    } else if(e.shiftKey && e.which == 57) {
        e.preventDefault();
        insertBracket(code_area,"()");
    } else if(e.shiftKey && e.which == 222) {
        e.preventDefault();
        insertBracket(code_area,"\"\"");
    } else if(e.which == 219) {
        e.preventDefault();
        insertBracket(code_area,"[]");
    } else if(e.which == 222) {
        e.preventDefault();
        insertBracket(code_area,"''");
    }
});

function insertBracket(o,value){
  var oS = o.scrollTop;
  if (o.setSelectionRange)
  {
    var sS = o.selectionStart;
    var sE = o.selectionEnd;
    o.value = o.value.substring(0, sS) + value + o.value.substr(sE);
    o.setSelectionRange(sS + 1, sS + 1);
    o.focus();
  }
  else if (o.createTextRange)
  {
    document.selection.createRange().text = value;
    e.returnValue = false;
  }
  o.scrollTop = oS;
}
