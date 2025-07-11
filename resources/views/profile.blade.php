<x-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.min.css">
  <style>
    body {
      background-color: #f4f6f9;
    }

    .profile-wrapper {
      max-width: 100%;
      padding: 40px;
    }

    .profile-row {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
    }

    .profile-left,
    .profile-right {
      background: white;
      border: 1px solid #ccc;
      border-radius: 10px;
      padding: 25px;
    }

    .profile-left {
      flex: 1;
      max-width: 300px;
      text-align: center;
    }

    .profile-left img {
      width: 130px;
      height: 130px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 10px;
    }

    .profile-left h3 {
      margin-bottom: 5px;
    }

    .profile-right {
      flex: 3;
    }

    .profile-right h4 {
      margin-bottom: 20px;
      color: #333;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      font-weight: 600;
      margin-bottom: 5px;
      color: #444;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .btn-update {
      background-color: #4a5bdc;
      color: white;
      padding: 10px 25px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .btn-update:hover {
      background-color: #3649b7;
    }
  </style>

  <div class="profile-wrapper">
    <div class="profile-row">
      <!-- Sidebar Profil -->
      <div class="profile-left">
        <img src="{{ auth()->user()->foto ? asset('foto/' . auth()->user()->foto) : asset('img/logo.png') }}" alt="Foto Profil">
        <h3>{{ Auth::user()->name }}</h3>
        <p>{{ Auth::user()->email }}</p>
        <hr style="margin: 15px 0;">
        <p><strong>Alamat:</strong><br> {{ Auth::user()->alamat ?? '-' }}</p>
      </div>

      <!-- Form Edit Profil -->
      <div class="profile-right">
        <h4>Ubah Profil</h4>
        <form method="POST" action="{{ route('updete_profile') }}" enctype="multipart/form-data">
          @csrf
          

          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ Auth::user()->name }}">
          </div>

          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ Auth::user()->email }}">
          </div>

          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" oninput="pass(this.value)">
          </div>

          <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="confim_password" id="confirm_pass" disabled>
          </div>

          <div class="form-group">
            <label>Kota</label>
              <input type="text" name="kota" value="{{ Auth::user()->kota }}">
          </div>

          <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ Auth::user()->alamat }}">
          </div>

          <div class="form-group">
            <label>Foto Profil</label>
            <input type="file" name="foto">
          </div>

          <button type="submit" class="btn-update">Ubah</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.all.min.js"></script>
  @error('confim_password')
      <script>
        Swal.fire({
          title: "Gagal Ubah Data",
          text: `Password tidak sama`,
          icon: "warning"
        });
      </script>
  @enderror
  <script>
    var password = document.getElementById('confirm_pass');
    function pass(value) {
      if (value !== '') {
        password.disabled = false;
        password.required = true;
      } else {
        password.disabled = true;
        password.required = false;
      }
    }

  </script>
  @if (session('profile'))
      <script>
        Swal.fire({
          title: "Selamat!",
          text: `{{ session('profile') }}`,
          icon: "success"
        });
      </script>
  @endif
</x-layout>
