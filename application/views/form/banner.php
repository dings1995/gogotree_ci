<html>
<body>

<?php echo $error;?>

<form action="/upload/do_upload_banner" method="post" enctype="multipart/form-data">
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
                <label>image title</label>
            </td>
            <td>
                <input type="text" name="image_title"/>
            </td>
        </tr>
        <tr>
            <td>
                <label>image sub_title</label>
            </td>
            <td>
                <input type="text" name="image_sub_title"/> can empty
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
                <label>banner title</label>
            </td>
            <td>
                <input type="text" name="title"/> can empty
            </td>
        </tr>
        <tr>
            <td>
                <label>banner desc</label>
            </td>
            <td>
                <input type="text" name="desc"/> can empty
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