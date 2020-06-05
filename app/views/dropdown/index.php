<?php

echo view('html/header');?><table>
    <div style="padding-left:30px; height:710px;">

    <div id="show_sub_categories">
        <?php echo form_dropdown('options', $options, '#', 'class="options"'); ?>

    </div>
    </div>

    <script>
        $(document).ready(function(){

                $(document).on("change", "[class*='options']", function() {

                    //first of all clear select items
                    $(this).nextAll('.options').remove(); // clear all otions
                    $(this).nextAll('label').remove();//clar all label to  hint no record

                    $('#show_sub_categories').append('<img src="<?php echo base_url(); ?>/img/loader.gif" style="float:left; margin-top:7px;" id="loader" alt="" />');

                    var option = $(this).val();
                    if(option == '#'){
                        return false;
                    }

                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>/category/sub_categories/"+option,//call ajax  url

                        success: function(suboptions)
                        {

                            console.log(suboptions);
                            var encodeurl=encodeURI(suboptions);
                            setTimeout("addelement('show_sub_categories', '"+escape(suboptions)+"')", 300);

                        }

                    });

                });
            }
        );
        function addelement(id, response){
            $('#loader').remove();

            $('#'+id).append(unescape(response));
        }

    </script>
<?php echo view('html/footer');?>