@props(['category', 'selectedCategory' => null, 'level' => 0])

@php
    // Define the space for indentation
    $space = str_repeat('&nbsp;', $level * 3);
@endphp

<option value="{{ $category->id }}">
    {!! $space !!}{{ app()->getLocale() === 'en' ? $category->title_en : $category->title }}
</option>

@if ($category->children->isNotEmpty())
    @foreach ($category->children as $child)
        <option @selected(in_array($child->id, [$selectedCategory?->id, old('parent_id')])) value="{{ $child->id }}">
            {!! str_repeat('&nbsp;', 2 * 3) !!}{{ app()->getLocale() === 'en' ? $child->title_en : $child->title }}
        </option>
    @endforeach
@endif
