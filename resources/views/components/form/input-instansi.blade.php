<div class="form-control">
    <label class="label">
        <span class="label-text">{{ $label }}</span>
    </label>
    <input type="text" class="input input-info input-bordered
        @error($field)
            input-error
        @enderror
    " wire:model="{{ $field }}">
    <label class="label">
        @error($field) <span class="label-text-alt text-error">{{ $message }}</span> @enderror
    </label>
</div>
