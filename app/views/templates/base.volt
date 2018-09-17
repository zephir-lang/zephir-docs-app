{{ get_doctype() }}
<!--[if IE 8]>
<html lang="{{ language }}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="{{ language }}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ language }}" class="no-js">
<!--<![endif]-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ config.path('app.descriptionLong')}}.">
    <meta name="author" content="Pphalcon Team">
    <meta name="generator" content="Phalcon Team">

    <link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
          crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/js/highlight/styles/darcula.css">
    <link rel="stylesheet" href="/css/docs.min.css?v={{ date('YmdHis') }}" >

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.css" />

    <link rel="shortcut icon" href="/favicon.ico">

    <title>Zephir Language — Zephir {{ config.path('app.version') }} documentation</title>

    <!-- Favicons -->
    <!-- @todo -->

    <!-- Twitter -->
    <!-- @todo -->

    <!-- Facebook -->
    <!-- @todo -->

    {%- include 'inc/google.volt' -%}
</head>
<body style="">
    {%- include 'inc/header.volt' -%}

    <div class="container-fluid">
        <div class="row flex-xl-nowrap">
            <div class="col-12 col-md-3 col-xl-2 bd-sidebar">
                {% include 'inc/search.volt' %}

                <nav class="collapse bd-links" id="bd-docs-nav">
                    <div class="bd-toc-item active">
                        <ul class="nav bd-sidenav">
                            {{ sidebar }}
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="d-none d-xl-block col-xl-2 bd-toc">
                <ul class="section-nav">
                    {{ menu }}
                </ul>
            </div>

            <main class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content" role="main">
                {{ article }}
            </main>
        </div>
    </div>

    <footer>
        <div class="footer">
            Zephir Language is an open source project licensed under
            <a href="/{{ language }}/{{ version }}/license">MIT license.</a>
                &copy; Copyright 2013-present, Zephir Team.
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    {%- include 'inc/algolia.volt' -%}
    <script type="text/javascript" src="/js/highlight/highlight.pack.js"></script>
    <script type="application/javascript">hljs.initHighlightingOnLoad();</script>
</body>
</html>
