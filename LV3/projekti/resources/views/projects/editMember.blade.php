@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					Uredi projekt
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

					<!-- New Project Form -->
					<form action="{{url('project/' . $project->id)}}" method="POST" class="form-horizontal">
						{{ csrf_field() }}
                                                {{ method_field('PATCH') }}

						
						<div class="form-group">
							<label for="project-description" class="col-sm-3 control-label">Obavljeni poslovi</label>
							<div class="col-sm-6">
								<input type="text" name="jobs" id="project-description" class="form-control" value="{{ old('project') ? old('project') : $project->jobs }}">
							</div>
						</div>

						<!-- Add Project Button -->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-btn fa-save"></i>Spremi
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
