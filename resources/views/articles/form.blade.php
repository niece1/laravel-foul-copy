<div class="form-group">
	<label for="title">Title</label>
	<input type="text" name="title" value="{{ old('title') ?? $article->title }}" class="form-control">
	<div>{{ $errors->first('title') }}</div>
</div>

<div class="form-group">
	<label for="content">Content</label>
	<textarea class="my_textarea" name="content" class="form-control" cols="30" rows="10">{{ old('content') ?? $article->content }}</textarea>
	<div>{{ $errors->first('content') }}</div>
</div>

<div class="form-group d-flex flex-column">
	<label for="image">Image</label>
	<input type="file" name="image" class="py-2">
	<div>{{ $errors->first('image') }}</div>
</div>

<div class="form-group">
	<label for="status">Status</label>
	<select name="status" value="{{ old('status') }}" class="form-control">
		<option value="" disabled>Select status</option>
		<option value="1" {{ $article->status == 'Published' ? 'selected' : '' }}>Published</option>
		<option value="0" {{ $article->status == 'Unpublished' ? 'selected' : '' }}>Unpublished</option>
	</select>
</div>

<div class="form-group">
	<label for="category_id">Choose category</label>
	<select name="category_id" value="{{ old('category_id') }}" class="form-control">
		@foreach ($categories as $category)
		<option value="{{ $category->id }}" {{ $category->id == $article->category_id ? 'selected' : '' }}>{{ $category->title }}</option>
		@endforeach
	</select>
</div>

<div class="form-group">
	<label for="tag_id">Choose tags</label>
	<select name="tag_id[]" value=""  class="form-control" multiple>
		@foreach ($tags as $tag)
		<option value="{{ $tag->id }}" {{ in_array($tag->id, $article->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $tag->title }}</option>
		@endforeach
	</select>
</div>

@csrf