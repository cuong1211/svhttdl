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
        <details open>
            <summary>{{ app()->getLocale() === 'en' ? $category->title_en : $category->title }}</summary>
            <ul>
                @foreach ($category->children as $child)
                    <x-admin.sidebar.category :category="$child" />
                @endforeach
            </ul>
        </details>
    </li>
@endif
