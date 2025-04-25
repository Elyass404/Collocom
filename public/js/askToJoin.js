// const joinButtons = document.querySelectorAll(".ask_to_join_button");
// joinButtons.forEach(button=>{
//     button.addEventListener('click',(e)=>{
//         let idOffer = e.target.id;
//         // console.log(`/offers/${idOffer}/ask_to_join`)
//         $.ajax({
//             url: `/offers/${idOffer}/ask_to_join`,
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
//     document.getElementById(idOffer).classList.replace("ask_to_join_button","cancel_demande_button");
//     document.getElementById(idOffer).classList.replace("bg-indigo-600", "bg-red-500");
//     document.getElementById(idOffer).classList.replace("hover:bg-indigo-700","hover:bg-red-600");
//     document.getElementById(idOffer).textContent = ('Cancel Demande');
//     })
// })

document.addEventListener('click', (e) => {
    // Handle Ask to Join
    if (e.target.classList.contains("ask_to_join_button")) {
        let idOffer = e.target.id;

        $.ajax({
            url: `/offers/${idOffer}/ask_to_join`,
            type: "GET",
            success: function(response) {
                Swal.fire({
                    title: response.success,
                    icon: "success",
                    draggable: true
                });

                // Change button to "Cancel Demand"
                e.target.classList.replace("ask_to_join_button", "cancel_demande_button");
                e.target.classList.replace("bg-indigo-600", "bg-red-500");
                e.target.classList.replace("hover:bg-indigo-700", "hover:bg-red-600");
                e.target.textContent = "Cancel Demande";
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


