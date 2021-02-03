<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ArticleController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Article(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('banner');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Article(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('banner');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(Article::with('tags'), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->text('banner');
            $form->select('user_id', '作者')->options('/api/users');

            $form->select('category_id', '分类')->options('/api/categories')->load('tags', '/api/tags');

            $form->multipleSelect('tags', '标签')
                ->saving(function ($value) {
                    // 转化成json字符串保存到数据库
                    // return json_encode($value);
                });

            $form->markdown('content', '内容');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
