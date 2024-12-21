<!DOCTYPE html>
<html>
<link rel="stylesheet" href="styles.css">

<head>
    <title>{{ title }}</title>
</head>
<body>
    {% include 'header.tpl' %}
    <div class="main-content">
    <p>Текущее время: {{ "now"|date("H:i:s") }}</p>
        <div class="content">
            {% include content_template_name %}
        </div>
        <div class="sidebar">
            {% include 'sidebar.tpl' %}
        </div>
    </div>
    {% include 'footer.tpl' %}
</body>
</html>
