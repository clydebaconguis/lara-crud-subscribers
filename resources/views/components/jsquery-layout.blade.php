<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    var table = $("#example")
        .DataTable({
            responsive: true,
        })
        .columns.adjust()
        .responsive.recalc();



    $('#addForm').on('submit', function(e){
        e.preventDefault();
        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url: url,
            data: form,
            dataType: 'json',
            success: function(data){
                $("#addForm")[0].reset();
                $("#check-notif").show();
                // alert(`${data.id} ${data.firstname} ${data.lastname}`);
                appendNewSubscriber(data)
            }
        });
    });

    $('#addProviderForm').on('submit', function(e){
        e.preventDefault();
        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url: url,
            data: form,
            dataType: 'json',
            success: function(data){
                $("#addProviderForm")[0].reset();
                $("#providerContainer")
                .append(`<div id=${data.id} class="flex justify-between items-center">
                    <h4 class="block font-sans text-base font-light leading-relaxed text-inherit antialiased">
                        ${data.provider} - ${data.phone}
                    </h4>
                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                        <a onclick="deleteProvider(${data.id})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </a>
                    </div>
                </div>`);
            }
        });
    });

    $('#delForm').on('submit', function(e){
        e.preventDefault();
        const sub_id = $("#subscriber_id").val();
        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url: url,
            data: form,
            dataType: 'json',
            success: function(data){
                alert("successfully removed");
                toggleModalDelete(0);
                var table = $('#example').DataTable();
                var row = table.row("#"+sub_id);
                row.remove().draw();
            }
        });
    });

    $("#btnToggleProvider").on('click', function(){
        toggleProvider();
    });

}); 
function deleteProvider(id){
    var url = "/delete-provider/"+id;
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        success: function(data){
            $("#"+id).remove();
        }
    });
}

function appendNewSubscriber(data){
    $("#table-body").append(`
            <tr id=${data.id} class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left">
                    <div class="flex items-center">
                        <div class="mr-2">
                            <img class="w-6 h-6 rounded-full" src="https://randomuser.me/api/portraits/men/${data.id}.jpg"/>
                        </div>
                        <span>${data.lastname}</span>
                    </div>
                </td>

                <td class="py-3 px-6 text-center">
                    <span>${data.firstname}</span>
                </td>

                <td class="py-3 px-6 text-center">
                    <span>${data.middlename}</span>
                </td>

                <td class="py-3 px-6 text-center">
                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">${data.gender}</span>
                </td>

                <td class="py-3 px-6 text-center">
                    <span>${data.address}</span>
                </td>

                <td class="py-3 px-6 text-center">
                    <div class="flex item-center justify-center">
                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                            <a href="/show/${data.id}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                        </div>
                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                            <a href="/edit/${data.id}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                        </div>
                        <div onclick="toggleModalDelete(${data.id})" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                    </div>
                </td>
            </tr>`)
}

function toggleModalDelete(id){
    $("#modal-delete").toggleClass("hidden");
    $("#subscriber_id").val(id);
}

function toggleProvider(id){
    $("#providerWrapper").toggleClass("hidden flex");
}

function showForm(){
    $("#check-notif").hide();
    $(".overlay").toggleClass("hidden");
    $("#modal").toggleClass("hidden");
}

function hideForm(){
    $("#modal").toggleClass("hidden");
    $(".overlay").toggleClass("hidden");
}
</script> 