<?php namespace Fes\Album\Controllers;

use Flash;
use BackendMenu;
use Backend\Classes\Controller;
use Fes\Album\Models\Album;

/**
 * Albums Back-end Controller
 */
class Albums extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ReorderController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Fes.Album', 'album', 'albums');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $itemId) {

                if (!$slider = Album::find($itemId)) {
                    continue;
                }

                $slider->delete();
            }

            Flash::success('Successfully deleted those selected.');
        }

        return $this->listRefresh();
    }
}
