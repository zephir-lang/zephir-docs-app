{% if page is defined %}
{% set suffix = '/' ~ page %}
{% else %}
{% set suffix = '' %}
{% endif %}
        <li class="nav-item dropdown">
            <a class="nav-item nav-link dropdown-toggle mr-md-2"
               href="{{ config.path('app.url') }}/{{ language }}/{{ version }}"
               id="bd-versions"
               data-toggle="dropdown"
               aria-haspopup="true"
               aria-expanded="false">
                <img class="no-shadow lang-image"
                     src="https://d2srrzh48sp2nh.cloudfront.net/31cd209e/images/flags/{{ language }}.png">
                {{ language }}
            </a>
            {% set languages = config.path('app.languages', []) %}
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                {#{% for item in config.path('app.versions', []) %}#}
                {% for item, label in languages %}
                    <a class="dropdown-item{% if language === item %} active{% endif %}"
                       href="{{ config.path('app.url') }}/{{ item }}/{{ version }}{{ suffix }}">
                        <img class="no-shadow lang-image"
                             src="https://d2srrzh48sp2nh.cloudfront.net/31cd209e/images/flags/{{ item }}.png">
                        {{ label }}
                    </a>
                {% endfor %}
            </div>
        </li>
