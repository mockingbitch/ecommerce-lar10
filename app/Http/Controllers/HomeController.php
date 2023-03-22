<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Repositories\Contracts\Interface\ProductRepositoryInterface as ProductRepository;
use App\Repositories\Contracts\Interface\CategoryRepositoryInterface as CategoryRepository;

class HomeController extends Controller
{
    /**
     * @var productRepository
     */
    protected $productRepository;

    /**
     * @var categoryRepository
     */
    protected $categoryRepository;

    /**
     * @param ProductRepository $productRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
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
        $products = $this->productRepository->getActive();
        $categories = $this->categoryRepository->getActive();

        return view('home.pages.homepage', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
