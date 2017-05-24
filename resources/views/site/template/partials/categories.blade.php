<div class="hidden-xs col-sm-2"></div>
<div class="col-xs-12 col-sm-8">
	@foreach($categories as $category)
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
			{{$category->name}}
		</div>
	@endforeach
</div>
<div class="hidden-xs col-sm-2"></div>