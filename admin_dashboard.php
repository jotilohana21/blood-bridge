<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

/* FETCH DONORS */
$donors = mysqli_query($conn, "SELECT * FROM users WHERE role='donor'");

/* FETCH REQUESTS (TABLE) */
$requests = mysqli_query($conn, "SELECT * FROM blood_requests");

/* FETCH REQUESTS (COUNT for stats) */
$requestsCount = mysqli_query($conn, "SELECT * FROM blood_requests");

/* FETCH INVENTORY */
$inventory = mysqli_query($conn, "SELECT * FROM blood_inventory");

/* FETCH CONTACT MESSAGES */
$messages = mysqli_query($conn, "SELECT * FROM contact_messages ORDER BY id DESC");

/* UNREAD COUNT (for badge) */
$unreadCount = mysqli_query($conn, "SELECT * FROM contact_messages WHERE status='Unread'");

/* FETCH LATEST NOTIFICATIONS */
$notifications = mysqli_query($conn,
  "SELECT * FROM notifications
   WHERE user_role='admin'
   ORDER BY id DESC
   LIMIT 6"
);

$unreadNotifCount = mysqli_query($conn,
  "SELECT id FROM notifications
   WHERE user_role='admin'
   AND status='Unread'"
);

/* FETCH EMERGENCY REQUESTS */
$emergencyRequests = mysqli_query($conn,
  "SELECT er.*, u.email
   FROM emergency_requests er
   JOIN users u ON er.user_id = u.id
   ORDER BY er.created_at DESC"
);

/* DONORS READY FOR EMERGENCY */
$donorReady = mysqli_query($conn, 
" SELECT er.*, 
         d.full_name AS donor_name, 
         d.email AS donor_email,
         d.phone AS donor_phone,
         d.blood_group AS donor_blood_group
  FROM emergency_requests er
  JOIN users d ON er.donor_id = d.id
  WHERE er.donor_status='Accepted'
  AND er.donor_id IS NOT NULL
");

/* CONFIRMED DONORS */
$confirmedDonors = mysqli_query($conn,
"SELECT er.*, 
        d.full_name AS donor_name, 
        d.email AS donor_email,
        d.phone AS donor_phone,
        d.blood_group AS donor_blood_group
 FROM emergency_requests er
 JOIN users d ON er.donor_id = d.id
 WHERE er.donor_status='Confirmed'
");

?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard | Blood Bridge</title>

    <!-- FONT AWESOME FIRST -->
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="admin-dashboard.css">
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2 class="logo">Blood Bridge</h2>

    <a class="active"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
    <a href="#donors"><i class="fa-solid fa-users"></i> Donors</a>
    <a href="#requests"><i class="fa-solid fa-hand-holding-medical"></i> Requests</a>
    <a href="#inventory"><i class="fa-solid fa-droplet"></i> Inventory</a>
    <a href="#messages">
    <i class="fa-solid fa-envelope"></i>
    Messages
    <span class="badge-count"><?= mysqli_num_rows($unreadCount); ?></span>
    </a>


    <a href="logout.php" class="logout">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>
</div>

<!-- MAIN -->
<div class="main">

<!-- TOP BAR -->
<div class="topbar">
    <h1>Admin Dashboard</h1>

    <div class="profile">
        <div class="notification">

  <i class="fa-solid fa-bell" id="notifBell"></i>

  <?php if(mysqli_num_rows($unreadNotifCount) > 0){ ?>
  <span class="notif-dot"></span>
<?php } ?>

  <!-- DROPDOWN -->
  <div class="notif-dropdown" id="notifDropdown">

    <h4>Notifications</h4>

    <?php while($n = mysqli_fetch_assoc($notifications)){ ?>
      <a href="mark_notification.php?id=<?= $n['id']; ?>"
         class="notif-item <?= $n['status']=='Unread' ? 'unread' : '' ?>">

        <i class="fa-solid fa-circle-info"></i>

        <div>
          <p><?= $n['message']; ?></p>
          <small><?= date('d M, h:i A', strtotime($n['created_at'])); ?></small>
        </div>

      </a>
    <?php } ?>

    <?php if(mysqli_num_rows($notifications)==0){ ?>
      <p class="empty">No notifications</p>
    <?php } ?>

  </div>
</div>

        <span><?php echo $_SESSION['user_name']; ?></span>
        <img src="Images/avatar.png">
    </div>
</div>

<!-- STATS -->
<div class="stats">

    <div class="card">
        <i class="fa-solid fa-users stat-icon"></i>
        <p>Total Donors</p>
        <h3><?php echo mysqli_num_rows($donors); ?></h3>
    </div>

    <div class="card">
        <i class="fa-solid fa-envelope-open-text stat-icon"></i>
        <p>Requests</p>
        <h3><?php echo mysqli_num_rows($requestsCount); ?></h3>
    </div>

    <div class="card">
        <i class="fa-solid fa-droplet stat-icon"></i>
        <p>Blood Types</p>
        <h3><?php echo mysqli_num_rows($inventory); ?></h3>
    </div>

</div>

<!-- DONORS TABLE -->
<div class="section">

    <div class="section-header">
        <h2>Registered Donors</h2>
        <a href="add_donor.php" class="btn">
            <i class="fa fa-plus"></i> Add Donor
        </a>
    </div>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Blood</th>
            <th>Action</th>
        </tr>

        <?php while($d = mysqli_fetch_assoc($donors)) { ?>
        <tr>
            <td><?= $d['full_name'] ?></td>
            <td><?= $d['email'] ?></td>
            <td><span class="badge"><?= $d['blood_group'] ?></span></td>
            <td class="actions">
                <a href="edit_donor.php?id=<?= $d['id'] ?>">
                  <i class="fa fa-pen"></i>
                </a>

                <a href="delete_donor.php?id=<?= $d['id'] ?>"
                   onclick="return confirm('Are you sure?')">
                   <i class="fa fa-trash"></i>
                </a>

            </td>
        </tr>
        <?php } ?>
    </table>

</div>

<!-- REQUESTS -->
<div class="section">
    <h2>Blood Requests</h2>

    <table>
        <tr>
            <th>Patient</th>
            <th>Blood</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while($r = mysqli_fetch_assoc($requests)) { ?>
        <tr>
            <td><?= $r['patient_name']; ?></td>
            <td><?= $r['blood_group']; ?></td>

            <!-- STATUS -->
            <td>
                <span class="status <?= ucfirst(strtolower($r['status'])) ?>">
                    <?= ucfirst($r['status']); ?>
                </span>
            </td>

            <!-- ACTION ICONS -->
            <td class="actions">
              <?php if($r['status'] == 'Pending'){ ?>
                <a href="approve_request.php?id=<?= $r['id']; ?>" class="approve">
                    <i class="fa-solid fa-circle-check"></i>
                </a>

                <a href="reject_request.php?id=<?= $r['id']; ?>" class="delete">
                    <i class="fa-solid fa-circle-xmark"></i>
                </a>
            <?php } else { ?>
              <i class="fa-solid fa-circle-check disabled"></i>
              <i class="fa-solid fa-circle-xmark disabled"></i>
            <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>


<div class="section">
  <h2>🚨 Emergency Blood Requests</h2>

  <table>
    <tr>
      <th>Requester Email</th>
      <th>Blood</th>
      <th>Units</th>
      <th>Hospital</th>
      <th>Status</th>
      <th>Action</th>
    </tr>

    <?php while($e = mysqli_fetch_assoc($emergencyRequests)){ ?>
    <tr class="emergency-row">
      <td><?= $e['email']; ?></td>
      <td><?= $e['blood_group']; ?></td>
      <td><?= $e['units']; ?></td>
      <td><?= $e['hospital']; ?></td>

      <td>
        <span class="status <?= $e['status']; ?>">
          <?= $e['status']; ?>
        </span>
      </td>

      <td class="actions">
        <?php if($e['status']=='Pending'){ ?>
          <a href="approve_emergency.php?id=<?= $e['id']; ?>" class="approve">
            <i class="fa-solid fa-circle-check"></i>
          </a>

          <a href="reject_emergency.php?id=<?= $e['id']; ?>" class="delete">
            <i class="fa-solid fa-circle-xmark"></i>
          </a>
        <?php } else { ?>
          <i class="fa-solid fa-circle-check disabled"></i>
          <i class="fa-solid fa-circle-xmark disabled"></i>
        <?php } ?>
      </td>
    </tr>
    <?php } ?>
  </table>
</div>

<div class="section">
  <h2 class="ready-title">🩸 Donors Ready to Donate</h2>

  <table class="ready-table">
    <tr>
      <th>Donor Name</th>
      <th>Email</th>
      <th>Blood Group</th>
      <th>Phone</th>
      <th>Hospital</th>
      <th>Action</th>
    </tr>

    <?php while($dr = mysqli_fetch_assoc($donorReady)){ ?>
    <tr class="ready-row">
      <td><?= $dr['donor_name']; ?></td>
      <td><?= $dr['donor_email']; ?></td>
      <td><?= $dr['blood_group']; ?></td>
      <td><?= $dr['donor_phone']; ?></td>
      <td><?= $dr['hospital']; ?></td>

      <td>
      <a href="confirm_donor.php?id=<?= $dr['id']; ?>" class="confirm-btn">
      <i class="fa-solid fa-circle-check"></i> Confirm
      </a>

        <a href="notify_requester.php?id=<?= $dr['id']; ?>" class="notify-btn">
          <i class="fa-solid fa-paper-plane"></i> Notify Requester
        </a>
      </td>
    </tr>
    <?php } ?>

    <?php if(mysqli_num_rows($donorReady)==0){ ?>
      <tr>
        <td colspan="5" class="empty">No donors available yet</td>
      </tr>
    <?php } ?>
  </table>
</div>

<div class="section">
  <h2 class="ready-title">✅ Confirmed Donors</h2>

  <table class="ready-table">
    <tr>
      <th>Donor Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Blood Group</th>
      <th>Hospital</th>
      <th>Status</th>
    </tr>

    <?php while($cd = mysqli_fetch_assoc($confirmedDonors)){ ?>
    <tr class="ready-row">
      <td><?= $cd['donor_name']; ?></td>
      <td><?= $cd['donor_email']; ?></td>
      <td><?= $cd['donor_phone']; ?></td>
      <td><?= $cd['donor_blood_group']; ?></td>
      <td><?= $cd['hospital']; ?></td>
      <td><span class="status Approved">Confirmed</span></td>
    </tr>
    <?php } ?>

    <?php if(mysqli_num_rows($confirmedDonors) == 0){ ?>
      <tr>
        <td colspan="6" class="empty">No confirmed donors yet</td>
      </tr>
    <?php } ?>
  </table>
</div>

<!-- INVENTORY -->
<div class="section">

    <div class="section-header">
        <h2>Blood Inventory</h2>
        <a href="add_inventory.php" class="btn">
            <i class="fa fa-plus"></i> Add Units
        </a>
    </div>

    <div class="inventory">
    <?php while($i = mysqli_fetch_assoc($inventory)) { ?>
        <div class="blood-card">

            <!-- EDIT / DELETE -->
            <div class="card-actions">
                <a href="edit_inventory.php?id=<?= $i['id']; ?>" class="edit">
                    <i class="fa-solid fa-pen"></i>
                </a>

                <a href="delete_inventory.php?id=<?= $i['id']; ?>"
                   class="delete"
                   onclick="return confirm('Delete this blood group?')">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </div>

            <i class="fa-solid fa-droplet"></i>
            <h3><?= $i['blood_group']; ?></h3>
            <p><?= $i['units']; ?> Units</p>
        </div>
    <?php } ?>
    </div>

</div>

 <!-- CONTACT MESSAGES -->
<div class="section" id="messages">

  <h2>Contact Messages</h2>

  <table class="messages-table">
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Message</th>
      <th>Status</th>
      <th>Action</th>
    </tr>

    <?php while($m = mysqli_fetch_assoc($messages)) { ?>
    <tr class="<?= $m['status']=='Unread' ? 'unread-row' : '' ?>">

      <td><?= $m['name']; ?></td>
      <td><?= $m['email']; ?></td>
      <td><?= substr($m['message'],0,40); ?>...</td>

      <td>
        <span class="msg-status <?= strtolower($m['status']); ?>">
          <?= $m['status']; ?>
        </span>
      </td>

      <td class="actions">
        <a href="mark_read.php?id=<?= $m['id']; ?>" class="read">
          <i class="fa-solid fa-eye"></i>
        </a>

        <a href="delete_message.php?id=<?= $m['id']; ?>" class="delete"
           onclick="return confirm('Delete message?')">
          <i class="fa-solid fa-trash"></i>
        </a>
      </td>

    </tr>
    <?php } ?>
  </table>

</div>

</div>

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

