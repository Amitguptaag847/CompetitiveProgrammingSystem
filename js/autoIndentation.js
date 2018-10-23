$("#code_area").keypress(function(e)
{
    if (e.which == 13) // ASCII newline
    {
        setTimeout(function(that)
        {
            var start = that.selectionStart;
            var v = $(that).val();
            var thisLine = "";
            var indentation = 0;
            for (var i = start-2; i >= 0 && v[i] != "\n"; i--)
            {
                thisLine = v[i] + thisLine;
            }
            for (var i = 0; i < thisLine.length && thisLine[i] == " "; i++)
            {

                indentation++;
             }
             $(that).val(v.slice(0, start) + " ".repeat(indentation) + v.slice(start));
             that.selectionStart = start+indentation;
             that.selectionEnd = start+indentation;
}, 0.01, this);
     }
});
