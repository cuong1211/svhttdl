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

{{-- @if ($category->children->isNotEmpty())
    <li>
        <details @if (isCategorySelected($category, request()->route('slug'))) open @endif>
            <summary>{{ app()->getLocale() === 'en' ? $category->title_en : $category->title }}</summary>
            <ul>
                @foreach ($category->children as $child)
                    <x-admin.sidebar.category :category="$child" />
                @endforeach
            </ul>
        </details>
    </li>
@else --}}
<li>
    <a class="{{ request()->routeIs('admin.categories.posts.index') && request()->route('category') == $category->id ? 'active' : '' }}" href="{{ route('admin.categories.posts.index', $category->id) }}">
        {{ app()->getLocale() === 'en' ? $category->title_en : $category->title }}
    </a>
</li>

{{-- @endif --}}
