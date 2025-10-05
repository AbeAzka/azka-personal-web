<?php
session_start();
require 'db.php';

// Login otomatis dari cookie (dipertahankan)
if (isset($_COOKIE['remember_me'])) {
    $token = $_COOKIE['remember_me'];
    $result = $conn->query("SELECT * FROM users WHERE remember_token='$token'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
    }
}

// Ambil data user jika login
$username = "Tamu";
$avatar_path = "images/user.png";
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT username, avatar FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($username, $avatar);
    $stmt->fetch();
    $stmt->close();

    $avatar = !empty($avatar) ? $avatar : "user.png";
    $avatar_path = in_array($avatar, ["avatar1.png", "avatar2.png", "avatar3.png", "avatar4.png"])
        ? "users/avatars/$avatar"
        : "users/uploads/$avatar?t=" . time();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Indodev Studio - Home</title>
  <link rel="icon" href="/images/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="style_modern.css?v=1.0" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<!-- ================= HEADER ================= -->
<?php include 'header.php'; ?>

<!-- ================= HERO SECTION ================= -->
<section id="hero" class="d-flex align-items-center justify-content-center text-center">
  <div class="container" data-aos="fade-up">
    <img src="images/Logo.png" alt="Indodev Studio" class="hero-logo mb-3">
    <h1 class="fw-bold text-white mb-3">Selamat Datang di <span class="text-primary">Indodev Studio</span></h1>
    <p class="lead text-light">Kami menghadirkan pengalaman digital terbaik melalui game, inovasi, dan kreativitas.</p>
    <a href="#about" class="btn btn-primary btn-lg mt-3">Jelajahi Sekarang</a>
  </div>
</section>

<!-- ================= ABOUT SECTION ================= -->
<section id="about" class="py-5 bg-light">
  <div class="container text-center" data-aos="fade-up">
    <h2 class="fw-bold mb-4">Tentang Kami</h2>
    <p class="text-muted mb-5">
      Indodev Studio adalah tim kreatif pengembang game dan solusi digital yang berfokus pada inovasi dan kesenangan.
      Kami menciptakan pengalaman interaktif untuk semua kalangan.
    </p>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100 hover-up">
          <i class="fa-solid fa-gamepad fa-2x text-primary mb-3"></i>
          <h5>Game Development</h5>
          <p class="text-muted">Kami merancang dan mengembangkan game dengan gameplay menarik dan visual modern.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100 hover-up">
          <i class="fa-solid fa-laptop-code fa-2x text-primary mb-3"></i>
          <h5>Software Solutions</h5>
          <p class="text-muted">Kami menciptakan aplikasi dan sistem digital yang efisien dan mudah digunakan.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100 hover-up">
          <i class="fa-solid fa-users fa-2x text-primary mb-3"></i>
          <h5>Community</h5>
          <p class="text-muted">Komunitas kami aktif berbagi ide, pengalaman, dan kolaborasi untuk masa depan digital.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================= PROJECTS SECTION ================= -->
<section id="projects" class="py-5">
  <div class="container text-center" data-aos="fade-up">
    <h2 class="fw-bold mb-4">Proyek Unggulan Kami</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card project-card shadow-sm h-100 hover-up">
          <img src="images/game1.jpg" class="card-img-top" alt="Game 1">
          <div class="card-body">
            <h5 class="card-title">RunGame 2</h5>
            <p class="card-text text-muted">Update besar dengan map baru dan mode kompetitif online.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card project-card shadow-sm h-100 hover-up">
          <img src="images/game2.jpg" class="card-img-top" alt="Game 2">
          <div class="card-body">
            <h5 class="card-title">Natural Disaster Survival</h5>
            <p class="card-text text-muted">Bertahan hidup dari bencana acak dengan gameplay realistis.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card project-card shadow-sm h-100 hover-up">
          <img src="images/game3.jpg" class="card-img-top" alt="Game 3">
          <div class="card-body">
            <h5 class="card-title">IoT Control App</h5>
            <p class="card-text text-muted">Kendalikan perangkat pintar Anda dengan mudah melalui aplikasi kami.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================= CONTACT SECTION ================= -->
<section id="contact" class="py-5 bg-light">
  <div class="container text-center" data-aos="fade-up">
    <h2 class="fw-bold mb-4">Hubungi Kami</h2>
    <p class="text-muted mb-4">Tertarik untuk bergabung atau bekerja sama? Ayo mulai langkah baru bersama kami!</p>
    <a href="/u/login" class="btn btn-primary btn-lg me-2">Login</a>
    <a href="/contact" class="btn btn-outline-primary btn-lg">Kontak Kami</a>
  </div>
</section>

<!-- ================= FOOTER ================= -->
<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800, once: true });
</script>
</body>
</html>
