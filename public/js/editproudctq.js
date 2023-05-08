$(document).ready(function () {
    $.ajaxSetup({ cache: false });
    var urlParams = new URLSearchParams(window.location.search);
    var proudctid=urlParams.get('id')
    var t=0;
    t=parseInt(proudctid);
    $("#addprod").click(function (e) { 
        e.preventDefault();
      q=parseInt( $('#quantity').val());
      db.transaction(function(tx){
        tx.executeSql(('UPDATE  roomcontant SET quntaty=? WHERE id=?'),[q,t]);
        var id =$("#quantity").attr('roomid');
        window.location.href ='editroom.php?id='+id;
  })
 
    });
    function init(){
        db.transaction(function(tx){
            tx.executeSql(('SELECT * FROM roomcontant WHERE id=?'),[t],function(tx,results){
                
                var len = results.rows.length;
          
              for(var i=0;i<len;i++){
                  var data=[];
                  
                  var name=results.rows.item(i).quntaty;
                  var roomid=results.rows.item(i).roomid;
                  $("#quantity").attr("placeholder", name);
                  $("#quantity").attr("roomid", roomid);
                  /*data.push(name)
                  
                  tabeldata.push(data);
                  console.log(tabeldata)*/
  
              }
              $.each(tabeldata, function (i, v) { 
                  text+="<tr><td>"+v[1]+"</td><td>"+v[2]+"</td><td><a href='editproductq.php?id="+v[0]+"'><button type='button'   class='btn btn-primary'>Edit</button></a></td><td><button type='button' class='btn btn-danger'>Delete</button></td></tr>"
                 $("#tabelroom").html(text);
              })
       
        })
      })
     
    }
    init()
});