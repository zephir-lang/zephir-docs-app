<p align="center">
    <a href="https://zephir-lang.com/" target="_blank">
        <img src="https://assets.phalcon.io/zephir/zephir_logo-105x36.svg" height="100" alt="Phalcon"/>
    </a>
</p>

<p align="center">
    Hosting by:
    <br />
    <a href="https://www.netlify.com">
        <img src="https://www.netlify.com/img/global/badges/netlify-color-accent.svg"/>
    </a>
</p>

# Zephir - Documentation site source

This is the official documentation site source code. The site is leveraging Jekyll and is deployed to [Netlify](https://app.netlify.com)

If you are interested in translating our documents, you can visit [our project in Crowdin](https://crowdin.com/project/zephir-documentation).

[![Crowdin](https://d322cqt584bo4o.cloudfront.net/zephir-documentation/localized.svg)](https://crowdin.com/project/zephir-documentation)

## How to try it out

```sh
$ git clone git@github.com:zephir-lang/zephir-docs-app.git
$ cd zephir-docs-app
$ git submodule init
$ git submodule update
```

And wait for load any required submodules. After that, we need a few ruby dependencies:

```sh
$ bundle install
$ ./prebuild.sh
$ bundle exec jekyll build
```

Then, from the root of the blog just run:

```sh
$ ./serve
```

### Easy way pull latest of all submodules

For git 1.6.1 or above you can use something similar to:

```sh
$ cd zephir-docs-app
$ git submodule update --remote --merge
$ ./prebuild.sh
$ bundle exec jekyll build
```

See [git-submodule(1)](https://mirrors.edge.kernel.org/pub/software/scm/git/docs/git-submodule.html) for details.

## License

This project is open-sourced software licensed under the MIT License. See the [LICENSE](https://github.com/zephir-lang/zephir-docs-app/blob/master/LICENSE) file for more information.
© Zephir Team and contributors

## Thank you

A big thank you to:
- [Netlify](https://app.netlify.com) for hosting the site
- [Crowdin](https://crowdin.com) for offering translation services
- [Algolia](https://www.algolia.com) for offering search services for our documentation
- All of our supporters and users!
