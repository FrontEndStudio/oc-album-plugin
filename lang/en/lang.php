<?php

return [
    'plugin' => [
        'name' => 'Album',
        'description' => 'Create a photo album for your website.'
    ],
    'permissions' => [
        'all' => 'Manage albums'
    ],
    'components' => [

        'single_title' =>  'Album',
        'single_description' => 'Display a single album',

        'details_title' =>  'Album detail',
        'details_description' => 'Display an album detail by id',
        'details_model' => 'Model class',
        'details_identifier_value' => 'Identifier value',
        'details_identifier_value_description' => 'Identifier value to load the record from the database. Specify a fixed value or URL parameter name.',
        'details_identifier_value_required' => 'The identifier value is required',
        'details_key_column' => 'Key column',
        'details_key_column_description' => 'Model column to use as a record identifier for fetching the record from the database.',
        'details_key_column_required' => 'The key column name is required',
        'details_display_column' => 'Display column',
        'details_display_column_description' => 'Model column to display on the details page. Used in the default component\'s partial.',
        'details_display_column_required' => 'Please select a display column.',
        'details_not_found_message' => 'Not found message',
        'details_not_found_message_description' => 'Message to display if the record is not found. Used in the default component\'s partial.',
        'details_not_found_message_default' => 'Record not found',


        'list_title' => 'Album list',
        'list_description' => 'List all active albums',

        'list_no_records' => 'No records message',
        'list_no_records_description' => 'Message to display in the list in case if there are no records. Used in the default component\'s partial.',
        'list_no_records_default' => 'No records found',
        'list_details_page_link' => 'Link to the details page',
        'list_details_page' => 'Details page',
        'list_details_page_description' => 'Page to display record details.',
        'list_details_page_no' => '--no details page--',
       'list_details_url_parameter' => 'URL parameter name',
        'list_details_url_parameter_description' => 'Name of the details page URL parameter which takes the record identifier.',

        'list_sorting' => 'Sorting',
        'list_sort_column' => 'Sort by column',
        'list_sort_column_description' => 'Model column the records should be ordered by',
        'list_sort_direction' => 'Direction',
        'list_display_column' => 'Display column',
        'list_order_direction_asc' => 'Ascending',
        'list_order_direction_desc' => 'Descending'
    ],
    'misc' => [
        'newalbum' => 'New Album',
        'reorder' => 'Reorder',
        'sure' => 'Are you sure?',
        'remove' => 'Remove',
        'title' => 'Title',
        'description' => 'Title of the album',
        'defaultname' => 'Album'
    ],
    'form' => [
        'create' => 'Create Albums',
        'update' => 'Update Albums',
        'preview' => 'Preview Albums',
        'manage' => 'Manage Albums'
    ],
    'modeldata' => [
        'name' => 'Name',
        'album_date' => 'Date',
        'created' => 'Created',
        'updated' => 'Updated',
        'images' => 'Images',
        'status' => 'Status',
        'sort_order' => 'Sort order'
    ],
    'create' => [
        'albums' => 'Albums',
        'creating' => 'Creating Album...',
        'create' => 'Create',
        'createclose' => 'Create and Close',
        'cancel' => 'Cancel',
        'or' => 'or',
        'return' => 'Return to albums list'
    ],
    'update' => [
        'saving' => 'Saving Album...',
        'save' => 'Save',
        'saveclose' => 'Save and Close',
        'deleting' => 'Deleting Album...',
        'reallydelete' => 'Do you really want to delete this album?'
    ],
    'menu' => [
        'name' => 'Album',
        'description' => 'Create a photo album.'
    ],
    'groups' => [
        'inject' => 'Inject'
    ],
    'idalbum' => [
        'title' => 'Album',
        'description' => 'Choose the album that will display'
    ],
    'inject_jquery' => [
        'title' => 'Inject jQuery',
        'description' => 'Whether to inject jQuery or not',
        'optionsyes' => 'Yes',
        'optionsno' => 'No'
    ],
    'inject_js' => [
        'title' => 'Inject JavaScript',
        'description' => 'Whether to inject JavaScript or not',
        'optionsyes' => 'Yes',
        'optionsno' => 'No'
    ],
    'inject_css' => [
        'title' => 'Inject CSS',
        'description' => 'Whether to inject CSS or not',
        'optionsyes' => 'Yes',
        'optionsno' => 'No'
    ]
];
