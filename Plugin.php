<?php namespace Fes\Album;

use App;
use Event;
use Backend;
use System\Classes\PluginBase;

/**
 * fes/album Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'          => 'fes.album::lang.plugin.name',
            'description'   => 'fes.album::lang.plugin.description',
            'author'        => 'FrontEndStudio',
            'icon'          => 'icon-picture-o',
            'homepage'      => 'https://github.com/FrontEndStudio/oc-album-plugin' 
        ];
    }

    public function registerComponents()
    {
        return [
            'Fes\Album\Components\Album' => 'album',
            'Fes\Album\Components\AlbumDetails' => 'albumDetails',
            'Fes\Album\Components\AlbumList' => 'albumList'
        ];
    }

    public function registerNavigation()
    {
        return [
            'album' => [
                'label' => 'fes.album::lang.menu.name',
                'url'   => Backend::url('fes/album/albums'),
                'icon'        => 'icon-picture-o',
                'permissions' => ['fes.album.*'],
                'order'       => 500,
            ],
        ];
    }

    public function registerPageSnippets()
    {
        return [
            'Fes\Album\Components\Album' => 'album',
            'Fes\Album\Components\AlbumList' => 'albumList'
        ];
    }

    public function registerPermissions()
    {
        return [
            'fes.album.*' => ['tab' => 'fes.album::lang.plugin.name', 'label' => 'fes.album::lang.permissions.all']
        ];
    }
}
