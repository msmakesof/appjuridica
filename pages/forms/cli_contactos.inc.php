<?php ?>
<div class="row">
	<div class="col-md-12">
		<div style="text-align:center; font-weight:bold; font-size:14px; color:red;">
			INFORMACIÓN DE REPRESENTANTE LEGAL Y OTROS.
		</div>
	</div>
	<div class="col-md-12">
		<div style="font-weight:bold; font-size:11px; color:blue;">
			Representante Legal
		</div>
	</div>
	<div class="col-md-2">
		<label class="form-label"><span style="color:red;">*</span> 
			Tipo Documento
		</label>                                    
										   
		<select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="tipodocumentorl" id="tipodocumentorl" required>
		 <option value="" >Seleccione Opción...</option>
			<?php
				for($i=0; $i<count($mtipodocumento['gen_tipodocumento']); $i++)
				{
					$TDO_IdTipoDocumento = $mtipodocumento['gen_tipodocumento'][$i]['TDO_IdTipoDocumento'];
					$TDO_Abreviatura = $mtipodocumento['gen_tipodocumento'][$i]['TDO_Abreviatura'];
					$TDO_Nombre = $mtipodocumento['gen_tipodocumento'][$i]['TDO_Nombre'];
					//$TDO_Estado = $m['gen_tipodocumento'][$i]['TDO_Estado'];
			?>
					<option value="<?php echo $TDO_IdTipoDocumento; ?>" <?php if (trim($TDO_IdTipoDocumento) == trim($TipoDocumentorl)){ echo "selected/=selected/";} else{ echo "";} ?>>
						<?php echo $TDO_Nombre ; ?>                                                
					</option>
			<?php
				}
			?>
		</select>
	</div>
	<div class="col-md-2"> 
		<label class="form-label"><span style="color:red;">*</span> N&uacute;mero Documento</label>
		<div class="form-line">
		   <input type="text" class="form-control" name="numerodocumentorl" id="numerodocumentorl" value="<?php echo $NumeroDocumentorl ;?>" maxlength="13" required placeholder="No digitar puntos ni guiones.">
		</div>
	</div>

	<div class="col-md-4">
		<label class="form-label"><span style="color:red;">*</span> Nombres</label>
		<div class="form-line">
			<input type="text" class="form-control" name="nombrerl" id="nombrerl" value="<?php echo $Nombrerl ;?>" required>											   
		</div>
	</div>
	
	<div class="col-md-4">
		<label class="form-label"><span style="color:red;">*</span> Apellidos</label>
		<div class="form-line">
			<input type="text" class="form-control" name="apellido1rl" id="apellido1rl" value="<?php echo $Apellido1rl ;?>" required>											   
		</div>
	</div> 
</div>

<div class="row">
	<div class="col-md-3">
		<label class="form-label">N&uacute;mero Celular</label>
		<div class="form-line">
			<input type="text" class="form-control" name="celularrl" id="celularrl" value="<?php echo $Celularrl ;?>" maxlength="13" required>                                       
		</div>
	</div>
	
	<div class="col-md-4">
		<label class="form-label">Email</label>
		<div class="form-line">
		   <input type="text" class="form-control" name="emailrl" id="emailrl" value="<?php echo $Emailrl ;?>" maxlength="60" required>                                       
		</div>
	</div>
</div>
	
<div class="row">
	<div class="col-md-12">
		<div style="font-weight:bold; font-size:11px; color:blue;">
			Otro Contacto
		</div>
	</div>
	<div class="col-md-2">
		<label class="form-label">
			Tipo Documento
		</label>                                    
										   
		<select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="tipodocumentorl2" id="tipodocumentorl2" required>
		 <option value="" >Seleccione Opción...</option>
			<?php
				for($i=0; $i<count($mtipodocumento['gen_tipodocumento']); $i++)
				{
					$TDO_IdTipoDocumento = $mtipodocumento['gen_tipodocumento'][$i]['TDO_IdTipoDocumento'];
					$TDO_Abreviatura = $mtipodocumento['gen_tipodocumento'][$i]['TDO_Abreviatura'];
					$TDO_Nombre = $mtipodocumento['gen_tipodocumento'][$i]['TDO_Nombre'];
					//$TDO_Estado = $m['gen_tipodocumento'][$i]['TDO_Estado'];
			?>
					<option value="<?php echo $TDO_IdTipoDocumento; ?>" <?php if (trim($TDO_IdTipoDocumento) == trim($TipoDocumentorl2)){ echo "selected/=selected/";} else{ echo "";} ?>>
						<?php echo $TDO_Nombre ; ?>                                                
					</option>
			<?php
				}
			?>
		</select>
	</div>
	<div class="col-md-2"> 
		<label class="form-label">N&uacute;mero Documento</label>
		<div class="form-line">
		   <input type="text" class="form-control" name="numerodocumentorl2" id="numerodocumentorl2" value="<?php echo $NumeroDocumentorl2 ;?>" maxlength="13" required placeholder="No digitar puntos ni guiones.">
		</div>
	</div>

	<div class="col-md-4">
		<label class="form-label">Nombres</label>
		<div class="form-line">
			<input type="text" class="form-control" name="nombrerl2" id="nombrerl2" value="<?php echo $Nombrerl2 ;?>" required>											   
		</div>
	</div>
	
	<div class="col-md-4">
		<label class="form-label">Apellidos</label>
		<div class="form-line">
			<input type="text" class="form-control" name="apellidosrl2" id="apellidosrl2" value="<?php echo $Apellido1rl2 ;?>" required>											   
		</div>
	</div> 
</div>

<div class="row">
	<div class="col-md-3">
		<label class="form-label">N&uacute;mero Celular</label>
		<div class="form-line">
			<input type="text" class="form-control" name="celularrl2" id="celularrl2" value="<?php echo $Celularrl2 ;?>" maxlength="13" required>                                       
		</div>
	</div>
	
	<div class="col-md-4">
		<label class="form-label">Email</label>
		<div class="form-line">
		   <input type="text" class="form-control" name="emailrl2" id="emailrl2" value="<?php echo $Emailrl2 ;?>" maxlength="60" required>                                       
		</div>
	</div>
</div>

<div class="row">
</div>
<?php ?>