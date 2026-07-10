<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'requester') {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

$totalReq   = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM blood_requests WHERE email='$email'"));
$pendingReq = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM blood_requests WHERE email='$email' AND status='Pending'"));
$doneReq    = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM blood_requests WHERE email='$email' AND status='Approved'"));

/* FETCH MY REQUESTS */
$myRequests = mysqli_query($conn,
   "SELECT * FROM blood_requests
    WHERE email='$email'
    ORDER BY id DESC"
);

/* FETCH NOTIFICATIONS */
$notifications = mysqli_query($conn,
  "SELECT * FROM notifications
   WHERE user_role='requester'
   AND email='$email'
   ORDER BY id DESC"
);

/* 🔴 FETCH MY EMERGENCY REQUESTS */
$myEmergency = mysqli_query($conn,
  "SELECT * FROM emergency_requests
   WHERE user_id = '{$_SESSION['user_id']}'
   ORDER BY id DESC"
);

/* UNREAD COUNT */
$notifCount = mysqli_num_rows(
  mysqli_query($conn,
    "SELECT id FROM notifications
     WHERE user_role='requester'
     AND email='$email'
     AND status='Unread'"
  )
);

/* FETCH MATCHED DONOR (ONLY AFTER ADMIN CONFIRM) */
$matchedDonor = mysqli_query($conn, 
"SELECT 
  er.hospital,
  u.full_name,
  u.blood_group,
  u.phone,
  u.email AS donor_email
FROM emergency_requests er
JOIN users u ON er.donor_id = u.id
WHERE er.user_id='{$_SESSION['user_id']}'
AND er.status='Accepted'
AND er.donor_status='Confirmed'
LIMIT 1"
);

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Requester Dashboard | Blood Bridge</title>

<link rel="stylesheet" href="requester-dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<div class="dashboard">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <h2 class="brand">Blood Bridge</h2>

    <ul class="menu">
      <li class="active"><i class="fa-solid fa-gauge"></i> Dashboard</li>
      <li><i class="fa-solid fa-droplet"></i> My Requests</li>
      <li><i class="fa-solid fa-clock-rotate-left"></i> History</li>
      <li><i class="fa-solid fa-bell"></i> Notifications</li>
      <li><i class="fa-solid fa-gear"></i> Settings</li>
    </ul>

    <a href="logout.php" class="logout-btn">
      <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main-content">

    <!-- TOP BAR -->
    <header class="topbar">
      <div>
        <h1>Welcome Back, <?= htmlspecialchars($_SESSION['user_name']); ?> 👋</h1>
        <p>Manage your blood requests easily</p>
      </div>

      <div class="top-actions">
        <div class="search-box">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" placeholder="Search request">
        </div>
        <div class="notification">
  <i class="fa-solid fa-bell" id="notifBell"></i>

   <?php if($notifCount > 0){ ?>
    <span class="notif-count"><?= $notifCount; ?></span>
   <?php } ?>

  <div class="notif-dropdown" id="notifDropdown">
    <h4>Notifications</h4>

    <?php if(mysqli_num_rows($notifications) > 0){ ?>
      <?php while($n = mysqli_fetch_assoc($notifications)){ ?>
        <div class="notif-item <?= $n['status']=='Unread' ? 'unread' : '' ?>">
          <p><?= $n['message']; ?></p>
          <small><?= date('d M h:i A', strtotime($n['created_at'])); ?></small>
        </div>
      <?php } ?>
    <?php } else { ?>
      <p class="empty">No notifications</p>
    <?php } ?>
  </div>
</div>
      </div>
    </header>

       <!-- DONOR READY MESSAGE -->

    <!-- STATS -->
    <section class="stats">
      <div class="stat-card">
        <i class="fa-solid fa-droplet"></i>
        <h3><?= $totalReq; ?></h3>
        <p>Total Requests</p>
      </div>

      <div class="stat-card">
        <i class="fa-solid fa-hourglass-half"></i>
        <h3><?= $pendingReq; ?></h3>
        <p>Pending</p>
      </div>

      <div class="stat-card">
        <i class="fa-solid fa-circle-check"></i>
        <h3><?= $doneReq; ?></h3>
        <p>Completed</p>
      </div>
    </section>

    <!-- ACTIVE REQUESTS -->
    <section class="card-section">
      <h2>Active Blood Requests</h2>

      <table>
        <tr>
          <th>Patient Name</th>
          <th>Email</th>
          <th>Blood Group</th>
          <th>Status</th>
        </tr>

        <?php while($r = mysqli_fetch_assoc($myRequests)) { ?>
<tr>
  <td><?= $r['patient_name']; ?></td>
  <td><?= $r['email']; ?></td>
  <td><?= $r['blood_group']; ?></td>

  <td class="<?= strtolower($r['status']); ?>">
    <?= $r['status']; ?>
  </td>
</tr>
<?php } ?>

<?php if(mysqli_num_rows($myRequests) == 0){ ?>
<tr>
  <td colspan="4" style="text-align:center;">No Requests Found</td>
</tr>
<?php } ?>

      </table>
    </section>

    <section class="card-section">
  <h2>🚑 My Emergency Requests</h2>

  <table>
    <tr>
      <th>Blood</th>
      <th>Units</th>
      <th>Hospital</th>
      <th>Donor Status</th>
    </tr>

    <?php while($e = mysqli_fetch_assoc($myEmergency)){ ?>
    <tr>
      <td><?= $e['blood_group']; ?></td>
      <td><?= $e['units']; ?></td>
      <td><?= $e['hospital']; ?></td>

      <td class="donor-status <?= strtolower($e['donor_status']); ?>">
       <?= $e['donor_status']; ?>
     </td>

    </tr>
    <?php } ?>

    <?php if(mysqli_num_rows($myEmergency)==0){ ?>
    <tr>
      <td colspan="4" style="text-align:center;">
        No emergency requests yet
      </td>
    </tr>
    <?php } ?>
  </table>
</section>

<?php if(mysqli_num_rows($matchedDonor) > 0){
$d = mysqli_fetch_assoc($matchedDonor);
?>
<section class="donor-match-card animate-fade">
  <div class="match-header">
    <i class="fa-solid fa-heart-pulse"></i>
    <h2>Donor Matched Successfully</h2>
    <span class="badge success">Emergency</span>
  </div>

  <div class="match-grid">
    <div>
      <p>Name</p>
      <strong><?= $d['full_name']; ?></strong>
    </div>

    <div>
      <p>Blood Group</p>
      <strong><?= $d['blood_group']; ?></strong>
    </div>

    <div>
      <p>Phone</p>
      <strong><?= $d['phone']; ?></strong>
    </div>

    <div>
      <p>Email</p>
      <strong><?= $d['donor_email']; ?></strong>
    </div>

    <div>
      <p>Hospital</p>
      <strong><?= $d['hospital']; ?></strong>
    </div>
  </div>
</section>
<?php } ?>


    <!-- EMERGENCY -->
    <section class="emergency">
      <div>
        <h2>Emergency Request</h2>
        <p>Immediate donor matching for critical cases</p>
      </div>
      
      <a href="emergency_request.php" class="emergency-btn">
          Create Emergency Request
      </a>

    </section>

  </main>

</div>

<script>
document.querySelectorAll("td.approved, td.rejected").forEach(el => {
  el.style.animation = "pulse 1s ease-in-out";
});
</script>

<script>
const bell = document.getElementById("notifBell");
const dropdown = document.getElementById("notifDropdown");

bell.addEventListener("click", () => {
  dropdown.style.display =
    dropdown.style.display === "block" ? "none" : "block";
});

document.addEventListener("click", (e) => {
  if(!bell.contains(e.target) && !dropdown.contains(e.target)){
    dropdown.style.display = "none";
  }
});
</script>

</body>
</html>

