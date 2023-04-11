<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Create\ProductModelRequest;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Contracts\Interface\ProductModelRepositoryInterface;
use App\Repositories\Contracts\Interface\CategoryRepositoryInterface;
use App\Repositories\Contracts\Interface\BrandRepositoryInterface;
use App\Services\ImageService;
use Illuminate\View\View;
use App\Constants\ProductModelConstant;
use App\Constants\Constant;
use App\Constants\RouteConstant;

class ProductModelController extends Controller
{
    /**
     * @var string
     */
    protected $breadcrumb = ProductModelConstant::BREADCRUMB;

    /**
     * @var productRepository
     */
    protected $productModelRepository;

    /**
     * @var categoryRepository
     */
    protected $categoryRepository;

    /**
     * @var brandRepository
     */
    protected $brandRepository;

    /**
     * @var imageService
     */
    protected $imageService;

    /**
     * @param ProductModelRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @param ImageService $imageService
     */
    public function __construct(
        ProductModelRepositoryInterface $productModelRepository,
        CategoryRepositoryInterface $categoryRepository,
        BrandRepositoryInterface $brandRepository,
        ImageService $imageService
        )
    {
        $this->productModelRepository       = $productModelRepository;
        $this->categoryRepository           = $categoryRepository;
        $this->brandRepository              = $brandRepository;
        $this->imageService                 = $imageService;
    }

    /**
     * @param Request $request
     *
     * @return View
     */
    public function list(Request $request) : View
    {
        if (null !== $request->category) :
            $productModels = $this->productModelRepository->getProductsByCategory($request->category);
        elseif (null !== $request->brand) :
            $productModels = $this->productModelRepository->getProductsByBrand($request->brand);
        else :
            $productModels = $this->productModelRepository->getAll();
        endif;

        return view('dashboard.list.product-model', [
            'productModels' => $productModels,
            'breadcrumb'    => $this->breadcrumb
        ]);
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
                ->route(RouteConstant::DASHBOARD['product_model_list'])
                ->with([
                    'errMsg' => ProductModelConstant::ERR_MSG_CATEGORY_NOT_FOUND
                ]);
        endif;

        return view('dashboard.create.product-model', [
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
            $productModel       = $this->productModelRepository->find($request->id);
            $categories         = $this->categoryRepository->getAvailableCategory();
            $brands             = $this->brandRepository->getAvailableBrand();

            if  (! $categories || null === $categories || count($categories) == 0 || null == $productModel) :
                return redirect()
                    ->route(RouteConstant::DASHBOARD['product_model_list'])
                    ->with([
                        'errMsg' => ProductModelConstant::ERR_MSG_NOT_FOUND
                    ]);
            endif;

            return view('dashboard.update.product-model', [
                'productModel'  => $productModel,
                'categories'    => $categories,
                'brands'        => $brands,
                'breadcrumb'    => $this->breadcrumb
            ]);
        } catch (\Throwable $th) {
            return redirect()
                ->route(RouteConstant::DASHBOARD['product_model_list'])
                ->with([
                    'errMsg' => ProductModelConstant::ERR_MSG_NOT_FOUND
                ]);
        }
    }

    /**
     * @param ProductModelRequest $request
     * @return View|RedirectResponse
     */
    public function create(ProductModelRequest $request) : View|RedirectResponse
    {
        $category_id    = $request->category_id;
        $brand_id       = $request->brand_id;

        if (! $this->categoryRepository->find($category_id) || ! $this->brandRepository->find($brand_id)) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['product_model_create'])
                ->with([
                    'errMsg' => ProductModelConstant::ERR_MSG_CATEGORY_NOT_FOUND
                ]);
        endif;

        $data = $request->toArray();

        if (null !== $request->image) :
            $data['image'] = $this->imageService->create($request->image, ProductModelConstant::IMAGE_FOLDER);

            if (null == $data['image'] || $data['image'] == '') :
                return redirect()
                    ->route(RouteConstant::DASHBOARD['product_model_create'])
                    ->with([
                        'errMsg' => ProductModelConstant::ERR_MSG_CANT_PROCESS_IMAGE
                    ]);
            endif;
        endif;

        if (! $this->productModelRepository->create($data)) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['product_model_create'])
                ->with([
                    'errMsg' => Constant::ERR_MSG['create_fail']
                ]);
        endif;

        return redirect()
            ->route(RouteConstant::DASHBOARD['product_model_create'])
            ->with([
                'msg' => Constant::ERR_MSG['create_success']
            ]);
    }

    /**
     * @param ProductModelRequest $request
     *
     * @return RedirectResponse
     */
    public function update(ProductModelRequest $request) : RedirectResponse
    {
        $data        = $request->toArray();
        $category_id = $request->category_id;

        if (! $this->categoryRepository->find($category_id)) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['product_model_update'], ['id' => $request->id])
                ->with([
                    'errMsg' => ProductModelConstant::ERR_MSG_CATEGORY_NOT_FOUND
                ]);
        endif;

        if (! $productModel = $this->productModelRepository->find($request->id)) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['product_model_list'])
                ->with('msg', ProductModelConstant::ERR_MSG_NOT_FOUND);
        endif;


        if (null !== $request->image) :
            $data['image'] = $this->imageService->create($request->image, ProductModelConstant::IMAGE_FOLDER);

            if (null == $data['image'] || $data['image'] == '') :
                return redirect()
                    ->route(RouteConstant::DASHBOARD['product_model_update'], ['id' => $request->id])
                    ->with([
                        'errMsg' => ProductModelConstant::ERR_MSG_CANT_PROCESS_IMAGE
                    ]);
            endif;

            $this->imageService->delete($productModel->image, 'products');
        endif;

        if (! $this->productModelRepository->update($request->id, $data)) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['product_model_update'], ['id' => $request->id])
                ->with([
                    'errMsg' => Constant::ERR_MSG['update_fail']
                ]);
        endif;

        return redirect()
            ->route(RouteConstant::DASHBOARD['product_model_update'], ['id' => $request->id])
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
        $product_model_id = $request->query('id');

        if (! $this->productModelRepository->delete($product_model_id)) :
            return false;
        endif;

        return true;
    }

    /**
     * @param Request $request
     *
     * @return View
     */
    public function listProductModel(Request $request) : View
    {
        $listProductModel   = $this->productModelRepository->getListProduct($request);
        $categories         = $this->categoryRepository->getActive();

        return view('home.pages.list_product_model', [
            'listProduct' => $listProductModel,
            'categories' => $categories
        ]);
    }

    public function productDetail(?int $id)
    {
        $productModel       = $this->productModelRepository->find($id);

        if (! $productModel || null === $productModel) :
            return redirect()->back()->with('errMsg', trans('product_not_found'));
        endif;

        $productStorage     = $productModel->storage;
        $roms   = [];
        $colors = [];

        foreach ($productStorage as $item) :
            $roms[]     = $item->ram;
            $colors[]   = $item->color;
        endforeach;

        $relatedProducts    = $this->productModelRepository->getAll();

        return view('home.pages.product_detail', [
            'productModel'      => $productModel,
            'productStorage'    => $productStorage,
            'relatedProducts'   => $relatedProducts,
            'roms'              => array_unique($roms),
            'colors'            => array_unique($colors)
        ]);
    }
}
