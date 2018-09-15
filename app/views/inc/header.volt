<header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar">
    <a class="navbar-brand mr-0 mr-md-2"
       href="{{ config.path('app.url') }}"
       aria-label="Zephir Documentation">
        <img class="bd-brand-logos" src="/images/logo.png">
    </a>

    <div class="navbar-nav-scroll">
        <ul class="navbar-nav bd-navbar-nav flex-row">
            <li class="nav-item">
                <a class="nav-link active"
                   href="{{ config.path('app.url') }}/{{ language }}/{{ version }}">
                    Zephir {{ version }} Documentation
                </a>
            </li>
        </ul>
    </div>

    <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
        {% include 'inc/header-languages.volt' %}
        {% include 'inc/header-versions.volt' %}

        <li class="nav-item">
            <a class="nav-link p-2"
               href="https://github.com/phalcon/zephir"
               target="_blank"
               rel="noopener"
               aria-label="GitHub">
                <i class="fab fa-github" aria-hidden="true"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link p-2"
               href="https://twitter.com/zephirlang"
               target="_blank"
               rel="noopener"
               aria-label="Twitter">
                <i class="fab fa-twitter" aria-hidden="true"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link p-2"
               href="https://www.facebook.com/groups/zephir.language/"
               target="_blank"
               rel="noopener"
               aria-label="Facebook">
                <i class="fab fa-facebook" aria-hidden="true"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link p-2"
               href="https://discordapp.com/channels/310910488152375297/310925465462505475"
               target="_blank"
               rel="noopener"
               aria-label="Discord">
                <i class="fab fa-discord" aria-hidden="true"></i>
            </a>
        </li>
    </ul>
</header>
