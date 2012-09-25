<%@LANGUAGE="VBSCRIPT"%> 
<%
response.Write("<html>" & vbcrlf & "<head>" & vbcrlf & "<title>Respuesta correcta a la comunicaci&oacute;n ON-LINE</title>" & vbcrlf  _
							& "</head>" & vbcrlf & "<body> " & vbcrlf & "$*$OKY$*$" & vbcrlf & "</body>" & vbcrlf & "</html> ")
%>
<!--#include file="../Connections/miconexion.asp" -->
<% 
'Recojo los datos del POST y los meto en la variable 'valor'
for each campo in Request.Form 

if campo <> "submit" then
valor = valor & campo & "= " & Request.Form(campo) & "<br>" 
end if

next

'response.write(valor)

application.lock
application("CAIXANOVA")= valor & "<br>" & NOW() & " entramos tienda/check.asp<br>-------------------------------------------<br>" & application("CAIXANOVA")
application.unlock


MerchantID = Trim(Request.Form("MerchantID"))
IF MerchantID="" THEN 
	MerchantID = Trim(Request.QueryString("MerchantID"))
END IF

AcquirerBIN = Trim(Request.Form("AcquirerBIN"))
IF AcquirerBIN="" THEN 
	AcquirerBIN = Trim(Request.QueryString("AcquirerBIN"))
END IF

TerminalID = Trim(Request.Form("TerminalID"))
IF TerminalID="" THEN 
	TerminalID = Trim(Request.QueryString("TerminalID"))
END IF

TipoMoneda = Trim(Request.Form("TipoMoneda"))
IF TipoMoneda="" THEN 
	TipoMoneda = Trim(Request.QueryString("TipoMoneda"))
END IF

Num_operacion = Trim(Request.Form("Num_operacion"))
IF Num_operacion="" THEN 
	Num_operacion = Trim(Request.QueryString("Num_operacion"))
END IF

Importe = Trim(Request.Form("Importe"))
IF Importe="" THEN 
	Importe = Trim(Request.QueryString("Importe"))
END IF

Num_aut = Trim(Request.Form("Num_aut"))
IF Num_aut="" THEN 
	Num_aut = Trim(Request.QueryString("Num_aut"))
END IF


valor=""
for each campo in Request.querystring 

if campo <> "submit" then
	valor = valor & campo & "= " & Request.querystring(campo) & "<br>" 
end if

next

application.lock
application("CAIXANOVA")= "<br>QUERY_STRING " & valor & " <br>-------------------------------------------<br>" & application("CAIXANOVA")
application.unlock

valor=""
'Recojo los datos del POST y los meto en la variable 'valor'
for each campo in Request.Form 
	valor = valor & campo & "= " & Request.Form(campo) & "<br>" 
next

application.lock
application("CAIXANOVA")= "<br>Form " & valor & " <br>-------------------------------------------<br>" & application("CAIXANOVA")
application.unlock




application.lock
application("CAIXANOVA")= valor & "<br>MerchantID " & MerchantID & "<br>" & application("CAIXANOVA")
application("CAIXANOVA")= valor & "<br>AcquirerBIN " & AcquirerBIN & "<br>" & application("CAIXANOVA")
application("CAIXANOVA")= valor & "<br>TerminalID " & TerminalID & "<br>" & application("CAIXANOVA")
application("CAIXANOVA")= valor & "<br>TipoMoneda " & TipoMoneda & "<br>" & application("CAIXANOVA")
application("CAIXANOVA")= valor & "<br>Num_operacion " & Num_operacion & "<br>" & application("CAIXANOVA")
application("CAIXANOVA")= valor & "<br>Importe " & Importe & "<br>" & application("CAIXANOVA")
application("CAIXANOVA")= valor & "<br>Num_aut " & Num_aut & "<br>" & application("CAIXANOVA")
application.unlock

total=Importe

IF (MerchantID<>"081169385") THEN
	application.lock
	application("CAIXANOVA")=  "MerchantID<>081169385<br>-------------------------------------------<br>" & application("CAIXANOVA")
	application.unlock

	Response.End()
END IF

IF (AcquirerBIN<>"0000554025") THEN
	application.lock
	application("CAIXANOVA")=  "AcquirerBIN<>0000554025<br>-------------------------------------------<br>" & application("CAIXANOVA")
	application.unlock

	Response.End()
END IF
IF (TerminalID<>"00000003") THEN
	application.lock
	application("CAIXANOVA")=  "TerminalID<>00000003<br>-------------------------------------------<br>" & application("CAIXANOVA")
	application.unlock

	Response.End()
END IF

IF (TipoMoneda<>"978") THEN
	application.lock
	application("CAIXANOVA")=  "TipoMoneda<>978<br>-------------------------------------------<br>" & application("CAIXANOVA")
	application.unlock
	
	Response.End()
END IF

application.lock
application("CAIXANOVA")=  "TAQUI<br>-------------------------------------------<br>" & application("CAIXANOVA")
application.unlock


'*** ABRIMOS LA CONEXION 
dim objConn, rs 

set objConn = Server.CreateObject("ADODB.Connection") 
objConn.Open MM_miconexion_STRING
set rs = Server.CreateObject("ADODB.Recordset") 

SQL = "SELECT * FROM ORDEN WHERE IDOrden = " & Num_operacion & " AND TOTAL= " & total & "" 

application.lock
application("CAIXANOVA")=  "RECORDSET<br>"&SQL&"" &"<br>"& application("CAIXANOVA")
application.unlock
rs.Open "" & SQL & "", objConn, adOpenDynamic, 2 


IF (Not rs.EOF) THEN

		
	

		rs("REALIZADO").value = 1
		rs("Num_aut").value = Num_aut
		
		rs.update 
	
		application.lock
		application("CAIXANOVA")=  "Actualizado registro pedido<br>"& application("CAIXANOVA")
		application.unlock
		

		response.Write("<html>" & vbcrlf & "<head>" & vbcrlf & "<title>Respuesta correcta a la comunicaci&oacute;n ON-LINE</title>" & vbcrlf  _
							& "</head>" & vbcrlf & "<body> " & vbcrlf & "$*$OKY$*$" & vbcrlf & "</body>" & vbcrlf & "</html> ")
						
		
		
		para "benizio@benizio.com"
		asunto = "Pedido realizado, tienda BENIZIO.COM"
		mensaje = "<HTML><BODY><font face=Arial size=2><p>Tiene un pedido nuevo, pulse aquí debajo para ver su desglose:</p><p><b><a href=http://www.benizio.com/control/gestion/compra_realizada.asp?IDOrden=" & Num_operacion & ">http://www.benizio.com/control/gestion/compra_realizada.asp?IDOrden=" & Num_operacion & "</a></p></font><p>Deberá haber accedido al panel de control antes de poder ver este link</p></BODY></HTML>"
		
		call superemail(de,para,"","",asunto,mensaje,"","","")
						

ELSE	


application.lock
application("CAIXANOVA")=  "RECORDSET VACIO<br>" & application("CAIXANOVA")
application.unlock

END IF

'*** CERRAMOS EL RECORDSET 
rs.close 
objConn.Close 

set rs = nothing
set objConn = nothing 

%>