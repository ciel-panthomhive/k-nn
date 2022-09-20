<form method="POST" action="{{ route('change') }}">
    @csrf

    @foreach ($errors->all() as $error)
        <p class="text-danger">{{ $error }}</p>
    @endforeach

    <h2>Ubah Password</h2>
    <br>
    <br>

    <div class="col">
        <label>Current Password</label>

        <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
    </div>

    <div class="col">
        <label>New Password</label>
        <input id="new_password" type="password" class="form-control" name="new_password"
            autocomplete="current-password">
    </div>

    <div class="col">
        <label>New Confirm
            Password</label>
        <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password"
            autocomplete="current-password">
    </div>
    <br>
    <br>

    <div class="col">
        <button type="submit"style="float:right; width: 150px" class="btn btn-primary">Ubah Password</button>
    </div>
</form>
<br>
<br>
