<!-- resources/views/auth/register.blade.php -->
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div>
        <label for="fullname">Full Name</label>
        <input id="fullname" type="text" name="fullname" required autofocus>
    </div>

    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" required>
    </div>

    <div>
        <label for="username">Username</label>
        <input id="username" type="username" name="username" required>
    </div>

    <div>
        <label for="role">Role</label>
        <input id="role" type="role" name="role" required>
    </div>

    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
    </div>

    <div>
        <label for="password-confirm">Confirm Password</label>
        <input id="password-confirm" type="password" name="password_confirmation" required>
    </div>

    <button type="submit">Register</button>
</form>
