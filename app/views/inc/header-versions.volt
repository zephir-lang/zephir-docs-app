        <li class="nav-item dropdown">
            <a class="nav-item nav-link dropdown-toggle mr-md-2"
               href="{{ config.path('app.url') }}/{{ language }}/{{ version }}"
               id="bd-versions"
               data-toggle="dropdown"
               aria-haspopup="true"
               aria-expanded="false">
                {{ version }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                {% for item in config.path('app.versions', []) %}
                    <a class="dropdown-item{% if loop.first %} active{% endif %}"
                       href="{{ config.path('app.url') }}/{{ language }}/{{ item }}">{{ item }}</a>
                {% endfor %}
            </div>
        </li>
