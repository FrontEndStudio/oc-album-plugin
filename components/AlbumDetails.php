<?php namespace Fes\Album\Components;

use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Lang;
use Fes\Album\Models\Album as Albums;
use SystemException;

class AlbumDetails extends ComponentBase
{
    /**
    * A model instance to display
    * @var \October\Rain\Database\Model
    */
    public $record = null;

    /**
    * Message to display if the record is not found.
    * @var string
    */
    public $notFoundMessage;

    /**
    * Model column to display on the details page.
    * @var string
    */
    public $displayColumn;

    /**
    * Model column to use as a record identifier for fetching the record from the database.
    * @var string
    */
    public $modelKeyColumn;

    /**
    * Identifier value to load the record from the database.
    * @var string
    */
    public $identifierValue;

    public $sortColumn;
    public $sortDirection;
    public $detailsPage;
    public $prev;
    public $next;

    public function componentDetails()
    {
        return [
            'name'        => 'fes.album::lang.components.details_title',
            'description' => 'fes.album::lang.components.details_description'
        ];
    }

    //
    // Properties
    //

    public function defineProperties()
    {
        return [
            'identifierValue' => [
                'title'       => 'fes.album::lang.components.details_identifier_value',
                'description' => 'fes.album::lang.components.details_identifier_value_description',
                'type'        => 'string',
                'default'     => '{{ :id }}',
                'validation'  => [
                    'required' => [
                        'message' => Lang::get('fes.album::lang.components.details_identifier_value_required')
                    ]
                ]
            ],
            'modelKeyColumn' => [
                'title'       => 'fes.album::lang.components.details_key_column',
                'description' => 'fes.album::lang.components.details_key_column_description',
                'type'        => 'autocomplete',
                'default'     => 'id',
                'validation'  => [
                    'required' => [
                        'message' => Lang::get('fes.album::lang.components.details_key_column_required')
                    ]
                ],
                'showExternalParam' => false
            ],
            'detailsPage' => [
                'title'       => 'fes.album::lang.components.list_details_page',
                'description' => 'fes.album::lang.components.list_details_page_description',
                'type'        => 'dropdown',
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
            ],
            'notFoundMessage' => [
                'title'       => 'fes.album::lang.components.details_not_found_message',
                'description' => 'fes.album::lang.components.details_not_found_message_description',
                'default'     => Lang::get('fes.album::lang.components.details_not_found_message_default'),
                'type'        => 'string',
                'showExternalParam' => false
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

    /**
    * Retrieve the detailsPage properties
    *
    * @return string
    */
    public function getDetailsPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    /*
     * Retrieve the sortColumn properties
     *
     * @return string
     *
     */
    public function getSortColumnOptions()
    {
        $columnNames = [
            'id',
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

        $this->record = $this->page['record'] = $this->loadRecord();

        if (count($this->record)) {
            $this->prev = $this->page['prev'] = $this->getPrevAlbum();
            $this->next = $this->page['next'] = $this->getNextAlbum();
        }

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

        foreach ($this->getProperties() as $key => $value) {
            $this->page[$key] = $value;
        }

    }

    protected function prepareVars()
    {
        $this->notFoundMessage = $this->page['notFoundMessage'] = Lang::get($this->property('notFoundMessage'));
        $this->modelKeyColumn = $this->page['modelKeyColumn'] = $this->property('modelKeyColumn');
        $this->identifierValue = $this->page['identifierValue'] = $this->property('identifierValue');

        $this->sortColumn = $this->page['sortColumn'] = $this->property('sortColumn');
        $this->sortDirection = $this->page['sortDirection'] = $this->property('sortDirection');
        $this->detailsPage = $this->page['detailsPage'] = $this->property('detailsPage');

        if (!strlen($this->modelKeyColumn)) {
            throw new SystemException('The model key column name is not set.');
        }

    }

    protected function loadRecord()
    {
        if (!strlen($this->identifierValue)) {
            return;
        }

        $modelClassName = 'Fes\Album\Models\Album';
        $model = new $modelClassName();
        return $model->where($this->modelKeyColumn, '=', $this->identifierValue)->where('status', '1')->first();
    }


    /**
     * Retrieve the prevAlbum
     *
     * @return mixed
     */
    protected function getPrevAlbum()
    {

        if ($this->sortColumn == 'sort_order') {
            $sortValue = $this->record->sort_order;
        } else {
            $sortValue = $this->record->id;
        }

        if ($this->sortDirection == 'asc') {
            $sortDirection = 'desc';
        } else {
            $sortDirection = 'asc';
        }

        $album = Albums::where('status', '1')->where($this->sortColumn, '>', $sortValue)->orderBy($this->sortColumn, $sortDirection)->first();

        if ($album instanceof Albums) {
            $album->setUrl($this->detailsPage, $this->controller);
        }

        return $album;
    }

    /**
     * Retrieve the nextAlbum
     *
     * @return mixed
     */
    protected function getNextAlbum()
    {

        if ($this->sortColumn == 'sort_order') {
            $sortValue = $this->record->sort_order;
        } else {
            $sortValue = $this->record->id;
        }

        $album = Albums::where('status', '1')->where($this->sortColumn, '<', $sortValue)->orderBy($this->sortColumn, $this->sortDirection)->first();

        if ($album instanceof Albums) {
            $album->setUrl($this->detailsPage, $this->controller);
        }

        return $album;
    }
}
