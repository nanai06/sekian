<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - AYU-NE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
        body { background:#F8F6F3; color:#3b1a1a; }

        .edit-page { max-width:640px; margin:0 auto; padding:32px 20px 60px; }

        .page-header { display:flex; align-items:center; gap:12px; margin-bottom:28px; }
        .back-btn { font-size:20px; color:#3b1a1a; text-decoration:none; font-weight:600; transition:color 0.2s; }
        .back-btn:hover { color:#D4537E; }
        .page-title { font-size:20px; font-weight:800; color:#3b1a1a; }

        /* CARD */
        .edit-card {
            background:white; border:0.5px solid #E8E3DF;
            border-radius:16px; padding:24px 28px; margin-bottom:16px;
        }
        .card-title { font-size:15px; font-weight:700; color:#3b1a1a; margin-bottom:6px; }
        .card-desc { font-size:12px; color:#9E7178; margin-bottom:20px; }

        /* FORM */
        .form-group { margin-bottom:18px; }
        .form-label { display:block; font-size:12px; font-weight:600; color:#5D393B; margin-bottom:6px; }
        .form-input {
            width:100%; padding:11px 14px; border:1.5px solid #E8E3DF;
            border-radius:12px; font-size:13px; font-family:'Poppins',sans-serif;
            color:#3b1a1a; background:white; outline:none; transition:border-color 0.2s;
        }
        .form-input:focus { border-color:#D4537E; box-shadow:0 0 0 3px rgba(212,83,126,0.08); }
        .form-input::placeholder { color:#c4b5b0; }
        .form-error { font-size:11px; color:#e07080; margin-top:4px; }

        textarea.form-input { min-height:80px; resize:vertical; }

        /* AVATAR UPLOAD */
        .avatar-upload {
            display:flex; align-items:center; gap:18px; margin-bottom:20px;
        }
        .avatar-preview {
            width:72px; height:72px; border-radius:50%;
            background:linear-gradient(135deg, #FBEAF0 0%, #F4C0D1 100%);
            display:flex; align-items:center; justify-content:center;
            font-size:24px; font-weight:700; color:#D4537E;
            overflow:hidden; flex-shrink:0;
            border:3px solid white; box-shadow:0 2px 8px rgba(212,83,126,0.18);
        }
        .avatar-preview img { width:100%; height:100%; object-fit:cover; }
        .avatar-actions { display:flex; flex-direction:column; gap:6px; }
        .btn-upload {
            display:inline-flex; align-items:center; gap:6px;
            padding:7px 16px; border:1.5px solid #F0D5D8;
            border-radius:20px; background:white; font-size:12px;
            font-weight:600; color:#5D393B; cursor:pointer;
            font-family:'Poppins',sans-serif; transition:all 0.2s;
        }
        .btn-upload:hover { background:#FFF0F2; border-color:#D4537E; }
        .avatar-hint { font-size:11px; color:#9E7178; }

        /* BUTTONS */
        .btn-row { display:flex; align-items:center; gap:12px; margin-top:6px; }
        .btn-save {
            padding:11px 28px; background:#D4537E; color:white;
            border:none; border-radius:50px; font-size:13px; font-weight:700;
            cursor:pointer; font-family:'Poppins',sans-serif; transition:all 0.2s;
        }
        .btn-save:hover { background:#b8436a; transform:translateY(-1px); }
        .btn-cancel {
            padding:11px 28px; background:white; color:#5D393B;
            border:1.5px solid #E8E3DF; border-radius:50px; font-size:13px;
            font-weight:600; cursor:pointer; font-family:'Poppins',sans-serif;
            text-decoration:none; transition:all 0.2s;
        }
        .btn-cancel:hover { border-color:#D4537E; color:#D4537E; }

        /* SUCCESS TOAST */
        .toast-success {
            background:#EAF3DE; color:#639922; border:1px solid #c8e4a0;
            padding:10px 18px; border-radius:12px; font-size:13px;
            font-weight:600; margin-bottom:20px; display:flex;
            align-items:center; gap:8px;
        }

        /* PASSWORD SECTION */
        .danger-zone {
            border-color:#fce4ec;
        }
        .danger-zone .card-title { color:#e07080; }
        .btn-danger {
            padding:11px 28px; background:white; color:#e07080;
            border:1.5px solid #fce4ec; border-radius:50px; font-size:13px;
            font-weight:600; cursor:pointer; font-family:'Poppins',sans-serif;
            transition:all 0.2s;
        }
        .btn-danger:hover { background:#fce4ec; border-color:#e07080; }
    </style>
</head>
<body>

@include('layouts.navigation')

<div class="edit-page">
    <div class="page-header">
        <a href="{{ route('profil') }}" class="back-btn">←</a>
        <div class="page-title">Edit Profil</div>
    </div>

    {{-- Success Toast --}}
    @if(session('status') === 'profile-updated')
        <div class="toast-success">✅ Profil berhasil diperbarui!</div>
    @endif
    @if(session('status') === 'password-updated')
        <div class="toast-success">🔒 Password berhasil diubah!</div>
    @endif

    {{-- ============================
         INFORMASI PROFIL
         ============================ --}}
    <div class="edit-card">
        <div class="card-title">Informasi Profil</div>
        <div class="card-desc">Perbarui data profilmu agar informasi selalu up to date.</div>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            {{-- Avatar --}}
            <div class="avatar-upload">
                <div class="avatar-preview">
                    @if($user->foto_profil)
                        <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil">
                    @else
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    @endif
                </div>
                <div class="avatar-actions">
                    <label class="btn-upload">
                        📷 Ganti Foto
                        <input type="file" name="foto_profil" accept="image/*" hidden
                               onchange="previewAvatar(this)">
                    </label>
                    <div class="avatar-hint">JPG, PNG (maks. 2MB)</div>
                </div>
            </div>

            {{-- Nama --}}
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-input"
                       value="{{ old('name', $user->name) }}" required>
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input"
                       value="{{ old('email', $user->email) }}" required>
                @error('email') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            {{-- Username --}}
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-input"
                       value="{{ old('username', $user->username) }}"
                       placeholder="@username">
                @error('username') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            {{-- No HP --}}
            <div class="form-group">
                <label class="form-label">No. Handphone</label>
                <input type="text" name="no_hp" class="form-input"
                       value="{{ old('no_hp', $user->no_hp) }}"
                       placeholder="08xxxxxxxxxx">
                @error('no_hp') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            {{-- Kota --}}
            <div class="form-group">
                <label class="form-label">Kota</label>
                <input type="text" name="kota" class="form-input"
                       value="{{ old('kota', $user->kota) }}"
                       placeholder="Jakarta, Bandung, dll.">
                @error('kota') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            {{-- Bio --}}
            <div class="form-group">
                <label class="form-label">Bio</label>
                <textarea name="bio" class="form-input"
                          placeholder="Ceritakan tentang dirimu... ✨">{{ old('bio', $user->bio) }}</textarea>
                @error('bio') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="btn-row">
                <button type="submit" class="btn-save">Simpan Perubahan</button>
                <a href="{{ route('profil') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>

    {{-- ============================
         UBAH PASSWORD
         ============================ --}}
    <div class="edit-card">
        <div class="card-title">🔒 Ubah Password</div>
        <div class="card-desc">Gunakan password yang kuat untuk keamanan akun.</div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label class="form-label">Password Lama</label>
                <input type="password" name="current_password" class="form-input"
                       placeholder="Masukkan password lama">
                @error('current_password', 'updatePassword')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password Baru</label>
                <input type="password" name="password" class="form-input"
                       placeholder="Min. 8 karakter">
                @error('password', 'updatePassword')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-input"
                       placeholder="Ulangi password baru">
                @error('password_confirmation', 'updatePassword')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-save">Ubah Password</button>
        </form>
    </div>

    {{-- ============================
         HAPUS AKUN
         ============================ --}}
    <div class="edit-card danger-zone">
        <div class="card-title">⚠️ Zona Berbahaya</div>
        <div class="card-desc">Setelah akun dihapus, semua data akan hilang secara permanen.</div>

        <form method="POST" action="{{ route('profile.destroy') }}"
              onsubmit="return confirm('Yakin mau hapus akun? Tindakan ini tidak bisa dibatalkan!')">
            @csrf
            @method('delete')

            <div class="form-group">
                <label class="form-label">Masukkan password untuk konfirmasi</label>
                <input type="password" name="password" class="form-input"
                       placeholder="Password kamu" required>
                @error('password', 'userDeletion')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-danger">Hapus Akun Saya</button>
        </form>
    </div>
</div>

<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.querySelector('.avatar-preview');
            preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>
