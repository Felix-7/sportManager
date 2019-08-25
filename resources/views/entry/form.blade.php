<div class="form-row my-5">
    <div class="col-10">
        <input type="text" class="form-control" placeholder="Wert" name="tempValue">
    </div>
    <div class="col-2">
        <input type="text" class="form-control" value="{{$discipline->unit}}" disabled>
    </div>
    <div class="text-warning">{{$errors->first('tempValue')}}</div>
</div>
@csrf
