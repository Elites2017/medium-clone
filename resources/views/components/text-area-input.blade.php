@props(['disabled' => false, 'content' => ''])
{{-- This component is used to render a text area input field with optional disabled state and custom attributes. --}}

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>{{ $slot }}{{ $content }}</textarea>