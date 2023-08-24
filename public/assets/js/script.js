// File input
function triggerFileInput() {
    document.getElementById("fileInput").click();
}

document.getElementById("fileInput").addEventListener("change", function () {
    const fileName = this.value.split("\\").pop();
    document.getElementById("myFileNameContainer").innerHTML = fileName;
});

// File edit
function triggerFileEdit() {
    document.getElementById("fileEdit").click();
}

document.getElementById("fileEdit").addEventListener("change", function () {
    const fileName = this.value.split("\\").pop();
    document.getElementById("myFileInputNameContainer").innerHTML = fileName;
});

// edit reward
function editDataReward(nama, stok, poin, route) {
    // console.log(id);
    var editNama = (document.getElementById("editNama").value = nama);
    var editStok = (document.getElementById("editStok").value = stok);
    var editPoin = (document.getElementById("editPoin").value = poin);

    var actionForms = document.querySelector("#modal-forms-edit");
    actionForms.action = route;
    console.log(actionForms);
}

// Swal.fire({
//     position: 'bottom-end',
//     title: 'Your work has been saved',
//     showConfirmButton: false,
//     timer: 3000,
//     background: 'rgba(52, 181, 58, 0.2)',
//     backdrop: false,
// })

// Sweetalert2
// Example delete function  for delete
function deleteReward(route) {
    Swal.fire({
        title: "Apakah ingin melanjutkan?",
        text: "Data selanjutnya tidak dapat direcovery",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, lanjut hapus",
        cancelButtonText: "Tidak",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            const deleteData = document.querySelector("#deleteData");
            deleteData.action = route;
            deleteData.submit();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire("Dibatalkan", "Data tidak jadi dihapus", "info");
            // Perform any additional actions if deletion is cancelled
        }
    });
}

function detailSumbangan(src) {
    let modalImage = document.getElementById("modal-image-sumbangan");

    modalImage.src = src;
}

function detailGambarReward(src) {
    let modalImage = document.getElementById("modal-image-sumbangan");

    modalImage.src = src;
    // console.log(src)
}

function updatePermintaanKontainer(href) {
    Swal.fire({
        title: "Apakah ingin melanjutkan?",
        text: "Permintaan akan diterima",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, terima permintaan",
        cancelButtonText: "Tidak",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            let updatePermintaanKontainer = document.querySelector(
                "#updatePermintaanKontainer"
            );

            updatePermintaanKontainer.action = href;
            updatePermintaanKontainer.submit();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire("Dibatalkan", "Data tidak jadi dihapus", "info");
            // Perform any additional actions if deletion is cancelled
        }
    });
}

// inputUbahGambarAdmin
function buttonUbahGambarAdmin() {
    const input = document.querySelector("#inputUbahGambarAdmin").click();
}

// Verifikasi sumbangan

function verifikasiSumbangan(route) {
    Swal.fire({
        title: 'Lanjutkan verifikasi?',
        text: "Anda tidak dapat membatalkan status kembali",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Lanjutkan verifikasi'
    }).then((result) => {
        if (result.isConfirmed) {
            const verifikasiStatusForm = document.querySelector('#verifikasiStatusForm')
            verifikasiStatusForm.action = route
            verifikasiStatusForm.submit()
        }
    })
}


function AjukanPergantianKontainer(action) {
    Swal.fire({
        title: "Apakah ingin melanjutkan?",
        text: "Pengajuan akan menunggu persetujuan admin CSR",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, lanjutkan",
        cancelButtonText: "Tidak",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            let updatePengajuanGantiKontainer = document.querySelector('#updatePengajuanGantiKontainer');
            updatePengajuanGantiKontainer.action = action;
            console.log(updatePengajuanGantiKontainer);
            updatePengajuanGantiKontainer.submit()
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire("Dibatalkan", "Pengajuan dibatalkan", "info");
            // Perform any additional actions if deletion is cancelled
        }
    });

    
}


function Logout() {
    Swal.fire({
        title: 'Apakah ingin keluar?',
        text: "Anda akan dimintai login kembali",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Logout'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    })
}

function hapusLokasi(url) {
    Swal.fire({
        title: "Apakah ingin melanjutkan?",
        text: "Data lokasi beserta turunan nya akan dihapus",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, hapus",
        cancelButtonText: "Tidak",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            let formsDeleteLokasi = document.querySelector('#formsDeleteLokasi')
            formsDeleteLokasi.action = url
            // console.log(formsDeleteLokasi);
            formsDeleteLokasi.submit();
            
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire("Dibatalkan", "Data tidak jadi dihapus", "info");
            // Perform any additional actions if deletion is cancelled
        }
    });
}