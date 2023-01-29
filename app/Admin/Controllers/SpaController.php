<?php

namespace App\Admin\Controllers;

use App\Models\Spa;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SpaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Spa';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Spa());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('spa_lat', __('Spa lat'));
        $grid->column('spa_lng', __('Spa lng'));
        $grid->column('spa_address', __('Spa address'));
        $grid->column('spa_name', __('Spa name'));
        $grid->column('spa_type', __('Spa type'))->sortable();
        $grid->column('spa_price', __('Spa price'))->sortable();
        $grid->column('spa_point', __('Spa point'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->like('spa_address', '住所');
            $filter->like('spa_name', '施設名');
            $filter->like('spa_type', 'タイプ');
            $filter->between('spa_price', '金額');
            $filter->between('created_at', '登録日')->datetime();
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Spa::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('spa_lat', __('Spa lat'));
        $show->field('spa_lng', __('Spa lng'));
        $show->field('spa_address', __('Spa address'));
        $show->field('spa_name', __('Spa name'));
        $show->field('spa_type', __('Spa type'));
        $show->field('spa_price', __('Spa price'));
        $show->field('spa_point', __('Spa point'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Spa());

        $form->decimal('spa_lat', __('Spa lat'));
        $form->decimal('spa_lng', __('Spa lng'));
        $form->text('spa_address', __('Spa address'));
        $form->text('spa_name', __('Spa name'));
        $form->text('spa_type', __('Spa type'));
        $form->text('spa_price', __('Spa price'));
        $form->textarea('spa_point', __('Spa point'));

        return $form;
    }
}
