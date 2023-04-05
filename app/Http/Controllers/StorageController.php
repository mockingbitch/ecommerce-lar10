<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Create\StorageRequest;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Contracts\Interface\StorageRepositoryInterface;
use App\Repositories\Contracts\Interface\ProductModelRepositoryInterface;
use App\Services\ImageService;
use Illuminate\View\View;
use App\Constants\StorageConstant;
use App\Constants\Constant;
use App\Constants\RouteConstant;

class StorageController extends Controller
{
    /**
     * @var string
     */
    protected $breadcrumb = StorageConstant::BREADCRUMB;

    /**
     * @var storageRepository
     */
    protected $storageRepository;

    /**
     * @var productModelRepository
     */
    protected $productModelRepository;

    /**
     * @var imageService
     */
    protected $imageService;

    /**
     * @param ProductModelRepositoryInterface $productModelRepository
     * @param StorageRepositoryInterface $storageRepository
     * @param ImageService $imageService
     */
    public function __construct(
        ProductModelRepositoryInterface $productModelRepository,
        StorageRepositoryInterface $storageRepository,
        ImageService $imageService
        )
    {
        $this->productModelRepository   = $productModelRepository;
        $this->storageRepository        = $storageRepository;
        $this->imageService             = $imageService;
    }

    /**
     * @param integer $model
     * @param Request $request
     *
     * @return View|RedirectResponse
     */
    public function list(int $model, Request $request) : View|RedirectResponse
    {
        if ($productModel = $this->productModelRepository->find($model)) :
            $productStorage = $this->storageRepository->getStorageByModel($request->model);

            return view('dashboard.list.storage', [
                'productModel'      => $productModel,
                'productStorage'    => $productStorage,
                'breadcrumb'        => $this->breadcrumb
            ]);
        endif;

        return redirect()->back()->with('errMsg', 'Product model not found');
    }

    /**
     * @return View|RedirectResponse
     */
    public function viewCreate(int $model) : View|RedirectResponse
    {
        if ($productModel = $this->productModelRepository->find($model)) :
            return view('dashboard.create.storage', [
                'productModel'  => $productModel,
                'breadcrumb'    => $this->breadcrumb
            ]);
        endif;

        return redirect()->back()->with('errMsg', 'Product Model not found');
    }

    /**
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function viewUpdate(int $model, Request $request) : View|RedirectResponse
    {
        if ($productModel = $this->productModelRepository->find($model)) :
            if ($productStorage = $this->storageRepository->find($request->id)) :
                return view('dashboard.update.storage', [
                    'productStorage'    => $productStorage,
                    'productModel'      => $productModel,
                    'breadcrumb'        => $this->breadcrumb
                ]);
            endif;
        endif;

        return redirect()->back()->with('errMsg', 'Product Model not found');
    }

    /**
     * @param integer $model
     * @param Request $request
     *
     * @return View|RedirectResponse
     */
    public function create(int $model, Request $request) : View|RedirectResponse
    {
        if (! $this->productModelRepository->find($model)) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['storage_create'])
                ->with([
                    'errMsg' => StorageConstant::ERR_MSG_PRODUCT_MODEL_NOT_FOUND
                ]);
        endif;

        $data = $request->toArray();
        $data['product_model_id'] = $model;

        if (null !== $request->image) :
            $data['image'] = $this->imageService->create($request->image, StorageConstant::IMAGE_FOLDER);

            if (null == $data['image'] || $data['image'] == '') :
                return redirect()
                    ->route(RouteConstant::DASHBOARD['storage_create'], ['model' => $model])
                    ->with([
                        'errMsg' => StorageConstant::ERR_MSG_CANT_PROCESS_IMAGE
                    ]);
            endif;
        endif;

        if (! $this->storageRepository->create($data)) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['storage_create'], ['model' => $model])
                ->with([
                    'errMsg' => Constant::ERR_MSG['create_fail']
                ]);
        endif;

        return redirect()
            ->route(RouteConstant::DASHBOARD['storage_create'], ['model' => $model])
            ->with([
                'msg' => Constant::ERR_MSG['create_success']
            ]);
    }

    /**
     * @param integer $model
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update(int $model, Request $request) : RedirectResponse
    {
        $data        = $request->toArray();

        if (! $productModel = $this->productModelRepository->find($model)) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['storage_list'], ['model' => $model])
                ->with([
                    'errMsg' => StorageConstant::ERR_MSG_PRODUCT_MODEL_NOT_FOUND
                ]);
        endif;

        if (! $productStorage = $this->storageRepository->find($request->id)) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['storage_list'])
                ->with('errMsg', StorageConstant::ERR_MSG_PRODUCT_STORAGE_NOT_FOUND);
        endif;


        if (null !== $request->image) :
            $data['image'] = $this->imageService->create($request->image, StorageConstant::IMAGE_FOLDER);

            if (null == $data['image'] || $data['image'] == '') :
                return redirect()
                    ->route(RouteConstant::DASHBOARD['storage_update'], ['model' => $model, 'id' => $request->id])
                    ->with([
                        'errMsg' => StorageConstant::ERR_MSG_CANT_PROCESS_IMAGE
                    ]);
            endif;

            $this->imageService->delete($productStorage->image, 'products');
        endif;

        if (! $this->storageRepository->update($request->id, $data)) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['storage_update'], ['model' => $model, 'id' => $request->id])
                ->with([
                    'errMsg' => Constant::ERR_MSG['update_fail']
                ]);
        endif;

        return redirect()
            ->route(RouteConstant::DASHBOARD['storage_update'], ['model' => $model, 'id' => $request->id])
            ->with([
                'msg' => Constant::ERR_MSG['update_success']
            ]);
    }

    /**
     * @param Request $request
     *
     * @return boolean
     */
    public function delete(Request $request) : bool
    {
        if (! $this->storageRepository->delete($request->query('id'))) :
            return false;
        endif;

        return true;
    }

    /**
     * @param Request $request
     *
     * @return View
     */
    public function listProduct(Request $request) : View
    {
        $listProduct = $this->productRepository->getListProduct($request);
        $categories = $this->categoryRepository->getActive();

        return view('home.pages.list_product', [
            'listProduct' => $listProduct,
            'categories' => $categories
        ]);
    }

    public function productDetail(?int $id)
    {
        $product = $this->productRepository->find($id);
        $related_products = $this->productRepository->getAll();

        if (! $product || null === $product) :
            return redirect()->back()->with('errMsg', trans('product_not_found'));
        endif;

        return view('home.pages.product_detail', [
            'product' => $product,
            'related_products' => $related_products
        ]);
    }
}
