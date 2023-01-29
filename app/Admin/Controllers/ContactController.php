<?php

namespace App\Admin\Controllers;

use App\Models\Contact;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ContactController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Contact';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Contact());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('sex', __('Sex'));
        $grid->column('mail', __('Mail'));
        $grid->column('tel', __('Tel'));
        $grid->column('contactText', __('ContactText'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->like('name', '名前');
            $filter->like('sex', '性別');
            $filter->like('mail', 'メール');
            $filter->like('tel', '電話番号');
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
        $show = new Show(Contact::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('sex', __('Sex'));
        $show->field('mail', __('Mail'));
        $show->field('tel', __('Tel'));
        $show->field('contactText', __('ContactText'));
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
        $form = new Form(new Contact());

        $form->text('name', __('Name'));
        $form->text('sex', __('Sex'));
        $form->email('mail', __('Mail'));
        $form->text('tel', __('Tel'));
        $form->textarea('contactText', __('ContactText'));

        return $form;
    }
}
