<html>
<body>

<?php echo $error;?>

<form action="/upload/do_upload_image" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>
                <label>file</label>
            </td>
            <td>
                <input type="file" name="image"/>
            </td>
        </tr>
        <tr>
            <td>
                <label>category</label>
            </td>
            <td>
                <select name="item_id">
                    <?php foreach ($categorys as $category) {?>
                        <option value="<?=$category["id"]?>"><?= $category["title"]?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
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
                <label>sub title</label>
            </td>
            <td>
                <input type="text" name="sub_title"/> can empty
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