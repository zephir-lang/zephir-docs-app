{% if page is defined %}
    {% set suffix = '/' ~ page %}
{% else %}
    {% set suffix = '' %}
{% endif %}
        {% set languages = config.path('app.languages', []) %}
<li class="nav-item dropdown">
    <a class="nav-item nav-link dropdown-toggle mr-md-2"
       href="{{ config.path('app.url') }}/{{ language }}/{{ version }}"
       id="bd-versions"
       data-toggle="dropdown"
       aria-haspopup="true"
       aria-expanded="false">
        <img class="no-shadow lang-image"
             src="https://d2srrzh48sp2nh.cloudfront.net/31cd209e/images/flags/{{ languages[language]['code'] }}.png">
        {{ languages[language]['name'] }}
    </a>
    <div class="dropdown-menu dropdown-menu-right"
         aria-labelledby="bd-versions">
        {#{% for item in config.path('app.versions', []) %}#}
        {% for key, data in languages %}
            <a class="dropdown-item{% if language === key %} active{% endif %}"
               href="{{ config.path('app.url') }}/{{ key }}/{{ version }}{{ suffix }}">
                <img class="no-shadow lang-image"
                     src="https://d2srrzh48sp2nh.cloudfront.net/31cd209e/images/flags/{{ data['code'] }}.png">
                {{ data['name'] }}
            </a>
        {% endfor %}
    </div>
</li>
