<!-- menu.php (View file) -->
<div class="container my-5">
    <h1 class="mb-4">Menu</h1>

    <div class="row">
        <?php foreach ($child as $item): ?>
             <?php if ($item->stok !== 'Tidak tersedia'): ?> <!-- Only show items with stock available -->
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="<?= base_url('foto/' . $item->foto) ?>" class="card-img-top" alt="<?= $item->nama_barang ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= $item->nama_barang ?></h5>
                        <p class="card-text" style="overflow-y: auto; max-height: 100px;"><?= $item->deskripsi ?></p> <!-- Scrollable description -->
                        <p class="card-text"><small>Stok: <?= $item->stok ?></small></p>
                        <div class="mt-auto"> <!-- Ensures button stays at the bottom -->
                            <button class="btn btn-primary add-to-cart" 
                                data-id="<?= $item->id_barang ?>"
                                data-nama="<?= $item->nama_barang ?>"
                                data-harga="<?= $item->harga_satuan ?>"
                                data-foto="<?= $item->foto ?>"
                                data-stok="<?= $item->stok ?>"
                            >Order</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <!-- Quantity Modal -->
    <div class="modal fade" id="quantityModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Choose Quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="number" id="selectedQuantity" class="form-control" min="1" value="1">
                </div>
                <div class="modal-footer">
                    <button type="button" id="addQuantityBtn" class="btn btn-primary">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
<!-- Cart Modal -->
<div id="cartModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table" id="cartTable">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Cart items will go here -->
                    </tbody>
                </table>
                <div class="text-end">
                    <h4>Total Bayar: <span id="grandTotal">Rp 0</span></h4>
                </div>
            </div>
            <div class="modal-footer">
                <button id="checkout" class="btn btn-primary">Proceed to Transaction</button>
                <button id="clearCart" class="btn btn-danger">Clear Cart</button> <!-- Clear Cart button -->
            </div>
        </div>
    </div>
</div>

<!-- Cart Button Floating -->
<button class="btn btn-warning position-fixed bottom-0 end-0 m-4" data-bs-toggle="modal" data-bs-target="#cartModal">
    View Cart
</button>

<!-- Scripts -->
<script>
const baseUrl = '<?= base_url('foto/') ?>';
let cart = [];
let tempItem = {}; // temporary holder when opening quantity modal

function renderCart() {
    let cartTable = document.querySelector('#cartTable tbody');
    cartTable.innerHTML = '';

    let grandTotal = 0;

    cart.forEach((item, index) => {
        const row = `
        <tr>
            <td>${item.nama}</td>
            <td><input type="number" class="form-control price" data-index="${index}" value="${item.harga}"></td>
            <td><input type="number" class="form-control quantity" data-index="${index}" value="${item.jumlah}"></td>
            <td>Rp ${(item.harga * item.jumlah).toLocaleString()}</td>
            <td><button class="btn btn-danger btn-sm remove-item" data-index="${index}">Cancel</button></td>
        </tr>`;
        cartTable.innerHTML += row;
        grandTotal += item.harga * item.jumlah;
    });

    document.getElementById('grandTotal').innerText = 'Rp ' + grandTotal.toLocaleString();
}

// Open quantity modal on click Order
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', () => {
        tempItem = {
            id: button.getAttribute('data-id'),
            nama: button.getAttribute('data-nama'),
            harga: parseInt(button.getAttribute('data-harga')),
            stok: parseInt(button.getAttribute('data-stok'))
        };
        document.getElementById('selectedQuantity').value = 1;
        document.getElementById('selectedQuantity').max = tempItem.stok;
        var quantityModal = new bootstrap.Modal(document.getElementById('quantityModal'));
        quantityModal.show();
    });
});

// When user confirms quantity
document.getElementById('addQuantityBtn').addEventListener('click', () => {
    const qty = parseInt(document.getElementById('selectedQuantity').value);

    if (qty > tempItem.stok) {
        alert('Stock not enough!');
        return;
    }

    const exist = cart.find(item => item.id === tempItem.id);
    if (exist) {
        exist.jumlah += qty;
    } else {
        cart.push({
            id: tempItem.id,
            nama: tempItem.nama,
            harga: tempItem.harga,
            jumlah: qty,
        });
    }

    renderCart();
    bootstrap.Modal.getInstance(document.getElementById('quantityModal')).hide();
});

// Quantity/Price change inside cart
document.addEventListener('input', function(e) {
    if (e.target.classList.contains('price') || e.target.classList.contains('quantity')) {
        const index = e.target.getAttribute('data-index');
        const value = parseInt(e.target.value);
        if (e.target.classList.contains('price')) {
            cart[index].harga = value;
        } else {
            cart[index].jumlah = value;
        }
        renderCart();
    }
});

// Remove item
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-item')) {
        const index = e.target.getAttribute('data-index');
        cart.splice(index, 1);
        renderCart();
    }
});

// Clear Cart
document.getElementById('clearCart').addEventListener('click', () => {
    cart = [];
    renderCart();
});

// // Proceed Cart
// document.getElementById('proceedCart').addEventListener('click', function() {
//     if (cart.length === 0) {
//         alert('Cart is empty!');
//         return;
//     }

//     const confirmAction = confirm('Are you sure you want to proceed to transaction?');

//     if (confirmAction) {
//         // Redirect to the transaction page with cart details
//         const params = new URLSearchParams();
//         cart.forEach(item => {
//             params.append('id_barang[]', item.id);
//             params.append('jumlah[]', item.jumlah);
//         });

//         window.location.href = 'transaction_page.php?' + params.toString(); // Replace with your actual transaction page URL

document.getElementById('checkout').addEventListener('click', function() {
    if (confirm('Are you sure? Proceed to checkout?')) {
        fetch('<?= base_url('home/save_cart_session') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(cart) // <-- send cart data
        })
        .then(response => response.json())
        .then(data => {
            if(data.status == 'ok'){
                window.location.href = '<?= base_url('home/pesan_barang') ?>'; // Go to the checkout form
            }
        });
    }
});

</script>

<!-- Extra Styling to Make Images Nicer -->
<style>
.card-img-top {
  height: 200px;
  object-fit: cover;
}

.card-body {
  display: flex;
  flex-direction: column;
}

.card-text {
  overflow-y: auto;
  max-height: 100px; /* Make description scrollable */
}
</style>
