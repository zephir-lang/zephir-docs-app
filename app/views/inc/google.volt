{%- if (not config.path('app.googleAnalytics', '') is empty) -%}
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90249744-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '{{ config.path('app.googleAnalytics') }}');
    </script>
{% endif %}
