
const buttons = document.querySelectorAll(".ask_to_join_button");
buttons.forEach(button=>{
    button.addEventListener('click',(e)=>{
        let idOffer = e.target.id;
        // console.log(`/offers/${idOffer}/ask_to_join`)
        $.ajax({
            url: `/offers/${idOffer}/ask_to_join`,
            type: "GET",
            success: function(response) {
                Swal.fire({
                    title: response.success,
                    icon: "success",
                    draggable: true
                });
            },
            error: function(error) {
                Swal.fire({
                    title: error.success,
                    icon: "error",
                    draggable: true
                });
            }
        });
    })
})


