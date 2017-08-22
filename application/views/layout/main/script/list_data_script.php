<script type="text/javascript">
$('.btn-edit').closest('a').click(function(){
    var form = $(this).closest('form');
    
    form.find('input[id="act"]').val('editinline');
    form.find('input[id="key"]').val($(this).attr('data-id'));
    
    form.submit();
    
    return false;    
});

$('.btn-save').closest('a').click(function(){
    var form = $(this).closest('form');
    
    if(!$(this).attr('data-id')) {
        form.find('input[id="act"]').val('insertinline');
        form.find('input[id="key"]').val('');    
    } else {
        form.find('input[id="act"]').val('updateinline');
        form.find('input[id="key"]').val($(this).attr('data-id'));
    }
    
    form.submit();
    
    return false;    
});

function goLimit()
{
    $('form#optiontable').submit();
}
</script>