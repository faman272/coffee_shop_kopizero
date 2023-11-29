function menu(menuId) {
    const selectedMenu = menu.find(menuId);
    console.log(selectedMenu);
    // Create the content of the Swal modal based on the selected menu item
    const modalContent = `
        <div style="display: flex;">
            <img src="${selectedMenu.gambar}" alt="Image" style="width: 200px;">
            <fieldset>
                <div class="radio-item-container">
                    <div class="radio-item">
                        <label for="hot">
                            <input type="radio" id="hot" name="flavor" value="hot">
                            <span>Hot (${selectedMenu.H_Hot})</span>
                        </label>
                    </div>
                    <div class="radio-item">
                        <label for="chocolate">
                            <input type="radio" id="chocolate" name="flavor" value="ice">
                            <span>Ice (${selectedMenu.H_Ice})</span>
                        </label>
                    </div>
                </div>
                <div class="quantity-container">
                    <label for="quantity">Qty:</label>
                    <input type="number" id="quantity" name="quantity" min="1" value="1">
                </div>
            </fieldset>
        </div>
    `;

    // Display the Swal modal with the selected menu item's details
    Swal.fire({
        title: selectedMenu.nama_menu,
        width: 600,
        imageAlt: "Custom image",
        animation: true,
        html: modalContent,
        showCancelButton: true,
        confirmButtonText: "Tambah",
        confirmButtonColor: "#C3AE89",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Success!",
                text: "Pesanan anda berhasil ditambahkan",
                confirmButtonColor: "#C3AE89",
                icon: "success"
            });
        }
    });
}
