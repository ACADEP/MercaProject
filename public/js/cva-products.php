
 
 <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script>
        var brands=[];
        $.ajax({
                url: '/getBrands',
                method: 'get',
                success: function(brands){
                     index=0;
                    update(index);
            
                    function update(i)
                    {
                        $.ajax({
                            url: '/update/products',
                            method: 'get',
                            data: {brand_id : brands[i]},
                            success: function(response){
                                console.log(response);
                                index++;
                                if(index<brands.length)
                                {
                                    update(index);
                                }
                            },
                            error: function(response){
                                alert("Intente de nuevo");
                            }
                        });
            
                    }
                  
                },
                error: function(response){
                    alert("Intente de nuevo");
                }
            });
       
</script>
