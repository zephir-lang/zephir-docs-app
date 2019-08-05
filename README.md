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
```

See [git-submodule(1)](http://www.kernel.org/pub/software/scm/git/docs/v1.6.1.3/git-submodule.html) for details.

## License

This project is open-sourced software licensed under the MIT License. See the LICENSE file for more information.
© Zephir Team and contributors

## Thank you

A big thank you to:
- [Netlify](https://app.netlify.com) for hosting the site
- [Crowdin](https://crowdin.com) for offering translation services
- [Algolia](https://www.algolia.com) for offering search services for our documentation
- All of our supporters and users!
