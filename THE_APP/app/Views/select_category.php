<htm>
    <head>
        <title>Selector</title>
        <style>
        div {padding-left:2rem}
        </style>
    </head>
    <body>
    <!--
        <form>
            <div id="mainDiv">

                <select id="mainSelector" onchange="inCart()">
                    <option value="null">select Category</option>
                    <?php
                    foreach ($categories as $category){
                        ?>
                        <option value="<?php echo $category['id']; ?>" ><?php echo $category['subject']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </form>
        -->
    </body>

</htm>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var containerElement, selectorElement, categoryID = 0 ;

    getChildren(categoryID);
    
    function getChildren(categoryID, parentID=null){
        if(categoryID == null){
            return false;
        }
        $.ajax({
            url: 'parent/'+categoryID,
            type: 'post',
            dataType:'json',
            data: {id: categoryID,csrf_token: $('#csrf').val()},
            success: function (html) {
                console.log(html);

                containerElement = createContainer(categoryID);

                
                if (categoryID == "0"){
                    document.body.appendChild(containerElement);
                }else{
                    console.log(categoryID);
                    $('#'+parentID+'_div div').remove();
                    $('#'+parentID+'_div').append(containerElement);
                }

                selectorElement = creatSelect(categoryID);

                var values = (html);
                
                var option = document.createElement("option");
                    option.value = null;
                    option.text = 'Select Category ('+html.length+')';
                    selectorElement.appendChild(option);

                for (const val of values){
                    var option = document.createElement("option");
                    option.value = val['id'];
                    option.text = val['subject']
                    selectorElement.appendChild(option);
                }
                containerElement.appendChild(selectorElement);

            },

        })
    }

    function createContainer( categoryID) {

        var div = document.createElement("div");
        div.name = categoryID+"_div";
        div.id = categoryID+"_div";

        return div;

    }

    $(document).on('change','select',function(){
        parentID = $(this).closest('div').attr('id').split('_div')[0];
        getChildren($(this).val(),parentID);
    });

    function creatSelect( categoryID) {

        var select = document.createElement("select");
        select.name = categoryID+"_select";
        select.id = categoryID+"_select";
        return select;

    }


</script>
<?php

