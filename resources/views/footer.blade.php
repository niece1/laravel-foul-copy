<div class="container-fluid" style="background: #cccccc;">
	<div class="row justify-content-center">
		<div class="col-md-4">
			<p>Rosy. All rigts reserved. <?php echo date('Y'); ?></p>
			<a href="{{route('download', '208-2019.pdf')}}" class="btn btn-outline-danger">Download</a>
		</div>
		<div class="col-md-">
						<h5>Contact us</h5>
			<h6>Subscribe to our newsletters!</h6>
			<div class="form-group">
				<form action="contact" method="post">					
					<input type="email" name="email" value="{{ old('email') }}" class="form-control">

					<div>{{ $errors->first('email') }}</div>
					<button type="submit" class="btn btn-primary mt-2">Send</button>
					@csrf
				</form>
			</div>
		</div>
	</div>
</div>