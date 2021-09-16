@props([
	'disabled' => false
])

{{-- <input {{ $disabled ? 'disabled' : '' }} > --}}

<input {{ $disabled ? 'disabled' : '' }}
	type="text" {!! $attributes->merge(['class' => 'form-control']) !!} 
	id="floatingInput" 
	placeholder="name@example.com">