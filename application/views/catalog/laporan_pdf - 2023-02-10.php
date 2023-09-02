<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Specification Data</title>
	<!--<link href="<?php echo base_url();?>assets/utilpdf/bootstrap.min.css" rel="stylesheet"/>	
	<script type="text/javascript" src="<?php echo base_url();?>assets/utilpdf/bootstrap.bundle.min.js"></script>-->
    <style type="text/css">
      * {
        margin: 0;
        padding: 0;
        text-indent: 0;
      }

      .s1 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 6pt;
      }

      p {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 8pt;
        margin: 0pt;
      }

      .s2 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 8pt;
        vertical-align: 1pt;
      }

      .s3 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 11pt;
      }

      .s4 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 8pt;
      }

      .s5 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 8pt;
      }

      .s6 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 5pt;
        vertical-align: 3pt;
      }

      .s7 {
        color: black;
        font-family: "Trebuchet MS", sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 9pt;
      }

      .s8 {
        color: black;
         font-family: "Trebuchet MS", sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 8pt;
      }

      .s9 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 4pt;
      }

      .s10 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 5pt;
        vertical-align: -1pt;
      }

      .s11 {
        color: black;
        font-family: "Trebuchet MS", sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 8pt;
      }

      .s12 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 8pt;
      }

      .s13 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 4pt;
      }

      .s14 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: underline;
        font-size: 4pt;
      }

      h1 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 8pt;
      }

      .a,
      a {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 6pt;
      }

      table,
      tbody {
        vertical-align: top;
        overflow: visible;
      }
    </style>
  </head>
  <body>
	
	<table width="100%" cellspacing="0" border="0">
		<tr>
			<td width="10%">&nbsp;</td>
			<td width="90%">
			
	<table width="95%" style="border-collapse:collapse;margin-left:10pt;margin-top:10pt; margin-right:10pt;" cellspacing="0" border="0">
      <tr style="height:10pt">
        <td>
			<table width="100%" cellspacing="0" border="0">
				<tr>
					<td><img src='assets/img/logo.jpg' width='150'></td>
					<td class="s3" style="padding-bottom: 2pt;padding-left: 2pt;padding-top: 40pt;text-indent: 0pt;line-height: 1pt;text-align: right; ">SPECIFICATION&nbsp;&nbsp;&nbsp;&nbsp;</td>
				</tr>
			</table>
			<br>
        </td>
      </tr>
	  <tr style="height:10pt">
        <td>
			<table width="100%" cellspacing="0" border="0"  style="border: 1px solid;">
				<tr>
					<td class="s8" style="padding-left: 2pt;"><b>PROJECT</td>
					<td class="s8">:</td>
					<td class="s8" colspan="8" style="padding-left: 2pt;text-align: left;"><?php echo $dt->project; ?></td>
					<td class="s8" style="text-align: center; border-left: 1px solid;"><b>CODE</td>
				</tr>
				<tr>
					<td class="s8" style="padding-left: 2pt;"><b>AREA</td>
					<td class="s8">:</td>
					<td class="s8" colspan="8" style="padding-left: 2pt;text-align: left;"><?php echo $dt->location; ?></td>
					<td rowspan='2' class="s8" style="text-align: center; border-left: 1px solid;"><B><?php echo $dt->codelamp; ?><B></td>
				</tr>
				<tr>
					<td class="s8" style="padding-left: 2pt;"><b>DATE</td>
					<td class="s8">:</td>
					<td class="s8" style="padding-left: 2pt;text-align: left;"><?php echo date('d-m-Y',strtotime($dt->tanggal_project)); ?></td>
					<td class="s8" style="padding-left: 2pt;text-align: left;"><b>STATUS</td>
					<td class="s8" style="padding-left: 2pt;text-align: left;">:</td>
					<td class="s8" style="padding-left: 2pt;text-align: left;"><?php echo $dt->status_project; ?></td>
					<td class="s8" style="padding-left: 2pt;text-align: left;"><b>REVISION</td>
					<td class="s8" style="padding-left: 2pt;text-align: left;">:</td>
					<td class="s8" style="padding-left: 2pt;text-align: left;">1</td>
					<td class="s8" style="padding-left: 2pt;text-align: left;">&nbsp;</td>
				</tr>
			</table>
			<br>
        </td>
      </tr>
	  <tr style="height:10pt">
        <td>
			<table width="100%" cellspacing="0" border="0" >
				<tr>
					<td colspan="16"><h1>TECHNICAL DATA</h1></td>					
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt; padding-bottom: 2pt;">Product Type</td>
					<td class="s7">:</td>
					<td colspan="7" class="s7"><?php
		  $side = $dt->adv_lamp_side;
		  $lamp = $dt->lamp;
								if($side == 'I')
								{
									$lamp_catside =  'Indoor';
									$cat = $dt->adv_cat_indoor;
									if($cat!=null)
									{
										$category = json_decode(ecurl('GET','viewcatlamp/'.$cat))->data;
									$lamp_cat =  $category->name_product_type;
									} else {
										$lamp_cat =  '';
									}
									
								} else {
									$lamp_catside =  'Outdoor';
									$cat = $dt->adv_cat_indoor;
									if($cat!=null)
									{
									$category = json_decode(ecurl('GET','viewcatlamp/'.$cat))->data;
									$lamp_cat =  $category->name_product_type;
									} else {
										$lamp_cat =  '';
									}
								}
				//echo 'Type '.$lamp_catside.' - '.$lamp_cat.'<br>'.$lamp;
				echo ($lamp_catside ? $lamp_catside : '-');
				echo '&nbsp;-&nbsp;'.$lamp_cat;
				
		  ?></td>					
					<td class="s7">&nbsp;</td>
					<td colspan="6" class="s7">&nbsp;</td>
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt; padding-bottom: 2pt;">Brand</td>
					<td class="s7">:</td>
					<td colspan="7" class="s7"><?php echo ($dt->name_product_brand ? $dt->name_product_brand : '-'); ?></td>					
					<td class="s7" >&nbsp;</td>
					<td colspan="6" class="s7">&nbsp;</td>
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt; padding-bottom: 2pt;">Product Name</td>
					<td class="s7">:</td>
					<td class="s7"><?php echo ($dt->product_brand_name ? $dt->product_brand_name : '-'); ?></td>
					<td style="border-left: 1px solid;" class="s7">&nbsp;</td>
					<td class="s7"><?php echo ($dt->power ? $dt->power : '-'); ?></td>
					<td class="s7"><b>W</td>
					<td style="border-right: 1px solid;" class="s7">&nbsp;</td>
					<td class="s7">&nbsp;</td>
					<td class="s7"><?php echo ($dt->lumen ? $dt->lumen : '-'); ?></td>
					<td class="s7" style="border-right: 1px solid;"><b>LM</td>
					<td class="s7">&nbsp;</td>
					<td class="s7">&nbsp;</td>
					<td class="s7"><?php echo ($dt->voltage ? $dt->voltage : '-'); ?></td>
					<td colspan="3" class="s7"><b>V</td>
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt; padding-bottom: 2pt;">Product Code</td>
					<td class="s7">:</td>
					<td class="s7"><?php echo ($dt->product_code ? $dt->product_code : '-'); ?></td>
					<td style="border-left: 1px solid;" class="s7">&nbsp;</td>
					<td class="s7"><?php echo ($dt->sw ? $dt->sw : '-'); ?></td>
					<td class="s7"><b>K</td>
					<td class="s7">&nbsp;</td>
					<td style="border-left: 1px solid;" class="s7">&nbsp;</td>
					<td class="s7"><?php echo ($dt->cri ? $dt->cri : '-'); ?></td>
					<td class="s7" style="border-right: 1px solid;"><b>CRI</td>
					<td class="s7">&nbsp;</td>
					<td class="s7">&nbsp;</td>
					<td class="s7">12</td>
					<td colspan="3" class="s7"><b>UGR</td>
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt; padding-bottom: 2pt;">Optic</td>
					<td class="s7">:</td>
					<td class="s7"><?php echo ($dt->ajust ? $dt->ajust : '-'); ?></td>
					<td class="s7">&nbsp;</td>
					<td class="s7">&nbsp;</td>
					<td class="s7" ><b>&#176;</td>
					<td class="s7">&nbsp;</td>
					<td style="border-left: 0px solid;" class="s7">&nbsp;</td>
					<td class="s7" ><?php echo ($dt->tilt ? $dt->tilt : '-'); ?></td>
					<td class="s7" style="border-right: 0px solid;"><b>Tilt</td>
					<td class="s7">&nbsp;</td>
					<td class="s7">&nbsp;</td>
					<td class="s7"><?php echo ($dt->rotation ? $dt->rotation : '-'); ?></td>
					<td colspan="3" class="s7"><b>Rotation</td>
				</tr>				
				
				<!--<tr>
					<td class="s7" style="padding-left: 2pt;">Source Type</td>
					<td class="s7">:</td>
					<td  class="s7"><?php echo ($dt->lamp ? $dt->lamp : '-'); ?></td>
					<td class="s7">SDCM : <?php echo ($dt->sdcm ? $dt->sdcm : '-'); ?></td>
					<td colspan="12" class="s7"></td>					
				</tr>-->


				<tr>
					<td class="s7" style="padding-left: 2pt; padding-bottom: 2pt;">Source Type</td>
					<td class="s7">:</td>
					<td class="s7"><?php echo ($dt->lamp ? $dt->lamp : '-'); ?></td>
					<td class="s7">&nbsp;</td>
					<td class="s7"><?php echo ($dt->sdcm ? $dt->sdcm : '-'); ?></td>
					<td class="s7" ><b>SDCM<b></td>
					<td class="s7">&nbsp;</td>
					<td style="border-left: 0px solid;" class="s7">&nbsp;</td>
					<td class="s7" ><?php echo ($dt->lamp_lifetime ? $dt->lamp_lifetime : '-'); ?></td>
					<td class="s7" style="border-right: 0px solid;"><b>Hours<b></td>
					<td class="s7"></td>
					<td class="s7">&nbsp;</td>
					<td class="s7"><?php // echo ($dt->rotation ? $dt->rotation : '-'); ?></td>
					<td colspan="3" class="s7"></td>
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt; padding-bottom: 2pt;">Accessories</td>
					<td class="s7">:</td>
					<td colspan="14" class="s7"><?php echo ($dt->accesories ? $dt->accesories : '-'); ?><?php //echo ($dt->name_optic ? $dt->name_optic : '-'); ?></td>
				</tr>
				
				
			</table>
			<br>
        </td>
      </tr>
	  <tr style="height:15pt">
        <td>
			<table width="100%" cellspacing="0" border="0" >
				<tr>
					<td style="padding-left: 2pt;"><h1>IMAGES</h1></td>					
				</tr>
				<tr>
					<td><BR><BR>
					
					<?php
						  $idlampiran = $dt->lampiran.'_imgmenu';
						  $lampiran = json_decode(ecurl('GET','lampiran/'.$idlampiran))->data;
                         if(!empty($lampiran)) {                        
                          foreach ($lampiran as $baris) { 
						echo "<img src='lampiran/".$baris->nama_berkas."' width='200'>&nbsp;";
							}
						} else {
							echo "<img src='assets/img/noimg.jpg' width='100'>&nbsp;";
						}
					?>					
					<?php
						  $idlampiran = $dt->lampiran.'_dimensi';
						  $lampiran = json_decode(ecurl('GET','lampiran/'.$idlampiran))->data;
                         if(!empty($lampiran)) {                        
                          foreach ($lampiran as $baris) { 
						echo "<img src='lampiran/".$baris->nama_berkas."' width='200'>&nbsp;";
							}
						} else {
							echo "<img src='assets/img/noimg.jpg' width='100'>&nbsp;";
						}
					?>
					<?php
						  $idlampiran = $dt->lampiran.'_aksesori';
						  $lampiran = json_decode(ecurl('GET','lampiran/'.$idlampiran))->data;
                         if(!empty($lampiran)) {                        
                          foreach ($lampiran as $baris) { 
						echo "<img src='lampiran/".$baris->nama_berkas."' width='200'>&nbsp;";
							}
						} else {
							echo "<img src='assets/img/noimg.jpg' width='100'>&nbsp;";
						}
					?>
					
					</td>				
				</tr>
			</table>
		</td>
      </tr>
	  <tr>
		<td><hr></td>
	  </tr>
	  <tr style="height:10pt">
        <td>
			<table width="100%" cellspacing="0" border="0">
				<tr>
					<td style="padding-left: 2pt;" colspan="15"><h1>DIMENSION</td>					
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt;">&nbsp;</td>
					<td class="s7">Shape</td>
					<td class="s7"><?php echo ($dt->shape ? $dt->shape : '-'); ?></td>
					<td class="s7" colspan="2">&nbsp;</td>					
					<td style="border-left: 1px solid;">&nbsp;</td>
					<td colspan="9" class="s7">Recessed Depth (mm) : <?php  echo ($dt->dim_recc_depth ? $dt->dim_recc_depth : '-'); ?></td>
					<td colspan="9"></td>					
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt;">&nbsp;</td>
					<td class="s7">Diameter (mm)</td>
					<td class="s7"><?php echo ($dt->dim_diameter ? $dt->dim_diameter : '-'); ?></td>
					<td class="s7" colspan="2" ></td>					
					<td style="border-left: 1px solid;">&nbsp;</td>
					<td colspan="9" class="s7">Cut Out Diameter (mm) : <?php  echo ($dt->dim_cut_o_diameter ? $dt->dim_cut_o_diameter : '-'); ?></td>
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt;">&nbsp;</td>
					<td class="s7">Dimension (mm)</td>
					<td class="s7">L : <?php echo ($dt->dim_length ? $dt->dim_length : '-'); ?></td>
					<td class="s7">W : <?php echo ($dt->dim_width ? $dt->dim_width : '-'); ?></td>
					<td class="s7">H : <?php echo ($dt->dim_height ? $dt->dim_height : '-'); ?></td>
					<td class="s7" style="border-left: 1px solid;">&nbsp;</td>
					<td class="s7">Cut Out Size</td>
					<td class="s7">L : <?php echo ($dt->cut_o_sq_lbr ? $dt->cut_o_sq_lbr : '-'); ?></td>
					<td class="s7">W : <?php echo ($dt->cut_o_sq_pjg ? $dt->cut_o_sq_pjg : '-'); ?></td>
					<td class="s7">D : <?php echo ($dt->dim_depth_housing ? $dt->dim_depth_housing : '-'); ?></td>
					<td class="s7">&nbsp;</td>
					<td class="s7">&nbsp;</td>
					<td class="s7">&nbsp;</td>
					<td class="s7">&nbsp;</td>					
					<td>&nbsp;</td>
				</tr>
			</table>
        </td>
      </tr>
	  <tr>
		<td><hr></td>
	  </tr>	  
	  <tr style="height:15pt">
        <td>
			<table width="100%" cellspacing="2" border="0">
				<tr>
					<td style="padding-left: 2pt;" colspan="16"><h1>PROPERTIES</h1></td>					
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt;"><h1>ELECTRICAL</h1></td>
					<td class="s7"></td>
					<td class="s7" style="padding-left: 2pt;">Power Supply</td>					
					<td colspan="5" class="s7"><?php echo ($dt->gears ? $dt->gears : '-'); ?></td>
					<td class="s7" rowspan="8" style="border-left: 0px solid;">&nbsp;</td>
					<td  class="s7">Driver IP</td>
					<td colspan="5" class="s7"><?php echo ($dt->driver_ip ? $dt->driver_ip : '-'); ?></td>	
					<td class="s7" rowspan="7" style="border-left: 0px solid;">&nbsp;</td>					
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt;"></td>
					<td class="s7">&nbsp;</td>
					<td class="s7" style="padding-left: 2pt;">Control</td>
					<td colspan="5" class="s7"><?php echo ($dt->name_control ? $dt->name_control : '-'); ?></td>
					<!--<td class="s7" style="border-left: 1px solid;">&nbsp;</td>-->
					<td  class="s7">THD</td>
					<td colspan="2" class="s7"><?php echo ($dt->thd ? $dt->thd : '-'); ?></td>	
					<td class="s7">&nbsp;</td>
					<td class="s7">Max</td>
					<td class="s7">&nbsp;</td>
					<!--<td class="s7" style="border-left: 1px solid;">&nbsp;</td>-->
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt;"></td>
					<td class="s7">&nbsp;</td>
					<td class="s7" style="padding-left: 2pt;">Brand Ref</td>
					<td colspan="5" class="s7"><?php echo ($dt->brand_ref ? $dt->brand_ref : '-'); ?></td>
					<!--<td class="s7" style="border-left: 1px solid;">&nbsp;</td>-->
					<td  class="s7">Lifetime</td>
					<td colspan="2" class="s7"><?php echo ($dt->lifetime ? $dt->lifetime : '-'); ?></td>	
					<td class="s7">&nbsp;</td>
					<td class="s7">Hours</td>
					<td class="s7">&nbsp;</td>
					<!--<td class="s7" style="border-left: 1px solid;">&nbsp;</td>-->
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt;"></td>
					<td class="s7">&nbsp;</td>
					<td class="s7" style="padding-left: 2pt;">Power Factor Min.</td>
					<td colspan="5" class="s7"><?php echo ($dt->power_fractor ? $dt->power_fractor : '-'); ?></td>
					<!--<td class="s7" style="border-left: 1px solid;">&nbsp;</td>-->
					<td  class="s7">Flicker Rate</td>
					<td colspan="2" class="s7"><?php echo ($dt->flicker_rate ? $dt->flicker_rate : '-'); ?></td>	
					<td class="s7">&nbsp;</td>
					<td class="s7">Max</td>
					<td class="s7">&nbsp;</td>
					<!--<td class="s7" style="border-left: 1px solid;">&nbsp;</td>-->
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt;"><h1>PHYSICAL</h1></td>
					<td class="s7"></td>
					<td class="s7" style="padding-left: 2pt; border-top: 1px solid;">Reflector</td>					
					<td colspan="5" class="s7" style="border-top: 1px solid;"><?php echo ($dt->tecspec_reflector ? $dt->tecspec_reflector : '-'); ?></td>
					<!--<td class="s7" style="border-left: 1px solid;">&nbsp;</td>-->
					<td  class="s7" style="border-top: 1px solid;">Finish</td>
					<td colspan="5" class="s7" style="border-top: 1px solid;"><?php echo ($dt->name_ref_finish ? $dt->name_ref_finish : '-'); ?></td>	
					<!--<td class="s7" style="border-left: 1px solid;">&nbsp;</td>-->
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt;"></td>
					<td class="s7">&nbsp;</td>
					<td class="s7" style="padding-left: 2pt;">Body</td>
					<td colspan="5" class="s7"><?php echo ($dt->body_material ? $dt->body_material : '-'); ?></td>
					<!--<td class="s7" style="border-left: 1px solid;">&nbsp;</td>-->
					<td  class="s7">Color</td>
					<td colspan="2" class="s7"><?php echo ($dt->name_product_colour ? $dt->name_product_colour : '-'); ?></td>	
					<td class="s7">&nbsp;</td>
					<td class="s7">&nbsp;</td>
					<td class="s7">&nbsp;</td>
					<!--<td class="s7" style="border-left: 1px solid;">&nbsp;</td>-->
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt;"></td>
					<td class="s7">&nbsp;</td>
					<td class="s7" style="padding-left: 2pt;">Trim</td>
					<td colspan="5" class="s7"><?php echo ($dt->tecspec_cover_trim ? $dt->tecspec_cover_trim : '-'); ?></td>
					<!--<td class="s7" style="border-left: 1px solid;">&nbsp;</td>-->
					<td  class="s7">Color</td>
					<td colspan="2" class="s7"><?php echo ($dt->name_product_colour ? $dt->name_product_colour : '-'); ?></td>	
					<td class="s7">&nbsp;</td>
					<td class="s7">&nbsp;</td>
					<td class="s7">&nbsp;</td>
					<!--<td class="s7" style="border-left: 1px solid;">&nbsp;</td>-->
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt;"></td>
					<td class="s7">&nbsp;</td>
					<td class="s7" style="padding-left: 2pt;">Protection</td>
					<td class="s7">IP</td>
					<td class="s7"><?php echo ($dt->tecspec_ip ? $dt->tecspec_ip : '-'); ?></td>
					<td class="s7">IK</td>
					<td class="s7"><?php echo ($dt->ugr_rating ? $dt->ugr_rating : '-'); ?></td>
					<td  class="s7"></td>
					<td  class="s7"></td>
					<td colspan="7" class="s7">&nbsp;</td>
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt;"><h1>Notes</h1></td>
					<td colspan="15" class="s7"><?php echo ($dt->add_note ? $dt->add_note : '-'); ?></td>
				</tr>
				<tr>
					<td class="s7" style="padding-left: 2pt;"><h1>Instalation Manual</h1></td>
					<td colspan="15" class="s7"><?php echo ($dt->instalation_manual ? $dt->instalation_manual : '-'); ?></td>
				</tr>
			</table>
        </td>
      </tr>
	  <tr>
		<td><hr></td>
	  </tr>
	  <tr  style="height:15pt">
        <td>
			<table width="100%" cellspacing="0" border="0" >
				<tr>
					<td style="padding-left: 2pt;"><h1>PHOTOMETRIC</h1><br></td>					
				</tr>
				<tr>
					<td><BR>
					
					<?php
						  $idlampiran = $dt->lampiran.'_potometri';
						  $lampiran = json_decode(ecurl('GET','lampiran/'.$idlampiran))->data;
                         if(!empty($lampiran)) {                        
                          foreach ($lampiran as $baris) { 
						echo "<img src='lampiran/".$baris->nama_berkas."' width='160'>&nbsp;";						
							}
						} else {
							echo "<img src='assets/img/noimg.jpg' width='100'>&nbsp;";
						}
					?>
					
					<?php
						  $idlampiran = $dt->lampiran.'_other';
						  $lampiran = json_decode(ecurl('GET','lampiran/'.$idlampiran))->data;
                         if(!empty($lampiran)) {                        
                          foreach ($lampiran as $baris) { 
						echo "<img src='lampiran/".$baris->nama_berkas."' width='160'>&nbsp;";						
							}
						} else {
							echo "<img src='assets/img/noimg.jpg' width='100'>&nbsp;";
						}
					?>
					
					
					</td>				
				</tr>
			</table>	
        </td>
      </tr>	  
    </table>
			
			
			</td>
		</tr>
	</table>
    
    <p style="padding-top: 4pt;padding-left: 80pt;text-indent: 0pt;text-align: left;">
      <a href="mailto:litac@litac_consultant.com" class="a" target="_blank">LITAC Lighting & Acoustic Design Consultant Jakarta, Indonesia · litac@</a><a href="http://litac-consultant.com/" class="a" target="_blank">litac-consultant.com</a>
      <!--<a href="http://litac-consultant.com/" target="_blank">www.litac-consultant.com</a>-->
    </p>
  </body>
</html>