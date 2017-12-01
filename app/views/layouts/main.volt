<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,800" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  <link rel="stylesheet" href="/css/styles.css">
  <link href="/css/main.508c7389.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="/assets/icons/favicon.png">
  {% block header %}{% endblock %}
  <title>{% block title %}{% endblock %}</title>
</head>
<body>
{# navbar #}
{{ partial('layouts/navbar') }}

{# main section #}
<section class="main">
  {{ flash.output() }}

  {# content #}
  {% block content %}{% endblock %}
</section>

{# footer #}
{{ partial('layouts/footer') }}

<div class="white-overlay"></div>
<a class="button green found-a-bug" href="https://betterresearch.typeform.com/to/o3W0BI" target="_blank">Report a Bug 🐞</a>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
<script type="text/javascript" src="/js/api.js"></script>
<script type="text/javascript" src="/js/jquery.sticky-sidebar.min.js"></script>

{{ partial('layouts/scripts') }}

<script type="text/javascript" src="/js/react/main.8679a0b9.js"></script>
{% block scripts %}{% endblock %}

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110506889-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-110506889-1');
</script>
</body>
</html>
