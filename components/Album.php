<?php namespace Fes\Album\Components;

use Cms\Classes\ComponentBase;
use Fes\Album\Models\Album as Albums;
use Lang;

class Album extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'fes.album::lang.components.single_title',
            'description' => 'fes.album::lang.components.single_description'
        ];
    }

    public function defineProperties()
    {
        return [
            'idAlbum' => [
                'title'        => 'fes.album::lang.idalbum.title',
                'description'  => 'fes.album::lang.idalbum.description',
                'type'         => 'dropdown',
            ],
            'lang' => [
                'title'             => 'fes.album::lang.misc.title',
                'description'       => 'fes.album::lang.misc.description',
                'type'              => 'string',
                'default'           => Lang::get('fes.album::lang.misc.defaultname')
            ],
            'inject_jquery' => [
                'title'             => 'fes.album::lang.inject_jquery.title',
                'description'       => 'fes.album::lang.inject_jquery.description',
                'type'              => 'dropdown',
                'default'           => 'no',
                'options'           => [
                    'yes' => 'fes.album::lang.inject_jquery.optionsyes',
                    'no' => 'fes.album::lang.inject_jquery.optionsno'
                        ],
                'group'             => Lang::get('fes.album::lang.groups.inject')
            ],
            'inject_js' => [
                'title'             => 'fes.album::lang.inject_js.title',
                'description'       => 'fes.album::lang.inject_js.description',
                'type'              => 'dropdown',
                'default'           => 'no',
                'options'           => [
                    'yes' => 'fes.album::lang.inject_js.optionsyes',
                    'no' => 'fes.album::lang.inject_js.optionsno'
                        ],
                'group'             => Lang::get('fes.album::lang.groups.inject')
            ],
            'inject_css' => [
                'title'             => 'fes.album::lang.inject_css.title',
                'description'       => 'fes.album::lang.inject_css.description',
                'type'              => 'dropdown',
                'default'           => 'no',
                'options'           => [
                    'yes' => 'fes.album::lang.inject_css.optionsyes',
                    'no' => 'fes.album::lang.inject_css.optionsno'
                        ],
                'group'             => Lang::get('fes.album::lang.groups.inject')
            ]
        ];
    }


    public function getidAlbumOptions()
    {
        return Albums::select('id', 'name')->orderBy('name')->get()->lists('name', 'id');
    }

    public function onRun()
    {
        if ($this->property('inject_jquery') == "yes") {
            //$this->addJs('assets/js/');
        }

        if ($this->property('inject_js') == "yes") {
            //$this->addJs('assets/js/');
        }

        if ($this->property('inject_css') == "yes") {
            //$this->addCss('assets/css/');
        }

    }

    public function onRender()
    {
        $album = new Albums;
        $this->album = $this->page['album'] = $album->where('id', '=', $this->property('idAlbum'))->first();

        foreach ($this->getProperties() as $key => $value) {
            $this->page[$key] = $value;
        }
    }
}
