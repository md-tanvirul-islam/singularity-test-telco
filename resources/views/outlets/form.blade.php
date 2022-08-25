<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{ old('name') ? old('name') : (isset($outlet) ? $outlet->name : null)}}" class="form-control" required>
    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
    <label for="phone">Phone</label>
    <input type="tel" name="phone" id="phone" value="{{ old('phone') ? old('phone') : (isset($outlet) ? $outlet->phone : null)}}" class="form-control" required>
    @if ($errors->has('phone'))
        <span class="help-block">
            <strong>{{ $errors->first('phone') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
    <label for="latitude">Latitude</label>
    <input type="text" name="latitude" id="latitude" value="{{ old('latitude') ? old('latitude') : (isset($outlet) ? $outlet->latitude : null)}}" class="form-control" required>
    @if ($errors->has('latitude'))
        <span class="help-block">
            <strong>{{ $errors->first('latitude') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
    <label for="longitude">Longitude</label>
    <input type="text" name="longitude" id="longitude" value="{{ old('longitude') ? old('longitude') : (isset($outlet) ? $outlet->longitude : null)}}" class="form-control" required>
    @if ($errors->has('longitude'))
        <span class="help-block">
            <strong>{{ $errors->first('longitude') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
    <label for="image">Image</label>
    <input type="file" name="image" id="image" class="form-control" accept=".png, .jpg, .jpeg">
    @if ($errors->has('image'))
        <span class="help-block">
            <strong>{{ $errors->first('image') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
