<?php
// Include database connection file
include 'koneksi.php';

// Initialize message
$message = "";

// Process Add, Update, and Delete
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_inventory = $_POST['id_inventory'];
    $kuantitas_stok = $_POST['kuantitas_stok'] ?? null;

    // Input validation
    if (empty($id_inventory) || !is_numeric($kuantitas_stok)) {
        $message = "Invalid input.";
    } else {
        try {
            if (isset($_POST['submit'])) {
                // Prepare Insert Statement
                $stmt = $conn->prepare("INSERT INTO inventory (id_inventory, kuantitas_stok) VALUES (?, ?)");
                $stmt->bind_param("si", $id_inventory, $kuantitas_stok);
                $stmt->execute();
                $message = "Data inventory berhasil ditambahkan.";
            } elseif (isset($_POST['update'])) {
                // Prepare Update Statement
                $stmt = $conn->prepare("UPDATE inventory SET kuantitas_stok=? WHERE id_inventory=?");
                $stmt->bind_param("is", $kuantitas_stok, $id_inventory);
                $stmt->execute();
                $message = "Data inventory berhasil diupdate.";
            } elseif (isset($_POST['delete'])) {
                // Prepare Delete Statement
                $stmt = $conn->prepare("DELETE FROM inventory WHERE id_inventory=?");
                $stmt->bind_param("s", $id_inventory);
                $stmt->execute();
                $message = "Data inventory berhasil dihapus.";
            }
        } catch (Exception $e) {
            $message = "An error occurred. Please try again later.";
            // Log error: error_log($e->getMessage());
        } finally {
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Inventory</title>
    <link rel="stylesheet" href="Dasboard.css"> <!-- Adjust according to your CSS file -->
    <style>
        /* Styles omitted for brevity */
    </style>
</head>
<body>
    <div class="main-content">
        <header>Data Inventory</header>

        <!-- Display Message -->
        <?php if(!empty($message)): ?>
            <div class="message">
                <?= htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <!-- Form for Adding Inventory -->
        <div class="form-container">
            <h2>Tambah Data Inventory</h2>
            <form action="inventory.php" method="POST">
                <div class="form-group">
                    <label for="id_inventory">ID Inventory</label>
                    <input type="text" id="id_inventory" name="id_inventory" required>
                </div>
                <div class="form-group">
                    <label for="kuantitas_stok">Stok</label>
                    <input type="number" id="kuantitas_stok" name="kuantitas_stok" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit">Tambah Inventory</button>
                </div>
            </form>
        </div>

        <!-- Table for Inventory Data -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID Inventory</th>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Kuantitas Stok</th>
                        <th>Lokasi Gudang</th>
                        <th>Serial Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mengambil data dari tabel inventory
                    $sql = "SELECT * FROM inventory";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0):
                        while($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id_inventory']); ?></td>
                        <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                        <td><?= htmlspecialchars($row['jenis_barang']); ?></td>
                        <td>
                            <?= htmlspecialchars($row['kuantitas_stok']); ?>
                            <?php if ($row['kuantitas_stok'] < 5): ?>
                                <span style="color: red; font-weight: bold;">(Stok Menipis)</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['lokasi_gudang']); ?></td>
                        <td><?= htmlspecialchars($row['serial_number']); ?></td>
                        <td>
                            <div class="action-buttons">
                                <button type="button" class="edit-button" onclick="openEditModal('<?= htmlspecialchars($row['id_inventory']); ?>', '<?= htmlspecialchars($row['kuantitas_stok']); ?>')">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="inventory.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    <input type="hidden" name="id_inventory" value="<?= htmlspecialchars($row['id_inventory']); ?>">
                                    <button type="submit" name="delete" class="delete-button">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php
                        endwhile;
                    else:
                    ?>
                    <tr>
                        <td colspan="7">Tidak ada data inventory ditemukan.</td>
                    </tr>
                    <?php
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" style="display: none;">
        <div style="position: fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5);">
            <div style="background-color: #fff; width: 500px; margin: 100px auto; padding: 30px; border-radius: 6px; position: relative;">
                <h2>Edit Data Inventory</h2>
                <form action="inventory.php" method="POST">
                    <div class="form-group">
                        <label for="edit_id_inventory">ID Inventory</label>
                        <input type="text" id="edit_id_inventory" name="id_inventory" readonly>
                    </div>
                    <div class="form-group">
                        <label for="edit_kuantitas_stok">Stok</label>
                        <input type="number" id="edit_kuantitas_stok" name="kuantitas_stok" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="update">Update Inventory</button>
                        <button type="button" onclick="closeEditModal()" style="background-color: #6c757d; margin-left: 10px;">Batal</button>
                    </div>
                </form>
                <span onclick="closeEditModal()" style="position: absolute; top: 10px; right: 20px; cursor: pointer; font-size: 24px;">&times;</span>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal -->
    <script>
        function openEditModal(id, quantity) {
            document.getElementById('edit_id_inventory').value = id;
            document.getElementById('edit_kuantitas_stok').value = quantity;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>

</body>
</html>
