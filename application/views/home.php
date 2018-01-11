<html>
<head>
    <title>index</title>
    <?php echo link_tag('css/index.css'); ?>
</head>
<body>
<div class="container">
    <div class="left_menu">
        <h2>menu</h2>

        <ul>
            <li><a href="/form/category" target="content_body">add category</a></li>

            <li><a href="/form/image" target="content_body">add image</a></li>

            <li><a href="/form/banner" target="content_body">add banner</a></li>

        </ul>
    </div>

    <div class="content">
        <iframe name="content_body" scrolling="auto"></iframe>
    </div>
</div>
</body>
</html>