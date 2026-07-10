<?php
session_start();

include 'db.php'; // database connection

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'donor') {
    header("Location: login.php");
    exit();
}

$donor_id = $_SESSION['user_id'];

$donationCount = mysqli_num_rows(mysqli_query($conn,
    "SELECT id FROM emergency_requests 
     WHERE donor_id='$donor_id' AND donor_status='Confirmed'"
));

/* Donor ka blood group */
$donorQuery = mysqli_query($conn, 
"SELECT blood_group, availability FROM users WHERE id='$donor_id'
");

$donorData = mysqli_fetch_assoc($donorQuery);

$donor_blood = $donorData['blood_group'];
$donor_availability = $donorData['availability'];

$emergencyQuery = mysqli_query($conn, 
"SELECT * FROM emergency_requests
 WHERE blood_group='$donor_blood'
 AND status='Pending'
 AND is_emergency=1
 AND donor_id IS NULL
");

$acceptedQuery = mysqli_query($conn,
"SELECT * FROM emergency_requests
 WHERE donor_id='$donor_id'
 AND donor_status='Accepted'
 LIMIT 1
");

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Donor Dashboard | Blood Bridge</title>

<link rel="stylesheet" href="donor-dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<div class="donor-dashboard">

  <!-- SIDEBAR -->
  <aside class="donor-sidebar">
    <h2 class="brand">Blood Bridge</h2>

    <ul class="nav-menu">
      <li class="active"><i class="fa-solid fa-house"></i> Dashboard</li>
      <li><i class="fa-solid fa-hand-holding-droplet"></i> Requests</li>
      <li><i class="fa-solid fa-calendar-check"></i> Donations</li>
      <li><i class="fa-solid fa-user"></i> Profile</li>
      <li><i class="fa-solid fa-gear"></i> Settings</li>
    </ul>

    <a href="logout.php" class="logout-btn">
      <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>
  </aside>

  <!-- MAIN -->
  <main class="donor-main">

    <!-- TOP -->
    <header class="donor-top">

  <div class="welcome-text">
    <h1>Hello, <?= htmlspecialchars($_SESSION['user_name']); ?> 👋</h1>
    <p>Your contribution saves lives</p>
  </div>

  <div class="top-actions">
    <div class="search-box">
      <i class="fa fa-search"></i>
      <input type="text" placeholder="Search requests">
    </div>

    <img src="images/avatar.png" class="avatar" alt="User Avatar">

    <div class="availability-toggle">
    <span>Status:</span>
    <button class="toggle active">Available</button>
    </div>

    <div class="notification">
    <i class="fa-solid fa-bell"></i>
    <span class="dot"></span>
    </div>


  </div>

</header>


    <!-- STATS -->
    <section class="donor-stats">
      <div class="stat">
        <i class="fa-solid fa-droplet"></i>
        <h3><?= $donationCount; ?></h3>
        <p>Total Donations</p>
      </div>

      <div class="stat">
        <i class="fa-solid fa-heart-pulse"></i>
        <h3><?= $donationCount * 1; ?></h3>
        <p>Lives Saved</p>
      </div>

      <div class="stat">
        <i class="fa-solid fa-calendar"></i>
        <h3>12 Aug</h3>
        <p>Last Donation</p>
      </div>

      <div class="stat highlight">
        <i class="fa-solid fa-award"></i>
        <h3>Gold</h3>
        <p>Donor Level</p>
     </div>

    </section>

    <!-- EMERGENCY ALERT -->
<?php if(mysqli_num_rows($acceptedQuery) > 0){ 
$acc = mysqli_fetch_assoc($acceptedQuery);
?>

<!-- SUCCESS CARD -->
<div class="success-card">
  <i class="fa-solid fa-circle-check"></i>
  <h3>You have accepted an emergency request</h3>
  <p>Please wait while admin contacts the requester.</p>
</div>

<?php } elseif(mysqli_num_rows($emergencyQuery) > 0 && $donor_availability=='available'){ 
$em = mysqli_fetch_assoc($emergencyQuery);
?>

<!-- EMERGENCY ALERT -->
<section class="emergency-alert">
  <div class="alert-icon">
    <i class="fa-solid fa-triangle-exclamation"></i>
  </div>

  <div class="alert-text">
    <h3>Emergency Blood Needed</h3>
    <p>
      <strong><?= $em['blood_group']; ?></strong>
      <?= $em['hospital']; ?> • Emergency
    </p>
  </div>

  <div class="alert-actions">
    <a href="donor_accept_emergency.php?id=<?= $em['id']; ?>" class="accept-btn">
      <i class="fa-solid fa-circle-check"></i>
    </a>

    <a href="decline_request.php?id=<?= $em['id']; ?>" class="decline">Decline</a>
  </div>
</section>

<!-- WHY ALERT -->
<section class="donor-info-card premium">
  <div class="info-icon">
    <i class="fa-solid fa-droplet"></i>
  </div>

  <div class="info-text">
    <h3>Why you received this alert</h3>
    <p>
      Your blood group <strong><?= $donor_blood ?></strong> matches
      an emergency blood request.
    </p>
  </div>
</section>

<!-- EMERGENCY DETAILS -->
<section class="emergency-details">
  <h2>Emergency Request Details</h2>

  <div class="details-grid">
    <div class="detail-box">
      <i class="fa-solid fa-hospital"></i>
      <p>Hospital</p>
      <strong><?= $em['hospital']; ?></strong>
    </div>

    <div class="detail-box urgent">
      <i class="fa-solid fa-triangle-exclamation"></i>
      <p>Priority</p>
      <strong>Emergency</strong>
    </div>
  </div>
</section>

<?php } ?>


    <!-- QUICK ACTIONS -->
    <section class="quick-actions">
      <div class="action">
        <i class="fa-solid fa-toggle-on"></i>
        <p>Update Availability</p>
      </div>

      <div class="action">
        <i class="fa-solid fa-location-dot"></i>
        <p>Update Location</p>
      </div>

      <div class="action">
        <i class="fa-solid fa-clock"></i>
        <p>Donation History</p>
      </div>
    </section>

  </main>

</div>

</body>
</html>
