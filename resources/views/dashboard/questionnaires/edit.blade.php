<form method="post" class="mb-5" action="/dashboard/questionnaire/{{ $questionnaire->id }}">
    @method('put')
    @csrf


    <div class="mb-3">
        <label for="question1" class="form-label">question1</label>
        <input type="text" class="form-control" id="question1" name="question1" value="" required autofocus>
    </div>
    <div class="mb-3">
        <label for="question2" class="form-label">question2</label>
        <input type="text" class="form-control" id="question2" name="question2" value="" required autofocus>
    </div>
    <div class="mb-3">
        <label for="question3" class="form-label">question3</label>
        <input type="text" class="form-control" id="question3" name="question3" value="" required autofocus>
    </div>
    <div class="mb-3">
        <label for="question4" class="form-label">question4</label>
        <input type="text" class="form-control" id="question4" name="question4" value="" required autofocus>
    </div>
    <button type="submit" class="btn btn-primary">Create Post</button>
</form>
