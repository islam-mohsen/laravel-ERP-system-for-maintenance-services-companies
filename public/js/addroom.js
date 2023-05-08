$(document).ready(function () {
    $.ajaxSetup({ cache: false });
    var urlParams = new URLSearchParams(window.location.search);
    var roomid=urlParams.get('id')
    $("#productdata").hide();
    $("#addprod").click(function (e) { 
       
        $("#productdata").show();
    });

    $("#canceled").click(function (e) { 
        $("#productdata").hide();
        $('#PartNumber').val();
  $("#partnumertarget").html('');
  $("#pronamecon").text('');
  $("#proDiscretioncon").text('');
  $("#promodelcon").text('');
  $("#protypecon").text('');
  $("#imagecard").attr("src",''); 
  $('#PartNumber').val('');
    });
    var prodectnum='';
    $("#okbtn").click(function (e) { 
        console.log(prodectnum);
        var t=0;
        t=parseInt(roomid, 10)
        var pn='';
        pn=prodectnum.toString();
        if(prodectnum){
        var q= $("#quantity").val();
      
        db.transaction(function (tx) {
            tx.executeSql(('INSERT INTO roomcontant (roomid,productid,quntaty) VALUES (?,?,?)'),[t,pn,q])
        })
        location.reload();
       // $('#roductsadded').append('<li class="prolis list-group-item list-group-item-secondary"> Unit Part Number :'+prodectnum+'<i  class=" closeli fas fa-times"></i></li>');
        prodectnum='';
        }
        $("#productdata").hide();
        
    });
    $('#roductsadded').on('click','li i',function() {  
       // e.preventDefault();
       //console.log($this)
        $(this).parent().hide(); 
        
    }); 
    var text=""; 
    /*prand */
    var arr=[]
    $("#PartNumber").keyup(function(e){
      $('#partnumertarget').html('');
              var searchField = $('#PartNumber').val()+"";
               var i=0;
             var expression = new RegExp(searchField, 'i');
              //var texts=""+expression;
             //console.log(expression)
              $.getJSON('data.json', function(data) {
                arr.push(data.products.product) 
              $.each(data.products.product, function(key, value){
               // arr.push(value)
                
                if (value.pn.search(expression) != -1 )
                {
                $('#partnumertarget').append('<li idindex='+value.id+' class="list-group-item link-class">'+value.pn+' </li>');
                }
                i++
              });   
              });
    
    });
    var image =['images/xerox-toner-refilling.jpg','images/drum.jpg','images/xerox-toner-refilling.jpg','images/drum.jpg','images/xerox-toner-refilling.jpg','images/drum.jpg','images/xerox-toner-refilling.jpg','images/drum.jpg','images/xerox-toner-refilling.jpg','images/drum.jpg','images/xerox-toner-refilling.jpg','images/drum.jpg','images/xerox-toner-refilling.jpg','images/drum.jpg','images/xerox-toner-refilling.jpg','images/drum.jpg','images/xerox-toner-refilling.jpg','images/drum.jpg','images/xerox-toner-refilling.jpg','images/drum.jpg'];

    $('#partnumertarget').on('click', 'li', function() {
       // console.log($(this).attr('idindex'))
      //  console.log(image[arr[0][$(this).attr('idindex')-1].id]) 
     prodectnum=arr[0][$(this).attr('idindex')-1].pn;

  var click_text = $(this).text().split('|');
  $('#PartNumber').val($.trim(click_text[0]));
  $("#partnumertarget").html('');
  $("#pronamecon").text(arr[0][$(this).attr('idindex')-1].name);
  $("#proDiscretioncon").text(arr[0][$(this).attr('idindex')-1].dis);
  $("#promodelcon").text(arr[0][$(this).attr('idindex')-1].model);
  $("#protypecon").text(arr[0][$(this).attr('idindex')-1].typ);
  $("#imagecard").attr("src",image[arr[0][$(this).attr('idindex')-1].id]) 

 });
 function init(){
      var tabeldata=[]; 
      var t=0;
      t=parseInt(roomid, 10)
     
      db.transaction(function(tx){
          tx.executeSql(('SELECT * FROM roomcontant WHERE roomid=?'),[t],function(tx,results){
              
              var len = results.rows.length;
        
            for(var i=0;i<len;i++){
                var data=[];
                var id=results.rows.item(i).id;
                data.push(id)
                var productid =results.rows.item(i).productid;
                data.push(productid);
                var name=results.rows.item(i).quntaty;
                data.push(name)
                
                tabeldata.push(data);
                console.log(tabeldata)

            }
            $.each(tabeldata, function (i, v) { 
                text+="<tr><td>"+v[1]+"</td><td>"+v[2]+"</td><td><a href='editproductq.php?id="+v[0]+"'><button type='button'   class='btn btn-primary'>Edit</button></a></td><td><button type='button' class='btn btn-danger'>Delete</button></td></tr>"
               $("#tabelroom").html(text);
            })
     
      })
    })
   
   
    
 }
 init();
});