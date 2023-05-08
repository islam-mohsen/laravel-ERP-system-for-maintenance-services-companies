var db = openDatabase('mydb', '1.0', 'system tabels', 2 * 1024 * 1024);
db.transaction(function (tx) {
    tx.executeSql('CREATE TABLE IF NOT EXISTS brandname (id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, name)');
    tx.executeSql('CREATE TABLE IF NOT EXISTS itemdescription (id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, description)');
    tx.executeSql('CREATE TABLE IF NOT EXISTS prouduct (id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, name,Discretion,Number,Model,Type,stockl)');
    tx.executeSql('CREATE TABLE IF NOT EXISTS supplier (id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, name,address,mobilenumber,telephonenumber)');
    tx.executeSql('CREATE TABLE IF NOT EXISTS store (id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, name)');
    tx.executeSql('CREATE TABLE IF NOT EXISTS room (id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,name ,storeid)');
    tx.executeSql('CREATE TABLE IF NOT EXISTS roomcontant (id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,roomid,productid,quntaty)');
    
    
  });

  function text(x){
    console.log(x);
  }

  /**
   * select prand name name and id 
   */
  
  
  //doth()
  
  