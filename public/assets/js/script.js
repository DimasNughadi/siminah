// edit reward
function editDataReward(id, nama, stok, poin, gambar) {
    // console.log(id);
    var editNama = document.getElementById('editNama').value = nama;
    var editStok = document.getElementById('editStok').value = stok;
    var editPoin = document.getElementById('editPoin').value = poin;
    var editGambar = gambar
}



// Sweetalert2
// Example delete function  for delete
function deleteReward(recordId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this record!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Perform the delete action
            // You can make an AJAX request or redirect to a delete route
            // Example AJAX request:
            axios.delete(`/records/${recordId}`)
                .then((response) => {
                    Swal.fire(
                        'Deleted!',
                        'The record has been deleted.',
                        'success'
                    );
                    // Perform any additional actions after successful deletion
                })
                .catch((error) => {
                    Swal.fire(
                        'Error!',
                        'The record could not be deleted.',
                        'error'
                    );
                    // Handle the error or perform any additional actions
                });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelled',
                'The record deletion has been cancelled.',
                'info'
            );
            // Perform any additional actions if deletion is cancelled
        }
    });
}