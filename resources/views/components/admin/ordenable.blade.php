@props(["url"])
<script type="text/javascript" src="/js/lib/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/lib/jquery-ui/jquery-ui.touch-punch.min.js"></script>
<script type="text/javascript">
    $(function(){
        $("#tabla-ordenable tbody").sortable({
            update:function(){
                array=[];
                $(this).children().each(function(i){
                    array.push($(this).children().last().html());
                });
                $.ajax({
                    url: '{{ $url }}',
                    method:'post',
                    data:{'ids':array},
                    success:function(ret){
                        if(ret.ok) {
                            orden=1;
                            $('#tabla-ordenable tbody').children().each(function(i){
                                $(this).children().first().html(orden);
                                orden+=1;
                            });
                        } else {
                            sweetAlert('Error', 'Hubo un error al actualizar el orden de los elementos, por favor intentá nuevamente.', 'error');
                        }
                    },
                    error:function(){ sweetAlert('Error', 'Hubo un error al actualizar el orden de los elementos, por favor recargá la página e intentá nuevamente.', 'error'); }
                });
            }
        });
    });
</script>