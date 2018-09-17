{%- if (not config.path('app.algoliaSearchKey', '') is empty) -%}
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>
    <script type="text/javascript"> docsearch({
            apiKey: '{{ config.path('app.algoliaSearchKey', '') }}',
            indexName: 'zephir-lang',
            inputSelector: '#docs-search',
            algoliaOptions: {
                'facetFilters': ["lang:{{ language }}", "version:{{ version }}"]
            },
            debug: false
        });
    </script>
{% endif %}
