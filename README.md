# October CMS Album plugin

## About

This is a Album plugin for [October CMS](https://octobercms.com), to create a photo album in your website.

## Supported fields

name, album_date, status, created_at, updated_at, sort_order

## Features
- Album overview, Album detail with prev and next link
- Media Manager
- Sorting
- Snippets

## How to use

- Under your October CMS plugins directory create a directory called: fes/album
- Checkout this repository

# How do this work
The plugin provides `album` component to build photo album with many customization settings, through which you can create your own style albums.
#####Make your own style **div** wrapper for album.

> **Note**: Put `{% styles %}` and `{% scripts %}` in your page header, if not there. If you have already included jQuery.js in your page header, you can set `Inject jQuery ` option to no.


# Album list component
Use the **albumlist** component to display an overview of all active photo albums.
The component has the following properties:
* **Alias** - A unique name given to this component when using it in the page or layout
* **No records message** - Message to display in the list in case if there are no records.

* *Link to the detail page*
* **Details page** - Page to display record details
* **URL parameter name** - Name of the details page URL parameter which takes the record identifier.

* *Sorting*
* **Sort by Column** - Model column the records should be ordered by: name, album_date, created_at, updated_at, sort_order
* **Direction** - The direction to sort `Ascending` ||  `Descending`.

# Album component
Use the **album** component to display the photo album detail.
The component has the following properties:
* **Alias** -  A unique name given to this component when using it in the page or layout
* **Album** - Album to display
* **Name** - Alterrnative name of the album

* *Inject*
* **Inject jQuery** - Whether to inject jQuery to the page or not, default value is `No`.
* **Inject JavaScript** - Whether to inject JavaScript to the page or not, default value is `No`.
* **Inject CSS** -  Whether to inject CSS to the page or not, default value is `No`.

The next example shows usage of `album` component:

	title = "Demonstration"
	url = "/"
	layout = "default"

	[album]
	idAlbum = "1"
	==
	<!-- album -->
	<div class="album-container">
		{% component 'album' %}
	</div>
	<!-- /album -->


> **Note**: Album and Album list are also available as snippets