//WARNING THIS SCRIPT DOES NOT WORK AS INTENDED FOR WHATEVER REASON (in users index.php)

console.log('delete_confirmation.js is loaded');
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const firstName = this.getAttribute('data-firstname');
            const lastName = this.getAttribute('data-lastname');

            if (!confirm(`Are you sure you want to delete ${firstName} ${lastName}?`)) {
                console.log('cancel button clicked');
                event.preventDefault();
                debugger;
            } else {
                if (!confirm(`This action will permanently delete ${firstName} ${lastName}. Are you sure?`)) {
                    console.log('cancel button clicked');
                    event.preventDefault();
                    debugger;

                } else {
                    debugger;
                    // User confirmed the second dialog, allow the deletion
                }
            }
        });
    });
});
