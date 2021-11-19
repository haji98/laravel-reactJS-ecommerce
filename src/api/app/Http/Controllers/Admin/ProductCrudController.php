<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->setView();

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductRequest::class);

        CRUD::addField([   // Category
            'type' => 'relationship',
            'name' => 'category_id',
            'label' => 'Category',
            'attribute' => 'name',
            'entity' => 'categories',
            'model' => 'App\Models\Category',
            'placeholder' => 'Select a category',
        ]);
        CRUD::field('name');
        CRUD::field('desc');
        CRUD::field('quantity');
        CRUD::field('price');
        CRUD::field('discount_percent');
        CRUD::field('active_discount');
        CRUD::field('rate');
        CRUD::addField([
            'name' => 'imgs',
            'label' => 'Upload multiple',
            'type' => 'upload_multiple',
            'upload' => true,
            'prefix'    => 'storage',
        ]);
        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->setView();
    }
    function setView()
    {
        CRUD::addColumn([
            'label'     => 'Category',
            'type'      => 'select',
            'name'      => 'category_id',
            'entity'    => 'categories',
            'attribute' => 'name',
            'model'     => 'App\Models\Category',
        ]);
        CRUD::column('name');
        CRUD::column('desc');
        CRUD::column('quantity');
        CRUD::column('price');
        CRUD::column('discount_percent');
        CRUD::column('rate');
        CRUD::column('created_at');
        CRUD::column('updated_at');
    }
}
