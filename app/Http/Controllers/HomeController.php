<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Repositories\Contracts\Interface\ProductModelRepositoryInterface as ProductModelRepository;
use App\Repositories\Contracts\Interface\CategoryRepositoryInterface as CategoryRepository;

class HomeController extends Controller
{
    /**
     * @var productModelRepository
     */
    protected $productModelRepository;

    /**
     * @var categoryRepository
     */
    protected $categoryRepository;

    /**
     * @param ProductModelRepository $productModelRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        ProductModelRepository $productModelRepository,
        CategoryRepository $categoryRepository
    )
    {
        $this->productModelRepository   = $productModelRepository;
        $this->categoryRepository       = $categoryRepository;
    }

    /**
     * @param string|null $language
     *
     * @return RedirectResponse
     */
    public function changeLanguage(?string $language) : RedirectResponse
    {
        \Session::put('website_language', $language);

        return redirect()->back();
    }

    /**
     * @return View
     */
    public function index() : View
    {
        $products = $this->productModelRepository->getActive();
        $categories = $this->categoryRepository->getActive();

        return view('home.pages.homepage', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
