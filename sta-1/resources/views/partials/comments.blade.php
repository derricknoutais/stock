<div class="row">
    <div class="col-xs-12">

        <!-- Fluid width widget -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-comment"></span> 
                    Recent Comments
                </h3>
            </div>
            <div class="panel-body">
                <ul class="media-list">
                    @foreach($comments as $comment)
                    <li class="media">
                        <div class="media-left">
                            <img src="http://placehold.it/60x60" class="img-circle">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                {{  $comment->body }}
                                <br>
                                <small>
                                    {{ $comment->user->name }} commented on <a href="#">{{ $comment->created_at }}</a>

                                </small>
                            </h4>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- End fluid width widget -->
    </div>
</div>

<div class="row container-fluid">
    <form action="{{ route('comments.store') }}" method="post" >
                        {{ csrf_field() }}
                        <input type="hidden" name="commentable_type" value="App\Project">
                        <input type="hidden" name="commentable_id" value="{{$project->id}}">
                        <div class="form-group" >
                            <label for="company-content">Comment<span class="required">*</span></label>
                            <textarea id="company-name" type="text" name="body" class="form-control autosize-target text-left" spellcheck="false" required rows="3" spellcheck="true" placeholder="Enter your Comment" ></textarea>
                        </div>
                        <div class="form-group" >
                            <label for="company-content">Proof of Work Done (Url/Photos)<span class="required">*</span></label>
                            <textarea id="company-name" type="text" name="url" class="form-control autosize-target text-left" spellcheck="false" required rows="2" spellcheck="true" placeholder="Enter url or Screenshots" ></textarea>
                        </div>
                        <div class="form-group" >
                            <input type="submit" class="btn btn-primary" value="Submit" />
                        </div>

        </form>
</div>
