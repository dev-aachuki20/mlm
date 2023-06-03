<?php

namespace App\Http\Livewire;

use App\Models\Package;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;


use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGridColumns};

final class PackageTable extends PowerGridComponent
{
    use ActionButton, WithExport;
    
    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            // Exportable::make('export')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Package>
     */
    public function datasource(): Builder
    {
        return Package::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('title')

           /** Example of custom column using a closure **/
            ->addColumn('title_lower', fn (Package $model) => strtolower(e($model->title)))

            ->addColumn('description')
            // ->addColumn('level_one_commission')
            // ->addColumn('level_two_commission')
            // ->addColumn('level_three_commission')
            ->addColumn('status')
            ->addColumn('created_at_formatted', fn (Package $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s a'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
      * PowerGrid Columns.
      *
      * @return array<int, Column>
      */
    public function columns(): array
    {
        return [
            Column::make(trans('global.sno'), '')->index(),
            Column::make(trans('cruds.package.fields.title'), 'title')
                ->sortable()
                ->searchable(),

            Column::make(trans('cruds.package.fields.description'), 'description')
                ->sortable()
                ->searchable(),

            // Column::make('Level one commission', 'level_one_commission')
            //     ->sortable()
            //     ->searchable(),

            // Column::make('Level two commission', 'level_two_commission')
            //     ->sortable()
            //     ->searchable(),

            // Column::make('Level three commission', 'level_three_commission')
            //     ->sortable()
            //     ->searchable(),

            Column::make(trans('global.status'), 'status')
                ->toggleable(),

            Column::make(trans('global.created_at'), 'created_at_formatted', 'created_at')
                ->sortable(),


        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            // Filter::inputText('title')->operators(['contains']),
            // Filter::boolean('status'),
            // Filter::datetimepicker('created_at'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Package Action Buttons.
     *
     * @return array<int, Button>
     */

    
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('btn btn-sm btn-primary')
               /*->route('package.edit', function(\App\Models\Package $model) {
                    return $model->id;
               })*/,

           Button::make('destroy', 'Delete')
               ->class('btn btn-sm btn-danger')
               /*->route('package.destroy', function(\App\Models\Package $model) {
                    return $model->id;
               })*/
               ->method('delete')
        ];
    }
    

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Package Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($package) => $package->id === 1)
                ->hide(),
        ];
    }
    */

    public function table(): Table
    {
        return Theme::table('table table-striped')
            // ...
            ->tdBodyEmpty('', 'vertical-align: middle; line-height: normal;');
    }

}
