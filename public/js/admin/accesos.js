function grantAccess(userID)
{
    const formToken = $("meta[name='csrf-token']").attr("content");
    $.ajax({
       url: './userAccess',
       type: 'POST',
       data: {
           '_token': formToken,
           user_id: userID,
       },
       success: function(data){
            Swal.fire({
                title: 'Acceso otorgado correctamente!',
                icon: 'success'
            });
            loadingDT(data);

        }
    });

}

function revokeAccess(userID)
{
    const formToken = $("meta[name='csrf-token']").attr("content");

    $('#form_userAccess').attr('method', 'DELETE');
    $.ajax({
       url: './userAccess/'+ userID,
       type: 'DELETE',
       data: {
           '_token': formToken,
           user_id: userID,
       },
       success: function(data){
            Swal.fire({
                title: 'El acceso ha sido revocado correctamente!',
                icon: 'success'
            });
            loadingDT(data);
        }
    });
}

function loadingDT(data){
    document.querySelector('#userAccess_Tbody').innerHTML = data;
}
