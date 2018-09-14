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
    <title>Zephir Language — Zephir {{ config.path('app.version') }} documentation</title>
    <link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="/js/highlight/styles/darcula.css">
    <link rel="stylesheet" href="/css/docs.css" type="text/css">
    <link rel="shortcut icon" href="/favicon.ico">

    {%- if (not config.get('google').get('analytics', '') is empty) -%}
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90249744-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{ config.path('google.analytics') }}');
    </script>
    {% endif %}

</head>
<body>

    <div>
        <div class="related">
            <ul>
                <li class="right">
                    <a href="https://zephir-lang.com/">
                        Zephir Language
                    </a>
                </li>
                <li>
                    <a href="/{{ language }}/{{ version }}/">
                        Zephir {{ config.path('app.version') }} documentation
                    </a>
                </li>
            </ul>
        </div>
        <table width="100%">
            <tbody>
            <tr>
                <td class="primary-box" width="20%" valign="top">
                    {{ sidebar }}
                </td>
                <td class="second-box" valign="top">
                    <div class="document">
                        <div class="documentwrapper">
                            <div class="bodywrapper">
                                <div class="body">
                                    <div class="section" id="zephir-language">
                                        {{ article }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="related">
            <ul>
                <li class="right">
                    <a href="https://zephir-lang.com/">
                        Zephir Language
                    </a>
                </li>
                <li>
                    <a href="/{{ language }}/{{ version }}/">
                        Zephir {{ config.path('app.version') }} documentation
                    </a>
                </li>
            </ul>
        </div>
        <div id="footer">
            <p>
                Zephir Language is an open source project licensed under
                <a href="/{{ language }}/{{ version }}/license">MIT license.</a>
            </p>
            <p>
                &copy; Copyright 2013-present, Zephir Team.
            </p>
        </div>
    </div>

    <script type="text/javascript" src="/js/highlight/highlight.pack.js"></script>
    <script type="application/javascript">hljs.initHighlightingOnLoad();</script>
</body>
</html>
