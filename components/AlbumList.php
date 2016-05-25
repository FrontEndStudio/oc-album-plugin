<?php namespace Fes\Album\Components;

use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Lang;
use Exception;
use SystemException;
use Fes\Album\Models\Album as Albums;

class AlbumList extends ComponentBase
{

    public $records;
    public $noRecordsMessage;
    public $detailsPage;
    public $detailsUrlParameter;
    public $sortColumn;
    public $sortDirection;
    public $extraData;

    public function componentDetails()
    {
        return [
            'name'        => 'fes.album::lang.components.list_title',
            'description' => 'fes.album::lang.components.list_description'
        ];
    }

    //
    // Properties
    //

    public function defineProperties()
    {
        return [
            'noRecordsMessage' => [
                'title'        => 'fes.album::lang.components.list_no_records',
                'description'  => 'fes.album::lang.components.list_no_records_description',
                'type'         => 'string',
                'default'      => Lang::get('fes.album::lang.components.list_no_records_default'),
                'showExternalParam' => false,
            ],
            'detailsPage' => [
                'title'       => 'fes.album::lang.components.list_details_page',
                'description' => 'fes.album::lang.components.list_details_page_description',
                'type'        => 'dropdown',
                'showExternalParam' => false,
                'group'       => 'fes.album::lang.components.list_details_page_link'
            ],
            'detailsUrlParameter' => [
                'title'       => 'fes.album::lang.components.list_details_url_parameter',
                'description' => 'fes.album::lang.components.list_details_url_parameter_description',
                'type'        => 'string',
                'default'     => 'id',
                'showExternalParam' => false,
                'group'       => 'fes.album::lang.components.list_details_page_link'
            ],
            'sortColumn' => [
                'title'       => 'fes.album::lang.components.list_sort_column',
                'description' => 'fes.album::lang.components.list_sort_column_description',
                'type'        => 'autocomplete',
                'default'     => 'sort_order',
                'group'       => 'fes.album::lang.components.list_sorting',
                'showExternalParam' => false
            ],
            'sortDirection' => [
                'title'       => 'fes.album::lang.components.list_sort_direction',
                'type'        => 'dropdown',
                'showExternalParam' => false,
                'group'       => 'fes.album::lang.components.list_sorting',
                'default'     => 'desc',
                'options'     => [
                    'asc'     => 'fes.album::lang.components.list_order_direction_asc',
                    'desc'    => 'fes.album::lang.components.list_order_direction_desc'
                ]
            ]
        ];
    }


    public function getDetailsPageOptions()
    {
        $pages = Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');

        $pages = [
            '-' => Lang::get('fes.album::lang.components.list_details_page_no')
            ] + $pages;

            return $pages;
    }

    public function getSortColumnOptions()
    {
        $columnNames = [
            'name',
            'album_date',
            'created_at',
            'updated_at',
            'sort_order'
        ];

        $options = [];

        foreach ($columnNames as $columnName) {
            $options[$columnName] = $columnName;
        }

        return $options;

    }

    //
    // Rendering and processing
    //

    public function onRun()
    {
        $this->prepareVars();
        //$this->records = $this->page['records'] = $this->listRecords();
        $this->records = $this->page['records'] = $this->listAlbums();
    }

    public function onRender()
    {
        $this->extraData = $this->page['extraData'] = $this->property('extraData');
    }

    protected function prepareVars()
    {
        $this->noRecordsMessage = $this->page['noRecordsMessage'] = Lang::get($this->property('noRecordsMessage'));
        $this->detailsPage = $this->page['detailsPage'] = $this->property('detailsPage');
        $this->detailsUrlParameter = $this->page['detailsUrlParameter'] = $this->property('detailsUrlParameter');
        $this->sortColumn = $this->page['sortColumn'] = $this->property('sortColumn');
        $this->sortDirection = $this->page['sortDirection'] = $this->property('sortDirection');
    }

    protected function listAlbums()
    {
        $albums = Albums::where('status', '1')->orderBy($this->sortColumn, $this->sortDirection)->get();

        $albums->each(function ($album) {
            $album->setUrl($this->detailsPage, $this->controller);
        });

        return $albums;
    }

    protected function listRecords()
    {
        $modelClassName = 'Fes\Album\Models\Album';
        $model = new $modelClassName();
        $model = $this->sort($model);

        if ($model) {
            $records = $model->where('status', '1')->get();

            $records->each(function ($record) {
                $record->setUrl($this->detailsPage, $this->controller);
            });

            return $records;

        }

    }

    protected function sort($model)
    {

        $sortColumn = trim($this->property('sortColumn'));

        if (!strlen($sortColumn)) {
            return;
        }

        $sortDirection = trim($this->property('sortDirection'));

        if ($sortDirection !== 'desc') {
            $sortDirection = 'asc';
        }

        return $model->orderBy($sortColumn, $sortDirection);
    }
}
