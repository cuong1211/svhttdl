@php
    if (!function_exists('isCategorySelected')) {
        function isCategorySelected($category, $id): bool
        {
            if ($category->id == $id) {
                return true;
            }

            foreach ($category->children as $child) {
                if (isCategorySelected($child, $id)) {
                    return true;
                }
            }

            return false;
        }
    }
@endphp

@if ($category->children->isNotEmpty())
    <li>
        <details @if (isCategorySelected($category, request()->route('category'))) open @endif>
            <summary>{{ app()->getLocale() === 'en' ? $category->title_en : $category->title }}</summary>
            <ul>
                @foreach ($category->children as $child)
                
                        <x-admin.sidebar.category :category="$child" />

                @endforeach
            </ul>
        </details>
    </li>
@else
    <li>
        <a @class([
            'active' => isCategorySelected($category, request()->route('category')),
        ]) href="{{ route('admin.categories.posts.index', ['category'=>$category->id]) }}">
            {{ app()->getLocale() === 'en' ? $category->title_en : $category->title }}
        </a>
    </li>
@endif
