<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{ isset($user) ? $user->name : null}}" class="form-control" required>
    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="{{ isset($user) ? $user->email : null}}" class="form-control" required>
    @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div>

<div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
    <label for="role">Role</label>
    <select name="role" id="role" class="form-control" required>
        <option value="">Select One</option>
        <option {{isset($user) ? ($user->role == 'admin' ? 'selected' : '') : null}} value="admin">Admin</option>
        <option {{isset($user) ? ($user->role == 'customer' ? 'selected' : '') : null}} value="customer">Customer</option>
    </select>
    @if ($errors->has('role'))
        <span class="help-block">
            <strong>{{ $errors->first('role') }}</strong>
        </span>
    @endif
</div>

<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password">Password</label>
    @if (Route::currentRouteName() == 'users.edit')
        <small>(If you want to change the password, enter new password.)</small>
    @endif
    <input type="password" name="password" id="password" class="form-control" {{ Route::currentRouteName() == 'users.create' ? 'required' : ''}}>
    @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
</div>

<div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    <label for="password_confirmation">Password(confirmation)</label>
    @if (Route::currentRouteName() == 'users.edit')
        <small>(If you want to change the password, enter new password.)</small>
    @endif
    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" {{ Route::currentRouteName() == 'users.create' ? 'required' : ''}}>
    @if ($errors->has('password_confirmation'))
        <span class="help-block">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
