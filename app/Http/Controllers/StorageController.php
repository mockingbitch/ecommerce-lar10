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
     * @return View
     */
    public function list(int $model, Request $request) : View
    {
        if (null !== $request->model) :
            $productStorage = $this->storageRepository->getStorageByModel($request->model);
        dd($productStorage->toArray());
            return view('dashboard.list.product', [
                'productStorage'    => $productStorage,
                'breadcrumb'        => $this->breadcrumb
            ]);
        endif;

        return redirect()->back()->with('errMsg', 'Product model not found');
    }

    /**
     * @return View|RedirectResponse
     */
    public function viewCreate() : View|RedirectResponse
    {
        $categories = $this->categoryRepository->getAvailableCategory();
        $brands     = $this->brandRepository->getAvailableBrand();

        if  (! $categories || count($categories) == 0 || ! $brands || count($brands) == 0) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['product_list'])
                ->with([
                    'errMsg' => ProductConstant::ERR_MSG_CATEGORY_NOT_FOUND
                ]);
        endif;

        return view('dashboard.create.product', [
            'categories'    => $categories,
            'brands'        => $brands,
            'breadcrumb'    => $this->breadcrumb
        ]);
    }

    /**
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function viewUpdate(Request $request) : View|RedirectResponse
    {
        try {
            $product    = $this->productRepository->find($request->id);
            $categories = $this->categoryRepository->getAvailableCategory();
            $brands     = $this->brandRepository->getAvailableBrand();

            if  (! $categories || null === $categories || count($categories) == 0 || null == $product) :
                return redirect()
                    ->route(RouteConstant::DASHBOARD['product_list'])
                    ->with([
                        'errMsg' => ProductConstant::ERR_MSG_NOT_FOUND
                    ]);
            endif;

            return view('dashboard.update.product', [
                'product'       => $product,
                'categories'    => $categories,
                'brands'        => $brands,
                'breadcrumb'    => $this->breadcrumb
            ]);
        } catch (\Throwable $th) {
            return redirect()
                ->route(RouteConstant::DASHBOARD['product_list'])
                ->with([
                    'errMsg' => ProductConstant::ERR_MSG_NOT_FOUND
                ]);
        }
    }

    /**
     * @param ProductRequest $request
     * @return View|RedirectResponse
     */
    public function create(ProductRequest $request) : View|RedirectResponse
    {
        $category_id    = $request->category_id;
        $brand_id       = $request->brand_id;

        if (! $this->categoryRepository->find($category_id) || ! $this->brandRepository->find($brand_id)) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['product_create'])
                ->with([
                    'errMsg' => ProductConstant::ERR_MSG_CATEGORY_NOT_FOUND
                ]);
        endif;

        $data = $request->toArray();

        if (null !== $request->image) :
            $data['image'] = $this->imageService->create($request->image, ProductConstant::IMAGE_FOLDER);

            if (null == $data['image'] || $data['image'] == '') :
                return redirect()
                    ->route(RouteConstant::DASHBOARD['product_create'])
                    ->with([
                        'errMsg' => ProductConstant::ERR_MSG_CANT_PROCESS_IMAGE
                    ]);
            endif;
        endif;

        if (! $this->productRepository->create($data)) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['product_create'])
                ->with([
                    'errMsg' => Constant::ERR_MSG['create_fail']
                ]);
        endif;

        return redirect()
            ->route(RouteConstant::DASHBOARD['product_create'])
            ->with([
                'msg' => Constant::ERR_MSG['create_success']
            ]);
    }

    /**
     * @param ProductRequest $request
     *
     * @return RedirectResponse
     */
    public function update(ProductRequest $request) : RedirectResponse
    {
        $data        = $request->toArray();
        $category_id = $request->category_id;

        if (! $this->categoryRepository->find($category_id)) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['product_update'], ['id' => $request->id])
                ->with([
                    'errMsg' => ProductConstant::ERR_MSG_CATEGORY_NOT_FOUND
                ]);
        endif;

        if (! $product = $this->productRepository->find($request->id)) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['product_list'])
                ->with('msg', ProductConstant::ERR_MSG_NOT_FOUND);
        endif;


        if (null !== $request->image) :
            $data['image'] = $this->imageService->create($request->image, ProductConstant::IMAGE_FOLDER);

            if (null == $data['image'] || $data['image'] == '') :
                return redirect()
                    ->route(RouteConstant::DASHBOARD['product_update'], ['id' => $request->id])
                    ->with([
                        'errMsg' => ProductConstant::ERR_MSG_CANT_PROCESS_IMAGE
                    ]);
            endif;

            $this->imageService->delete($product->image, 'products');
        endif;

        if (! $this->productRepository->update($request->id, $data)) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['product_update'], ['id' => $request->id])
                ->with([
                    'errMsg' => Constant::ERR_MSG['update_fail']
                ]);
        endif;

        return redirect()
            ->route(RouteConstant::DASHBOARD['product_update'], ['id' => $request->id])
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
        $product_id = $request->query('id');

        if (! $this->productRepository->delete($product_id)) :
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
