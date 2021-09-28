# Algolia Search Plugin

The **Algolia Search** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav). Search plugin for Algolia

## Installation

Installing the Algolia Search plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### GPM Installation (Preferred)

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install algolia-search

This will install the Algolia Search plugin into your `/user/plugins`-directory within Grav. Its files can be found under `/your/site/grav/user/plugins/algolia-search`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `algolia-search`. You can find these files on [GitHub](https://github.com//grav-plugin-algolia-search) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/algolia-search

> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see its [blueprints.yaml-file on GitHub](https://github.com//grav-plugin-algolia-search/blob/master/blueprints.yaml).

### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins`-menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/algolia-search/algolia-search.yaml` to `user/config/plugins/algolia-search.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
searchRoute: "/search"
algolia:
    applicationID: "your-application-id"
    adminKey: "your-admin-key"
    indexName: "your-index-name"
```

The searchRoute must be an existing path.

## Usage

If the plugin is configured correctly, you can call your searchsite with the query parameter ``?s=your_search_word``. The search result can be accessed through the Twig Variable ``{{ dump(searchResults) }}``.

