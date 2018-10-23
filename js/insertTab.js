$("#code_area").keydown(function(e)
{
    if (e.which == 9  && !e.shiftKey && !e.ctrlKey && !e.altKey) //ASCII tab
    {
        e.preventDefault();
        var start = this.selectionStart;
        var end = this.selectionEnd;
        var v = $(this).val();
        if (start == end)
        {
            $(this).val(v.slice(0, start) + "    " + v.slice(start));
            this.selectionStart = start+4;
            this.selectionEnd = start+4;
            return;
        }

        var selectedLines = [];
        var inSelection = false;
        var lineNumber = 0;
        for (var i = 0; i < v.length; i++)
        {
            if (i == start)
            {
                inSelection = true;
                selectedLines.push(lineNumber);
            }
            if (i >= end)
                inSelection = false;

            if (v[i] == "\n")
            {
                lineNumber++;
                if (inSelection)
                    selectedLines.push(lineNumber);
            }
        }
        var lines = v.split("\n");
        for (var i = 0; i < selectedLines.length; i++)
        {
            lines[selectedLines[i]] = "    " + lines[selectedLines[i]];
        }

        $(this).val(lines.join("\n"));
    }
});
