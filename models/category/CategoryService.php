<?php

declare(strict_types=1);

namespace app\models\category;

class CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create(CategoryForm $form): Category
    {
        $category = Category::create(
            $form->name,
            (int)$form->status,
        );
        $this->categoryRepository->save($category);
        return $category;
    }

    public function edit($id, CategoryForm $form): Category
    {
        $category = $this->categoryRepository->getById($id);
        $category->edit(
            $form->name,
            (int)$form->status,
        );
        $this->categoryRepository->save($category);
        return $category;
    }

    public function remove($id): void
    {
        $category = $this->categoryRepository->getById($id);
        $this->categoryRepository->remove($category);
    }
}