
document.getElementById('filter_company_id').addEventListener('change', function()	 {

	let companyId = this.value || this.options[this.selectedIndex].value;
	window.location.href = window.location.href.split('?')[0] + '?company_id=' + companyId;
});




document.querySelectorAll(".btn-delete").forEach((button) => {
    // sweetalert2 delete alert 
    button.addEventListener("click", function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.value) {
                let action = this.getAttribute("href");
                let form = document.getElementById("form-delete");
                form.setAttribute("action", action);
                form.submit();
            }
        }
    )});
    
});

// clear search
document.getElementById('btn-clear').addEventListener('click', () => {

    window.location.href = window.location.href.split('?')[0];
});

// function to toggle refresh button
const  toggleClearButton = () =>  {
    let clearButton = document.getElementById('btn-clear');
    if (document.getElementById('search').value.length > 0) {
        clearButton.style.display = 'block';
    } else {
        clearButton.style.display = 'none';
    }
}

toggleClearButton();
