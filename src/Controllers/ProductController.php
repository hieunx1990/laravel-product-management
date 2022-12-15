<?php


namespace Hieu\ProductManagement\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Log;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Hieu\ProductManagement\Models\GalleryImage;
use Hieu\ProductManagement\Models\Product;

class ProductController extends AdminController
{
    protected $title = 'Products';

    /**
     * Make product grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        // Grid Cols
        $grid->column('id', __('ID'))->sortable();
        $grid->column('galleryImages', __('Thumbnail'))->display(function($galleryImages) {
            if (count($galleryImages)) {
                $src = env('APP_URL') . '/uploads/' . $galleryImages[0]['url'];
            } else {
                $src = env('APP_URL') . '/uploads/' . 'placeholder.jpeg';
            }
            return "<img width='70px' src='{$src}'/>";
        });
        $grid->column('name', __('Name'));
        $grid->column('price', __('Price'))->sortable();
        $grid->column('quantity', __('Quantity'))->sortable();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        // Grid filter
        $grid->filter(function($filter) {
            $filter->disableIdFilter();
            // Add a column filter
            $filter->like('name', __('Product Name'));
        });
        $grid->expandFilter();

        $grid->actions(function ($actions) {
            $actions->disableView();
        });

        return $grid;
    }

    /**
     * Make a form builder for create and edit page
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product());
        $form->text('name', __('Product Name'));
        $form->ckeditor('description', __('Product Description'));
        $form->currency('price', __('Price'))->default(0.00)->symbol('$');
        $form->number('quantity', __('Quantity'))->default(0);
        $form->multipleImage('galleryImages',__('Gallery Images'))
            ->pathColumn('url')->removable();

        $form->footer(function($footer) {
            $footer->disableViewCheck();
            $footer->disableCreatingCheck();
        });

        $form->tools(function($tools) {
            $tools->disableView();
        });

        try {
            $this->handleDeleteImage($form);
        } catch (ContainerExceptionInterface $e) {
            Log::error($e->getMessage());
        } catch (NotFoundExceptionInterface $e) {
            Log::error($e->getMessage());
        }

        return $form;
    }

    /**
     * @param $form
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function handleDeleteImage($form) {
        $form->saved(function(Form $form) {
            $isDel = request()->get('galleryImages', false) == \Encore\Admin\Form\Field::FILE_DELETE_FLAG;
            $id = request()->get(\Encore\Admin\Form\Field::FILE_DELETE_FLAG, false);
            if ($isDel && $id) {
                $image = GalleryImage::findById($id);
                if ($image) {
                    $image->delete();
                }
            }
        });
    }
}
