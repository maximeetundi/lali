<?php

declare(strict_types=1);

namespace Domain\Shop\Category\Observers;

use App\Observers\LogAttemptDeleteResource;
use Domain\Shop\Category\Models\Category;
use Filament\Support\Exceptions\Halt;
use Illuminate\Database\Eloquent\Builder;

class CategoryObserver
{
    use LogAttemptDeleteResource;

    /**
     * @throws Halt
     */
    public function deleting(Category $category): void
    {
        $category->loadCount([
            'products' => function (Builder $builder) {
                /** @var \Domain\Shop\Product\Models\Product|\Illuminate\Database\Eloquent\Builder $builder */
                $builder->withTrashed();
            },
            'children' => function (Builder $builder) {
                /** @var \Domain\Shop\Category\Models\Category|\Illuminate\Database\Eloquent\Builder $builder */
                $builder->withTrashed();
            },
        ]);

        if ($category->products_count > 0) {

            self::abortThenLogAttemptDeleteRelationCount(
                $category,
                trans('Can not delete category with associated products.'),
                'products',
                $category->products_count
            );

            abort(403);
        }
        if ($category->children_count > 0) {

            self::abortThenLogAttemptDeleteRelationCount(
                $category,
                trans('Can not delete category with associated children.'),
                'children',
                $category->children_count
            );

        }
    }

    public function updating(Category $category): void
    {
        $category->loadCount([
            'products' => function (Builder $builder) {
                /** @var \Domain\Shop\Product\Models\Product|\Illuminate\Database\Eloquent\Builder $builder */
                $builder->withTrashed();
            },
        ]);

        if (null === $category->parent_id && $category->products_count > 0) {
            abort(403, trans('Can not remove parent category with associated products.'));
        }
    }
}
