$(document).ready(function () {
    $.ajaxSetup({ cache: false });
    var roomname =[];
    $("#roomdata").hide();
   
    //add room by clicking 
    $("#addRoom").click(function (e) { 
        e.preventDefault();
        $("#roomdata").show(); 
    });
    $("#canceled").click(function (e) { 
        e.preventDefault();
        $("#roomname").val('');
        $("#roomdata").hide();
        
    });
    $("#okbtn").click(function (e) { 
        e.preventDefault();
        var name=$("#roomname").val();
        if(name){
           // roomname.push(name);
           $("#roomname").val('');
            $("#roomdata").hide();
            $('#roomlist').append('<li datasend="'+name+'" class="prolis list-group-item list-group-item-secondary">Room Name :'+name+'<i  class=" closeli fas fa-times"></i></li>')
        }
        
    });

    $('#roomlist').on('click','li i',function() {  
        // e.preventDefault();
        //console.log($this)
         $(this).parent().remove(); 
         
     });
     $(".endbut").click(function (e) { 
        var storename=$("#storename").val();
        var id=0;
        console.log(storename);
         $("#roomlist li").each( function () { 
             
             
              
              roomname.push($(this).attr('datasend'));
              
         });
         db.transaction(function (tx) {
            var i=0
           tx.executeSql(('INSERT INTO store (name) VALUES (?)'),[storename],function(tx,results){
               i= results.insertId;
               for (let index = 0; index < roomname.length; index++) {
                tx.executeSql(('INSERT INTO room (name,storeid) VALUES (?,?)'),[roomname[index],i])
                   
               }
              
              //// console.log(id)
               //i=this.id;
            }); 
            
           
            });
           // console.log(this.id); 
            location.reload();
         
     });
     var tabeldata=[]
     function init(){
        db.transaction(function (tx) {
            tx.executeSql('SELECT * FROM store',[],function(tx,results){
                var len = results.rows.length, i;
                for(var i=0;i<len;i++){
                    var data=[];
                    var id =results.rows.item(i).id;
                    data.push(id);
                    var name=results.rows.item(i).name;
                    data.push(name)
                    tabeldata.push(data);

                }
                $.each(tabeldata, function (i, v) { 
                    text+="<tr><th scope='row'>"+v[0]+"</td><td>"+v[1]+"</td><td><a  href='room.php?id="+v[0]+"'><button type='button' class='btn btn-primary'>Edit</button></a></td><td><button type='button' class='btn btn-danger'>Delete</button></td></tr>"
                   $("#tabelroom").html(text);
                });
                function redir(id){
                    window.location='room.php?id='+id;
                }
            })
        })
        
     }
     init();
    
});