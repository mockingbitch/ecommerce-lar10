<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Contracts\Interface\BrandRepositoryInterface;
use App\Constants\BrandConstant;
use App\Constants\RouteConstant;
use App\Constants\Constant;

class BrandController extends Controller
{
    /**
     * @var string
     */
    protected $breadcrumb = BrandConstant::BREADCRUMB;

    /**
     * @var brandRepository
     */
    protected $brandRepository;

    /**
     * @param BrandRepositoryInterface $brandRepository
     */
    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * @param Request $request
     *
     * @return View
     */
    public function list(Request $request) : View
    {
        return view('dashboard.list.brand', [
            'brands'        => $this->brandRepository->getAll(),
            'breadcrumb'    => $this->breadcrumb
        ]);
    }

    /**
     * @return View
     */
    public function viewCreate() : View
    {
        return view('dashboard.create.brand', [
            'breadcrumb' => $this->breadcrumb
        ]);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function create(Request $request) : RedirectResponse
    {
        if (! $this->brandRepository->create($request->toArray())) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['brand_create'])
                ->with([
                    'errMsg' => Constant::ERR_MSG['create_fail']
                ]);
        endif;

        return redirect()
            ->route(RouteConstant::DASHBOARD['brand_create'])
            ->with([
                'msg' => Constant::ERR_MSG['create_success']
            ]);
    }

    /**
     * @param Request $request
     *
     * @return View|RedirectResponse
     */
    public function viewUpdate(Request $request) : View|RedirectResponse
    {
        $brand = $this->brandRepository->find($request->id);

        if (null == $brand || $brand == '') :
            return redirect()
                ->route(RouteConstant::DASHBOARD['brand_list'])
                ->with([
                    'errMsg' => BrandConstant::ERR_MSG_NOT_FOUND
                ]);
        endif;

        return view('dashboard.update.brand', [
            'brand' => $brand,
            'breadcrumb' => $this->breadcrumb
        ]);
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update(Request $request) : RedirectResponse
    {
        if (! $this->brandRepository->find($request->id)) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['brand_list'])
                ->with('errMsg', BrandConstant::ERR_MSG_NOT_FOUND);
        endif;

        if (! $this->brandRepository->update($brandId, $request->toArray())) :
            return redirect()
                ->back()
                ->with([
                    'errMsg' => Constant::ERR_MSG['update_fail']
                ]);
        endif;

        return redirect()
            ->back()
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
        if (! $this->brandRepository->delete($request->id)) :
            return false;
        endif;

        return true;
    }
}
