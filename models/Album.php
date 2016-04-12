<?php namespace Fes\Album\Models;

use Model;

/**
* Album Model
*/
class Album extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;

    //public $timestamps = false;

    /**
    * @var string The database table used by the model.
    */
    public $table = 'fes_album_albums';

    public $rules = [
        'name' => 'required|between:3,64',
    ];

    /**
    * @var array Guarded fields
    */
    protected $guarded = ['*'];

    /**
    * @var array Fillable fields
    */
    protected $fillable = [];

    /**
    * @var array Relations
    */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [
        'images' => ['System\Models\File', 'order' => 'sort_order', 'delete' => 'true'],
    ];

    public function afterDelete()
    {
        foreach ($this->images as $image) {
            $image->delete();
        }
    }

    /**
    * Sets the "url" attribute with a URL to this object
    * @param string $pageName
    * @param Cms\Classes\Controller $controller
    */
    public function setUrl($pageName, $controller)
    {

        $slug = str_slug($this->name, "-");

        $params = [
            'id' => $this->id,
            'slug' => $slug
        ];

        return $this->url = $controller->pageUrl($pageName, $params);
    }
}
