    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{old('name') ?? $discipline->name}}" class="form-control">
        <div>{{$errors->first('name')}}</div>
    </div>

    <div class="form-group">
        <label for="unit">Einheit</label>
        <input type="text" name="unit" value="{{old('unit') ?? $discipline->unit}}" class="form-control">
        <div>{{$errors->first('unit')}}</div>
    </div>

    <div class="form-check form-check-inline">
        <input type="hidden" name="best_high" value="0">
        <input type="checkbox" name="best_high" @if($discipline->best_high == 1) checked @endif class="form-check-input" value="1">
        <label class="form-check-label" for="best_high">Höhere Werte sind besser</label>
    </div>
    <input type="hidden" name="active" value="1">

    <br>

@csrf