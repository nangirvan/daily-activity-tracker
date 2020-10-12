@extends('layouts.app')

@section('content')
<!-- Modal Help -->
<div class="modal fade" id="modalHelp" tabindex="-1" role="dialog" aria-labelledby="modalHelp" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<ul class="list-group text-center mb-2">
					<li class="list-group-item">
						<p>If it's your first time, you need to add activity</p>
						<button class="btn btn-primary" type="submit" data-toggle="modal" data-target="#modalAddActivity">Add Activity</button>
					</li>
					<li class="list-group-item">
						<p>Start your activity by clicking</p>
						<a class="text-decoration-none" href="#" data-toggle="modal" data-target="#modalAddProgress"><i class="fas fa-running"></i> What will you do today?</a>		
					</li>
					<li class="list-group-item">
						<p>When you finish doing your activity, you can click <span class="text-warning"><i class="fas fa-check-circle"></i></span> button on each activity</p>	
					</li>
				</ul>
				<button class="btn btn-danger float-right" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">Close</span>
				</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal Add Activity -->
<div class="modal fade" id="modalAddActivity" tabindex="-1" role="dialog" aria-labelledby="modalAddActivity" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<form action="/add-activity" method="POST">
					@csrf
					<div class="form-group">
						<label for="inputActivityName">Activity Name</label>
						<input class="form-control" type="text" id="inputActivityName" name="activity_name" placeholder="example: Workout" required>
						<small id="inputTargetMinuteHelp" class="form-text text-muted">
							Please input no more than 50 character
						</small>
					</div>
					<button class="btn btn-primary float-left" type="submit" name="add_activity">Add Activity</button>
					<button class="btn btn-danger float-right" type="button" data-dismiss="modal" aria-label="Cancel">
						<span aria-hidden="true">Cancel</span>
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Modal Add Progress -->
<div class="modal fade" id="modalAddProgress" tabindex="-1" role="dialog" aria-labelledby="modalAddProgress" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				@if (sizeof($all_activities) > 0 )
					@if (sizeof($not_done_activities) > 0)
					<form action="/add-progress" method="POST">
						@csrf
						<div class="form-group">
							<label for="inputActivity">Select Activity</label>
							<a class="action-button" href="#" data-toggle="modal" data-dismiss="modal" data-target="#modalAddActivity"><i class="fas fa-plus-circle"></i></a>	
							<select class="form-control" id="inputProgressActivity" name="progress_activity" required>	
							@foreach ($not_done_activities as $activity)
								<option>{{ $activity->name }}</option>
							@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="inputTarget">Target Duration</label>
							<div class="row">
								<div class="col">
									<input type="number" class="form-control" name="progress_hour" max="23" min="0" value="0" required>
									<small id="inputTargetHourHelp" class="form-text text-muted">
										Hour
									</small>
								</div>
								<div class="col">
									<input type="number" class="form-control" name="progress_minute" max="59" min="0" value="0" required>
									<small id="inputTargetMinuteHelp" class="form-text text-muted">
										Minute
									</small>
								</div>
							</div>
						</div>
						<button class="btn btn-primary float-left" type="submit" name="add_progress">Start Activity</button>
						<button class="btn btn-danger float-right" type="button" data-dismiss="modal" aria-label="Cancel">
							<span aria-hidden="true">Cancel</span>
						</button>
					</form>
					@else
					<div class="text-center">
						<h5>Today Activities Completed</h5>
						<hr>
						<p>Add more activity?</p>
						<button class="btn btn-primary" type="submit" data-toggle="modal" data-dismiss="modal" data-target="#modalAddActivity">Yes</button>
						<button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Cancel">No</button>
					</div>
					@endif
				@else
				<div class="text-center">
					<p>Please Add Activity First</p>
					<button class="btn btn-primary" type="submit" data-toggle="modal" data-dismiss="modal" data-target="#modalAddActivity">Add Activity</button>
					<button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Cancel">Cancel</button>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>

<!-- Main Content -->
<div class="container mt-3" id="page-content">
	<!-- Progress of The Day -->
	<div class="text-center">
		<?php 
			$total_target = 0; 
			$total_progress = 0; 
            if (sizeof($progresses) > 0) {
				foreach ($progresses as $progress) {
					$total_target += $progress->target_minutes;
					$total_progress += $progress->progress_minutes	;
				}
			}
		?>
		<h5 class="mb-3">Target Time Spent</h5>
		<div class="progress mb-2" style="height: 30px;">
			@if (($total_target-$total_progress) == $total_target)
				<div class="progress-bar bg-secondary" role="progressbar" style="width: 100%" aria-valuenow="{{ $total_target }}" aria-valuemin="0" aria-valuemax="{{ $total_target }}">
					{{ $total_target - $total_progress }} Minutes remaining
				</div>
			@else 
				<div class="progress-bar bg-primary" role="progressbar" style="width: {{ ($total_progress/$total_target)*100 }}%" aria-valuenow="{{ $total_progress }}" aria-valuemin="0" aria-valuemax="{{ $total_target }}">
					{{ $total_progress }} Achieved
				</div>
				<div class="progress-bar bg-secondary" role="progressbar" style="width: {{ ($total_target/$total_progress)*100 }}%" aria-valuenow="{{ $total_target }}" aria-valuemin="0" aria-valuemax="{{ $total_target }}">
					{{ $total_target - $total_progress }} Minutes remaining
				</div>
			@endif
		</div>
	</div>

	<div class="row mt-4">
		<div class="col-md-12  mb-4">
			<div class="card shadow">
				<div class="card-body">
					<h5 class="card-title text-center">Your Activities</h5>
					<hr>
					@if (sizeof($progresses) > 0)
						@foreach ($progresses as $progress)
						<div class="activity-header">
							@if ($progress->start_at != null && $progress->end_at == null)
							<a class="action-button" href="/update-progress?id={{ $progress->id }}"><i class="fas fa-check-circle"></i></a>	
							<p class="activity-name">{{ $progress->name }} (On Going)</p>
							@else
							<p class="activity-name">{{ $progress->name }}</p>
							@endif
						</div>
						<div class="progress mb-3">
							<div class="progress-bar" role="progressbar" style="width: {{ ($progress->progress_minutes/$progress->target_minutes)*100 }}%;" aria-valuenow="{{ $progress->progress_minutes }}" aria-valuemin="0" aria-valuemax="{{ $progress->target_minutes }}">
							{{ $progress->progress_minutes }} Minutes
							</div>
						</div>
						@endforeach
						<div class="mt-4">
							<a href="#" class="float-right"><i class="fas fa-angle-double-right fa-2x"></i></a>
							@if (sizeof($not_done_activities) > 0)
								<a href="#" class="float-left text-warning" data-toggle="modal" data-target="#modalAddProgress"><i class="fas fa-plus-circle fa-2x"></i></a>					
							@endif
						</div>
					@else
						<div class="text-center">
							<a class="text-decoration-none" href="#" data-toggle="modal" data-target="#modalAddProgress"><i class="fas fa-running"></i> What will you do today?</a>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>

</div>
@endsection