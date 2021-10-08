<?php
namespace Grav\Plugin;

use Algolia\AlgoliaSearch\SearchClient;
use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;

/**
 * Class AlgoliaSearchPlugin
 * @package Grav\Plugin
 */
class AlgoliaSearchPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => [
                // Uncomment following line when plugin requires Grav < 1.7
                // ['autoload', 100000],
                ['onPluginsInitialized', 0]
            ]
        ];
    }

    /**
     * Composer autoload
     *
     * @return ClassLoader
     */
    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized(): void
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Enable the main events we are interested in
        $this->enable([
            'onPageInitialized' => ['onPageInitialized', 0]
        ]);
    }

    /**
     * On Plugin initialized
     */
    public function onPageInitialized() {

        if(($this->grav['page']->route() === $this->config()['searchRoute']) && $this->grav['uri']->query('s')) {
            $this->runSearch($this->grav['uri']->query('s'));
        }

    }

    /**
     * @param string $searchWord
     */
    private function runSearch(string $searchWord) {
        $algoliaClient = SearchClient::create(
            $this->config()['algolia']['applicationID'],
            $this->config()['algolia']['adminKey']
        );

        $index = $algoliaClient->initIndex($this->config()['algolia']['indexName']);
        $objects = $index->search($searchWord);
        $this->grav['twig']->twig_vars['searchResults'] = $objects;
    }
}
