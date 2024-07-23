<!-- resources/views/auth/passwords/email.blade.php -->
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" required>
    </div>
    <button type="submit">Send Password Reset Link</button>
</form>
