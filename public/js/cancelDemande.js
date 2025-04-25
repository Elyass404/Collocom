// const CancelButtons = document.querySelectorAll(".cancel_demande_button");
// CancelButtons.forEach(button=>{
//     button.addEventListener('click',(e)=>{
//         let idOffer = e.target.id;
//         // console.log(`/offers/${idOffer}/cancel_demande`)
//         $.ajax({
//             url: `/offers/${idOffer}/cancel_demande`,
//             type: "GET",
//             success: function(response) {
//                 Swal.fire({
//                     title: response.success,
//                     icon: "success",
//                     draggable: true
//                 });
//             },
//             error: function(error) {
//                 Swal.fire({
//                     title: error.error,
//                     icon: "error",
//                     draggable: true
//                 });
//             }
//         });
//     document.getElementById(idOffer).classList.replace("cancel_demande_button", "ask_to_join_button");
//     document.getElementById(idOffer).classList.replace("bg-red-500","bg-indigo-600");
//     document.getElementById(idOffer).classList.replace("hover:bg-red-600","hover:bg-indigo-700");
//     document.getElementById(idOffer).textContent = ('Ask to Join');
    
//     })
// })


document.addEventListener('click', (e) => {
if (e.target.classList.contains("cancel_demande_button")) {
    let idOffer = e.target.id;

    $.ajax({
        url: `/offers/${idOffer}/cancel_demande`,
        type: "GET",
        success: function(response) {
            Swal.fire({
                title: response.success,
                icon: "success",
                draggable: true
            });

            // Change button back to "Ask to Join"
            e.target.classList.replace("cancel_demande_button", "ask_to_join_button");
            e.target.classList.replace("bg-red-500", "bg-indigo-600");
            e.target.classList.replace("hover:bg-red-600", "hover:bg-indigo-700");
            e.target.textContent = "Ask to Join";
        },
        error: function(error) {
            Swal.fire({
                title: error.responseJSON?.error || "Something went wrong!",
                icon: "error",
                draggable: true
            });
        }
    });
}
});