<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Restore;
use App\Models\Category;
use App\Models\Tag;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;

class TagController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Tag(), function (Grid $grid) {
            $grid->model()->with(['category']);

            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('category.name', '分类');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('category_id');

                // 范围过滤器，调用模型的`onlyTrashed`方法，查询出被软删除的数据。
                $filter->scope('trashed', '回收站')->onlyTrashed();
            });

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                if (request('_scope_') == 'trashed') {
                    $actions->append(new Restore(Tag::class));
                }
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
        return Show::make($id, new Tag(), function (Show $show) {
            $show->field('id');
            $show->field('category_id');
            $show->field('name');
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
        return Form::make(new Tag(), function (Form $form) {
            $form->display('id');
            $form->select('category_id', '分类')->options('/api/categories');
            $form->text('name');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }

    // 定义下拉框搜索接口
    public function apiIndex(Request $request)
    {
        $category_id  = $request->get('q');

        $tags = Tag::query()->where('category_id', $category_id)->get();
        $tags = $tags->map(function(Tag $tag) {
            return ['id' => $tag->id, 'text' => $tag->name];
        });

        return $tags;
    }
}
