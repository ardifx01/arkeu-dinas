<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
</head>
<body>
    <header>
        <h1>Edit Profil</h1>
        <nav>
            <a href="{{ url('/dashboard') }}">Dashboard</a> |
            <a href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               Logout
            </a>
        </nav>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </header>

    <main>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PATCH')

            <div>
                <label for="name">Nama</label><br>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}">
            </div>

            <div>
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
            </div>

            <div>
                <label for="password">Password Baru (opsional)</label><br>
                <input type="password" id="password" name="password">
            </div>

            <div>
                <label for="password_confirmation">Konfirmasi Password Baru</label><br>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <div>
                <button type="submit">Simpan Perubahan</button>
            </div>
        </form>
    </main>
</body>
</html>
