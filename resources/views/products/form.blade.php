<div class="form-group">
	<label for="name">Name</label>
	<input type="text" name="name" value="{{ old('name') ?? $product->name }}" class="form-control">
	<div>{{ $errors->first('name') }}</div>
</div>

<div class="form-group">
	<label for="slug">Slug</label>
	<input type="text" name="slug" value="{{ old('slug') ?? $product->slug }}" class="form-control">
	<div>{{ $errors->first('slug') }}</div>
</div>



<div class="form-group d-flex flex-column">
	<label for="image">Image</label>
	<input type="file" name="image" class="py-2">
	<div>{{ $errors->first('image') }}</div>
</div>

<div class="form-group">
	<label for="details">Details</label>
	<input name="details" class="form-control" value="{{ old('details') ?? $product->details }}">
	<div>{{ $errors->first('details') }}</div>
</div>

<div class="form-group">
	<label for="price">Price</label>
	<input name="price" class="form-control" value="{{ old('price') ?? $product->price }}">
	<div>{{ $errors->first('price') }}</div>
</div>

<div class="form-group">
	<label for="description">Description</label>
	<textarea name="description" class="form-control" cols="30" rows="10">{{ old('description') ?? $product->description }}</textarea>
	<div>{{ $errors->first('description') }}</div>
</div>
@csrf