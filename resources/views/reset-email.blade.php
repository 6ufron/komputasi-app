<form action="{{ route('reset-email') }}" method="POST">
    @csrf
    <label for="current_email">Email Saat Ini:</label>
    <input type="email" name="current_email" required>
    <label for="new_email">Email Baru:</label>
    <input type="email" name="new_email" required>
    <button type="submit">Reset Email</button>
</form>
