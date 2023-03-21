<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Contracts\Interface\CategoryRepositoryInterface;
use App\Constants\CategoryConstant;
use App\Constants\RouteConstant;
use App\Constants\Constant;

class CategoryController extends Controller
{
    /**
     * @var string
     */
    protected $breadcrumb = CategoryConstant::BREADCRUMB;

    /**
     * @var categoryRepository
     */
    protected $categoryRepository;

    /**
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Request $request
     *
     * @return View
     */
    public function list(Request $request) : View
    {
        return view('dashboard.list.category', [
            'categories' => $this->categoryRepository->getAll(),
            'breadcrumb' => $this->breadcrumb
        ]);
    }

    /**
     * @return View
     */
    public function viewCreate() : View
    {
        return view('dashboard.create.category', [
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
        if (! $this->categoryRepository->create($request->toArray())) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['category_create'])
                ->with([
                    'errMsg' => Constant::ERR_MSG['create_fail']
                ]);
        endif;

        return redirect()
            ->route(RouteConstant::DASHBOARD['category_create'])
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
        $category = $this->categoryRepository->find($request->id);

        if (null == $category || $category == '') :
            return redirect()
                ->route(RouteConstant::DASHBOARD['category_list'])
                ->with([
                    'errMsg' => CategoryConstant::ERR_MSG_NOT_FOUND
                ]);
        endif;

        return view('dashboard.update.category', [
            'category' => $category,
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
        if (! $this->categoryRepository->find($request->id)) :
            return redirect()
                ->route(RouteConstant::DASHBOARD['category_list'])
                ->with('errMsg', CategoryConstant::ERR_MSG_NOT_FOUND);
        endif;

        if (! $this->categoryRepository->update($categoryId, $request->toArray())) :
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
        if (! $this->categoryRepository->delete($request->id)) :
            return false;
        endif;

        return true;
    }
}
