<div class="text-center">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{old('name')}}" class="form-control">
        <div>{{$errors->first('name')}}</div>
    </div>

    <div class="form-group">
        <label for="unit">Einheit</label>
        <input type="text" name="unit" value="{{old('unit')}}" class="form-control">
        <div>{{$errors->first('unit')}}</div>
    </div>

    <div class="form-check form-check-inline">
        <input type="hidden" name="best_high" value="0">
        <input type="checkbox" name="best_high" checked class="form-check-input" value="1">
        <label class="form-check-label" for="best_high">Höher ist besser</label>
    </div>

    <div class="form-check form-check-inline">
        <input type="hidden" name="active" value="0">
        <input type="checkbox" name="active" checked class="form-check-input" value="1">
        <label class="form-check-label" for="active">Aktiv</label>
    </div>

    <p></p>

    <button type="submit" class="btn btn-primary">Add Discipline</button>
</div>

@csrf