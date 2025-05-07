<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Offer;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Cache\RedisTagSet;

class CategoryController extends Controller
{
    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //continue the work from here , get inspired by the user controller, it uses the repository pattern as well
        $categories = $this->categoryRepository->getAll();
        $countCategories= Category:: count();
        $activeCategories = 12;
        $latestCategory = Category::where('created_at', '>=', now()->subHours(48))->count();

        
        
        return view("categories.index",compact("categories","countCategories", "activeCategories","latestCategory"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAll();

        return view("categories.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validated();
        $this->categoryRepository->create($validatedData);
        return redirect()->route('categories.index')->with("success","The category has been created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category= $this->categoryRepository->getById($id);
        return view("categories.show",compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category= $this->categoryRepository->getById($id);
        $categories = $this->categoryRepository->getAll();

        return view("categories.edit",compact("category","categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $validatedData = $request->validated();
        $this->categoryRepository->update($id, $validatedData);
        return redirect()->route("categories.index")->with("success","The Category has been modified with success!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        return redirect()->route("categories.index")->with("success","The category has been deleted successfully");

    }
}
