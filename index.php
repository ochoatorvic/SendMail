<?
include_once 'sendContacto.php';
?>
<html><head></head><body>
<table width="964" border="0" cellspacing="0" cellpadding="0">

	<tr>
		<td height="421" valign="top">
		<table width="100%" height="402" border="0" cellpadding="0"
			cellspacing="0" bgcolor="#FFFFFF">
			<tr>
				<td width="56%" style="padding-top: 10px; padding-bottom: 10px">
				<table width="514" height="231" border="0" cellpadding="1"
					cellspacing="0" bgcolor="#015ca1">
					<tr>
						<td width="558" height="54">
						<table width="100%" height="133" border="0" cellpadding="5"
							cellspacing="0" bgcolor="#FFFFFF">
							<tr>
								<td><form action="" method="post">
								<table width="470" height="366" border="0" align="center"
									cellspacing="3" bgcolor="#FFFFFF" class="azul1">
									<tr><td colspan="3"><?=getMSG($msg);?></td></tr>
									<tr>
										<td width="216" valign="bottom">
										<div align="left">Nombre completo*:</div>
										</td>
										<td width="241" valign="bottom">&nbsp;</td>
									</tr>
									<tr>
										<td height="24" colspan="2" valign="top">
										<div align="left"><input name="entity[Nombre_completo]" type="text"
											id="textfield" size="65" value="<?getValue('Nombre_completo')?>"></div>
										</td>
									</tr>
									<tr>
										<td height="24" valign="bottom">
										<div align="left">Tel&eacute;fono:</div>
										</td>
										<td valign="bottom">
										<div align="left">E-Mail*:</div>
										</td>
									</tr>
									<tr>
										<td height="25" valign="top">
										<div align="left"><input name="entity[Tel�fono]" type="text"
											id="textfield4" size="30" value="<?getValue('Tel�fono')?>"></div>
										</td>
										<td valign="top">
										<div align="left"><input name="entity[E-Mail]" type="text"
											id="textfield6" size="30" value="<?getValue('E-Mail')?>"></div>
										</td>
									</tr>
									<tr>
										<td height="21" valign="bottom">
										<div align="left">Asunto*:</div>
										</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td height="25" valign="top">
										<div align="left"><select name="entity[Asunto]" id="select">
											<?$options = array('Sugerencia'=>'Sugerencia','Informaci�n de Eventos'=>'Informaci�n de Eventos','Otro Asunto'=>'Otro Asunto');
											genericOptions($options,getValue('Asunto',false));?>
										</select></div>
										</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td height="25" valign="bottom">
										<div align="left">Comentario*:</div>
										</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td height="85" colspan="2" valign="top">
										<div align="left"><textarea name="entity[Comentario]" cols="40"
											rows="5" id="textfield3"><?=getValue('Comentario')?></textarea></div>
										</td>
									</tr>
									<td colspan="4">
                                    <table  cellpadding="0" cellspacing="0" border="0">
                                    <tr>
															<td height="27" align="center" style="padding-top:10px;">
															<img width="170px" height="65px" id="captcha" src="sendMail/captcha/securimage/securimage_show.php" alt="CAPTCHA Image" />
															<!-- Si se queire agregar audio--><object type="application/x-shockwave-flash" data="sendMail/captcha/securimage/securimage_play.swf?audio=sendMail/captcha/securimage/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" height="19" width="19">

    <param name="movie" value="sendMail/captcha/securimage/securimage_play.swf?audio=sendMail/captcha/securimage/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" />
  </object>
																<a href="#" style="text-decoration:none;" onClick="document.getElementById('captcha').src = 'sendMail/captcha/securimage/securimage_show.php?' + Math.random(); return false">
																<p align="left"><img src="sendMail/captcha/images/refresh.gif" border="0" /></p></a>
															</td>
															<td align="center" height="27">
															<input type="text" name="captcha_code" size="10" maxlength="6" />
															</td>
														</tr>
                                    </table>
                                    </td>
									<tr>
										<td height="77"><label>
										<div align="left"><input type="hidden" name="cmd" value="send" /><input type="submit" name="button"
											id="button" value="Enviar" /> <br />
										<br />
										<span class="style1">*Campos obligatorios</span></div>
										</label></td>
										<td>&nbsp;</td>
									</tr>
									<tr>
									</tr>
								</table>
								</form></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</body></html>