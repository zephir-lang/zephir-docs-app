<?php

namespace Docs\Controllers;

use Docs\Exception\HttpException;
use Phalcon\Http\ResponseInterface;
use Phalcon\Text;
use function Docs\Functions\base_url;
use function str_replace;

/**
 * Docs\Controllers\DocsController
 *
 * @package Docs\Controllers
 */
class DocsController extends BaseController
{
    /**
     * @param null|string $language
     * @param null|string $version
     * @param string      $page
     *
     * @return ResponseInterface
     * @throws HttpException
     */
    public function mainAction(string $language = null, string $version = null, string $page = ''): ResponseInterface
    {
        if (empty($language)) {
            return $this->response->redirect(base_url($this->getVersion('/en/')));
        }

        $language = $this->getLanguage($language);

        if (true === empty($version) || 'latest' === $version) {
            $suffix = '';
            if (true !== empty($page)) {
                $suffix = '/' . $page;
            }
            return $this->response->redirect(
                base_url(
                    $this->getVersion('/' . $language . '/') . $suffix
                )
            );
        }

        $version = $this->getVersion('', $version);

        $renderFile = 'index/article';
        if (empty($page)) {
            $page = 'welcome';
        }

        if (!$article = $this->getDocument($language, $version, $page)) {
            throw new HttpException('Not Found', 404);
        }

        preg_match('/(<div.*?<\/div>)/ius', $article, $article_menu);
        $article = preg_replace('/(<div.*?<\/div>)/ius', "", $article);

        $canonical = Text::reduceSlashes(base_url("{$language}/{$version}/{$page}"));

        /**
         * Get the SEO stuff from here
         */
        $this->tag->setTitle($this->getSeoTitle($language, $version, $page));
        $contents = $this->viewSimple->render(
            $renderFile,
            [
                'language'    => $language,
                'version'     => $version,
                'sidebar'     => $this->getMenu($language, $version, 'sidebar'),
                'article'     => $article,
                'menu'        => $this->getMenu($language, $version, $page . '-menu'),
                'canonical'   => $canonical,
            ]
        );
        $this->response->setContent($contents);

        return $this->response;
    }

    /**
     * Performs necessary redirection
     *
     * @return ResponseInterface
     */
    public function redirectAction(): ResponseInterface
    {
        return $this->response->redirect(base_url($this->getVersion('/en/')));
    }

    /**
     * @param null|string $language
     * @param null|string $version
     *
     * @return ResponseInterface
     */
    public function searchAction(string $language = null, string $version = null): ResponseInterface
    {
        $language = 'en';
        $version  = $this->getVersion();
        $page     = 'introduction';

        $renderFile = 'index/search';
        $contents   = $this->viewSimple->render(
            $renderFile,
            [
                'language'    => $language,
                'version'     => $version,
                'topicsArray' => $this->getSidebar($language, $version),
                'menu'        => $this->getDocument($language, $version, $page . '-menu'),
            ]
        );
        $this->response->setContent($contents);

        return $this->response;
    }
}
