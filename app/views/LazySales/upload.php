<html>

<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script language="javascript">

//Khai báo phương thức
function methodName()
{
    //Có thể gọi các thuộc tính bên trong đối tượng tại đây
    var varName = this.name; 
    console.log(varName);
}
 
//Khai báo đối tượng
function objectName(a)
{
    this.name = a;
    //Gọi phương thức tương tự như cách khai báo các thuộc tính
    this.myMethodName = methodName;
    
}

function test(b){
	$.get
		(
			'http://localhost/lazysales/public/test',
			function(result)
			{	
				
				st = new objectName(b);
				st.myMethodName();
				st2 = new objectName(result);
				st2.myMethodName();
				
			}
		);
}
   
    
</script>
</body>
</html>