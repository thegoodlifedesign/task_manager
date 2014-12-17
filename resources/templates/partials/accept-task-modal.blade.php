<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Do you wanna accept the task?!?!?!?!?! Yes!!!!!! or no!!!!!</h4>
      </div>
      <div class="modal-body">
      {!! Form::open(['url' => URL::route('accept.task')]) !!}

       <div class="form-group">
        <label for="completionTime">How long will it take u to reach the center of the blow pop?</label>
        <input type="number"  id="completionTime" name="completion_time" class="form-control" placeholder="Completion Time">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="hidden" name="task_id" value="{{$task->id}}">
            <button class="submit btn btn-primary" type="submit">Accept</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

