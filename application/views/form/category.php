<html>
<body>
<form action="/api/addCategory" method="post" enctype="application/x-www-form-urlencoded">
    <table>
        <tr>
            <td>
                <label>title</label>
            </td>
            <td>
                <input type="text" name="title"/>
            </td>
        </tr>
        <tr>
            <td>
                <label>desc</label>
            </td>
            <td>
                <input type="text" name="desc"/>
            </td>
        </tr>
        <tr>
            <td>
                <label>showText</label>
            </td>
            <td>
                <input type="text" name="show_text"/>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="comform"/>
            </td>
        </tr>
    </table>
</form>
</body>
</html>