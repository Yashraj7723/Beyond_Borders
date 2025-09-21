<?php
// index.php
require 'includes/db.php';
include 'includes/header.php';

// fetch all destinations
$dest_q = $mysqli->query("SELECT id, name, description FROM destinations ORDER BY id ASC");
$destinations = [];
while ($r = $dest_q->fetch_assoc()) { $destinations[] = $r; }

// selected id (default to first)
$selected_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($selected_id <= 0 && count($destinations) > 0) $selected_id = (int)$destinations[0]['id'];

// fetch selected destination details
$dest = null;
if ($selected_id > 0) {
    $stmt = $mysqli->prepare("SELECT id, name, description, info FROM destinations WHERE id = ?");
    $stmt->bind_param('i', $selected_id);
    $stmt->execute();
    $stmt->bind_result($did, $dname, $ddesc, $dinfo);
    if ($stmt->fetch()) {
        $dest = ['id'=>$did,'name'=>$dname,'description'=>$ddesc,'info'=>$dinfo];
    }
    $stmt->close();
}

// fetch images for selected
$images = [];
if ($dest) {
    $stmt2 = $mysqli->prepare("SELECT image_path FROM destination_images WHERE destination_id = ? ORDER BY id ASC");
    $stmt2->bind_param('i', $selected_id);
    $stmt2->execute();
    $stmt2->bind_result($imgp);
    while ($stmt2->fetch()) $images[] = $imgp;
    $stmt2->close();
}
if (empty($images)) $images[] = 'images/placeholder.jpg';

// messages from enquiry
$success = isset($_GET['success']) ? 1 : 0;
$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
?>

<!-- top-wide box showing .php instruction (matches your sketch text) -->
<!-- <div class="row">
  <div class="col-12">
    <div class="top-instruction small-text big-border p-2">
      Make the files in .php extension
    </div>
  </div>
</div> -->

<div class="row gx-3 position-relative">
  <!-- LEFT: Country Options -->
  <div class="col-md-3">
    <div id="country-options" class="country-panel big-border p-3">
      <h4>Countries</h4>

      <!-- image box inside left panel (like the sketch)
      <div class="image-box">
        <div style="text-align:center;">
          <div style="font-weight:700; font-size:1.1rem;">Images</div>
        </div>
      </div> -->

      <!-- list of destinations -->
      <?php foreach ($destinations as $d): 
          // fetch single thumbnail for each destination
          $thumb = 'images/placeholder.jpg';
          $stmt = $mysqli->prepare("SELECT image_path FROM destination_images WHERE destination_id = ? LIMIT 1");
          $stmt->bind_param('i', $d['id']);
          $stmt->execute();
          $stmt->bind_result($tpath);
          if ($stmt->fetch()) $thumb = $tpath;
          $stmt->close();
      ?>
        <a href="index.php?id=<?php echo $d['id']; ?>" class="text-decoration-none text-dark">
          <div class="destination-item">
            <img src="<?php echo htmlspecialchars($thumb); ?>" class="small-thumb" alt="thumb">
            <div>
              <div style="font-weight:700;"><?php echo htmlspecialchars($d['name']); ?></div>
              <div class="small-text">
                <?php echo htmlspecialchars(strlen($d['description']) > 50 ? substr($d['description'], 0, 50) . '...' : $d['description']);?>
              </div>

            </div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- RIGHT: Main area -->
  <div class="col-md-9 position-relative">
    <div class="main-panel big-border p-3">
      <!-- destination title -->
      <h3><?php echo $dest ? htmlspecialchars($dest['name']) : 'Select a destination'; ?></h3>

      <!-- show success / error -->
      <?php if ($success): ?>
        <div class="alert alert-success">Enquiry submitted. Thank you.</div>
      <?php endif; ?>
      <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php endif; ?>

      <!-- Bootstrap carousel -->
      <div id="destCarousel" class="carousel slide border mb-3" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php foreach ($images as $i => $img): ?>
            <div class="carousel-item <?php echo $i===0 ? 'active' : ''; ?>">
              <img src="<?php echo htmlspecialchars($img); ?>" class="d-block w-100 carousel-image" alt="slide">
            </div>
          <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#destCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#destCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
      </div>

      <!-- info area -->
      <div class="destination-info">
        <!-- <h5>All the relevant information about this destination</h5> -->
        <p><?php echo $dest ? nl2br(htmlspecialchars($dest['info'])) : 'No destination selected.'; ?></p>
      </div>

      <!-- Enquiry box (absolute positioned to overlap bottom-right of this panel) -->
      
    </div>
  </div>
  
</div>
<div class="enquiry-box">
        <h6 class="mb-2">Enquiry Form</h6>
        <form method="post" action="process_enquiry.php">
          <input type="hidden" name="destination_id" value="<?php echo $dest ? $dest['id'] : 0; ?>">
          <div class="mb-2">
            <label class="form-label small">Name</label>
            <input name="name" class="form-control form-control-sm" required>
          </div>
          <div class="mb-2">
            <label class="form-label small">Email</label>
            <input name="email" type="email" class="form-control form-control-sm" required>
          </div>
          <div class="mb-2">
            <label class="form-label small">Message</label>
            <textarea name="message" rows="3" class="form-control form-control-sm" required></textarea>
          </div>
          <button class="btn btn-sm btn-primary" type="submit">Submit button</button>
        </form>
      </div>

<?php include 'includes/footer.php'; ?>
